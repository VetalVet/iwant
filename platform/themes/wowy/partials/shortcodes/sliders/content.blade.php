{{-- <div class="hero-slider-content-2">
    @if ($subtitle = $slider->getMetaData('subtitle', true))
        <h4 class="animated">{!! BaseHelper::clean($subtitle) !!}</h4>
    @endif

    @if ($slider->title)
        <h2 class="animated fw-900">{!! BaseHelper::clean($slider->title) !!}</h2>
    @endif

    @if ($highlightText = $slider->getMetaData('highlight_text', true))
        <h1 class="animated fw-900 text-brand">{!! BaseHelper::clean($highlightText) !!}</h1>
    @endif

    @if ($slider->description)
        <p class="animated">{!! BaseHelper::clean($slider->description) !!}</p>
    @endif
    @if ($slider->link && $buttonText = $slider->getMetaData('button_text', true))
        <a class="animated btn btn-default btn-rounded" href="{{ url($slider->link) }}">{!! $buttonText !!} <i class="fa fa-arrow-right"></i> </a>
    @endif
</div> --}}
<div class="slide swiper-slide">
    @if ($subtitle = $slider->getMetaData('subtitle', true))
        <h2>{!! BaseHelper::clean($subtitle) !!}</h2>
    @endif

    <div class="slider-img"><img width="326" height="365" src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}" alt=""></div>
    <div class="info">
        @if ($slider->description)
            <p>{!! BaseHelper::clean($slider->description) !!}</p>
        @endif
        {{-- <p>Період акції <br>
            с 1 травня до 31 травня <br>
            2022 року</p> --}}
        <div class="price">від 24 000 ₴</div>
    </div>
</div>
