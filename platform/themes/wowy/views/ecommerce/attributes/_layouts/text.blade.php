<div class="attr_wrap text-swatches-wrapper attribute-swatches-wrapper attribute-swatches-wrapper form-group product__attribute product__color" data-type="text">
    <h3 class="attribute-name">{{ $set->title }}</h3>
    {{-- <div class="attribute-values">
        <ul class="text-swatch attribute-swatch color-swatch"> --}}
            @foreach($attributes->where('attribute_set_id', $set->id) as $attribute)
                <li data-slug="{{ $attribute->slug }}"
                    data-id="{{ $attribute->id }}"
                    class="attribute-swatch-item @if (!$variationInfo->where('id', $attribute->id)->count()) pe-none @endif">
                    {{ $attribute->title }}
                    {{-- <div>
                        <label>
                            <input class="product-filter-item"
                                type="radio"
                                name="attribute_{{ $set->slug }}_{{ $key }}"
                                value="{{ $attribute->id }}"
                                {{ $selected->where('id', $attribute->id)->count() ? 'checked' : '' }}>
                            <span>{{ $attribute->title }}</span>
                        </label>
                    </div> --}}
                </li>
            @endforeach
        {{-- </ul>
    </div> --}}
</div>
