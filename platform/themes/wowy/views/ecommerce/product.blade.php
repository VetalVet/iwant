@php
    $layout = MetaBox::getMetaData($product, 'layout', true);
    $layout = ($layout && in_array($layout, array_keys(get_product_single_layouts()))) ? $layout : 'product-right-sidebar';
    Theme::layout($layout);

    //Theme::asset()->usePath()->add('lightGallery-css', 'plugins/lightGallery/css/lightgallery.min.css');
    //Theme::asset()->container('footer')->usePath()
    //    ->add('lightGallery-js', 'plugins/lightGallery/js/lightgallery.min.js', ['jquery']);

    //Theme::asset()
    //    ->container('header')
    //    ->scriptUsingPath('vue.js', 'plugins/vue.global.min.js');

    //Theme::asset()
    //    ->container('footer')
    //    ->scriptUsingPath('app.js', 'js/app.js');
@endphp

<div class="product-detail accordion-detail">
    <div class="row mb-50">
        {{-- <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="detail-gallery">
                <div class="product-image-slider">
                    @foreach ($productImages as $img)
                        <figure class="border-radius-10">
                            <a href="{{ RvMedia::getImageUrl($img) }}">
                                <img src="{{ RvMedia::getImageUrl($img, 'medium') }}" alt="{{ $product->name }}">
                            </a>
                        </figure>
                    @endforeach
                </div>
                <div class="slider-nav-thumbnails pl-15 pr-15">
                    @foreach ($productImages as $img)
                        <div><img src="{{ RvMedia::getImageUrl($img, 'thumb') }}" alt="{{ $product->name }}"></div>
                    @endforeach
                </div>
            </div>
            <div class="single-social-share clearfix mt-50 mb-15">
                <p class="mb-15 mt-30 font-sm"> <i class="fa fa-share-alt mr-5"></i> <span class="d-inline-block">{{ __('Share this') }}</span></p>
                <div class="mobile-social-icon wow fadeIn  mb-sm-5 mb-md-0 animated">
                    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="twitter" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ strip_tags(strip_tags(SeoHelper::getDescription())) }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&summary={{ rawurldecode(strip_tags(SeoHelper::getDescription())) }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <a class="mail-to-friend font-sm color-grey" href="mailto:someone@example.com?subject={{ __('Buy') }} {{ $product->name }}&body={{ __('Buy this one: :link', ['link' => $product->url]) }}"><i class="far fa-envelope"></i> {{ __('Email to a Friend') }}</a>
        </div> --}}
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="detail-info">
                {{-- <h2 class="title-detail">{{ $product->name }}</h2> --}}
                <div class="product-detail-rating">
                    {{-- @if ($product->brand->id)
                        <div class="pro-details-brand">
                            <span class="d-inline-block me-1">{{ __('Brands') }}:</span> <a href="{{ $product->brand->url }}">{{ $product->brand->name }}</a>
                        </div>
                    @endif --}}

                    {{-- @if (EcommerceHelper::isReviewEnabled())
                        <div class="product-rate-cover text-end">
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                </div>
                                <span class="rating_num">({{ __(':count reviews', ['count' => $product->reviews_count]) }})</span>
                            </div>
                        </div>
                    @endif --}}
                </div>
                {{-- <div class="clearfix product-price-cover">
                    <div class="product-price primary-color float-left">
                        <ins><span class="text-brand">{{ format_price($product->front_sale_price_with_taxes) }}</span></ins>
                        @if ($product->front_sale_price !== $product->price)
                            <ins><span class="old-price font-md ml-15">{{ format_price($product->price_with_taxes) }}</span></ins>
                            <span class="save-price font-md color3 ml-15"><span class="percentage-off d-inline-block">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</span> <span class="d-inline-block">{{ __('Off') }}</span></span>
                        @endif
                    </div>
                </div> --}}
                {{-- <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                <div class="short-desc mb-30">
                    {!! apply_filters('ecommerce_before_product_description', null, $product) !!}
                    {!! BaseHelper::clean($product->description) !!}
                    {!! apply_filters('ecommerce_after_product_description', null, $product) !!}
                </div> --}}

                {{-- <div class="bt-1 border-color-1 mt-30 mb-30"></div> --}}
                <form class="add-to-cart-form" method="POST" action="{{ route('public.cart.add-to-cart') }}">
                    @csrf

                    @if ($product->variations()->count() > 0)
                        <div class="pr_switch_wrap">
                            {!! render_product_swatches($product, [
                                'selected' => $selectedAttrs,
                                'view'     => Theme::getThemeNamespace() . '::views.ecommerce.attributes.swatches-renderer'
                            ]) !!}
                        </div>
                        <div class="number-items-available" style="@if (!$product->isOutOfStock()) display: none; @endif margin-bottom: 10px;">
                            @if ($product->isOutOfStock())
                                <span class="text-danger">({{ __('Out of stock') }})</span>
                            @endif
                        </div>
                    @endif

                    {!! render_product_options($product) !!}

                    {!! apply_filters(ECOMMERCE_PRODUCT_DETAIL_EXTRA_HTML, null, $product) !!}
                    <input type="hidden" name="id" class="hidden-product-id" value="{{ ($product->is_variation || !$product->defaultVariation->product_id) ? $product->id : $product->defaultVariation->product_id }}"/>
                    <div class="detail-extralink">
                        @if (EcommerceHelper::isCartEnabled())
                            <div class="detail-qty border radius">
                                <a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                <input type="number" min="1" value="1" name="qty" class="qty-val qty-input" />
                                <a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                            </div>
                        @endif

                        <div class="product-extra-link2 @if (EcommerceHelper::isQuickBuyButtonEnabled()) has-buy-now-button @endif">
                            @if (EcommerceHelper::isCartEnabled())
                                <button type="submit" class="button button-add-to-cart @if ($product->isOutOfStock()) btn-disabled @endif" type="submit" @if ($product->isOutOfStock()) disabled @endif>{{ __('Add to cart') }}</button>
                                @if (EcommerceHelper::isQuickBuyButtonEnabled())
                                    <button class="button button-buy-now ms-2 @if ($product->isOutOfStock()) btn-disabled @endif" type="submit" name="checkout" @if ($product->isOutOfStock()) disabled @endif>{{ __('Buy Now') }}</button>
                                @endif
                            @endif

                            @if (EcommerceHelper::isWishlistEnabled())
                                <a aria-label="{{ __('Add To Wishlist') }}" class="action-btn hover-up js-add-to-wishlist-button" data-url="{{ route('public.wishlist.add', $product->id) }}" href="#"><i class="far fa-heart"></i></a>
                            @endif
                            @if (EcommerceHelper::isCompareEnabled())
                                <a aria-label="{{ __('Add To Compare') }}" href="#" class="action-btn hover-up js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}"><i class="far fa-exchange-alt"></i></a>
                            @endif
                        </div>
                    </div>
                </form>
                {{-- <ul class="product-meta font-xs color-grey mt-50">

                    <li class="mb-5 @if (! $product->sku) d-none @endif"><span class="d-inline-block me-1" id="product-sku">{{ __('SKU') }}</span>: <span>{{ $product->sku }}</span></li>

                    @if ($product->categories->count())
                        <li class="mb-5"><span class="d-inline-block me-1">{{ __('Categories') }}:</span>
                        @foreach($product->categories as $category)
                            <a href="{{ $category->url }}" title="{{ $category->name }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                        @endforeach
                    </li>
                    @endif
                    @if ($product->tags->count())
                        <li class="mb-5"><span class="d-inline-block me-1">{{ __('Tags') }}:</span>
                        @foreach($product->tags as $tag)
                            <a href="{{ $tag->url }}" rel="tag" title="{{ $tag->name }}">{{ $tag->name }}</a>@if (!$loop->last),@endif
                        @endforeach
                        </li>
                    @endif

                    <li><span class="d-inline-block me-1">{{ __('Availability') }}:</span> <span class="in-stock text-success ml-5">{!! BaseHelper::clean($product->stock_status_html) !!}</span></li>
                </ul> --}}
            </div>
            <!-- Detail Info -->

        </div>
    </div>
    <div class="tab-style3">
        {{-- <ul class="nav nav-tabs text-uppercase">
            <li class="nav-item">
                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">{{ __('Description') }}</a>
            </li>
            @if (EcommerceHelper::isReviewEnabled())
                <li class="nav-item">
                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">{{ __('Reviews') }} ({{ $product->reviews_count }})</a>
                </li>
            @endif
            @if (is_plugin_active('faq'))
                @if (count($product->faq_items) > 0)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-faq">{{ __('Questions and Answers') }}</a>
                    </li>
                @endif
            @endif
        </ul> --}}
        {{-- <div class="tab-content2 shop_info_tab entry-main-content">
            <div class="tab-pane2 fade show active" id="Description">
                <div class="ck-content">
                    {!! BaseHelper::clean($product->content) !!}
                </div>
                @if (theme_option('facebook_comment_enabled_in_product', 'yes') == 'yes')
                    <br />
                    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, Theme::partial('comments')) !!}
                @endif
            </div>

            @if (is_plugin_active('faq') && count($product->faq_items) > 0)
                <div class="tab-pane2 fade faqs-list" id="tab-faq">
                    <div class="accordion" id="faq-accordion">
                        @foreach($product->faq_items as $faq)
                            <div class="card">
                                <div class="card-header" id="heading-faq-{{ $loop->index }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left @if (!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-{{ $loop->index }}" aria-expanded="true" aria-controls="collapse-faq-{{ $loop->index }}">
                                            {!! BaseHelper::clean($faq[0]['value']) !!}
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-faq-{{ $loop->index }}" class="collapse @if ($loop->first) show @endif" aria-labelledby="heading-faq-{{ $loop->index }}" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        {!! BaseHelper::clean($faq[1]['value']) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (EcommerceHelper::isReviewEnabled())
            <div class="tab-pane2 fade" id="Reviews">
                @if ($product->reviews_count > 0)
                    @if (count($product->review_images))
                        <div class="my-3">
                            <h4>{{ __('Images from customer (:count)', ['count' => count($product->review_images)]) }}</h4>
                            <div class="block--review">
                                <div class="block__images row m-0 block__images_total">
                                    @foreach ($product->review_images as $img)
                                        <a href="{{ RvMedia::getImageUrl($img) }}" class="col-lg-1 col-sm-2 col-3 more-review-images @if ($loop->iteration > 6) d-none @endif">
                                            <div class="border position-relative rounded">
                                                <img src="{{ RvMedia::getImageUrl($img, 'thumb') }}" alt="{{ $product->name }}" class="img-responsive rounded h-100">
                                                @if ($loop->iteration == 6 && (count($product->review_images) - $loop->iteration > 0))
                                                    <span>+{{ count($product->review_images) - $loop->iteration }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="comments-area">
                        <div class="row">
                            <div class="col-lg-8 block--product-reviews" id="product-reviews">
                                <h4 class="mb-30">{{ __('Customer questions & answers') }}</h4>
                                <product-reviews-component url="{{ route('public.ajax.product-reviews', $product->id) }}"></product-reviews-component>
                            </div>
                            <div class="col-lg-4">
                                <h4 class="mb-30">{{ __('Customer reviews') }}</h4>
                                <div class="d-flex mb-30">
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                        </div>
                                        <span class="rating_num">({{ __(':avg out of 5', ['avg' => number_format($product->reviews_avg, 2)]) }})</span>
                                    </div>
                                </div>

                                @foreach (EcommerceHelper::getReviewsGroupedByProductId($product->id, $product->reviews_count) as $item)
                                    <div class="progress">
                                        <span>{{ __(':number star', ['number' => $item['star']]) }}</span>

                                        <div class="progress-bar" role="progressbar" style="width: {{ $item['percent'] }}%;" aria-valuenow="{{ $item['percent'] }}" aria-valuemin="0" aria-valuemax="100">{{ $item['percent'] }}%</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <p>{{ __('No reviews!') }}</p>
                @endif
                <div class="comment-form" @if (!$product->reviews_count) style="border: none" @endif>
                    <h4 class="mb-15">{{ __('Add a review') }}</h4>
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            {!! Form::open(['route' => 'public.reviews.create', 'method' => 'post', 'class' => 'form-contact comment_form form-review-product', 'files' => true]) !!}
                                @if (!auth('customer')->check())
                                    <p class="text-danger">{{ __('Please') }} <a href="{{ route('customer.login') }}">{{ __('login') }}</a> {{ __('to write review!') }}</p>
                                @endif
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label>{{ __('Quality') }}</label>
                                    <div class="rate">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="star" value="{{ $i }}" @if ($i == 5) checked @endif>
                                            <label for="star{{ $i }}" title="text">{{ __(':number star', ['number' => $i]) }}</label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="{{ __('Write Comment') }}" @if (!auth('customer')->check()) disabled @endif></textarea>
                                </div>

                                <div class="form-group">
                                    <script type="text/x-custom-template" id="review-image-template">
                                        <span class="image-viewer__item" data-id="__id__">
                                            <img src="{{ RvMedia::getDefaultImage() }}" alt="Preview" class="img-responsive d-block">
                                            <span class="image-viewer__icon-remove">
                                                <i class="far fa-times"></i>
                                            </span>
                                        </span>
                                    </script>
                                    <div class="image-upload__viewer d-flex">
                                        <div class="image-viewer__list position-relative">
                                            <div class="image-upload__uploader-container">
                                                <div class="d-table">
                                                    <div class="image-upload__uploader">
                                                        <i class="far fa-image image-upload__icon"></i>
                                                        <div class="image-upload__text">{{ __('Upload photos') }}</div>
                                                        <input type="file"
                                                               name="images[]"
                                                               data-max-files="{{ EcommerceHelper::reviewMaxFileNumber() }}"
                                                               class="image-upload__file-input"
                                                               accept="image/png,image/jpeg,image/jpg"
                                                               multiple="multiple"
                                                               data-max-size="{{ EcommerceHelper::reviewMaxFileSize(true) }}"
                                                               data-max-size-message="{{ trans('validation.max.file', ['attribute' => '__attribute__', 'max' => '__max__']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="loading">
                                                <div class="half-circle-spinner">
                                                    <div class="circle circle-1"></div>
                                                    <div class="circle circle-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="help-block d-inline-block">
                                            {{ __('You can upload up to :total photos, each photo maximum size is :max kilobytes', [
                                                'total' => EcommerceHelper::reviewMaxFileNumber(),
                                                'max'   => EcommerceHelper::reviewMaxFileSize(true),
                                            ]) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="button button-contactForm" @if (!auth('customer')->check()) disabled @endif>{{ __('Submit Review') }}</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div> --}}
    </div>

    {{-- @php
        $crossSellProducts = get_cross_sale_products($product, $layout == 'product-full-width' ? 4 : 3);
    @endphp
    @if (count($crossSellProducts) > 0)
        <div class="row mt-60">
            <div class="col-12">
                <h3 class="section-title style-1 mb-30">{{ __('You may also like') }}</h3>
            </div>
            @foreach($crossSellProducts as $crossProduct)
                <div class="col-lg-{{ 12 / ($layout == 'product-full-width' ? 4 : 3) }} col-md-4 col-12 col-sm-6">
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', ['product' => $crossProduct])
                </div>
            @endforeach
        </div>
    @endif --}}

    {{-- <div class="row mt-60" id="related-products">
        <div class="col-12">
            <h3 class="section-title style-1 mb-30">{{ __('Related products') }}</h3>
        </div>
        @foreach(get_related_products($product, 6) as $relatedProduct)
            <div class="col-lg-{{ 12 / ($layout == 'product-full-width' ? 4 : 3) }} col-md-4 col-12 col-sm-6">
                @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', ['product' => $relatedProduct])
            </div>
        @endforeach
    </div> --}}
</div>

<section class="product">
    <div class="container">
        <div class="top-product">
            <div class="product-slider swiper-container">
                <div class="product-slider__wrapper swiper-wrapper">
                    @foreach ($productImages as $img)
                        <div class="product-slide swiper-slide">
                            <img width="454" height="487" src="{{ RvMedia::getImageUrl($img, 'medium') }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
                <!-- Добавляем если нам нужны стрелки управления -->
                <div class="product-button-prev">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.89743 6.00007L6.84875 2.04876C7.31734 1.58016 7.31734 0.820412 6.84875 0.351814C6.38015 -0.116783 5.6204 -0.116783 5.15181 0.351814L0.369804 5.13382C0.363769 5.13961 0.357781 5.14548 0.351839 5.15142C-0.116759 5.62001 -0.116759 6.37976 0.351839 6.84836L5.15151 11.648C5.62011 12.1166 6.37986 12.1166 6.84846 11.648C7.31705 11.1794 7.31705 10.4197 6.84846 9.95109L2.89743 6.00007Z"
                            fill="#333333" />
                    </svg>
                </div>
                <div class="product-button-next">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.30276 6.00007L0.351448 2.04876C-0.117149 1.58016 -0.117149 0.820412 0.351448 0.351814C0.820045 -0.116783 1.57979 -0.116783 2.04839 0.351814L6.83039 5.13382C6.83643 5.13961 6.84241 5.14548 6.84836 5.15142C7.31695 5.62001 7.31695 6.37976 6.84836 6.84836L2.04868 11.648C1.58008 12.1166 0.820337 12.1166 0.35174 11.648C-0.116857 11.1794 -0.116857 10.4197 0.35174 9.95109L4.30276 6.00007Z"
                            fill="#333333" />
                    </svg>
                </div>
                <!-- Добавляем, если нам нужна пагинация -->
                <div class="product-pagination"></div>
            </div>

            <div class="product-info">
                <div data-da=".product .top-product, 768, first" class="product-top">
                    <a href="#">
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.93108 3.9999L4.56549 6.63431C4.87791 6.94673 4.87791 7.45327 4.56549 7.76569C4.25307 8.0781 3.74654 8.0781 3.43412 7.76569L0.24462 4.57619C0.24103 4.57273 0.237465 4.56923 0.233925 4.56568C-0.0784949 4.25327 -0.0784948 3.74673 0.233925 3.43431L3.43392 0.234315C3.74634 -0.078105 4.25288 -0.078105 4.5653 0.234315C4.87771 0.546734 4.87771 1.05327 4.5653 1.36568L1.93108 3.9999Z"
                                fill="#333333" />
                        </svg>
                        Чоловічі сумки
                    </a>
                    @if ($product->sku)
                        <span>Артикул: {{ $product->sku }}</span>
                    @endif
                </div>

                <h1>{{ $product->name }}</h1>

                <div class="stock-rating">
                    <!-- <p class="unstock">Немає в наявності</p> -->
                    @if ($product->isOutOfStock())
                        <p class="unstock">{{ __('Out of stock') }}</p>
                    @else
                        <p class="stock">Є в наявності</p>
                    @endif

                    @if (EcommerceHelper::isReviewEnabled())
                        <div class="stars">
                            @for ( $i = 0; $i < round($product->reviews_avg); $i++)
                                <span class="active"></span>
                            @endfor
                            @for ( $i = 0; $i < 5 - round($product->reviews_avg); $i++)
                                <span></span>
                            @endfor
                        </div>
                        <div class="reviews">{{ $product->reviews_count }} відгуків</div>
                    @endif
                </div>
                <div data-da=".product-info .btns, 768, last" class="price">{{ format_price($product->price_with_taxes) }}</div>


                @if ($product->variations()->count() > 0)
                    {{-- <div class="pr_switch_wrap">
                        {!! render_product_swatches($product, [
                            'selected' => $selectedAttrs,
                            'view'     => Theme::getThemeNamespace() . '::views.ecommerce.attributes.swatches-renderer'
                        ]) !!}
                    </div> --}}

                    <div data-da=".product-slider, 768, first" class="variations">
                        {!! render_product_swatches($product, [
                            'selected' => $selectedAttrs,
                            'view'     => Theme::getThemeNamespace() . '::views.ecommerce.attributes.swatches-renderer'
                        ]) !!}
                        {{-- <a class="current" href="{{ route('public.web.get-variation-by-attributes', ['id' => $product->id]) }}"></a>
                        <a href="{{ route('public.web.get-variation-by-attributes', ['id' => $product->id]) }}"></a>
                        <a href="{{ route('public.web.get-variation-by-attributes', ['id' => $product->id]) }}"></a> --}}
                    </div>
                @endif
                <div class="product-quantity">
                    <div class="quantity__button quantity__button_minus">
                        <svg width="16" height="16" viewBox="0 0 16 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.179811 0.797119H15.284C15.4038 0.797119 15.4638 0.857056 15.4638 0.97693V2.32551C15.4638 2.44539 15.4038 2.50533 15.284 2.50533H0.179811C0.0599371 2.50533 0 2.44539 0 2.32551V0.97693C0 0.857056 0.0599371 0.797119 0.179811 0.797119Z" fill="#333333"/>
                        </svg>
                    </div>
                    <div class="quantity__input">
                        <input autocomplete="off" type="text" name="form[]" value="1">
                    </div>
                    <div class="quantity__button quantity__button_plus">
                        <svg width="16" height="16"
                            viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.59387 0.768066H8.94246C9.06233 0.768066 9.12227 0.828003 9.12227 0.947878V16.7713C9.12227 16.8911 9.06233 16.9511 8.94246 16.9511H7.59387C7.474 16.9511 7.41406 16.8911 7.41406 16.7713V0.947878C7.41406 0.828003 7.474 0.768066 7.59387 0.768066Z"
                                fill="#333333" />
                            <path
                                d="M0.714968 8.00562H15.8191C15.939 8.00562 15.9989 8.06555 15.9989 8.18543V9.53401C15.9989 9.65389 15.939 9.71382 15.8191 9.71382H0.714968C0.595093 9.71382 0.535156 9.65389 0.535156 9.53401V8.18543C0.535156 8.06555 0.595093 8.00562 0.714968 8.00562Z"
                                fill="#333333" />
                        </svg>
                    </div>
                </div>

                <form class="btns">
                    <button class="addtocart">
                        <svg class="added-icon" width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.3584 0L9.21121 11.2691L4.07405 5.78687L0.675781 8.97124L8.97511 17.8281L24.5166 3.42337L21.3584 0Z" fill="white"/>
                        </svg>
                        <span>Додати у кошик</span>
                        <svg class="mob-icon" width="27" height="23" viewBox="0 0 27 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.1232 18.4115H23.0133V15.4596H21.5621V18.4115H18.46V19.7961H21.5621V22.9432H23.0133V19.7961H26.1232V18.4115Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.3557 1.78683L17.2856 4.83869H7.67056L10.6004 1.78683C11.0042 1.36622 10.9904 0.697915 10.5698 0.294136C10.1493 -0.109643 9.48097 -0.0960138 9.0772 0.324604L4.85434 4.72341C4.81914 4.76007 4.78712 4.7986 4.75826 4.83869H2.11142C0.945314 4.83869 0 5.78401 0 6.95012C0 7.06642 0.0096091 7.18252 0.0287281 7.29724L1.64123 16.9723C1.89575 18.4994 3.21705 19.6187 4.76528 19.6187H17V17.5073H4.76528C4.2492 17.5073 3.80877 17.1341 3.72392 16.6251L2.11142 6.95012H22.8446L21.6697 14H23.8102L24.9273 7.29724C25.1191 6.14699 24.3421 5.05912 23.1918 4.86742C23.0771 4.8483 22.961 4.83869 22.8446 4.83869H20.1979C20.169 4.7986 20.1369 4.76007 20.1018 4.72341L15.8789 0.324604C15.4751 -0.0960138 14.8069 -0.109643 14.3863 0.294136C13.9657 0.697915 13.9519 1.36622 14.3557 1.78683ZM23.013 17.8899V15.4596H21.5618V18.4116H18.4596V19.6187H20.1909C21.4077 19.6187 22.4843 18.9273 23.013 17.8899ZM13.5338 10.1173C13.5338 9.53423 13.0611 9.06159 12.4781 9.06159C11.895 9.06159 11.4223 9.53423 11.4223 10.1173V14.3402C11.4223 14.9231 11.895 15.3959 12.4781 15.3959C13.0611 15.3959 13.5338 14.9231 13.5338 14.3402V10.1173ZM8.25519 10.1173C8.25519 9.53423 7.78254 9.06159 7.19948 9.06159C6.61643 9.06159 6.14377 9.53423 6.14377 10.1173V14.3402C6.14377 14.9231 6.61643 15.3959 7.19948 15.3959C7.78254 15.3959 8.25519 14.9231 8.25519 14.3402V10.1173ZM18.8123 10.1173C18.8123 9.53423 18.3397 9.06159 17.7566 9.06159C17.1736 9.06159 16.7009 9.53423 16.7009 10.1173V14.3402C16.7009 14.9231 17.1736 15.3959 17.7566 15.3959C18.3397 15.3959 18.8123 14.9231 18.8123 14.3402V10.1173Z"
                                fill="white" />
                        </svg>
                    </button>

                    <a href="#add_featured_unlogin" class="featured _popup-link">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.6 2.22222C4.16995 2.22222 2.2 4.21207 2.2 6.66667C2.2 6.70067 2.20038 6.73457 2.20112 6.76835C2.20145 6.78301 2.20148 6.79767 2.20123 6.81234C2.20042 6.86023 2.2 6.90902 2.2 6.9587C2.2 10.5914 4.15083 13.2893 6.34071 15.1283C7.43243 16.0451 8.55869 16.725 9.47008 17.1726C9.9256 17.3964 10.3173 17.5571 10.6137 17.6591C10.8285 17.7331 10.95 17.761 10.9957 17.7714C10.9971 17.7718 10.9985 17.7721 10.9998 17.7724C11.0012 17.7721 11.0026 17.7717 11.0041 17.7714C11.0499 17.7609 11.1711 17.7329 11.3855 17.6589C11.6819 17.5566 12.0736 17.3956 12.5292 17.1714C13.4407 16.7229 14.5671 16.0419 15.659 15.1244C17.8495 13.2836 19.8 10.5856 19.8 6.9587C19.8 6.90905 19.7996 6.86032 19.7988 6.81249C19.7985 6.7978 19.7986 6.78311 19.7989 6.76843C19.7996 6.73463 19.8 6.7007 19.8 6.66667C19.8 4.21207 17.8301 2.22222 15.4 2.22222C13.9614 2.22222 12.6841 2.91844 11.8794 4.00021C11.6717 4.27956 11.3459 4.44391 11 4.44391C10.6541 4.44391 10.3283 4.27956 10.1206 4.00021C9.31594 2.91844 8.03862 2.22222 6.6 2.22222ZM0 6.66667C0 2.98477 2.95492 0 6.6 0C8.29078 0 9.83309 0.642919 11 1.69768C12.1669 0.642919 13.7092 0 15.4 0C19.0451 0 22 2.98477 22 6.66667C22 6.70975 21.9996 6.75276 21.9988 6.79568C21.9996 6.84954 22 6.90388 22 6.9587C22 11.4778 19.5505 14.7448 17.066 16.8327C15.8204 17.8794 14.5406 18.6536 13.4927 19.1692C12.9685 19.4271 12.4923 19.6253 12.0969 19.7618C11.749 19.8819 11.3377 20 11 20C10.6629 20 10.2519 19.8824 9.90387 19.7625C9.50849 19.6264 9.03222 19.4286 8.50804 19.1711C7.46006 18.6564 6.18007 17.8833 4.93429 16.8371C2.44917 14.7502 0 11.4831 0 6.9587C0 6.90385 0.000404668 6.84949 0.0012142 6.79562C0.000405782 6.75272 0 6.70974 0 6.66667Z"
                                fill="#BCBCBC" />
                        </svg>
                    </a>
                    <a href="#get_featured" class="compare _popup-link">
                        <svg width="29" height="20" viewBox="0 0 29 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.0143 12.8575H0V15.7146H10.0143V20.0003L15.7143 14.2861L10.0143 8.57178V12.8575Z"
                                fill="#BCBCBC" />
                            <path
                                d="M18.5613 4.28571V0L12.8613 5.71427L18.5613 11.4285V7.14284H28.5756V4.28571H18.5613Z"
                                fill="#BCBCBC" />
                        </svg>
                    </a>
                </form>

            </div>
        </div>

        <div class="bot-product">
            <div class="product-tabs">
                <div class="nav-tabs">
                    <a href="#" data-tab="1" class="nav-tab active">Опис</a>
                    <a href="#" data-tab="2" class="nav-tab">Характеристика</a>
                    {{-- @if (EcommerceHelper::isReviewEnabled())
                        <a href="#" data-tab="3" class="nav-tab">Відгуки ({{ $product->reviews_count }})</a>
                    @endif --}}
                </div>
                <div class="tab-content">
                    <div data-tab-content="1" class="tab-pane description active">
                        <div class="text">
                            {!! apply_filters('ecommerce_before_product_description', null, $product) !!}
                            {!! BaseHelper::clean($product->description) !!}
                            {!! apply_filters('ecommerce_after_product_description', null, $product) !!}
                        </div>
                        <a class="moretext" data-text="Приховати" href="#">Показати більше</a>
                    </div>
                    <div data-tab-content="2" class="tab-pane characteristics">
                        {!! BaseHelper::clean($product->content) !!}
                    </div>
                    {{-- @if (EcommerceHelper::isReviewEnabled())
                        <div data-tab-content="3" class="tab-pane testimonials">
                            <!-- Если есть комментарии -->
                            @if ($product->reviews_count > 0)
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8 block--product-reviews" id="product-reviews">
                                            <h4 class="mb-30">{{ __('Customer questions & answers') }}</h4>
                                            
                                            <product-reviews-component url="{{ route('public.ajax.product-reviews', $product->id) }}"></product-reviews-component>
                                        </div>
                                        <div class="col-lg-4">
                                            <h4 class="mb-30">{{ __('Customer reviews') }}</h4>
                                            <div class="d-flex mb-30">
                                                <div class="rating_wrap">
                                                    <div class="rating">
                                                        <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                                    </div>
                                                    <span class="rating_num">({{ __(':avg out of 5', ['avg' => number_format($product->reviews_avg, 2)]) }})</span>
                                                </div>
                                            </div>

                                            @foreach (EcommerceHelper::getReviewsGroupedByProductId($product->id, $product->reviews_count) as $item)
                                                <div class="progress">
                                                    <span>{{ __(':number star', ['number' => $item['star']]) }}</span>

                                                    <div class="progress-bar" role="progressbar" style="width: {{ $item['percent'] }}%;" aria-valuenow="{{ $item['percent'] }}" aria-valuemin="0" aria-valuemax="100">{{ $item['percent'] }}%</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="comments">
                                    <div class="comment">
                                        <div class="name">Олег</div>
                                        <div class="stars">
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                        </div>
                                        <div class="date">
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8333 3.25V2.70833C10.8333 2.40918 10.5908 2.16667 10.2917 2.16667H1.625C1.32585 2.16667 1.08333 2.40918 1.08333 2.70833V3.25H10.8333ZM10.8333 4.33333H1.08333V11.375C1.08333 11.6742 1.32585 11.9167 1.625 11.9167H10.2917C10.5908 11.9167 10.8333 11.6742 10.8333 11.375V4.33333ZM9.75 1.08333H10.2917C11.1892 1.08333 11.9167 1.81087 11.9167 2.70833V11.375C11.9167 12.2725 11.1892 13 10.2917 13H1.625C0.72754 13 0 12.2725 0 11.375V2.70833C0 1.81087 0.72754 1.08333 1.625 1.08333H2.16667V0.541667C2.16667 0.242512 2.40918 0 2.70833 0C3.00749 0 3.25 0.242512 3.25 0.541667V1.08333H8.66667V0.541667C8.66667 0.242512 8.90917 0 9.20833 0C9.5075 0 9.75 0.242512 9.75 0.541667V1.08333ZM2.70833 9.75C3.00749 9.75 3.25 9.9925 3.25 10.2917C3.25 10.5908 3.00749 10.8333 2.70833 10.8333C2.40918 10.8333 2.16667 10.5908 2.16667 10.2917C2.16667 9.9925 2.40918 9.75 2.70833 9.75ZM4.875 9.75C5.17416 9.75 5.41667 9.9925 5.41667 10.2917C5.41667 10.5908 5.17416 10.8333 4.875 10.8333C4.57585 10.8333 4.33333 10.5908 4.33333 10.2917C4.33333 9.9925 4.57585 9.75 4.875 9.75ZM7.04167 9.75C7.34083 9.75 7.58333 9.9925 7.58333 10.2917C7.58333 10.5908 7.34083 10.8333 7.04167 10.8333C6.7425 10.8333 6.5 10.5908 6.5 10.2917C6.5 9.9925 6.7425 9.75 7.04167 9.75ZM2.70833 7.58333C3.00749 7.58333 3.25 7.82584 3.25 8.125C3.25 8.42416 3.00749 8.66667 2.70833 8.66667C2.40918 8.66667 2.16667 8.42416 2.16667 8.125C2.16667 7.82584 2.40918 7.58333 2.70833 7.58333ZM4.875 7.58333C5.17416 7.58333 5.41667 7.82584 5.41667 8.125C5.41667 8.42416 5.17416 8.66667 4.875 8.66667C4.57585 8.66667 4.33333 8.42416 4.33333 8.125C4.33333 7.82584 4.57585 7.58333 4.875 7.58333ZM7.04167 7.58333C7.34083 7.58333 7.58333 7.82584 7.58333 8.125C7.58333 8.42416 7.34083 8.66667 7.04167 8.66667C6.7425 8.66667 6.5 8.42416 6.5 8.125C6.5 7.82584 6.7425 7.58333 7.04167 7.58333ZM2.70833 5.41667C3.00749 5.41667 3.25 5.65917 3.25 5.95833C3.25 6.2575 3.00749 6.5 2.70833 6.5C2.40918 6.5 2.16667 6.2575 2.16667 5.95833C2.16667 5.65917 2.40918 5.41667 2.70833 5.41667ZM4.875 5.41667C5.17416 5.41667 5.41667 5.65917 5.41667 5.95833C5.41667 6.2575 5.17416 6.5 4.875 6.5C4.57585 6.5 4.33333 6.2575 4.33333 5.95833C4.33333 5.65917 4.57585 5.41667 4.875 5.41667ZM7.04167 5.41667C7.34083 5.41667 7.58333 5.65917 7.58333 5.95833C7.58333 6.2575 7.34083 6.5 7.04167 6.5C6.7425 6.5 6.5 6.2575 6.5 5.95833C6.5 5.65917 6.7425 5.41667 7.04167 5.41667ZM9.20833 9.75C9.5075 9.75 9.75 9.9925 9.75 10.2917C9.75 10.5908 9.5075 10.8333 9.20833 10.8333C8.90917 10.8333 8.66667 10.5908 8.66667 10.2917C8.66667 9.9925 8.90917 9.75 9.20833 9.75ZM9.20833 7.58333C9.5075 7.58333 9.75 7.82584 9.75 8.125C9.75 8.42416 9.5075 8.66667 9.20833 8.66667C8.90917 8.66667 8.66667 8.42416 8.66667 8.125C8.66667 7.82584 8.90917 7.58333 9.20833 7.58333ZM9.20833 5.41667C9.5075 5.41667 9.75 5.65917 9.75 5.95833C9.75 6.2575 9.5075 6.5 9.20833 6.5C8.90917 6.5 8.66667 6.2575 8.66667 5.95833C8.66667 5.65917 8.90917 5.41667 9.20833 5.41667Z"
                                                    fill="#A7A7A7" />
                                            </svg>
                                            10.02.22
                                        </div>

                                        <div class="text-comment">Спасибо огромное за данную статью, было очень полезно!
                                            Все применю. Еще раз спасибо!</div>
                                    </div>
                                    <div class="comment replied">
                                        <div class="name">SocolPack</div>
                                        <div class="verified">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.55041 0.652671C7.34851 0.446069 7.10735 0.281903 6.8411 0.16982C6.57485 0.0577377 6.28888 0 6 0C5.71112 0 5.42515 0.0577377 5.1589 0.16982C4.89265 0.281903 4.65149 0.446069 4.44959 0.652671L3.98305 1.13119L3.31548 1.12294C3.02651 1.11952 2.73978 1.17391 2.47214 1.28291C2.2045 1.39191 1.96136 1.55333 1.75702 1.75766C1.55267 1.96199 1.39125 2.20511 1.28224 2.47274C1.17323 2.74036 1.11884 3.02707 1.12226 3.31602L1.12976 3.98355L0.652712 4.45007C0.446097 4.65195 0.28192 4.8931 0.169831 5.15933C0.0577413 5.42556 0 5.71151 0 6.00038C0 6.28924 0.0577413 6.57519 0.169831 6.84142C0.28192 7.10765 0.446097 7.3488 0.652712 7.55068L1.13051 8.0172L1.12226 8.68473C1.11884 8.97368 1.17323 9.26039 1.28224 9.52801C1.39125 9.79564 1.55267 10.0388 1.75702 10.2431C1.96136 10.4474 2.2045 10.6088 2.47214 10.7178C2.73978 10.8268 3.02651 10.8812 3.31548 10.8778L3.98305 10.8703L4.44959 11.3473C4.65149 11.5539 4.89265 11.7181 5.1589 11.8302C5.42515 11.9423 5.71112 12 6 12C6.28888 12 6.57485 11.9423 6.8411 11.8302C7.10735 11.7181 7.34851 11.5539 7.55041 11.3473L8.01695 10.8696L8.68452 10.8778C8.97349 10.8812 9.26022 10.8268 9.52786 10.7178C9.7955 10.6088 10.0386 10.4474 10.243 10.2431C10.4473 10.0388 10.6088 9.79564 10.7178 9.52801C10.8268 9.26039 10.8812 8.97368 10.8777 8.68473L10.8702 8.0172L11.3473 7.55068C11.5539 7.3488 11.7181 7.10765 11.8302 6.84142C11.9423 6.57519 12 6.28924 12 6.00038C12 5.71151 11.9423 5.42556 11.8302 5.15933C11.7181 4.8931 11.5539 4.65195 11.3473 4.45007L10.8695 3.98355L10.8777 3.31602C10.8812 3.02707 10.8268 2.74036 10.7178 2.47274C10.6088 2.20511 10.4473 1.96199 10.243 1.75766C10.0386 1.55333 9.7955 1.39191 9.52786 1.28291C9.26022 1.17391 8.97349 1.11952 8.68452 1.12294L8.01695 1.13044L7.55041 0.653421V0.652671ZM7.76568 5.14084L5.51545 7.39093C5.48061 7.42585 5.43923 7.45356 5.39366 7.47247C5.3481 7.49137 5.29925 7.5011 5.24992 7.5011C5.20059 7.5011 5.15175 7.49137 5.10618 7.47247C5.06062 7.45356 5.01924 7.42585 4.9844 7.39093L3.85928 6.26589C3.82441 6.23102 3.79676 6.18962 3.77788 6.14407C3.75901 6.09851 3.7493 6.04969 3.7493 6.00038C3.7493 5.95107 3.75901 5.90224 3.77788 5.85668C3.79676 5.81113 3.82441 5.76973 3.85928 5.73486C3.89415 5.7 3.93555 5.67234 3.98111 5.65347C4.02667 5.6346 4.0755 5.62489 4.12481 5.62489C4.17412 5.62489 4.22295 5.6346 4.26851 5.65347C4.31407 5.67234 4.35547 5.7 4.39034 5.73486L5.24992 6.59515L7.23462 4.60982C7.30505 4.5394 7.40056 4.49984 7.50015 4.49984C7.59974 4.49984 7.69526 4.5394 7.76568 4.60982C7.8361 4.68024 7.87566 4.77575 7.87566 4.87533C7.87566 4.97492 7.8361 5.07042 7.76568 5.14084Z"
                                                    fill="#4FA3DF" />
                                            </svg>
                                        </div>
                                        <div class="date">
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8333 3.25V2.70833C10.8333 2.40918 10.5908 2.16667 10.2917 2.16667H1.625C1.32585 2.16667 1.08333 2.40918 1.08333 2.70833V3.25H10.8333ZM10.8333 4.33333H1.08333V11.375C1.08333 11.6742 1.32585 11.9167 1.625 11.9167H10.2917C10.5908 11.9167 10.8333 11.6742 10.8333 11.375V4.33333ZM9.75 1.08333H10.2917C11.1892 1.08333 11.9167 1.81087 11.9167 2.70833V11.375C11.9167 12.2725 11.1892 13 10.2917 13H1.625C0.72754 13 0 12.2725 0 11.375V2.70833C0 1.81087 0.72754 1.08333 1.625 1.08333H2.16667V0.541667C2.16667 0.242512 2.40918 0 2.70833 0C3.00749 0 3.25 0.242512 3.25 0.541667V1.08333H8.66667V0.541667C8.66667 0.242512 8.90917 0 9.20833 0C9.5075 0 9.75 0.242512 9.75 0.541667V1.08333ZM2.70833 9.75C3.00749 9.75 3.25 9.9925 3.25 10.2917C3.25 10.5908 3.00749 10.8333 2.70833 10.8333C2.40918 10.8333 2.16667 10.5908 2.16667 10.2917C2.16667 9.9925 2.40918 9.75 2.70833 9.75ZM4.875 9.75C5.17416 9.75 5.41667 9.9925 5.41667 10.2917C5.41667 10.5908 5.17416 10.8333 4.875 10.8333C4.57585 10.8333 4.33333 10.5908 4.33333 10.2917C4.33333 9.9925 4.57585 9.75 4.875 9.75ZM7.04167 9.75C7.34083 9.75 7.58333 9.9925 7.58333 10.2917C7.58333 10.5908 7.34083 10.8333 7.04167 10.8333C6.7425 10.8333 6.5 10.5908 6.5 10.2917C6.5 9.9925 6.7425 9.75 7.04167 9.75ZM2.70833 7.58333C3.00749 7.58333 3.25 7.82584 3.25 8.125C3.25 8.42416 3.00749 8.66667 2.70833 8.66667C2.40918 8.66667 2.16667 8.42416 2.16667 8.125C2.16667 7.82584 2.40918 7.58333 2.70833 7.58333ZM4.875 7.58333C5.17416 7.58333 5.41667 7.82584 5.41667 8.125C5.41667 8.42416 5.17416 8.66667 4.875 8.66667C4.57585 8.66667 4.33333 8.42416 4.33333 8.125C4.33333 7.82584 4.57585 7.58333 4.875 7.58333ZM7.04167 7.58333C7.34083 7.58333 7.58333 7.82584 7.58333 8.125C7.58333 8.42416 7.34083 8.66667 7.04167 8.66667C6.7425 8.66667 6.5 8.42416 6.5 8.125C6.5 7.82584 6.7425 7.58333 7.04167 7.58333ZM2.70833 5.41667C3.00749 5.41667 3.25 5.65917 3.25 5.95833C3.25 6.2575 3.00749 6.5 2.70833 6.5C2.40918 6.5 2.16667 6.2575 2.16667 5.95833C2.16667 5.65917 2.40918 5.41667 2.70833 5.41667ZM4.875 5.41667C5.17416 5.41667 5.41667 5.65917 5.41667 5.95833C5.41667 6.2575 5.17416 6.5 4.875 6.5C4.57585 6.5 4.33333 6.2575 4.33333 5.95833C4.33333 5.65917 4.57585 5.41667 4.875 5.41667ZM7.04167 5.41667C7.34083 5.41667 7.58333 5.65917 7.58333 5.95833C7.58333 6.2575 7.34083 6.5 7.04167 6.5C6.7425 6.5 6.5 6.2575 6.5 5.95833C6.5 5.65917 6.7425 5.41667 7.04167 5.41667ZM9.20833 9.75C9.5075 9.75 9.75 9.9925 9.75 10.2917C9.75 10.5908 9.5075 10.8333 9.20833 10.8333C8.90917 10.8333 8.66667 10.5908 8.66667 10.2917C8.66667 9.9925 8.90917 9.75 9.20833 9.75ZM9.20833 7.58333C9.5075 7.58333 9.75 7.82584 9.75 8.125C9.75 8.42416 9.5075 8.66667 9.20833 8.66667C8.90917 8.66667 8.66667 8.42416 8.66667 8.125C8.66667 7.82584 8.90917 7.58333 9.20833 7.58333ZM9.20833 5.41667C9.5075 5.41667 9.75 5.65917 9.75 5.95833C9.75 6.2575 9.5075 6.5 9.20833 6.5C8.90917 6.5 8.66667 6.2575 8.66667 5.95833C8.66667 5.65917 8.90917 5.41667 9.20833 5.41667Z"
                                                    fill="#A7A7A7" />
                                            </svg>
                                            10.02.22
                                        </div>

                                        <div class="text-comment">Спасибо огромное за отзыв!</div>
                                    </div>
                                    <div class="comment">
                                        <div class="name">Оксана</div>
                                        <div class="stars">
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="date">
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8333 3.25V2.70833C10.8333 2.40918 10.5908 2.16667 10.2917 2.16667H1.625C1.32585 2.16667 1.08333 2.40918 1.08333 2.70833V3.25H10.8333ZM10.8333 4.33333H1.08333V11.375C1.08333 11.6742 1.32585 11.9167 1.625 11.9167H10.2917C10.5908 11.9167 10.8333 11.6742 10.8333 11.375V4.33333ZM9.75 1.08333H10.2917C11.1892 1.08333 11.9167 1.81087 11.9167 2.70833V11.375C11.9167 12.2725 11.1892 13 10.2917 13H1.625C0.72754 13 0 12.2725 0 11.375V2.70833C0 1.81087 0.72754 1.08333 1.625 1.08333H2.16667V0.541667C2.16667 0.242512 2.40918 0 2.70833 0C3.00749 0 3.25 0.242512 3.25 0.541667V1.08333H8.66667V0.541667C8.66667 0.242512 8.90917 0 9.20833 0C9.5075 0 9.75 0.242512 9.75 0.541667V1.08333ZM2.70833 9.75C3.00749 9.75 3.25 9.9925 3.25 10.2917C3.25 10.5908 3.00749 10.8333 2.70833 10.8333C2.40918 10.8333 2.16667 10.5908 2.16667 10.2917C2.16667 9.9925 2.40918 9.75 2.70833 9.75ZM4.875 9.75C5.17416 9.75 5.41667 9.9925 5.41667 10.2917C5.41667 10.5908 5.17416 10.8333 4.875 10.8333C4.57585 10.8333 4.33333 10.5908 4.33333 10.2917C4.33333 9.9925 4.57585 9.75 4.875 9.75ZM7.04167 9.75C7.34083 9.75 7.58333 9.9925 7.58333 10.2917C7.58333 10.5908 7.34083 10.8333 7.04167 10.8333C6.7425 10.8333 6.5 10.5908 6.5 10.2917C6.5 9.9925 6.7425 9.75 7.04167 9.75ZM2.70833 7.58333C3.00749 7.58333 3.25 7.82584 3.25 8.125C3.25 8.42416 3.00749 8.66667 2.70833 8.66667C2.40918 8.66667 2.16667 8.42416 2.16667 8.125C2.16667 7.82584 2.40918 7.58333 2.70833 7.58333ZM4.875 7.58333C5.17416 7.58333 5.41667 7.82584 5.41667 8.125C5.41667 8.42416 5.17416 8.66667 4.875 8.66667C4.57585 8.66667 4.33333 8.42416 4.33333 8.125C4.33333 7.82584 4.57585 7.58333 4.875 7.58333ZM7.04167 7.58333C7.34083 7.58333 7.58333 7.82584 7.58333 8.125C7.58333 8.42416 7.34083 8.66667 7.04167 8.66667C6.7425 8.66667 6.5 8.42416 6.5 8.125C6.5 7.82584 6.7425 7.58333 7.04167 7.58333ZM2.70833 5.41667C3.00749 5.41667 3.25 5.65917 3.25 5.95833C3.25 6.2575 3.00749 6.5 2.70833 6.5C2.40918 6.5 2.16667 6.2575 2.16667 5.95833C2.16667 5.65917 2.40918 5.41667 2.70833 5.41667ZM4.875 5.41667C5.17416 5.41667 5.41667 5.65917 5.41667 5.95833C5.41667 6.2575 5.17416 6.5 4.875 6.5C4.57585 6.5 4.33333 6.2575 4.33333 5.95833C4.33333 5.65917 4.57585 5.41667 4.875 5.41667ZM7.04167 5.41667C7.34083 5.41667 7.58333 5.65917 7.58333 5.95833C7.58333 6.2575 7.34083 6.5 7.04167 6.5C6.7425 6.5 6.5 6.2575 6.5 5.95833C6.5 5.65917 6.7425 5.41667 7.04167 5.41667ZM9.20833 9.75C9.5075 9.75 9.75 9.9925 9.75 10.2917C9.75 10.5908 9.5075 10.8333 9.20833 10.8333C8.90917 10.8333 8.66667 10.5908 8.66667 10.2917C8.66667 9.9925 8.90917 9.75 9.20833 9.75ZM9.20833 7.58333C9.5075 7.58333 9.75 7.82584 9.75 8.125C9.75 8.42416 9.5075 8.66667 9.20833 8.66667C8.90917 8.66667 8.66667 8.42416 8.66667 8.125C8.66667 7.82584 8.90917 7.58333 9.20833 7.58333ZM9.20833 5.41667C9.5075 5.41667 9.75 5.65917 9.75 5.95833C9.75 6.2575 9.5075 6.5 9.20833 6.5C8.90917 6.5 8.66667 6.2575 8.66667 5.95833C8.66667 5.65917 8.90917 5.41667 9.20833 5.41667Z"
                                                    fill="#A7A7A7" />
                                            </svg>
                                            01.08.21
                                        </div>

                                        <div class="text-comment">Спасибо огромное за данную статью, было очень</div>
                                    </div>
                                    <div class="comment">
                                        <div class="name">Сергей</div>
                                        <div class="stars">
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span class="active"></span>
                                            <span></span>
                                        </div>
                                        <div class="date">
                                            <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8333 3.25V2.70833C10.8333 2.40918 10.5908 2.16667 10.2917 2.16667H1.625C1.32585 2.16667 1.08333 2.40918 1.08333 2.70833V3.25H10.8333ZM10.8333 4.33333H1.08333V11.375C1.08333 11.6742 1.32585 11.9167 1.625 11.9167H10.2917C10.5908 11.9167 10.8333 11.6742 10.8333 11.375V4.33333ZM9.75 1.08333H10.2917C11.1892 1.08333 11.9167 1.81087 11.9167 2.70833V11.375C11.9167 12.2725 11.1892 13 10.2917 13H1.625C0.72754 13 0 12.2725 0 11.375V2.70833C0 1.81087 0.72754 1.08333 1.625 1.08333H2.16667V0.541667C2.16667 0.242512 2.40918 0 2.70833 0C3.00749 0 3.25 0.242512 3.25 0.541667V1.08333H8.66667V0.541667C8.66667 0.242512 8.90917 0 9.20833 0C9.5075 0 9.75 0.242512 9.75 0.541667V1.08333ZM2.70833 9.75C3.00749 9.75 3.25 9.9925 3.25 10.2917C3.25 10.5908 3.00749 10.8333 2.70833 10.8333C2.40918 10.8333 2.16667 10.5908 2.16667 10.2917C2.16667 9.9925 2.40918 9.75 2.70833 9.75ZM4.875 9.75C5.17416 9.75 5.41667 9.9925 5.41667 10.2917C5.41667 10.5908 5.17416 10.8333 4.875 10.8333C4.57585 10.8333 4.33333 10.5908 4.33333 10.2917C4.33333 9.9925 4.57585 9.75 4.875 9.75ZM7.04167 9.75C7.34083 9.75 7.58333 9.9925 7.58333 10.2917C7.58333 10.5908 7.34083 10.8333 7.04167 10.8333C6.7425 10.8333 6.5 10.5908 6.5 10.2917C6.5 9.9925 6.7425 9.75 7.04167 9.75ZM2.70833 7.58333C3.00749 7.58333 3.25 7.82584 3.25 8.125C3.25 8.42416 3.00749 8.66667 2.70833 8.66667C2.40918 8.66667 2.16667 8.42416 2.16667 8.125C2.16667 7.82584 2.40918 7.58333 2.70833 7.58333ZM4.875 7.58333C5.17416 7.58333 5.41667 7.82584 5.41667 8.125C5.41667 8.42416 5.17416 8.66667 4.875 8.66667C4.57585 8.66667 4.33333 8.42416 4.33333 8.125C4.33333 7.82584 4.57585 7.58333 4.875 7.58333ZM7.04167 7.58333C7.34083 7.58333 7.58333 7.82584 7.58333 8.125C7.58333 8.42416 7.34083 8.66667 7.04167 8.66667C6.7425 8.66667 6.5 8.42416 6.5 8.125C6.5 7.82584 6.7425 7.58333 7.04167 7.58333ZM2.70833 5.41667C3.00749 5.41667 3.25 5.65917 3.25 5.95833C3.25 6.2575 3.00749 6.5 2.70833 6.5C2.40918 6.5 2.16667 6.2575 2.16667 5.95833C2.16667 5.65917 2.40918 5.41667 2.70833 5.41667ZM4.875 5.41667C5.17416 5.41667 5.41667 5.65917 5.41667 5.95833C5.41667 6.2575 5.17416 6.5 4.875 6.5C4.57585 6.5 4.33333 6.2575 4.33333 5.95833C4.33333 5.65917 4.57585 5.41667 4.875 5.41667ZM7.04167 5.41667C7.34083 5.41667 7.58333 5.65917 7.58333 5.95833C7.58333 6.2575 7.34083 6.5 7.04167 6.5C6.7425 6.5 6.5 6.2575 6.5 5.95833C6.5 5.65917 6.7425 5.41667 7.04167 5.41667ZM9.20833 9.75C9.5075 9.75 9.75 9.9925 9.75 10.2917C9.75 10.5908 9.5075 10.8333 9.20833 10.8333C8.90917 10.8333 8.66667 10.5908 8.66667 10.2917C8.66667 9.9925 8.90917 9.75 9.20833 9.75ZM9.20833 7.58333C9.5075 7.58333 9.75 7.82584 9.75 8.125C9.75 8.42416 9.5075 8.66667 9.20833 8.66667C8.90917 8.66667 8.66667 8.42416 8.66667 8.125C8.66667 7.82584 8.90917 7.58333 9.20833 7.58333ZM9.20833 5.41667C9.5075 5.41667 9.75 5.65917 9.75 5.95833C9.75 6.2575 9.5075 6.5 9.20833 6.5C8.90917 6.5 8.66667 6.2575 8.66667 5.95833C8.66667 5.65917 8.90917 5.41667 9.20833 5.41667Z"
                                                    fill="#A7A7A7" />
                                            </svg>
                                            15.03.21
                                        </div>

                                        <div class="text-comment">Спасибо огромное за данную статью, было очень полезно!
                                            Все применю. Спасибо огромное за данную статью, было очень полезно! Все
                                            применю.</div>
                                    </div>

                                    <a href="#" class="loadcomments">Показати більше відгуків</a>
                                </div>

                                <div class="leave-comment">
                                    <p>Залиште ваш відгук. <br>
                                        Для нас це дуже важливо!</p>
                                    <a class="leave-btn _popup-link" href="#review_unlogin">Залишити відгук</a>
                                </div>
                            @else
                                <!-- Если нет комментариев -->
                                <div class="no-comments">
                                    <p>Про цей товар ще немає відгуків. <br> Станьте першим!</p>
                                    <a class="leave-btn _popup-link" href="#review_unlogin">Залишити відгук</a>
                                </div>
                            @endif

                            <form action="" class="comment-form _hidden">
                                <div class="input">
                                    <input type="text" placeholder="Ваше ім’я">
                                </div>
                                <div class="input tel">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.3222 8.55107L9.69619 6.92506C9.11547 6.34434 8.12825 6.57665 7.89597 7.33156C7.72175 7.85423 7.14103 8.14459 6.61839 8.02842C5.45695 7.73807 3.88901 6.2282 3.59865 5.00869C3.42444 4.48602 3.77287 3.9053 4.29552 3.73111C5.05045 3.49882 5.28274 2.5116 4.70202 1.93089L3.07601 0.304877C2.61143 -0.101626 1.91457 -0.101626 1.50807 0.304877L0.404706 1.40824C-0.698658 2.56968 0.52085 5.64748 3.25022 8.37685C5.9796 11.1062 9.0574 12.3838 10.2188 11.2224L11.3222 10.119C11.7287 9.65443 11.7287 8.95757 11.3222 8.55107Z"
                                            fill="#A7A7A7" />
                                    </svg>

                                    <input class="phone-ukr" type="text" placeholder="+38 ___ ___ __ __">
                                </div>

                                <div class="text">
                                    <textarea placeholder="Введіть ваш комментар"></textarea>
                                </div>

                                <p class="rating-title">Оцінка:</p>

                                <div class="simple-rating">
                                    <div class="simple-rating__items">
                                        <input id="simple-rating__5" type="radio" class="simple-rating__item"
                                            name="rating" value="5">
                                        <label for="simple-rating__5" class="simple-rating__label"></label>
                                        <input id="simple-rating__4" type="radio" class="simple-rating__item"
                                            name="rating" value="4">
                                        <label for="simple-rating__4" class="simple-rating__label"></label>
                                        <input id="simple-rating__3" type="radio" class="simple-rating__item"
                                            checked name="rating" value="3">
                                        <label for="simple-rating__3" class="simple-rating__label"></label>
                                        <input id="simple-rating__2" type="radio" class="simple-rating__item"
                                            name="rating" value="2">
                                        <label for="simple-rating__2" class="simple-rating__label"></label>
                                        <input id="simple-rating__1" type="radio" class="simple-rating__item"
                                            name="rating" value="1">
                                        <label for="simple-rating__1" class="simple-rating__label"></label>
                                    </div>
                                </div>

                                <button href="#review_published" class="_popup-link">Залишити відгук</button>
                            </form>
                        </div>
                    @endif --}}
                </div>
            </div>

            @php
                $crossSellProducts = get_cross_sale_products($product, $layout == 'product-full-width' ? 4 : 3);
            @endphp
            @if (count($crossSellProducts) > 0)
                <div class="upsells">
                    <p>Разом з цим купують</p>

                    <div class="upsell-slider swiper-container">
                        <div class="upsell-slider__wrapper swiper-wrapper">
                            @foreach($crossSellProducts as $crossProduct)
                                @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', ['product' => $crossProduct])
                            @endforeach
                        </div>
                        <!-- Добавляем, если нам нужна пагинация -->
                        <div class="upsell-pagination"></div>
                    </div>
                
                    <!-- Добавляем если нам нужны стрелки управления -->
                    <div class="upsell-button-prev">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2850_10179)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9999 0C8.95423 0 -0.000106812 8.95434 -0.000106812 20.0001C-0.000106812 31.0458 8.95423 40.0001 19.9999 40.0001C31.0457 40.0001 40 31.0458 40 20.0001C40 8.95434 31.0457 0 19.9999 0ZM22.5089 12.0072C22.7995 11.7813 23.2197 11.8018 23.4868 12.0687L23.5483 12.1386C23.7742 12.4291 23.7538 12.8493 23.4868 13.1164L16.6037 20.0001L23.4868 26.8837L23.5483 26.9535C23.7742 27.2441 23.7538 27.6643 23.4868 27.9313C23.1974 28.2206 22.7285 28.2206 22.4392 27.9313L15.0318 20.5238L14.9702 20.454C14.7443 20.1635 14.7648 19.7433 15.0318 19.4762L22.4392 12.0687L22.5089 12.0072Z" fill="#00963D"/>
                            <path d="M22.5089 12.0072C22.7995 11.7813 23.2197 11.8018 23.4868 12.0687L23.5483 12.1386C23.7742 12.4291 23.7538 12.8493 23.4868 13.1164L16.6037 20.0001L23.4868 26.8837L23.5483 26.9535C23.7742 27.2441 23.7538 27.6643 23.4868 27.9313C23.1974 28.2206 22.7285 28.2206 22.4392 27.9313L15.0318 20.5238L14.9702 20.454C14.7443 20.1635 14.7648 19.7433 15.0318 19.4762L22.4392 12.0687L22.5089 12.0072Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2850_10179">
                            <rect width="40" height="40" fill="white" transform="matrix(-1 0 0 1 40 0)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="upsell-button-next">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2850_10175)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0001 0C31.0458 0 40.0001 8.95434 40.0001 20.0001C40.0001 31.0458 31.0458 40.0001 20.0001 40.0001C8.95434 40.0001 0 31.0458 0 20.0001C0 8.95434 8.95434 0 20.0001 0ZM17.4911 12.0072C17.2005 11.7813 16.7803 11.8018 16.5132 12.0687L16.4517 12.1386C16.2258 12.4291 16.2462 12.8493 16.5132 13.1164L23.3963 20.0001L16.5132 26.8837L16.4517 26.9535C16.2258 27.2441 16.2462 27.6643 16.5132 27.9313C16.8026 28.2206 17.2715 28.2206 17.5608 27.9313L24.9682 20.5238L25.0298 20.454C25.2557 20.1635 25.2352 19.7433 24.9682 19.4762L17.5608 12.0687L17.4911 12.0072Z" fill="#00963D"/>
                            <path d="M17.4911 12.0072C17.2005 11.7813 16.7803 11.8018 16.5132 12.0687L16.4517 12.1386C16.2258 12.4291 16.2462 12.8493 16.5132 13.1164L23.3963 20.0001L16.5132 26.8837L16.4517 26.9535C16.2258 27.2441 16.2462 27.6643 16.5132 27.9313C16.8026 28.2206 17.2715 28.2206 17.5608 27.9313L24.9682 20.5238L25.0298 20.454C25.2557 20.1635 25.2352 19.7433 24.9682 19.4762L17.5608 12.0687L17.4911 12.0072Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2850_10175">
                            <rect width="40" height="40" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="main-s3">
    <div class="container">
        <div class="top">
            <h3>Топ продаж</h3>
            <a href="#">
                <span>Дивитись усі</span>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976316 0.683417 -0.0976316 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.097631 8.68342 -0.097631 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                        fill="#00963D" />
                </svg>
            </a>
        </div>

        <div class="main-s3-flex">
            @foreach(get_related_products($product, 6) as $relatedProduct)
                @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', ['product' => $relatedProduct])
            @endforeach
            {{-- <a href="#" class="loadmore good">
                <svg width="151" height="127" viewBox="0 0 151 127" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.22445 79.455C7.96161 79.455 9.68141 78.6791 10.8164 77.1967L13.3352 73.9251C17.1049 96.2882 32.7683 115.42 55.0041 123.139C61.8485 125.513 68.8725 126.654 75.8037 126.654C96.5571 126.654 116.529 116.416 128.486 98.3901C130.252 95.7265 129.523 92.1306 126.859 90.3644C124.184 88.5867 120.605 89.3279 118.828 91.9916C105.805 111.645 81.1195 119.96 58.8085 112.201C40.2961 105.773 27.3831 89.658 24.6268 70.9429L29.5835 74.7589C32.1256 76.6987 35.7563 76.2355 37.7019 73.6992C39.6533 71.163 39.1843 67.5323 36.648 65.5809C36.648 65.5809 22.9534 55.0363 22.9186 55.0131C20.0407 52.7953 15.9468 51.5504 13.341 54.9494L1.64412 70.138C-0.307299 72.6743 0.161737 76.305 2.698 78.2564C3.74609 79.0613 4.99106 79.455 6.22445 79.455Z"
                        fill="#00963D" />
                    <path
                        d="M24.5812 36.2925C27.2391 38.0586 30.835 37.329 32.6127 34.6653C45.6357 15.018 70.344 6.70276 92.6318 14.4563C111.144 20.8838 124.057 36.9989 126.813 55.714L121.857 51.898C119.315 49.9524 115.684 50.4157 113.738 52.9577C111.787 55.494 112.256 59.1246 114.792 61.0761C114.792 61.0761 128.487 71.6149 128.522 71.6438C131.452 73.8964 135.453 75.1587 138.099 71.7075L149.796 56.5189C151.748 53.9826 151.279 50.352 148.742 48.4005C146.206 46.4491 142.57 46.9239 140.624 49.4602L138.105 52.7319C134.335 30.3688 118.672 11.2368 96.4362 3.51795C69.1048 -5.96697 38.9013 4.20703 22.9541 28.261C21.188 30.9304 21.9176 34.5206 24.5812 36.2925Z"
                        fill="#00963D" />
                </svg>
                <div>Показати ще
                    7 товарів</div>
            </a> --}}
        </div>
    </div>
</section>