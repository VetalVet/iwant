{{-- <section class="bg-grey-9 section-padding-60 product-tabs">
    <div class="container">
        <div class="heading-tab d-flex">
            <div class="heading-tab-left wow fadeIn animated">
                <h3 class="section-title mb-35">{{ $category->name }}</h3>
            </div>
            <div class="heading-tab-right wow fadeIn animated">
                <ul class="nav nav-tabs right no-border" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" type="button" data-url="{{ route('public.ajax.products-by-category', $category->id, ['limit' => $limit]) }}" role="tab" aria-controls="product-collections-tab" aria-selected="true">{{ __('All') }}</button>
                    </li>
                    @foreach($category->activeChildren as $item)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" type="button" data-url="{{ route('public.ajax.products-by-category', $item->id, ['limit' => $limit]) }}" role="tab" aria-controls="product-categories-product" aria-selected="true">{{ $item->name }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="tab-content wow fadeIn animated">
            <div class="half-circle-spinner loading-spinner d-none">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
            </div>

            <div class="tab-pane fade show active" id="product-categories-product" role="tabpanel" aria-labelledby="product-categories-product-tab">
                <div class="row product-grid-4">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', compact('product'))
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="main-s4" data-category="{{ $category->id }}">
    <div class="container">
        <div class="top">
            <h3>{{ $category->name }}</h3>
            <a href="#">
                <span>Дивитись усі</span>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976316 0.683417 -0.0976316 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.097631 8.68342 -0.097631 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                        fill="#00963D" />
                </svg>
            </a>
        </div>

        <div class="books-slider swiper-container">
            <div class="books-slider__wrapper swiper-wrapper">
                @foreach($products as $product)
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item', compact('product'))
                @endforeach
            </div>
        </div>

        <div class="books-nav">
            <!-- Добавляем если нам нужны стрелки управления -->
            <div class="arrows">
                <div class="books-button-prev books-button-prev{{ $category->id }}">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1477_8944)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.9999 0C8.95423 0 -0.000106812 8.95434 -0.000106812 20.0001C-0.000106812 31.0458 8.95423 40.0001 19.9999 40.0001C31.0457 40.0001 40 31.0458 40 20.0001C40 8.95434 31.0457 0 19.9999 0ZM22.5089 12.0072C22.7995 11.7813 23.2197 11.8018 23.4868 12.0687L23.5483 12.1386C23.7742 12.4291 23.7538 12.8493 23.4868 13.1164L16.6037 20.0001L23.4868 26.8837L23.5483 26.9535C23.7742 27.2441 23.7538 27.6643 23.4868 27.9313C23.1974 28.2206 22.7285 28.2206 22.4392 27.9313L15.0318 20.5238L14.9702 20.454C14.7443 20.1635 14.7648 19.7433 15.0318 19.4762L22.4392 12.0687L22.5089 12.0072Z"
                                fill="#00963D" />
                            <path
                                d="M22.5089 12.0072C22.7995 11.7813 23.2197 11.8018 23.4868 12.0687L23.5483 12.1386C23.7742 12.4291 23.7538 12.8493 23.4868 13.1164L16.6037 20.0001L23.4868 26.8837L23.5483 26.9535C23.7742 27.2441 23.7538 27.6643 23.4868 27.9313C23.1974 28.2206 22.7285 28.2206 22.4392 27.9313L15.0318 20.5238L14.9702 20.454C14.7443 20.1635 14.7648 19.7433 15.0318 19.4762L22.4392 12.0687L22.5089 12.0072Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1477_8944">
                                <rect width="40" height="40" fill="white" transform="matrix(-1 0 0 1 40 0)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="books-button-next books-button-next{{ $category->id }}">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1429_8951)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M20.0001 0C31.0458 0 40.0001 8.95434 40.0001 20.0001C40.0001 31.0458 31.0458 40.0001 20.0001 40.0001C8.95434 40.0001 0 31.0458 0 20.0001C0 8.95434 8.95434 0 20.0001 0ZM17.4911 12.0072C17.2005 11.7813 16.7803 11.8018 16.5132 12.0687L16.4517 12.1386C16.2258 12.4291 16.2462 12.8493 16.5132 13.1164L23.3963 20.0001L16.5132 26.8837L16.4517 26.9535C16.2258 27.2441 16.2462 27.6643 16.5132 27.9313C16.8026 28.2206 17.2715 28.2206 17.5608 27.9313L24.9682 20.5238L25.0298 20.454C25.2557 20.1635 25.2352 19.7433 24.9682 19.4762L17.5608 12.0687L17.4911 12.0072Z"
                                fill="#00963D" />
                            <path
                                d="M17.4911 12.0072C17.2005 11.7813 16.7803 11.8018 16.5132 12.0687L16.4517 12.1386C16.2258 12.4291 16.2462 12.8493 16.5132 13.1164L23.3963 20.0001L16.5132 26.8837L16.4517 26.9535C16.2258 27.2441 16.2462 27.6643 16.5132 27.9313C16.8026 28.2206 17.2715 28.2206 17.5608 27.9313L24.9682 20.5238L25.0298 20.454C25.2557 20.1635 25.2352 19.7433 24.9682 19.4762L17.5608 12.0687L17.4911 12.0072Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1429_8951">
                                <rect width="40" height="40" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
            <!-- Добавляем, если нам нужна пагинация -->
            <div class="books-pagination books-pagination{{ $category->id }}"></div>
        </div>
    </div>
</section>