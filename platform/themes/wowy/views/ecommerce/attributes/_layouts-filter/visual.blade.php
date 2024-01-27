{{-- <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-5 mb-sm-5 widget-filter-item" data-type="visual">
    <h5 class="mb-20 widget__title" data-title="{{ $set->title }}">{{ __('By :name', ['name' => $set->title]) }}</h5>
    <ul class="list-filter ps-custom-scrollbar">
        @foreach($attributes->where('attribute_set_id', $set->id) as $attribute)
            <li data-slug="{{ $attribute->slug }}"
                data-toggle="tooltip"
                data-placement="top"
                title="{{ $attribute->title }}"
                class="mx-1">
                <div class="custom-checkbox">
                    <label>
                        <input class="form-control product-filter-item" type="checkbox" name="attributes[{{ $set->slug }}][]" value="{{ $attribute->id }}" {{ in_array($attribute->id, $selected) ? 'checked' : '' }}>
			            <span style="{{ $attribute->getAttributeStyle() }}"></span>
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</div> --}}

<div class="block__item">
    <button type="button" data-spoller data-title="{{ $set->title }}" class="block__title">{{ __('By :name', ['name' => $set->title]) }}</button>
    <div class="block__text color">
        @foreach($attributes->where('attribute_set_id', $set->id) as $attribute)
            <label for="{{ $attribute->id }}">
                <input id="{{ $attribute->id }}" type="checkbox" name="attributes[{{ $set->slug }}][]" {{ in_array($attribute->id, $selected) ? 'checked' : '' }}>
                <span>{{ $attribute->title }}</span>
            </label>
        @endforeach
    </div>
</div>