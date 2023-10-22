@php
    Theme::asset()->usePath()
                    ->add('custom-scrollbar-css', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css');
    Theme::asset()->container('footer')->usePath()
                ->add('custom-scrollbar-js', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js', ['jquery']);

    [$categoriesFromFilter, $brands, $tags, $rand, $categoriesRequest, $urlCurrent, $categoryId, $maxFilterPrice] = EcommerceHelper::dataForFilter($category ?? null);

    if (! isset($categories)) {
        $categories = $categoriesFromFilter;
    }

    $categories->loadCount('products');

    if (! Route::is('public.products') && $categoriesRequest) {
        $categories = $categories->whereIn('id', $categoriesRequest)->where('id', '<>', $categoryId);
    }
@endphp

<div class="shop-product-filter-header">
    <div class="row">
        @if ($categories->isNotEmpty())
            <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item product-categories-filter-widget">
                <h5 class="mb-20 widget__title" data-title="{{ __('Categories') }}">{{ __('By :name', ['name' => __('categories')]) }}</h5>
                <div class="custome-checkbox ps-custom-scrollbar">
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.filter-product-category', ['categories' => $categories, 'indent' => null])
                </div>
            </div>
        @endif

        @if ($brands->isNotEmpty())
            <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                <h5 class="mb-20 widget__title" data-title="{{ __('Brand') }}">{{ __('By :name', ['name' => __('Brands')]) }}</h5>
                <div class="custome-checkbox ps-custom-scrollbar">
                    @foreach($brands as $brand)
                        <input class="form-check-input"
                               name="brands[]"
                               type="checkbox"
                               id="brand-filter-{{ $brand->id }}"
                               value="{{ $brand->id }}"
                               @if (in_array($brand->id, request()->input('brands', []))) checked @endif>
                        <label class="form-check-label" for="brand-filter-{{ $brand->id }}"><span class="d-inline-block">{{ $brand->name }}</span> <span class="d-inline-block">({{ $brand->products_count }})</span> </label>
                        <br>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($tags->isNotEmpty())
            <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
                <h5 class="mb-20 widget__title" data-title="{{ __('Tag') }}">{{ __('By :name', ['name' => __('tags')]) }}</h5>
                <div class="custome-checkbox ps-custom-scrollbar">
                    @foreach($tags as $tag)
                        <input class="form-check-input"
                               name="tags[]"
                               type="checkbox"
                               id="tag-filter-{{ $tag->id }}"
                               value="{{ $tag->id }}"
                               @if (in_array($tag->id, request()->input('tags', []))) checked @endif>
                        <label class="form-check-label" for="tag-filter-{{ $tag->id }}"><span class="d-inline-block">{{ $tag->name }}</span> <span class="d-inline-block">({{ $tag->products_count }})</span> </label>
                        <br>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($maxFilterPrice)
            <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="price">
                <h5 class="mb-20 widget__title" data-title="{{ __('Price') }}">{{ __('By :name', ['name' => __('Price')]) }}</h5>
                <div class="price-filter range">
                    <div class="price-filter-inner">
                        <div class="slider-range"></div>
                        <input type="hidden"
                            class="min_price min-range"
                            name="min_price"
                            value="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}"
                            data-min="0"
                            data-label="{{ __('Min price') }}"/>
                        <input type="hidden"
                            class="min_price max-range"
                            name="max_price"
                               value="{{ BaseHelper::stringify(request()->input('max_price', $maxFilterPrice)) }}"
                               data-max="{{ $maxFilterPrice }}"
                            data-label="{{ __('Max price') }}"/>
                        <div class="price_slider_amount">
                            <div class="label-input">
                                <span class="d-inline-block">{{ __('Range:') }} </span>
                                <span class="from d-inline-block"></span>
                                <span class="to d-inline-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <a class="show-advanced-filters" href="#">
        <span class="title">{{ __('Advanced filters') }}</span>
        <i class="far fa-angle-up angle-down"></i>
        <i class="far fa-angle-down angle-up"></i>
    </a>

    <div class="advanced-search-widgets" style="display: none">
        <div class="row">
            {!! render_product_swatches_filter([
                'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
            ]) !!}
        </div>
    </div>

    <div class="widget">
        <a class="clear_filter dib clear_all_filter" href="{{ URL::current() }}">{{ __('Clear All Filter') }}</a>

        <button type="submit" class="btn btn-sm btn-default ms-2"><i class="fa fa-filter mr-5 ml-0"></i> {{ __('Filter') }}</button>
    </div>
</div>
