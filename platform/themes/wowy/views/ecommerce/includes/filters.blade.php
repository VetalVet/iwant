@php
    //Theme::asset()->usePath()
    //                ->add('custom-scrollbar-css', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css');
    //Theme::asset()->container('footer')->usePath()
    //            ->add('custom-scrollbar-js', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js', ['jquery']);

    [$categoriesFromFilter, $brands, $tags, $rand, $categoriesRequest, $urlCurrent, $categoryId, $maxFilterPrice] = EcommerceHelper::dataForFilter($category ?? null);

    if (! isset($categories)) {
        $categories = $categoriesFromFilter;
    }

    $categories->loadCount('products');

    if (! Route::is('public.products') && $categoriesRequest) {
        $categories = $categories->whereIn('id', $categoriesRequest)->where('id', '<>', $categoryId);
    }
@endphp


<form data-spollers class="filters" action="{{ URL::current() }}" method="GET" id="products-filter-ajax">
    <div class="filter-title2">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0.5 2.82561H8.11266C8.34209 3.86894 9.27472 4.65221 10.387 4.65221C11.4992 4.65221 12.4318 3.86897 12.6613 2.82561H15.5C15.7761 2.82561 16 2.60195 16 2.32609C16 2.05023 15.7761 1.82657 15.5 1.82657H12.661C12.4312 0.783772 11.4972 0 10.387 0C9.27609 0 8.34262 0.783647 8.11284 1.82657H0.5C0.223875 1.82657 0 2.05023 0 2.32609C0 2.60195 0.223875 2.82561 0.5 2.82561ZM9.05866 2.3274C9.05866 2.32562 9.05869 2.32381 9.05869 2.32203C9.06087 1.59252 9.65672 0.999063 10.387 0.999063C11.1162 0.999063 11.7121 1.59171 11.7152 2.32088L11.7153 2.32821C11.7142 3.05897 11.1187 3.65321 10.387 3.65321C9.65553 3.65321 9.06028 3.05957 9.05863 2.32924L9.05866 2.3274ZM15.5 13.1744H12.661C12.4311 12.1316 11.4972 11.3478 10.387 11.3478C9.27609 11.3478 8.34262 12.1315 8.11284 13.1744H0.5C0.223875 13.1744 0 13.398 0 13.6739C0 13.9498 0.223875 14.1734 0.5 14.1734H8.11266C8.34209 15.2167 9.27472 16 10.387 16C11.4992 16 12.4318 15.2167 12.6613 14.1734H15.5C15.7761 14.1734 16 13.9498 16 13.6739C16 13.398 15.7761 13.1744 15.5 13.1744ZM10.387 15.001C9.65553 15.001 9.06028 14.4073 9.05863 13.677L9.05866 13.6752C9.05866 13.6734 9.05869 13.6716 9.05869 13.6698C9.06087 12.9403 9.65672 12.3468 10.387 12.3468C11.1162 12.3468 11.7121 12.9395 11.7152 13.6686L11.7153 13.6759C11.7143 14.4068 11.1188 15.001 10.387 15.001ZM15.5 7.50048H7.88734C7.65791 6.45715 6.72528 5.67391 5.61303 5.67391C4.50078 5.67391 3.56816 6.45715 3.33872 7.50048H0.5C0.223875 7.50048 0 7.72414 0 8C0 8.27589 0.223875 8.49952 0.5 8.49952H3.33897C3.56888 9.54229 4.50275 10.3261 5.61303 10.3261C6.72391 10.3261 7.65738 9.54241 7.88716 8.49952H15.5C15.7761 8.49952 16 8.27589 16 8C16 7.72414 15.7761 7.50048 15.5 7.50048ZM6.94134 7.99869C6.94134 8.0005 6.94131 8.00228 6.94131 8.00406C6.93912 8.73357 6.34328 9.32703 5.61303 9.32703C4.88381 9.32703 4.28794 8.73438 4.28478 8.00525L4.28469 7.99794C4.28578 7.26709 4.88125 6.67294 5.61303 6.67294C6.34447 6.67294 6.93972 7.26655 6.94137 7.99691L6.94134 7.99869Z"
                fill="black" />
        </svg>
        Фільтр
    </div>

    
    @if ($maxFilterPrice)
        {{-- <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="price">
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
        </div> --}}

        <div class="block__item price">
            <button type="button" data-spoller class="filter-title">Ціна</button>
            <div class="block__text filter-content">
                <div class="price__inputs">
                    <input id="price-start" autocomplete="off" type="text" name="form[]"
                        data-error="Ошибка" value="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}" data-from="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}" data-value="Задать вопрос"
                        class="input">
                    <input id="price-end" autocomplete="off" type="text" name="form[]"
                        data-error="Ошибка" value="{{ BaseHelper::stringify(request()->input('max_price', $maxFilterPrice)) }}" data-to="{{ $maxFilterPrice }}" data-value="Задать вопрос"
                        class="input">
                </div>
                <div class="price-filter__slider"></div>

            </div>
        </div>
    @endif

    @if ($categories->isNotEmpty())
        <div class="block__item">
            <button type="button" data-spoller data-title="{{ __('Categories') }}" class="block__title">{{ __('By :name', ['name' => __('Categories')]) }}</button>

            <div class="block__text">
                {{-- @foreach($brands as $brand) --}}
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.filter-product-category', ['categories' => $categories, 'indent' => null])
                {{-- @endforeach --}}
            </div>
        </div>
    @endif

    @if ($brands->isNotEmpty())
        <div class="block__item">
            <button type="button" data-spoller data-title="{{ __('Brands') }}" class="block__title">{{ __('By :name', ['name' => __('Brands')]) }}</button>

            <div class="block__text">
                @foreach($brands as $brand)
                    <label for="brand-filter-{{ $brand->id }}">
                        <input class="form-check-input"
                            name="brands[]"
                            type="checkbox"
                            id="brand-filter-{{ $brand->id }}"
                            value="{{ $brand->id }}"
                            @if (in_array($brand->id, request()->input('brands', []))) checked @endif>
                        <span>{{ $brand->name }} ({{ $brand->products_count }})</span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item">
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
        </div> --}}
    @endif

    @if ($tags->isNotEmpty())
        <div class="block__item">
            <button type="button" data-spoller data-title="{{ __('Tag') }}" class="block__title">{{ __('By :name', ['name' => __('tags')]) }}</button>
            
            <div class="block__text">
                @foreach($tags as $tag)
                    {{-- <input class="form-check-input"
                            name="tags[]"
                            type="checkbox"
                            id="tag-filter-{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            @if (in_array($tag->id, request()->input('tags', []))) checked @endif>
                    <label class="form-check-label" for="tag-filter-{{ $tag->id }}">
                        <span class="d-inline-block">{{ $tag->name }}</span> 
                        <span class="d-inline-block">({{ $tag->products_count }})</span> 
                    </label> --}}
                    
                    <label class="form-check-label" for="tag-filter-{{ $tag->id }}">
                        <input class="form-check-input"
                            name="tags[]"
                            type="checkbox"
                            id="tag-filter-{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            @if (in_array($tag->id, request()->input('tags', []))) checked @endif>
                        <span>{{ $tag->name }} ({{ $tag->products_count }})</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endif

    {!! render_product_swatches_filter([
        'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
    ]) !!}

    <div class="btns">
        <a href="#">Очистити</a>
        <a class="green-btn" href="#">Прийняти</a>
    </div>

    
    {{-- <div class="widget">
        <a class="clear_filter dib clear_all_filter" href="{{ URL::current() }}">{{ __('Clear All Filter') }}</a>

        <button type="submit" class="btn btn-sm btn-default ms-2"><i class="fa fa-filter mr-5 ml-0"></i> {{ __('Filter') }}</button>
    </div> --}}

</form>

<div class="close">×</div>

{{-- <div class="shop-product-filter-header">
не то
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

    <div class="advanced-search-widgets">
        <div class="row">
            {!! render_product_swatches_filter([
                'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
            ]) !!}
        </div>
    </div>
</div> --}}
