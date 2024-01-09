@if($categories)
    <section class="main-s2">
        <div class="container">
            <div class="top">
                <h3>{{ $title }}</h3>
                <a href="#">
                    <span>Дивитись усі</span>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976316 0.683417 -0.0976316 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.097631 8.68342 -0.097631 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                            fill="#00963D" />
                    </svg>
                </a>
            </div>
            <div class="main-s2-flex">
                @foreach($categories as $category)
                    <div class="category">
                        <div class="category-img">
                            <img loading="lazy" width="160" height="160" src="{{ RvMedia::getImageUrl($category->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $category->name }}" >
                        </div>
                        <div class="category-name">
                            <h4><a href="#">{{ $category->name }}</a></h4>
                            <a href="{{ $category->url }}">
                                Перейти
                                <svg width="18" height="9" viewBox="0 0 18 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.7935 4.85702C17.7933 4.85723 17.7931 4.85747 17.7929 4.85768L14.119 8.51388C13.8437 8.78778 13.3986 8.78676 13.1246 8.51149C12.8507 8.23626 12.8517 7.79108 13.1269 7.51715L15.5936 5.06243H0.703115C0.314785 5.06243 0 4.74765 0 4.35932C0 3.97099 0.314785 3.6562 0.703115 3.6562H15.5936L13.127 1.20149C12.8517 0.927552 12.8507 0.482374 13.1246 0.20714C13.3986 -0.0681648 13.8438 -0.0691137 14.119 0.20475L17.7929 3.86095C17.7931 3.86116 17.7933 3.8614 17.7936 3.86162C18.0689 4.13646 18.0681 4.58308 17.7935 4.85702Z"
                                        fill="#333333" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif