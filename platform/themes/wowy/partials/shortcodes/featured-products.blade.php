{{-- <section class="section-padding-60">
    <div class="container wow fadeIn animated">
        @if (clean($title))
            <h3 class="section-title style-1 mb-30">{!! BaseHelper::clean($title) !!}</h3>
        @endif

        <div class="carousel-6-columns-cover position-relative">
            <div class="slider-arrow slider-arrow-2 carousel-6-columns-arrow" id="carousel-6-columns-arrows"></div>
            <div class="carousel-slider-wrapper carousel-6-columns" id="carousel-6-columns-products">
                @foreach ($products as $product)
                    <div class="product-cart-wrap small hover-up p-10">
                        @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item-small', compact('product'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> --}}

<section class="main-s3">
    <div class="container">
        <div class="top">
            @if (clean($title))
                <h3>{!! BaseHelper::clean($title) !!}</h3>
            @endif

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
            @foreach ($products as $product)
                {{-- {{ print_r($product) }} --}}
                <div class="product-cart-wrap small hover-up p-10">
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-item-small', compact('product'))
                </div>
            @endforeach
            
            <a href="#" class="loadmore good">
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
            </a>
        </div>
    </div>
</section>
