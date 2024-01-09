@if ($product)
    {{-- <div class="product-cart-wrap mb-30">
        <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom">
                <a href="{{ $product->url }}">
                    <img class="default-img" src="{{ RvMedia::getImageUrl($product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                    <img class="hover-img" src="{{ RvMedia::getImageUrl($product->images[1] ?? $product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                </a>
            </div>
            <div class="product-action-1">
                <a aria-label="{{ __('Quick View') }}" href="#" class="action-btn hover-up js-quick-view-button" data-url="{{ route('public.ajax.quick-view', $product->id) }}"><i class="far fa-eye"></i></a>
                @if (EcommerceHelper::isWishlistEnabled())
                    <a aria-label="{{ __('Add To Wishlist') }}" href="#" class="action-btn hover-up js-add-to-wishlist-button" data-url="{{ route('public.wishlist.add', $product->id) }}"><i class="far fa-heart"></i></a>
                @endif
                @if (EcommerceHelper::isCompareEnabled())
                    <a aria-label="{{ __('Add To Compare') }}" href="#" class="action-btn hover-up js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}"><i class="far fa-exchange-alt"></i></a>
                @endif
            </div>
            <div class="product-badges product-badges-position product-badges-mrg">
                @if ($product->isOutOfStock())
                    <span style="background-color: #000; font-size: 11px;">{{ __('Out Of Stock') }}</span>
                @else
                    @if ($product->productLabels->count())
                        @foreach ($product->productLabels as $label)
                            <span @if ($label->color) style="background-color: {{ $label->color }}" @endif>{{ $label->name }}</span>
                        @endforeach
                    @elseif ($product->front_sale_price !== $product->price && $percentSale = get_sale_percentage($product->price, $product->front_sale_price))
                        <span class="hot">{{ $percentSale }}</span>
                    @endif
                @endif
            </div>
        </div>
        <div class="product-content-wrap">
            @php $category = $product->categories->sortByDesc('id')->first(); @endphp
            @if ($category)
                <div class="product-category">
                    <a href="{{ $category->url }}">{{ $category->name }}</a>
                </div>
            @endif
            <h2 class="text-truncate"><a href="{{ $product->url }}" title="{{ $product->name }}">{{ $product->name }}</a></h2>

            @if (EcommerceHelper::isReviewEnabled())
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                    </div>
                    <span class="rating_num">({{ $product->reviews_count }})</span>
                </div>
            @endif

            {!! apply_filters('ecommerce_before_product_price_in_listing', null, $product) !!}

            <div class="product-price">
                <span>{{ format_price($product->front_sale_price_with_taxes) }}</span>
                @if ($product->front_sale_price !== $product->price)
                    <span class="old-price">{{ format_price($product->price_with_taxes) }}</span>
                @endif
            </div>

            {!! apply_filters('ecommerce_after_product_price_in_listing', null, $product) !!}

            @if (EcommerceHelper::isCartEnabled())
                <div class="product-action-1 show" @if (!EcommerceHelper::isReviewEnabled()) style="bottom: 10px;" @endif>
                    <a aria-label="{{ __('Add To Cart') }}" class="action-btn hover-up add-to-cart-button" data-id="{{ $product->id }}" data-url="{{ route('public.cart.add-to-cart') }}" href="#"><i class="far fa-shopping-bag"></i></a>
                </div>
            @endif
        </div>
    </div> --}}
    <div class="good swiper-slide">
        {{-- <pre>
        {{ print_r($category) }}
        </pre> --}}
        <a href="{{ $product->url }}" class="photo">
            <img width="235" height="235" loading="lazy" src="{{ RvMedia::getImageUrl($product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="">
            <div class="variants"></div>
        </a>

        <h3><a href="{{ $product->url }}">{{ $product->name }}</a></h3>
        <div class="rating">
            <div class="stars">
                @for ( $i = 0; $i < round($product->reviews_avg); $i++)
                    <span class="active"></span>
                @endfor
                @for ( $i = 0; $i < 5 - round($product->reviews_avg); $i++)
                    <span></span>
                @endfor
            </div>
            <span>{{ $product->reviews_count }} відгуки</span>
        </div>

        <div class="bot">
            <div class="price">{{ format_price($product->front_sale_price_with_taxes) }}</div>
            <a aria-label="{{ __('Add To Cart') }}" 
                href="#" 
                class="buy-btn add-to-cart-button"
                data-id="{{ $product->id }}" 
                data-url="{{ route('public.cart.add-to-cart') }}" 
            >
                Купити
                <svg width="18" height="9" viewBox="0 0 18 9" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.7935 4.85714C17.7933 4.85735 17.7931 4.8576 17.7929 4.85781L14.119 8.51401C13.8437 8.7879 13.3986 8.78688 13.1246 8.51161C12.8507 8.23638 12.8517 7.7912 13.1269 7.51727L15.5936 5.06255H0.703115C0.314785 5.06255 0 4.74777 0 4.35944C0 3.97111 0.314785 3.65632 0.703115 3.65632H15.5936L13.127 1.20161C12.8517 0.927674 12.8507 0.482496 13.1246 0.207262C13.3986 -0.0680428 13.8438 -0.0689917 14.119 0.204872L17.7929 3.86107C17.7931 3.86128 17.7933 3.86153 17.7936 3.86174C18.0689 4.13659 18.0681 4.5832 17.7935 4.85714Z"
                        fill="#333333" />
                </svg>
            </a>
        </div>
    </div>
@endif
