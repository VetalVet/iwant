{{-- <section class="section-padding-60">
    <div class="container">
        <div class="col-12">
            @if (clean($title))
                <h3 class="section-title style-1 mb-30 wow fadeIn animated">{!! BaseHelper::clean($title) !!}</h3>
            @endif

            <div class="post-list mb-4 mb-lg-0">
                <div class="row">
                    @foreach($posts as $post)
                        <article class="wow fadeIn animated col-lg-6">
                            <div class="d-md-flex d-block">
                                <div class="post-thumb d-flex mr-15 border-radius-10">
                                    <a class="color-white" href="{{ $post->url }}">
                                        <img class="border-radius-10" src="{{ RvMedia::getImageUrl($post->image) }}" alt="{{ $post->name }}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="entry-meta mb-5 mt-10">
                                        <a class="entry-meta meta-2" href="{{ $post->firstCategory->url }}"><span class="post-in text-danger font-x-small text-uppercase">{{ $post->firstCategory->name }}</span></a>
                                    </div>
                                    <h4 class="post-title mb-25 text-limit-2-row">
                                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                                    </h4>
                                    <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on"> <i class="far fa-clock"></i> {{ $post->created_at->translatedFormat('d M Y') }}</span>
                                            <span class="hit-count has-dot">{{ number_format($post->views) }} {{ __('Views')}}</span>
                                        </div>
                                        <a href="{{ $post->url }}">{{ __('Read more') }} <i class="fa fa-arrow-right font-xxs ml-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="main-s6 blog">
    <div class="container">
        <div class="top">
            @if (clean($title))
                <h3>{!! BaseHelper::clean($title) !!}</h3>
            @endif
            <a href="/blog/">
                <span>Дивитись усі</span>
                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M1.70711 0.292893C1.31658 -0.0976315 0.683417 -0.0976315 0.292893 0.292893C-0.0976316 0.683417 -0.0976316 1.31658 0.292893 1.70711L3.58579 5L0.292893 8.29289C-0.097631 8.68342 -0.097631 9.31658 0.292893 9.70711C0.683417 10.0976 1.31658 10.0976 1.70711 9.70711L5.70711 5.70711C6.09763 5.31658 6.09763 4.68342 5.70711 4.29289L1.70711 0.292893Z"
                        fill="#00963D" />
                </svg>
            </a>
        </div>

        <div class="blog-slider swiper-container">
            <div class="blog-slider__wrapper swiper-wrapper">
                @foreach($posts as $post)
                    <div class="blog-slide swiper-slide">
                        <a href="{{ $post->url }}" class="photo">
                            <img loading="lazy" width="280" height="412" src="{{ RvMedia::getImageUrl($post->image) }}"
                                alt="{{ $post->name }}">
                        </a>
                        <div class="content">
                            <h3><a href="{{ $post->url }}">{{ $post->name }}</a></h3>
                            <p>{{ $post->description }}</p>
                            <a href="{{ $post->url }}">
                                Детальніше
                                <svg width="18" height="9" viewBox="0 0 18 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.7935 4.85714C17.7933 4.85735 17.7931 4.8576 17.7929 4.85781L14.119 8.51401C13.8437 8.7879 13.3986 8.78688 13.1246 8.51161C12.8507 8.23638 12.8517 7.7912 13.1269 7.51727L15.5936 5.06255H0.703115C0.314785 5.06255 0 4.74777 0 4.35944C0 3.97111 0.314785 3.65632 0.703115 3.65632H15.5936L13.127 1.20161C12.8517 0.927674 12.8507 0.482497 13.1246 0.207262C13.3986 -0.0680424 13.8438 -0.0689914 14.119 0.204872L17.7929 3.86107C17.7931 3.86128 17.7933 3.86153 17.7936 3.86174C18.0689 4.13659 18.0681 4.5832 17.7935 4.85714Z"
                                        fill="#00963D" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="books-nav">
            <!-- Добавляем если нам нужны стрелки управления -->
            <div class="arrows">
                <div class="blog-button-prev">
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
                <div class="blog-button-next">
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
            <div class="blog-pagination"></div>
        </div>
    </div>
</section>
