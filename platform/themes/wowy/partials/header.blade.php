<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- {!! BaseHelper::googleFonts('https://fonts.googleapis.com/css2?family=' . urlencode(theme_option('font_text', 'Poppins')) . ':ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap') !!} --}}
        <link rel="stylesheet" href="<?php //echo $_SERVER['APP_URL']; ?>/themes/wowy/css/fonts.css">
            
        <style>
            :root {
                --font-text: {{ theme_option('font_text', 'Poppins') }}, sans-serif;
                --color-brand: {{ theme_option('color_brand', '#5897fb') }};
                --color-brand-2: {{ theme_option('color_brand_2', '#3256e0') }};
                --color-primary: {{ theme_option('color_primary', '#3f81eb') }};
                --color-secondary: {{ theme_option('color_secondary', '#41506b') }};
                --color-warning: {{ theme_option('color_warning', '#ffb300') }};
                --color-danger: {{ theme_option('color_danger', '#ff3551') }};
                --color-success: {{ theme_option('color_success', '#3ed092') }};
                --color-info: {{ theme_option('color_info', '#18a1b7') }};
                --color-text: {{ theme_option('color_text', '#4f5d77') }};
                --color-heading: {{ theme_option('color_heading', '#222222') }};
                --color-grey-1: {{ theme_option('color_grey_1', '#111111') }};
                --color-grey-2: {{ theme_option('color_grey_2', '#242424') }};
                --color-grey-4: {{ theme_option('color_grey_4', '#90908e') }};
                --color-grey-9: {{ theme_option('color_grey_9', '#f4f5f9') }};
                --color-muted: {{ theme_option('color_muted', '#8e8e90') }};
                --color-body: {{ theme_option('color_body', '#4f5d77') }};
            }
        </style>

        {!! Theme::header() !!}

        @php
            $headerStyle = theme_option('header_style') ?: '';
            $page = Theme::get('page');
            if ($page) {
                $headerStyle = $page->getMetaData('header_style', true) ?: $headerStyle;
            }
            $headerStyle = ($headerStyle && in_array($headerStyle, array_keys(get_layout_header_styles()))) ? $headerStyle : '';
        
            
            //echo '<pre>';
            //print_r(Theme::test());
            //echo '</pre>';
        
        @endphp
        
        @if($_SERVER['REQUEST_URI'] == '/')
            <link rel="stylesheet" href="<?php //echo $_SERVER['APP_URL']; ?>/themes/wowy/css/index.css">
        @elseif(str_contains($_SERVER['REQUEST_URI'], 'product-categories') || str_contains($_SERVER['REQUEST_URI'], 'products'))
            <link rel="stylesheet" href="<?php //echo $_SERVER['APP_URL']; ?>/themes/wowy/css/nouislider.css">
            <link rel="stylesheet" href="<?php //echo $_SERVER['APP_URL']; ?>/themes/wowy/css/shop.css">
        @endif
    </head>
    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif class="@if (BaseHelper::siteLanguageDirection() == 'rtl') rtl @endif header_full_true wowy-template css_scrollbar lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-index wowy_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true header_sticky_true hide_scrolld_true des_header_3 h_banner_true top_bar_true prs_bordered_grid_1 search_pos_canvas lazyload @if (Theme::get('bodyClass')) {{ Theme::get('bodyClass') }} @endif">
        {!! apply_filters(THEME_FRONT_BODY, null) !!}
        <div id="alert-container"></div>

        {{-- {!! Theme::partial('preloader') !!} --}}

        {{-- <header class="header-area header-height-2 {{ $headerStyle }}">
            <div class="header-top header-top-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4">
                            <div class="header-info">
                                <ul>
                                    @if (theme_option('hotline'))
                                        <li><i class="fa fa-phone-alt mr-5"></i><a href="tel:{{ theme_option('hotline') }}">{{ theme_option('hotline') }}</a></li>
                                    @endif

                                    @if (is_plugin_active('ecommerce') && EcommerceHelper::isOrderTrackingEnabled())
                                        <li><i class="far fa-anchor mr-5"></i><a href="{{ route('public.orders.tracking') }}">{{ __('Track Your Order') }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-4">
                            <div class="text-center">
                                @if (theme_option('header_messages') && $headerMessages = json_decode(theme_option('header_messages'), true))
                                    <div id="news-flash" class="d-inline-block">
                                        <ul>
                                            @foreach($headerMessages as $headerMessage)
                                                @if (count($headerMessage) == 4)
                                                    <li>
                                                        @if ($headerMessage[0]['value'])
                                                            <i class="{{ $headerMessage[0]['value'] }} d-inline-block mr-5"></i>
                                                        @endif

                                                        @if ($headerMessage[1]['value'])
                                                            <span class="d-inline-block">
                                                                {!! BaseHelper::clean($headerMessage[1]['value']) !!}
                                                            </span>
                                                        @endif
                                                        @if ($headerMessage[2]['value'] && $headerMessage[3]['value'])
                                                            &nbsp;<a class="active d-inline-block" href="{{ url($headerMessage[2]['value']) }}">{!! BaseHelper::clean($headerMessage[3]['value']) !!}</a>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @php $currencies = is_plugin_active('ecommerce') ? get_all_currencies() : []; @endphp

                        @if (is_plugin_active('ecommerce') || is_plugin_active('language'))
                            <div class="col-xl-4 col-lg-4">
                                <div class="header-info header-info-right">
                                        <ul>
                                            @if (is_plugin_active('language'))
                                                {!! Theme::partial('language-switcher') !!}
                                            @endif

                                            @if (is_plugin_active('ecommerce'))
                                                @if (count($currencies) > 1)
                                                    <li>
                                                        <a class="language-dropdown-active" href="#"> <i class="fa fa-coins"></i> {{ get_application_currency()->title }} <i class="fa fa-chevron-down"></i></a>
                                                        <ul class="language-dropdown">
                                                            @foreach ($currencies as $currency)
                                                                @if ($currency->id !== get_application_currency_id())
                                                                    <li><a href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                                @if (auth('customer')->check())
                                                    <li><a href="{{ route('customer.overview') }}">{{ auth('customer')->user()->name }}</a></li>
                                                @else
                                                    <li><a href="{{ route('customer.login') }}">{{ __('Log In / Sign Up') }}</a></li>
                                                @endif
                                            @endif
                                        </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap header-space-between">
                        <div class="logo logo-width-1">
                            @if (theme_option('logo'))
                                <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}"></a>
                            @endif
                        </div>
                        @if (is_plugin_active('ecommerce'))
                            <div class="search-style-2">
                                <form action="{{ route('public.products') }}" method="get">
                                    <div class="form-group--icon">
                                        <div class="product-cat-label">{{ __('All Categories') }}</div>
                                        <select class="product-category-select" name="categories[]">
                                            <option value="">{{ __('All Categories') }}</option>
                                            {!! Theme::partial('product-categories-select', ['categories' => $categories, 'indent' => null]) !!}
                                        </select>
                                    </div>
                                    <input type="text" name="q" placeholder="{{ __('Search for items…') }}" autocomplete="off">
                                    <button type="submit"> <i class="far fa-search"></i> </button>
                                </form>
                            </div>
                            <div class="header-action-right">
                                <div class="header-action-2">
                                    @if (EcommerceHelper::isCompareEnabled())
                                        <div class="header-action-icon-2">
                                            <a href="{{ route('public.compare') }}" class="compare-count">
                                                <img class="svgInject" alt="{{ __('Compare') }}" src="{{ Theme::asset()->url('images/icons/icon-compare.svg') }}">
                                                <span class="pro-count blue"><span>{{ Cart::instance('compare')->count() }}</span></span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (EcommerceHelper::isWishlistEnabled())
                                        <div class="header-action-icon-2">
                                            <a href="{{ route('public.wishlist') }}" class="wishlist-count">
                                                <img class="svgInject" alt="{{ __('Wishlist') }}" src="{{ Theme::asset()->url('images/icons/icon-heart.svg') }}">
                                                <span class="pro-count blue">@if (auth('customer')->check())<span>{{ auth('customer')->user()->wishlist()->count() }}</span> @else <span>{{ Cart::instance('wishlist')->count() }}</span>@endif</span>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="{{ route('public.cart') }}">
                                            <img alt="{{ __('Cart') }}" src="{{ Theme::asset()->url('images/icons/icon-cart.svg') }}">
                                            <span class="pro-count blue">{{ Cart::instance('cart')->count() }}</span>
                                        </a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                            {!! Theme::partial('cart-panel') !!}
                                        </div>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('customer.login') }}">
                                            <img alt="{{ __('Sign In') }}" src="{{ Theme::asset()->url('images/icons/icon-user.svg') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header-bottom header-bottom-bg-color sticky-bar gray-bg sticky-blue-bg">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative main-nav">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            @if ($logo = theme_option('logo_light') ?: theme_option('logo'))
                                <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl($logo) }}" alt="{{ theme_option('site_title') }}"></a>
                            @endif
                        </div>

                        @if (theme_option('enabled_browse_categories_on_header', 'yes') == 'yes')
                            @php
                                $openBrowse = $page && $page->template == 'homepage' && $page->getMetaData('expanding_product_categories_on_the_homepage', true) == 'yes';
                                $cantCloseBrowse = $openBrowse && $headerStyle == 'header-style-2';
                            @endphp
                            <div class="main-categories-wrap d-none d-lg-block">
                            <a class="categories-button-active @if ($openBrowse) open @endif @if ($cantCloseBrowse) cant-close @endif" href="#">
                                <span class="fa fa-list"></span> {{ __('Browse Categories') }} <i class="down far fa-chevron-down"></i> <i class="up far fa-chevron-up"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large @if ($openBrowse) default-open open @endif">
                                <ul>
                                    {!! Theme::partial('product-categories-dropdown', ['categories' => $categories, 'more' => false]) !!}
                                    @if (count($categories) > 10)
                                        <li>
                                            <ul class="more_slide_open">
                                                {!! Theme::partial('product-categories-dropdown', ['categories' => $categories, 'more' => true]) !!}
                                            </ul>
                                        </li>
                                    @endif
                                </ul>

                                @if (count($categories) > 10)
                                    <div class="more_categories">{{ __('Show more...') }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block main-menu-light-white hover-boder hover-boder-white">
                            <nav>
                                {!!
                                    Menu::renderMenuLocation('main-menu', [
                                        'view' => 'main-menu',
                                    ])
                                !!}
                            </nav>
                        </div>

                        @if (theme_option('hotline'))
                            <div class="hotline d-none d-lg-block">
                                <p><i class="fa fa-phone-alt"></i><span>{{ __('Hotline') }}</span> {{ theme_option('hotline') }}</p>
                            </div>
                        @endif

                        @if (is_plugin_active('ecommerce'))
                            <div class="header-action-right d-block d-lg-none">
                                <div class="header-action-2">
                                    @if (EcommerceHelper::isCompareEnabled())
                                        <div class="header-action-icon-2">
                                            <a href="{{ route('public.compare') }}" class="compare-count">
                                                <img class="svgInject" alt="{{ __('Compare') }}" src="{{ Theme::asset()->url('images/icons/icon-compare-white.svg') }}">
                                                <span class="pro-count white"><span>{{ Cart::instance('compare')->count() }}</span></span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (EcommerceHelper::isWishlistEnabled())
                                        <div class="header-action-icon-2">
                                            <a href="{{ route('public.wishlist') }}" class="wishlist-count">
                                                <img alt="wowy" src="{{ Theme::asset()->url('images/icons/icon-heart-white.svg') }}">
                                                <span class="pro-count white">@if (auth('customer')->check())<span>{{ auth('customer')->user()->wishlist()->count() }}</span> @else <span>{{ Cart::instance('wishlist')->count() }}</span>@endif</span>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="{{ route('public.cart') }}">
                                            <img alt="cart" src="{{ Theme::asset()->url('images/icons/icon-cart-white.svg') }}">
                                            <span class="pro-count white">{{ Cart::instance('cart')->count() }}</span>
                                        </a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                            {!! Theme::partial('cart-panel') !!}
                                        </div>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('customer.login') }}">
                                            <img alt="wowy" src="{{ Theme::asset()->url('images/icons/icon-user-white.svg') }}">
                                        </a>
                                    </div>
                                    <div class="header-action-icon-2 d-block d-lg-none">
                                        <div class="burger-icon burger-icon-white">
                                            <span class="burger-icon-top"></span>
                                            <span class="burger-icon-mid"></span>
                                            <span class="burger-icon-bottom"></span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="mobile-header-wrapper-inner">
                <div class="mobile-header-top">
                    @if (theme_option('logo'))
                        <div class="mobile-header-logo">
                            <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}"></a>
                        </div>
                    @endif
                    <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                        <button class="close-style search-close">
                            <i class="icon-top"></i>
                            <i class="icon-bottom"></i>
                        </button>
                    </div>
                </div>
                @if (is_plugin_active('ecommerce'))
                    <div class="mobile-header-content-area">
                    <div class="mobile-search search-style-3 mobile-header-border">
                        <form action="{{ route('public.products') }}">
                            <input type="text" name="q" placeholder="{{ __('Search...') }}">
                            <button type="submit"> <i class="far fa-search"></i> </button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <div class="main-categories-wrap mobile-header-border">
                            <a class="categories-button-active-2" href="#">
                                <span class="far fa-bars"></span> {{ __('Browse Categories') }} <i class="down far fa-chevron-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-small">
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ $category->url }}">
                                                @if ($category->getMetaData('icon_image', true))
                                                    <img src="{{ RvMedia::getImageUrl($category->getMetaData('icon_image', true)) }}" alt="{{ $category->name }}" width="18" height="18">
                                                @elseif ($category->getMetaData('icon', true))
                                                    <i class="{{ $category->getMetaData('icon', true) }}"></i>
                                                @endif {{ $category->name }}

                                                @if ($category->activeChildren->count() > 0)
                                                    <span class="menu-expand"><i class="down far fa-chevron-down"></i></span>
                                                @endif
                                            </a>
                                            @if ($category->activeChildren->count() > 0)
                                                <ul class="dropdown" style="display: none">
                                                    @foreach($category->activeChildren as $childCategory)
                                                        <li><a href="{{ $childCategory->url }}">{{ $childCategory->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- mobile menu start -->
                        <nav>
                            {!!
                                Menu::renderMenuLocation('main-menu', [
                                    'options' => ['class' => 'mobile-menu'],
                                    'view'    => 'mobile-menu',
                                ])
                            !!}
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="mobile-header-info-wrap mobile-header-border">
                        @if (is_plugin_active('language'))
                            <div class="single-mobile-header-info">
                                <a class="mobile-language-active" href="#">{{ __('Language') }} <span><i class="far fa-angle-down"></i></span></a>
                                <div class="lang-curr-dropdown lang-dropdown-active">
                                    <ul>
                                        @php
                                            $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
                                        @endphp

                                        @foreach (Language::getSupportedLocales() as $localeCode => $properties)
                                            <li><a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}">{!! language_flag($properties['lang_flag'], $properties['lang_name']) !!} {{ $properties['lang_name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (count($currencies) > 1)
                            <div class="single-mobile-header-info">
                                <a class="mobile-language-active" href="#">{{ __('Currency') }} <span><i class="far fa-angle-down"></i></span></a>
                                <div class="lang-curr-dropdown lang-dropdown-active">
                                    <ul>
                                        @foreach ($currencies as $currency)
                                            <li><a href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (is_plugin_active('ecommerce'))
                            <div class="single-mobile-header-info">
                                @if (auth('customer')->check())
                                    <a href="{{ route('customer.overview') }}">{{ auth('customer')->user()->name }}</a>
                                @else
                                    <a href="{{ route('customer.login') }}">{{ __('Log In / Sign Up') }}</a>
                                @endif
                            </div>
                        @endif

                        @if (theme_option('hotline'))
                            <div class="single-mobile-header-info">
                                <a href="tel:{{ theme_option('hotline') }}">{{ theme_option('hotline') }}</a>
                            </div>
                        @endif
                    </div>

                    @if (theme_option('social_links'))
                        <div class="mobile-social-icon">
                            @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                                @if (count($socialLink) == 4)
                                    <a href="{{ $socialLink[2]['value'] }}"
                                       title="{{ $socialLink[0]['value'] }}" style="background-color: {{ $socialLink[3]['value'] }}; border: 1px solid {{ $socialLink[3]['value'] }};">
                                        <i class="{{ $socialLink[1]['value'] }}"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div> --}}
        <div class="wrapper">
        <header>
            <div class="container">

                <div class="header-left">
                    <div class="burger">
                        <div class="cross">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p>Каталог товарів</p>


                        {{-- @if (theme_option('enabled_browse_categories_on_header', 'yes') == 'yes')
                            @php
                                $openBrowse = $page && $page->template == 'homepage' && $page->getMetaData('expanding_product_categories_on_the_homepage', true) == 'yes';
                                $cantCloseBrowse = $openBrowse && $headerStyle == 'header-style-2';
                            @endphp
                            <div class="categories-dropdown-wrap categories-dropdown-active-large @if ($openBrowse) default-open open @endif">
                                <ul>
                                    {!! Theme::partial('product-categories-dropdown', ['categories' => $categories, 'more' => false]) !!}
                                    @if (count($categories) > 10)
                                        <li>
                                            <ul class="more_slide_open">
                                                {!! Theme::partial('product-categories-dropdown', ['categories' => $categories, 'more' => true]) !!}
                                            </ul>
                                        </li>
                                    @endif
                                </ul>

                                @if (count($categories) > 10)
                                    <div class="more_categories">{{ __('Show more...') }}</div>
                                @endif
                            </div>
                        </div>
                        @endif --}}


                        <nav data-da=".wrapper, 1200, 3" class="catalog">
                            <div class="back">
                                <a href="#">
                                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.52909 4.875V0L0 6.5L6.52909 13V8.125H18V4.875H6.52909Z" fill="#333333"/>
                                    </svg>
                                    Назад
                                </a>
                            </div>
                            @if (count($categories) > 10)
                                <ul>
                                    {!! Theme::partial('product-categories-dropdown', ['categories' => $categories, 'more' => false]) !!}
                                </ul>
                            @endif
                        </nav>
                    </div>
                    
                    <button class="opensearch">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.37859 2.37859C5.55003 -0.792864 10.692 -0.792864 13.8634 2.37859C16.9018 5.417 17.0293 10.264 14.2458 13.4542L19.205 18.4133C19.5956 18.8038 19.5956 19.437 19.205 19.8275C18.8145 20.218 18.1813 20.218 17.7908 19.8275L12.755 14.7918C9.5887 16.9968 5.2025 16.6874 2.37859 13.8635C-0.792862 10.692 -0.792862 5.55005 2.37859 2.37859ZM12.4492 3.79281C10.0588 1.4024 6.1832 1.4024 3.7928 3.79281C1.4024 6.18322 1.4024 10.0588 3.7928 12.4492C6.1832 14.8396 10.0588 14.8396 12.4492 12.4492C14.8396 10.0588 14.8396 6.18322 12.4492 3.79281Z"
                                fill="#333333" />
                        </svg>
                    </button>
                    <form class="search" action="{{ route('public.products') }}" method="get">
                        <input type="text" placeholder="Пошук" name="q">
                        <button type="submit" class="search-btn">Пошук</button>
                        <div class="ajax-search">
                            {{-- <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="#" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="#" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="#" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div> --}}
                            <!-- <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="search-product">
                                <div class="photo">
                                    <img width="100" height="100" src="assets/img/search.png" alt="">
                                </div>
                                <div class="product-info">
                                    <div class="articul">Артикул: 158465</div>
                                    <div class="name">Вітаміни OstroVit Omega 3 D3+K2 90 кап</div>
                                    <div class="price">3 700 ₴</div>
                                </div>
                                <a href="" class="buy-btn">
                                    <svg width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7638 4.97256L14.7529 1.83627C14.3379 1.40402 14.352 0.717224 14.7843 0.302274C15.2165 -0.112677 15.9033 -0.0986702 16.3182 0.333585L20.6579 4.85409C20.6941 4.89177 20.727 4.93137 20.7567 4.97256H23.4767C23.5962 4.97256 23.7156 4.98243 23.8334 5.00208C25.0155 5.19909 25.814 6.31706 25.617 7.49913L23.9599 17.4418C23.6983 19.0112 22.3405 20.1615 20.7495 20.1615H4.89712C3.30606 20.1615 1.9482 19.0112 1.68664 17.4418L0.0295229 7.49913C0.00987496 7.38124 0 7.26192 0 7.1424C0 5.94403 0.971467 4.97256 2.16984 4.97256H4.8899C4.91956 4.93137 4.95247 4.89177 4.98864 4.85409L9.32833 0.333585C9.74328 -0.0986702 10.4301 -0.112677 10.8623 0.302274C11.2945 0.717224 11.3086 1.40402 10.8936 1.83627L7.88278 4.97256H17.7638ZM2.16984 7.1424L3.82695 17.0851C3.91415 17.6082 4.36676 17.9917 4.89712 17.9917H20.7495C21.2798 17.9917 21.7324 17.6082 21.8196 17.0851L23.4767 7.1424H2.16984ZM12.8233 9.31229C13.4225 9.31229 13.9082 9.79801 13.9082 10.3972V14.7369C13.9082 15.336 13.4225 15.8218 12.8233 15.8218C12.2241 15.8218 11.7384 15.336 11.7384 14.7369V10.3972C11.7384 9.79801 12.2241 9.31229 12.8233 9.31229ZM7.39867 9.31229C7.99786 9.31229 8.48359 9.79801 8.48359 10.3972V14.7369C8.48359 15.336 7.99786 15.8218 7.39867 15.8218C6.79948 15.8218 6.31374 15.336 6.31374 14.7369V10.3972C6.31374 9.79801 6.79948 9.31229 7.39867 9.31229ZM18.2479 9.31229C18.8471 9.31229 19.3328 9.79801 19.3328 10.3972V14.7369C19.3328 15.336 18.8471 15.8218 18.2479 15.8218C17.6487 15.8218 17.163 15.336 17.163 14.7369V10.3972C17.163 9.79801 17.6487 9.31229 18.2479 9.31229Z" fill="white"/>
                                        <path d="M28.2718 18.1147V17.3647H27.5218H25.0758V15.0811V14.3311H24.3258H22.8345H22.0845V15.0811V17.3647H19.6465H18.8965V18.1147V19.5376V20.2876H19.6465H22.0845V22.7717V23.5217H22.8345H24.3258H25.0758V22.7717V20.2876H27.5218H28.2718V19.5376V18.1147Z" fill="white" stroke="#00A046" stroke-width="1.5"/>
                                    </svg>
                                </a>
                            </div> -->


                            <!-- Если ничего не найдено -->
                            <!-- <div class="notfound">Ничего не найдено</div> -->

                            <!-- Показать все результаты если они есть -->
                            {{-- <a href="#" class="allresults">Показати всі результати пошуку</a> --}}
                        </div>
                    </form>
                </div>
                
                @if (theme_option('logo'))
                    <a href="{{ route('public.index') }}" class="head-logo">
                        <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}">
                    </a>
                @endif

                <div class="header-right">
                    @if (auth('customer')->check())
                        <a href="{{ route('customer.overview') }}" class="cabinet _popup-link">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.85 21V21.15H1H2.5625H2.7125V21C2.7125 16.4304 6.43038 12.7125 11 12.7125C15.5696 12.7125 19.2875 16.4304 19.2875 21V21.15H19.4375H21H21.15V21C21.15 18.2891 20.094 15.7398 18.1772 13.8228L18.0711 13.9289L18.1772 13.8228C17.1412 12.7869 15.9201 12.0028 14.5885 11.5005C16.0108 10.4164 16.9312 8.70458 16.9312 6.78125C16.9312 3.51063 14.2706 0.85 11 0.85C7.72938 0.85 5.06875 3.51063 5.06875 6.78125C5.06875 8.70459 5.98917 10.4164 7.41157 11.5005C6.07995 12.0028 4.85885 12.7869 3.82288 13.8228L3.92895 13.9289L3.82288 13.8228C1.906 15.7398 0.85 18.2891 0.85 21ZM11 10.85C8.75663 10.85 6.93125 9.02466 6.93125 6.78125C6.93125 4.53784 8.75663 2.7125 11 2.7125C13.2434 2.7125 15.0688 4.53784 15.0688 6.78125C15.0688 9.02466 13.2434 10.85 11 10.85Z"
                                    fill="#333333" stroke="#333333" stroke-width="0.3" />
                            </svg>
                            <span>{{ auth('customer')->user()->name }}</span>
                        </a>
                    @else
                        {{-- #login --}}
                        <a href="{{ route('customer.login') }}" class="cabinet _popup-link">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.85 21V21.15H1H2.5625H2.7125V21C2.7125 16.4304 6.43038 12.7125 11 12.7125C15.5696 12.7125 19.2875 16.4304 19.2875 21V21.15H19.4375H21H21.15V21C21.15 18.2891 20.094 15.7398 18.1772 13.8228L18.0711 13.9289L18.1772 13.8228C17.1412 12.7869 15.9201 12.0028 14.5885 11.5005C16.0108 10.4164 16.9312 8.70458 16.9312 6.78125C16.9312 3.51063 14.2706 0.85 11 0.85C7.72938 0.85 5.06875 3.51063 5.06875 6.78125C5.06875 8.70459 5.98917 10.4164 7.41157 11.5005C6.07995 12.0028 4.85885 12.7869 3.82288 13.8228L3.92895 13.9289L3.82288 13.8228C1.906 15.7398 0.85 18.2891 0.85 21ZM11 10.85C8.75663 10.85 6.93125 9.02466 6.93125 6.78125C6.93125 4.53784 8.75663 2.7125 11 2.7125C13.2434 2.7125 15.0688 4.53784 15.0688 6.78125C15.0688 9.02466 13.2434 10.85 11 10.85Z"
                                    fill="#333333" stroke="#333333" stroke-width="0.3" />
                            </svg>
                            <span>Кабінет</span>
                        </a>
                    @endif
                    
                    @if (EcommerceHelper::isWishlistEnabled())
                        <a href="#view_featured_unlogin" class="featured _popup-link">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.6 2.22222C4.16995 2.22222 2.2 4.21207 2.2 6.66667C2.2 6.70067 2.20038 6.73457 2.20112 6.76835C2.20145 6.78301 2.20148 6.79767 2.20123 6.81234C2.20042 6.86023 2.2 6.90902 2.2 6.9587C2.2 10.5914 4.15083 13.2893 6.34071 15.1283C7.43243 16.0451 8.55869 16.725 9.47008 17.1726C9.9256 17.3964 10.3173 17.5571 10.6137 17.6591C10.8285 17.7331 10.95 17.761 10.9957 17.7714C10.9971 17.7718 10.9985 17.7721 10.9998 17.7724C11.0012 17.7721 11.0026 17.7717 11.0041 17.7714C11.0499 17.7609 11.1711 17.7329 11.3855 17.6589C11.6819 17.5566 12.0736 17.3956 12.5292 17.1714C13.4407 16.7229 14.5671 16.0419 15.659 15.1244C17.8495 13.2836 19.8 10.5856 19.8 6.9587C19.8 6.90905 19.7996 6.86032 19.7988 6.81249C19.7985 6.7978 19.7986 6.78311 19.7989 6.76843C19.7996 6.73463 19.8 6.7007 19.8 6.66667C19.8 4.21207 17.8301 2.22222 15.4 2.22222C13.9614 2.22222 12.6841 2.91844 11.8794 4.00021C11.6717 4.27956 11.3459 4.44391 11 4.44391C10.6541 4.44391 10.3283 4.27956 10.1206 4.00021C9.31594 2.91844 8.03862 2.22222 6.6 2.22222ZM0 6.66667C0 2.98477 2.95492 0 6.6 0C8.29078 0 9.83309 0.642919 11 1.69768C12.1669 0.642919 13.7092 0 15.4 0C19.0451 0 22 2.98477 22 6.66667C22 6.70975 21.9996 6.75276 21.9988 6.79568C21.9996 6.84954 22 6.90388 22 6.9587C22 11.4778 19.5505 14.7448 17.066 16.8327C15.8204 17.8794 14.5406 18.6536 13.4927 19.1692C12.9685 19.4271 12.4923 19.6253 12.0969 19.7618C11.749 19.8819 11.3377 20 11 20C10.6629 20 10.2519 19.8824 9.90387 19.7625C9.50849 19.6264 9.03222 19.4286 8.50804 19.1711C7.46006 18.6564 6.18007 17.8833 4.93429 16.8371C2.44917 14.7502 0 11.4831 0 6.9587C0 6.90385 0.000404668 6.84949 0.0012142 6.79562C0.000405782 6.75272 0 6.70974 0 6.66667Z"
                                    fill="#333333" />
                            </svg>
                            @if (auth('customer')->check())
                                <span>{{ auth('customer')->user()->wishlist()->count() }}</span> 
                            @else 
                                <span>{{ Cart::instance('wishlist')->count() }}</span>
                            @endif
                        </a>
                    @endif
                    <a href="#" class="cart">
                        <svg width="26" height="20" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.0084 4.93272L14.9561 1.82156C14.5354 1.39278 14.5497 0.711478 14.9878 0.299852C15.426 -0.111774 16.1222 -0.0978797 16.5429 0.330912L20.9424 4.8152C20.979 4.85258 21.0124 4.89186 21.0425 4.93272H23.7999C23.9211 4.93272 24.0421 4.94252 24.1616 4.96201C25.36 5.15744 26.1695 6.26645 25.9697 7.43905L24.2898 17.3021C24.0246 18.8589 22.6481 20 21.0352 20H4.96455C3.35158 20 1.97503 18.8589 1.70986 17.3021L0.0299294 7.43905C0.0100109 7.32211 0 7.20374 0 7.08519C0 5.89641 0.984844 4.93272 2.19972 4.93272H4.95723C4.9873 4.89186 5.02066 4.85258 5.05733 4.8152L9.45677 0.330912C9.87743 -0.0978797 10.5737 -0.111774 11.0118 0.299852C11.45 0.711478 11.4643 1.39278 11.0436 1.82156L7.99132 4.93272H18.0084ZM2.19972 7.08519L3.87964 16.9482C3.96804 17.4671 4.42689 17.8475 4.96455 17.8475H21.0352C21.5728 17.8475 22.0317 17.4671 22.12 16.9482L23.7999 7.08519H2.19972ZM12.9998 9.23769C13.6073 9.23769 14.0997 9.71952 14.0997 10.3139V14.6188C14.0997 15.2131 13.6073 15.6951 12.9998 15.6951C12.3924 15.6951 11.9 15.2131 11.9 14.6188V10.3139C11.9 9.71952 12.3924 9.23769 12.9998 9.23769ZM7.50054 9.23769C8.10798 9.23769 8.6004 9.71952 8.6004 10.3139V14.6188C8.6004 15.2131 8.10798 15.6951 7.50054 15.6951C6.89311 15.6951 6.40068 15.2131 6.40068 14.6188V10.3139C6.40068 9.71952 6.89311 9.23769 7.50054 9.23769ZM18.4991 9.23769C19.1066 9.23769 19.599 9.71952 19.599 10.3139V14.6188C19.599 15.2131 19.1066 15.6951 18.4991 15.6951C17.8917 15.6951 17.3993 15.2131 17.3993 14.6188V10.3139C17.3993 9.71952 17.8917 9.23769 18.4991 9.23769Z"
                                fill="#333333" />
                        </svg>
                        <span class="pro-count">{{ Cart::instance('cart')->count() }}</span>
                    </a>
                </div>
            </div>
        </header>

        <div class="close">×</div>

        <div class="mobile-menu">
            @if (theme_option('logo'))
                <div class="logo">
                    <img width="60" height="14" src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}">
                </div>
            @endif
            <div class="burger">
                <div class="cross">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <p>Каталог товарів</p>
            </div>

            <ul>
                <li>
                    <a href="#">
                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4673 3.45291L10.3542 1.27509C10.0629 0.974943 10.0728 0.498035 10.3762 0.209896C10.6796 -0.0782418 11.1615 -0.0685158 11.4528 0.231639L14.4986 3.37064C14.5239 3.3968 14.5471 3.4243 14.5679 3.45291H16.4769C16.5608 3.45291 16.6445 3.45976 16.7272 3.47341C17.5569 3.61021 18.1173 4.38652 17.979 5.20734L16.816 12.1115C16.6324 13.2012 15.6795 14 14.5628 14H3.43699C2.32032 14 1.36733 13.2012 1.18375 12.1115L0.0207203 5.20734C0.00693064 5.12548 0 5.04262 0 4.95963C0 4.12749 0.681815 3.45291 1.52288 3.45291H3.43193C3.45275 3.4243 3.47584 3.3968 3.50123 3.37064L6.547 0.231639C6.83822 -0.0685158 7.32024 -0.0782418 7.62358 0.209896C7.92694 0.498035 7.93684 0.974943 7.64559 1.27509L5.53245 3.45291H12.4673ZM1.52288 4.95963L2.68591 11.8638C2.7471 12.227 3.06477 12.4933 3.43699 12.4933H14.5628C14.935 12.4933 15.2527 12.227 15.3138 11.8638L16.4769 4.95963H1.52288ZM8.99989 6.46638C9.42043 6.46638 9.76133 6.80366 9.76133 7.21975V10.2332C9.76133 10.6492 9.42043 10.9866 8.99989 10.9866C8.57934 10.9866 8.23845 10.6492 8.23845 10.2332V7.21975C8.23845 6.80366 8.57934 6.46638 8.99989 6.46638ZM5.19268 6.46638C5.61322 6.46638 5.95412 6.80366 5.95412 7.21975V10.2332C5.95412 10.6492 5.61322 10.9866 5.19268 10.9866C4.77215 10.9866 4.43124 10.6492 4.43124 10.2332V7.21975C4.43124 6.80366 4.77215 6.46638 5.19268 6.46638ZM12.8071 6.46638C13.2276 6.46638 13.5685 6.80366 13.5685 7.21975V10.2332C13.5685 10.6492 13.2276 10.9866 12.8071 10.9866C12.3866 10.9866 12.0457 10.6492 12.0457 10.2332V7.21975C12.0457 6.80366 12.3866 6.46638 12.8071 6.46638Z" fill="#333333"/>
                        </svg>
                        Кошик ({{ Cart::instance('cart')->count() }})
                    </a>
                </li>

                @if (EcommerceHelper::isWishlistEnabled())
                    <li>
                        <a href="{{ route('public.wishlist') }}" class="_popup-link">
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.1 1.66667C3.22223 1.66667 1.7 3.15905 1.7 5C1.7 5.0255 1.70029 5.05092 1.70087 5.07626C1.70112 5.08726 1.70115 5.09826 1.70095 5.10925C1.70032 5.14517 1.7 5.18176 1.7 5.21903C1.7 7.94357 3.20746 9.967 4.89964 11.3462C5.74324 12.0338 6.61353 12.5438 7.31779 12.8795C7.66978 13.0473 7.97245 13.1678 8.2015 13.2444C8.36748 13.2998 8.46133 13.3207 8.49667 13.3286C8.49779 13.3288 8.49885 13.3291 8.49986 13.3293C8.5009 13.3291 8.50201 13.3288 8.50319 13.3285C8.53854 13.3206 8.63224 13.2997 8.79791 13.2442C9.02695 13.1675 9.32964 13.0467 9.68166 12.8786C10.386 12.5422 11.2564 12.0314 12.1001 11.3433C13.7928 9.96268 15.3 7.93916 15.3 5.21903C15.3 5.18179 15.2997 5.14524 15.299 5.10936C15.2989 5.09835 15.2989 5.08733 15.2991 5.07632C15.2997 5.05097 15.3 5.02553 15.3 5C15.3 3.15905 13.7778 1.66667 11.9 1.66667C10.7883 1.66667 9.80133 2.18883 9.17957 3.00016C9.01902 3.20967 8.76729 3.33293 8.5 3.33293C8.23271 3.33293 7.98099 3.20967 7.82043 3.00016C7.19868 2.18883 6.21166 1.66667 5.1 1.66667ZM0 5C0 2.23858 2.28335 0 5.1 0C6.40651 0 7.5983 0.482189 8.5 1.27326C9.40171 0.482189 10.5935 0 11.9 0C14.7167 0 17 2.23858 17 5C17 5.03231 16.9997 5.06457 16.9991 5.09676C16.9997 5.13716 17 5.17791 17 5.21903C17 8.60833 15.1072 11.0586 13.1874 12.6245C12.2248 13.4096 11.2359 13.9902 10.4261 14.3769C10.0211 14.5703 9.65313 14.719 9.34759 14.8213C9.07877 14.9114 8.76092 15 8.5 15C8.23949 15 7.92194 14.9118 7.65299 14.8219C7.34747 14.7198 6.97944 14.5714 6.5744 14.3783C5.76459 13.9923 4.77551 13.4124 3.81286 12.6278C1.89254 11.0627 0 8.6123 0 5.21903C0 5.17789 0.000312698 5.13712 0.000938246 5.09672C0.000313559 5.06454 0 5.0323 0 5Z" fill="#333333"/>
                            </svg>
                            Вибране (@if(auth('customer')->check()){{auth('customer')->user()->wishlist()->count()}}@else{{Cart::instance('wishlist')->count()}}@endif)
                        </a>
                    </li>
                @endif

                @if (auth('customer')->check())
                    <li>
                        {{-- #login --}}
                        <a href="{{ route('customer.overview') }}" class="_popup-link">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.85 18V18.15H1H2.32812H2.47812V18C2.47812 14.1283 5.62825 10.9781 9.5 10.9781C13.3717 10.9781 16.5219 14.1283 16.5219 18V18.15H16.6719H18H18.15V18C18.15 15.6898 17.25 13.5171 15.6165 11.8835L15.5104 11.9896L15.6165 11.8835C14.7435 11.0105 13.7161 10.3473 12.5959 9.91873C13.792 8.99201 14.5641 7.54176 14.5641 5.91406C14.5641 3.12161 12.2924 0.85 9.5 0.85C6.70755 0.85 4.43594 3.12161 4.43594 5.91406C4.43594 7.54176 5.20803 8.99201 6.40417 9.91873C5.28395 10.3473 4.25657 11.0105 3.38354 11.8835L3.4896 11.9896L3.38354 11.8835C1.74997 13.5171 0.85 15.6898 0.85 18ZM9.5 9.35C7.60556 9.35 6.06406 7.80853 6.06406 5.91406C6.06406 4.01959 7.60556 2.47812 9.5 2.47812C11.3944 2.47812 12.9359 4.01959 12.9359 5.91406C12.9359 7.80853 11.3944 9.35 9.5 9.35Z" fill="#333333" stroke="#333333" stroke-width="0.3"/>
                            </svg>
                            {{ auth('customer')->user()->name }}
                        </a>
                    </li>
                @else
                    <li>
                        {{-- #login --}}
                        <a href="{{ route('customer.login') }}" class="_popup-link">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.85 18V18.15H1H2.32812H2.47812V18C2.47812 14.1283 5.62825 10.9781 9.5 10.9781C13.3717 10.9781 16.5219 14.1283 16.5219 18V18.15H16.6719H18H18.15V18C18.15 15.6898 17.25 13.5171 15.6165 11.8835L15.5104 11.9896L15.6165 11.8835C14.7435 11.0105 13.7161 10.3473 12.5959 9.91873C13.792 8.99201 14.5641 7.54176 14.5641 5.91406C14.5641 3.12161 12.2924 0.85 9.5 0.85C6.70755 0.85 4.43594 3.12161 4.43594 5.91406C4.43594 7.54176 5.20803 8.99201 6.40417 9.91873C5.28395 10.3473 4.25657 11.0105 3.38354 11.8835L3.4896 11.9896L3.38354 11.8835C1.74997 13.5171 0.85 15.6898 0.85 18ZM9.5 9.35C7.60556 9.35 6.06406 7.80853 6.06406 5.91406C6.06406 4.01959 7.60556 2.47812 9.5 2.47812C11.3944 2.47812 12.9359 4.01959 12.9359 5.91406C12.9359 7.80853 11.3944 9.35 9.5 9.35Z" fill="#333333" stroke="#333333" stroke-width="0.3"/>
                            </svg>
                            Кабінет
                        </a>
                    </li>
                @endif

                @if (EcommerceHelper::isCompareEnabled())
                    <li>
                        <a href="{{ route('public.compare') }}">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.30807 8.09902H0V9.89875H6.30807V12.5984L9.89854 8.99888L6.30807 5.39941V8.09902Z" fill="#333333"/>
                                <path d="M11.692 2.6996V0L8.10156 3.59947L11.692 7.19894V4.49934H18.0001V2.6996H11.692Z" fill="#333333"/>
                            </svg>
                            Порівняння ({{ Cart::instance('compare')->count() }})
                        </a>
                    </li>
                @endif
            </ul>



            <div class="contacts">
                @if (theme_option('phone'))
                    <p class="title">Call-центр</p>
                    <a class="phone" href="tel:{{ theme_option('phone') }}">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.0526 7.90106C10.3124 7.90106 9.58738 7.78548 8.90021 7.55873C8.56484 7.44315 8.184 7.53221 7.96359 7.75706L6.60127 8.7859C5.03811 7.9516 4.03769 6.95179 3.21475 5.4L4.21579 4.0699C4.46779 3.8179 4.55812 3.44905 4.45012 3.10358C4.22148 2.412 4.10528 1.68632 4.10528 0.947369C4.10528 0.425043 3.68023 0 3.15791 0H0.947369C0.425043 0 0 0.425043 0 0.947369C0 7.04147 4.95853 12 11.0526 12C11.575 12 12 11.575 12 11.0526V8.84843C12 8.3261 11.575 7.90106 11.0526 7.90106Z" fill="#00963D"/>
                        </svg>
                        {{ theme_option('phone') }}
                    </a>   
                @endif

                @if (theme_option('social_links'))
                    @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                        @if($socialLink[0]['value'] == 'Telegram')
                            <a class="tg" href="{{ $socialLink[2]['value'] }}">
                                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.651878 4.95405L13.0676 0.0598993C13.6439 -0.152938 14.1471 0.203619 13.9604 1.09446L13.9615 1.09336L11.8475 11.2755C11.6908 11.9974 11.2712 12.1729 10.6843 11.8328L7.46497 9.40716L5.91219 10.9365C5.7405 11.1121 5.59563 11.2602 5.26297 11.2602L5.49154 7.91072L11.458 2.40001C11.7176 2.16633 11.4 2.03467 11.0577 2.26726L3.68445 7.0133L0.505936 5.99958C-0.184065 5.77577 -0.199088 5.29415 0.651878 4.95405Z" fill="#00963D"/>
                                </svg>
                                Написати у telegram
                            </a>
                        @endif
                    @endforeach
                @endif

                @if (theme_option('schedule') || theme_option('working_hours') || theme_option('working_hours2') || theme_option('working_hours3'))
                    <div class="schedule">
                        @if (theme_option('schedule'))
                            <p>{{ theme_option('schedule') }}</p>
                        @endif

                        @if (theme_option('working_hours'))
                            <p>{{ theme_option('working_hours') }}</p>
                        @endif

                        @if (theme_option('working_hours2'))
                            <p>{{ theme_option('working_hours2') }}</p>
                        @endif

                        @if (theme_option('working_hours3'))
                            <p>{{ theme_option('working_hours3') }}</p>
                        @endif
                    </div>
                @endif

            </div>

            @if (theme_option('social_links'))
                <div class="social">
                    @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                        @if($socialLink[0]['value'] == 'Facebook')
                            <a href="{{ $socialLink[2]['value'] }}">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.5 0C10.0277 0 7.61099 0.733112 5.55538 2.10663C3.49976 3.48015 1.89761 5.43238 0.951511 7.71646C0.00541602 10.0005 -0.242126 12.5139 0.24019 14.9386C0.722505 17.3634 1.91301 19.5907 3.66117 21.3388C5.40933 23.087 7.63661 24.2775 10.0614 24.7598C12.4861 25.2421 14.9995 24.9946 17.2835 24.0485C19.5676 23.1024 21.5199 21.5002 22.8934 19.4446C24.2669 17.389 25 14.9723 25 12.5C25 9.18479 23.683 6.00537 21.3388 3.66116C18.9946 1.31696 15.8152 0 12.5 0V0ZM15.6678 11.3158L15.4605 13.0576C15.4516 13.1384 15.413 13.213 15.3523 13.2671C15.2915 13.3212 15.2129 13.3508 15.1316 13.3503H13.3224V18.5148C13.3228 18.5765 13.2988 18.6358 13.2557 18.6799C13.2126 18.7239 13.1538 18.7491 13.0921 18.75H11.25C11.2193 18.7496 11.189 18.7431 11.1609 18.731C11.1327 18.7188 11.1072 18.7013 11.0858 18.6793C11.0644 18.6573 11.0476 18.6313 11.0363 18.6028C11.0249 18.5743 11.0193 18.5438 11.0197 18.5132L11.0296 13.3503H9.65954C9.5723 13.3503 9.48863 13.3157 9.42694 13.254C9.36525 13.1923 9.3306 13.1086 9.3306 13.0214V11.2812C9.3306 11.194 9.36525 11.1103 9.42694 11.0486C9.48863 10.987 9.5723 10.9523 9.65954 10.9523H11.0197V9.2648C11.0197 7.3125 12.1826 6.25 13.8816 6.25H15.2747C15.3619 6.25 15.4456 6.28466 15.5073 6.34634C15.569 6.40803 15.6036 6.4917 15.6036 6.57895V8.04441C15.6036 8.13165 15.569 8.21532 15.5073 8.27701C15.4456 8.3387 15.3619 8.37335 15.2747 8.37335H14.4211C13.4967 8.38816 13.3224 8.83059 13.3224 9.49177V10.9474H15.3487C15.3946 10.9484 15.4397 10.959 15.4813 10.9786C15.5228 10.9981 15.5598 11.0262 15.5899 11.0609C15.6199 11.0956 15.6424 11.1362 15.6558 11.1801C15.6692 11.224 15.6733 11.2702 15.6678 11.3158Z"
                                        fill="#333333" />
                                </svg>
                            </a>
                        @endif
                        @if($socialLink[0]['value'] == 'Telegram')
                            <a href="{{ $socialLink[2]['value'] }}">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M25 12.5C25 19.4036 19.4036 25 12.5 25C5.59644 25 0 19.4036 0 12.5C0 5.59644 5.59644 0 12.5 0C19.4036 0 25 5.59644 25 12.5ZM16.9082 7.71346L5.82276 11.9893C5.06297 12.2864 5.07638 12.7072 5.69245 12.9027L8.53041 13.7883L15.1137 9.64194C15.4193 9.43874 15.7029 9.55376 15.471 9.75791L10.1439 14.5724L9.93981 17.4986C10.2368 17.4986 10.3662 17.3692 10.5195 17.2159L11.9059 15.8798L14.7802 17.999C15.3043 18.2961 15.679 18.1427 15.8188 17.5121L17.7063 8.61636L17.7054 8.61732C17.8721 7.83903 17.4227 7.52752 16.9082 7.71346Z"
                                        fill="#333333" />
                                </svg>
                            </a>
                        @endif
                        @if($socialLink[0]['value'] == 'Instagram')
                            <a href="{{ $socialLink[2]['value'] }}">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.5 0C19.4036 0 25 5.59644 25 12.5C25 19.4036 19.4036 25 12.5 25C5.59644 25 0 19.4036 0 12.5C0 5.59644 5.59644 0 12.5 0ZM9.53956 5.9209H15.4606C16.4203 5.9209 17.3406 6.30212 18.0192 6.98071C18.6978 7.65929 19.079 8.57965 19.079 9.53932V15.4604C19.079 16.42 18.6978 17.3404 18.0192 18.019C17.3406 18.6976 16.4203 19.0788 15.4606 19.0788H9.53956C8.5799 19.0788 7.65954 18.6976 6.98095 18.019C6.30237 17.3404 5.92114 16.42 5.92114 15.4604V9.53932C5.92114 8.57965 6.30237 7.65929 6.98095 6.98071C7.65954 6.30212 8.5799 5.9209 9.53956 5.9209ZM17.0529 17.0527C17.613 16.4925 17.9277 15.7328 17.9277 14.9406V10.0591C17.9277 9.2669 17.613 8.50718 17.0529 7.94704C16.4928 7.3869 15.733 7.07221 14.9409 7.07221H10.0593C9.26714 7.07221 8.50743 7.3869 7.94728 7.94704C7.38714 8.50718 7.07246 9.2669 7.07246 10.0591V14.9406C7.07246 15.7328 7.38714 16.4925 7.94728 17.0527C8.50743 17.6128 9.26714 17.9275 10.0593 17.9275H14.9409C15.733 17.9275 16.4928 17.6128 17.0529 17.0527ZM14.8997 10.1253L14.8684 10.094L14.8421 10.0677C14.2202 9.44797 13.378 9.10017 12.5 9.10059C12.0567 9.1036 11.6182 9.19394 11.2098 9.36644C10.8014 9.53894 10.4309 9.79023 10.1197 10.1059C9.80838 10.4217 9.56235 10.7956 9.39564 11.2064C9.22892 11.6173 9.14479 12.0569 9.14804 12.5003C9.14737 13.4 9.50204 14.2636 10.1349 14.9032C10.4449 15.217 10.8142 15.4658 11.2214 15.6353C11.6287 15.8047 12.0655 15.8913 12.5066 15.8901C13.1682 15.8762 13.8114 15.6701 14.3579 15.2969C14.9043 14.9238 15.3304 14.3996 15.5841 13.7885C15.8378 13.1773 15.9082 12.5056 15.7866 11.8551C15.6651 11.2046 15.3569 10.6036 14.8997 10.1253ZM12.5 14.7305C12.0576 14.7367 11.6234 14.6112 11.2525 14.3699C10.8817 14.1287 10.591 13.7826 10.4174 13.3756C10.2438 12.9687 10.1951 12.5193 10.2776 12.0846C10.3601 11.65 10.57 11.2496 10.8806 10.9346C11.1913 10.6196 11.5886 10.404 12.022 10.3154C12.4555 10.2268 12.9055 10.2691 13.3149 10.4369C13.7242 10.6048 14.0744 10.8906 14.3209 11.258C14.5674 11.6254 14.699 12.0578 14.699 12.5003C14.7012 12.7911 14.646 13.0796 14.5367 13.3491C14.4273 13.6186 14.2659 13.864 14.0617 14.0711C13.8575 14.2782 13.6144 14.443 13.3465 14.5562C13.0785 14.6693 12.7909 14.7286 12.5 14.7305ZM16.7885 9.25214C16.8281 9.15432 16.8481 9.04965 16.8472 8.94411C16.8479 8.7573 16.784 8.57599 16.6663 8.43095L16.6482 8.41121C16.6266 8.38468 16.6024 8.36043 16.5758 8.33884L16.5594 8.32239C16.4168 8.20334 16.2369 8.13815 16.0512 8.13818C15.8924 8.1408 15.738 8.18994 15.6069 8.27952C15.4759 8.36909 15.374 8.49516 15.314 8.64209C15.2539 8.78902 15.2383 8.95035 15.269 9.10607C15.2998 9.26179 15.3756 9.40506 15.487 9.51812C15.5606 9.59258 15.6481 9.65171 15.7447 9.69208C15.8413 9.73245 15.9449 9.75327 16.0495 9.75331C16.1551 9.75267 16.2594 9.73121 16.3567 9.69018C16.4539 9.64914 16.5421 9.58933 16.6162 9.51416C16.6903 9.439 16.7488 9.34996 16.7885 9.25214Z"
                                        fill="#333333" />
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
