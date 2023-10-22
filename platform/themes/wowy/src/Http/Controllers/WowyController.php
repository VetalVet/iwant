<?php

namespace Theme\Wowy\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Facades\Cart;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Repositories\Interfaces\ProductCategoryInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Theme\Wowy\Http\Resources\ReviewResource;

class WowyController extends PublicController
{
    public function ajaxCart(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        return $response->setData([
            'count' => Cart::instance('cart')->count(),
            'html' => Theme::partial('cart-panel'),
        ]);
    }

    public function ajaxGetProductReviews(
        int|string $id,
        Request $request,
        BaseHttpResponse $response,
        ProductInterface $productRepository
    ) {
        if (! $request->ajax() || ! $request->wantsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $product = $productRepository->getFirstBy([
            'id' => $id,
            'status' => BaseStatusEnum::PUBLISHED,
            'is_variation' => 0,
        ]);

        if (! $product) {
            abort(404);
        }

        $star = (int)$request->input('star');
        $perPage = (int)$request->input('per_page', 10);

        $reviews = EcommerceHelper::getProductReviews($product, $star, $perPage);

        if ($star) {
            $message = __(':total review(s) ":star star" for ":product"', [
                'total' => $reviews->total(),
                'product' => $product->name,
                'star' => $star,
            ]);
        } else {
            $message = __(':total review(s) for ":product"', [
                'total' => $reviews->total(),
                'product' => $product->name,
            ]);
        }

        return $response
            ->setData(ReviewResource::collection($reviews))
            ->setMessage($message)
            ->toApiResponse();
    }

    public function getQuickView(int|string $id, Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        $product = get_products(
            array_merge([
                'condition' => [
                    'ec_products.id' => $id,
                    'ec_products.status' => BaseStatusEnum::PUBLISHED,
                ],
                'take' => 1,
                'with' => [
                    'slugable',
                    'tags',
                    'tags.slugable',
                    'options' => function ($query) {
                        return $query->with('values');
                    },
                ],
            ], EcommerceHelper::withReviewsParams())
        );

        if (! $product) {
            return $response->setNextUrl(route('public.index'));
        }

        [$productImages, , $selectedAttrs] = EcommerceHelper::getProductVariationInfo($product);

        return $response->setData(Theme::partial('quick-view', compact('product', 'selectedAttrs', 'productImages')));
    }

    public function ajaxGetProductsByCollection(int|string $id, Request $request, BaseHttpResponse $response)
    {
        if (! $request->expectsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $products = get_products_by_collections(array_merge([
            'collections' => [
                'by' => 'id',
                'value_in' => [$id],
            ],
            'take' => $request->integer('limit') ?: 8,
            'with' => EcommerceHelper::withProductEagerLoadingRelations(),
        ], EcommerceHelper::withReviewsParams()));

        $data = [];
        foreach ($products as $product) {
            $data[] = '<div class="col-lg-3 col-md-4 col-12 col-sm-6">' . view(
                Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item',
                compact('product')
            )->render() . '</div>';
        }

        return $response->setData($data);
    }

    public function ajaxGetProductsByCategory(
        int|string $id,
        Request $request,
        BaseHttpResponse $response,
        ProductInterface $productRepository,
        ProductCategoryInterface $productCategoryRepository
    ) {
        if (! $request->expectsJson()) {
            return $response->setNextUrl(route('public.index'));
        }

        $category = $productCategoryRepository->getFirstBy(
            [
                'status' => BaseStatusEnum::PUBLISHED,
                'id' => $id,
            ],
            ['*'],
            [
                'activeChildren' => function ($query) {
                    return $query->limit(3);
                },
            ]
        );

        if (! $category) {
            return $response->setData([]);
        }

        $products = $productRepository->getProductsByCategories(array_merge([
            'categories' => [
                'by' => 'id',
                'value_in' => array_merge([$category->id], $category->activeChildren->pluck('id')->all()),
            ],
            'take' => $request->integer('limit') ?: 8,
        ], EcommerceHelper::withReviewsParams()));

        $data = [];
        foreach ($products as $product) {
            $data[] = '<div class="col-lg-3 col-md-4 col-12 col-sm-6">' . view(
                Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item',
                compact('product')
            )->render() . '</div>';
        }

        return $response->setData($data);
    }
}
