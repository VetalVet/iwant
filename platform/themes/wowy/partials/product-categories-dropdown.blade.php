@foreach($categories as $category)
    @if ((!$more && $loop->index < 10) || ($more && $loop->index >= 10))
        <li @if ($category->activeChildren->count() > 0) class="has-sub" @endif>
            <a href="{{ $category->url }}">
                {{-- @if ($category->getMetaData('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($category->getMetaData('icon_image', true)) }}" alt="{{ $category->name }}" width="18" height="18">
                @elseif ($category->getMetaData('icon', true))
                    <i class="{{ $category->getMetaData('icon', true) }}"></i>
                @endif  --}}
                {{ $category->name }}
            </a>

            @if ($category->activeChildren->count() > 0)
                <svg class="arrow" width="6" height="10" viewBox="0 0 6 10" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976315 0.683417 -0.0976315 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.0976309 8.68342 -0.0976309 9.31658 0.292894 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                        fill="#00963D" />
                </svg>
                <ul>
                    @foreach($category->activeChildren as $childCategory)
                        <li @if ($childCategory->activeChildren->count() > 0) class="has-sub" @endif>
                            <a class="dropdown-item nav-link nav_item" href="{{ $childCategory->url }}">{{ $childCategory->name }}</a>

                            @if ($childCategory->activeChildren->count() > 0)
                                <svg class="arrow" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976315 0.683417 -0.0976315 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.0976309 8.68342 -0.0976309 9.31658 0.292894 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                                        fill="#00963D" />
                                </svg>
                                <ul>
                                    @foreach($childCategory->activeChildren as $childOfChildCategory)
                                        <li>
                                            <a class="dropdown-item nav-link nav_item" href="{{ $childOfChildCategory->url }}">{{ $childOfChildCategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endif
@endforeach
