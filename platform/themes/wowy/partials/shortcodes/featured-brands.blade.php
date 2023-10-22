<section class="section-padding-60">
    <div class="container">
        <h3 class="section-title style-1 mb-30 wow fadeIn animated">{!! BaseHelper::clean($title) !!}</h3>

        <div class="carousel-6-columns-cover arrow-center position-relative wow fadeIn animated">
            <div class="slider-arrow slider-arrow-3 carousel-6-columns-arrow" id="carousel-6-columns-3-arrows"></div>
            <div class="carousel-slider-wrapper carousel-6-columns text-center" id="carousel-6-columns-3">
                @foreach ($brands as $brand)
                    <div class="brand-logo">
                        @if ($brand->website)
                            <a href="{{ $brand->website }}"><img class="img-grey-hover" src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}"/></a>
                        @else
                            <img class="img-grey-hover" src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}"/>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
