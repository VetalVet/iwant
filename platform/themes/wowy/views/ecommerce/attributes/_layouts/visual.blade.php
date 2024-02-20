<div class="attr_wrap visual-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color" data-type="visual">
    <h3 class="attribute-name">{{ $set->title }}</h3>
    {{-- <div class="attribute-values">
        <ul class="visual-swatch color-swatch attribute-swatch"> --}}
            @foreach($attributes->where('attribute_set_id', $set->id) as $attribute)
                <a class="{{ $selected->where('id', $attribute->id)->count() ? 'current' : '' }}" style="{{ $attribute->getAttributeStyle($set, $productVariations) }}" data-slug="{{ $attribute->slug }}"
                    data-id="{{ $attribute->id }}"
                    class="attribute-swatch-item @if (!$variationInfo->where('id', $attribute->id)->count()) pe-none @endif"
                    title="{{ $attribute->title }}">
                    {{-- <div class="custom-radio">
                        <label>
                            <input class="form-control product-filter-item"
                                type="radio"
                                name="attribute_{{ $set->slug }}_{{ $key }}"
                                value="{{ $attribute->id }}"
                                {{ $selected->where('id', $attribute->id)->count() ? 'checked' : '' }}>
				            <span style="{{ $attribute->getAttributeStyle($set, $productVariations) }}"></span>
                        </label>
                    </div> --}}
                </a>
            @endforeach
        {{-- </ul>
    </div> --}}
</div>
