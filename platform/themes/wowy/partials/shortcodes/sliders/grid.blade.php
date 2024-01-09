{{-- <div class="hero-slider-1 dot-style-1 dot-style-1-position-1 {{ $class ?? ''}}" data-autoplay="{{ $shortcode->is_autoplay ?: 'yes' }}" data-autoplay-speed="{{ in_array($shortcode->autoplay_speed, theme_get_autoplay_speed_options()) ? $shortcode->autoplay_speed : 3000 }}">
    @foreach($sliders as $slider)
        <div class="single-hero-slider single-animation-wrap">
            <div class="container">
                <div class="row align-items-center slider-animated-1">
                    <div class="col-lg-5 col-md-6">
                        {!! Theme::partial('shortcodes.sliders.content', compact('slider')) !!}
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="single-slider-img single-slider-img-1">
                            <img class="animated" src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="slider-arrow hero-slider-1-arrow"></div> --}}

<section class="main-s1">
    <div class="container">
        <div class="action-slider swiper-container">
            <div class="action-slider__wrapper swiper-wrapper">
                @foreach($sliders as $slider)
                    {{-- <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6"> --}}
                                    {!! Theme::partial('shortcodes.sliders.content', compact('slider')) !!}
                                {{-- </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated" src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide swiper-slide">
                        <h2>Найкращі ціни на Apple техніку</h2>
                        <div class="slider-img"><img width="326" height="365" src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}" alt=""></div>
                        <div class="info">
                            <p>Період акції <br>
                                с 1 травня до 31 травня <br>
                                2022 року</p>
                            <div class="price">від 24 000 ₴</div>
                        </div>
                    </div> --}}
                @endforeach
            </div>
            <div class="action-pagination"></div>
        </div>
    </div>
</section>