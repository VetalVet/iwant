    {{-- {!! dynamic_sidebar('top_footer_sidebar') !!} --}}
    {{-- <footer class="main">
        <section class="section-padding-60">
            <div class="container">
                <div class="row">
                    {!! dynamic_sidebar('footer_sidebar') !!}
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">{{ theme_option('copyright') }}</p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        {{ __('All rights reserved.') }}
                    </p>
                </div>
            </div>
        </div>
    </footer> --}}

    <!-- Quick view -->
    {{-- <div class="modal fade custom-modal" id="quick-view-modal" tabindex="-1" aria-labelledby="quick-view-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="half-circle-spinner loading-spinner">
                        <div class="circle circle-1"></div>
                        <div class="circle circle-2"></div>
                    </div>
                    <div class="quick-view-content"></div>
                </div>
            </div>
        </div>
    </div>

    @if (is_plugin_active('ecommerce'))
        <script>
            window.currencies = {!! json_encode(get_currencies_json()) !!};
        </script>
    @endif --}}

    {{-- @if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
            <script type="text/javascript">
                window.onload = function () {
                    @if (session()->has('success_msg'))
                    window.showAlert('alert-success', '{{ session('success_msg') }}');
                    @endif

                    @if (session()->has('error_msg'))
                    window.showAlert('alert-danger', '{{ session('error_msg') }}');
                    @endif

                    @if (isset($error_msg))
                    window.showAlert('alert-danger', '{{ $error_msg }}');
                    @endif

                    @if (isset($errors))
                    @foreach ($errors->all() as $error)
                    window.showAlert('alert-danger', '{!! BaseHelper::clean($error) !!}');
                    @endforeach
                    @endif
                };
            </script>
        @endif --}}

        {{-- <div id="scrollUp"><i class="fal fa-long-arrow-up"></i></div> --}}
        <!-- =======================  footer.php  ======================= -->
        <footer>
            <div class="container">
                <div class="footer-top">
                    {!! dynamic_sidebar('footer_sidebar') !!}
                    {!! dynamic_sidebar('footer_sidebar_contact_info') !!}
                </div>
                <div class="footer-bot">
                    <div class="info">
                        <a href="{{ route('public.index') }}" class="head-logo">
                            <svg width="100" height="23" viewBox="0 0 100 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.99 6.86C3.15 6.86 2.42 6.56 1.8 5.96C1.2 5.34 0.9 4.62 0.9 3.8C0.9 2.98 1.2 2.27 1.8 1.67C2.42 1.05 3.15 0.739999 3.99 0.739999C4.81 0.739999 5.52 1.05 6.12 1.67C6.74 2.27 7.05 2.98 7.05 3.8C7.05 4.62 6.74 5.34 6.12 5.96C5.52 6.56 4.81 6.86 3.99 6.86ZM1.2 23V8H6.75V23H1.2Z"
                                    fill="#00963D" />
                                <path
                                    d="M19.8853 23L13.9453 2H20.5453L23.3953 13.55L26.7853 2H31.4053L34.7953 13.55L37.6453 2H44.2453L38.3053 23H32.3953L29.0953 11.78L25.7953 23H19.8853ZM56.6871 23L55.9671 20.3H49.9071L49.1871 23H42.7371L49.4271 2H56.4471L63.1371 23H56.6871ZM51.1971 15.5H54.6771L52.9371 9.05L51.1971 15.5ZM75.7418 2H81.7418V23H76.9418L70.3418 13.4V23H64.3418V2H69.1418L75.7418 11.6V2ZM99.4324 2V7.82H94.4824V23H88.4824V7.82H83.5324V2H99.4324Z"
                                    fill="#333333" />
                            </svg>
                        </a>

                        <p>{{ theme_option('copyright') }}</p>
                    </div>
                    {!! dynamic_sidebar('footer_sidebar_bot') !!}
                </div>
            </div>
        </footer>


        <div class="overlay"></div>
        <div class="cart-block">
            <div class="top">
                <h3>
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.52 0.44C3.72774 0.163014 4.05377 0 4.4 0H17.6C17.9462 0 18.2723 0.163014 18.48 0.44L21.78 4.84C21.9228 5.03041 22 5.26199 22 5.5V18.7C22 19.5752 21.6523 20.4146 21.0335 21.0335C20.4146 21.6523 19.5752 22 18.7 22H3.3C2.42479 22 1.58542 21.6523 0.966548 21.0335C0.347678 20.4146 0 19.5752 0 18.7V5.5C0 5.26199 0.0771956 5.03041 0.22 4.84L3.52 0.44ZM4.95 2.2L2.2 5.86667V18.7C2.2 18.9917 2.31589 19.2715 2.52218 19.4778C2.72847 19.6841 3.00826 19.8 3.3 19.8H18.7C18.9917 19.8 19.2715 19.6841 19.4778 19.4778C19.6841 19.2715 19.8 18.9917 19.8 18.7V5.86667L17.05 2.2H4.95Z"
                            fill="#333333" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0 5.5C0 4.89249 0.492487 4.4 1.1 4.4H20.9C21.5075 4.4 22 4.89249 22 5.5C22 6.10751 21.5075 6.6 20.9 6.6H1.1C0.492487 6.6 0 6.10751 0 5.5Z"
                            fill="#333333" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.6 8.8C7.20751 8.8 7.7 9.29249 7.7 9.9C7.7 10.7752 8.04768 11.6146 8.66655 12.2335C9.28542 12.8523 10.1248 13.2 11 13.2C11.8752 13.2 12.7146 12.8523 13.3335 12.2335C13.9523 11.6146 14.3 10.7752 14.3 9.9C14.3 9.29249 14.7925 8.8 15.4 8.8C16.0075 8.8 16.5 9.29249 16.5 9.9C16.5 11.3587 15.9205 12.7576 14.8891 13.7891C13.8576 14.8205 12.4587 15.4 11 15.4C9.54131 15.4 8.14236 14.8205 7.11091 13.7891C6.07946 12.7576 5.5 11.3587 5.5 9.9C5.5 9.29249 5.99249 8.8 6.6 8.8Z"
                            fill="#333333" />
                    </svg>
                    Кошик
                </h3>
                <p>3 товара</p>
                <div class="cart-close">×</div>
            </div>

            <div class="goods-list">
                <div class="cart-goods">
                    <div class="photo">
                        <img loading="lazy" width="100" height="100" src="assets/img/cart1.png" alt="">
                    </div>
                    <div class="title">
                        <h3>Чоловіча бежева сумка з якісного замінника
                        </h3>
                        <div class="articul">Артикул: 158465</div>
                        <div class="quantity">
                            <div class="quantity__button quantity__button_minus">-</div>
                            <div class="quantity__input"><input autocomplete="off" type="text" name="form[]" value="1">
                            </div>
                            <div class="quantity__button quantity__button_plus">+</div>
                        </div>
                        <div data-price="3700" class="mob-price">3 700 ₴</div>

                    </div>

                    <div data-price="3700" class="price">3 700 ₴</div>

                    <div class="remove">
                        <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.24999 15.7499C2.24999 16.1641 2.58578 16.4999 2.99998 16.4999H11.9999C12.4142 16.4999 12.7499 16.1641 12.7499 15.7499V6.74996H2.24999V15.7499ZM11.2499 2.24999H12.7499C13.9926 2.24999 14.9999 3.25734 14.9999 4.49998V5.99997C14.9999 6.41418 14.6641 6.74996 14.2499 6.74996V15.7499C14.2499 16.9926 13.2426 17.9999 11.9999 17.9999H2.99998C1.75735 17.9999 0.749996 16.9926 0.749996 15.7499V6.74996C0.335788 6.74996 0 6.41418 0 5.99997V4.49998C0 3.25734 1.00736 2.24999 2.24999 2.24999H3.74998C3.74998 1.00736 4.75734 0 5.99997 0H8.99995C10.2426 0 11.2499 1.00736 11.2499 2.24999ZM3.74998 9.74995C3.74998 9.33572 4.08577 8.99995 4.49998 8.99995C4.91418 8.99995 5.24997 9.33572 5.24997 9.74995V13.4999C5.24997 13.9142 4.91418 14.2499 4.49998 14.2499C4.08577 14.2499 3.74998 13.9142 3.74998 13.4999V9.74995ZM6.74996 9.74995C6.74996 9.33572 7.08574 8.99995 7.49996 8.99995C7.91418 8.99995 8.24996 9.33572 8.24996 9.74995V13.4999C8.24996 13.9142 7.91418 14.2499 7.49996 14.2499C7.08574 14.2499 6.74996 13.9142 6.74996 13.4999V9.74995ZM9.74995 9.74995C9.74995 9.33572 10.0857 8.99995 10.4999 8.99995C10.9142 8.99995 11.2499 9.33572 11.2499 9.74995V13.4999C11.2499 13.9142 10.9142 14.2499 10.4999 14.2499C10.0857 14.2499 9.74995 13.9142 9.74995 13.4999V9.74995ZM5.99997 1.49999C5.58576 1.49999 5.24997 1.83578 5.24997 2.24999H9.74995C9.74995 1.83578 9.41417 1.49999 8.99995 1.49999H5.99997ZM1.49999 5.24997H13.4999V4.49998C13.4999 4.08577 13.1642 3.74998 12.7499 3.74998H2.24999C1.83578 3.74998 1.49999 4.08577 1.49999 4.49998V5.24997Z"
                                fill="#CDCDCD" />
                        </svg>
                    </div>
                </div>
                <div class="cart-goods">
                    <div class="photo">
                        <img loading="lazy" width="100" height="100" src="assets/img/cart2.png" alt="">
                    </div>
                    <div class="title">
                        <h3>Apple iPhone 7 32GB Black
                            Super Puper Phone
                        </h3>
                        <div class="articul">Артикул: 158465</div>
                        <div class="quantity">
                            <div class="quantity__button quantity__button_minus">-</div>
                            <div class="quantity__input"><input autocomplete="off" type="text" name="form[]" value="1">
                            </div>
                            <div class="quantity__button quantity__button_plus">+</div>
                        </div>
                        <div class="mob-price" data-price="2400">2 400 ₴</div>

                    </div>

                    <div class="price" data-price="2400">2 400 ₴</div>

                    <div class="remove">
                        <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.24999 15.7499C2.24999 16.1641 2.58578 16.4999 2.99998 16.4999H11.9999C12.4142 16.4999 12.7499 16.1641 12.7499 15.7499V6.74996H2.24999V15.7499ZM11.2499 2.24999H12.7499C13.9926 2.24999 14.9999 3.25734 14.9999 4.49998V5.99997C14.9999 6.41418 14.6641 6.74996 14.2499 6.74996V15.7499C14.2499 16.9926 13.2426 17.9999 11.9999 17.9999H2.99998C1.75735 17.9999 0.749996 16.9926 0.749996 15.7499V6.74996C0.335788 6.74996 0 6.41418 0 5.99997V4.49998C0 3.25734 1.00736 2.24999 2.24999 2.24999H3.74998C3.74998 1.00736 4.75734 0 5.99997 0H8.99995C10.2426 0 11.2499 1.00736 11.2499 2.24999ZM3.74998 9.74995C3.74998 9.33572 4.08577 8.99995 4.49998 8.99995C4.91418 8.99995 5.24997 9.33572 5.24997 9.74995V13.4999C5.24997 13.9142 4.91418 14.2499 4.49998 14.2499C4.08577 14.2499 3.74998 13.9142 3.74998 13.4999V9.74995ZM6.74996 9.74995C6.74996 9.33572 7.08574 8.99995 7.49996 8.99995C7.91418 8.99995 8.24996 9.33572 8.24996 9.74995V13.4999C8.24996 13.9142 7.91418 14.2499 7.49996 14.2499C7.08574 14.2499 6.74996 13.9142 6.74996 13.4999V9.74995ZM9.74995 9.74995C9.74995 9.33572 10.0857 8.99995 10.4999 8.99995C10.9142 8.99995 11.2499 9.33572 11.2499 9.74995V13.4999C11.2499 13.9142 10.9142 14.2499 10.4999 14.2499C10.0857 14.2499 9.74995 13.9142 9.74995 13.4999V9.74995ZM5.99997 1.49999C5.58576 1.49999 5.24997 1.83578 5.24997 2.24999H9.74995C9.74995 1.83578 9.41417 1.49999 8.99995 1.49999H5.99997ZM1.49999 5.24997H13.4999V4.49998C13.4999 4.08577 13.1642 3.74998 12.7499 3.74998H2.24999C1.83578 3.74998 1.49999 4.08577 1.49999 4.49998V5.24997Z"
                                fill="#CDCDCD" />
                        </svg>
                    </div>
                </div>
                <div class="cart-goods">
                    <div class="photo">
                        <img loading="lazy" width="100" height="100" src="assets/img/cart3.png" alt="">
                    </div>
                    <div class="title">
                        <h3>Apple iPhone 7 32GB Black
                            Super Puper Phone
                        </h3>
                        <div class="articul">Артикул: 158465</div>
                        <div class="quantity">
                            <div class="quantity__button quantity__button_minus">-</div>
                            <div class="quantity__input"><input autocomplete="off" type="text" name="form[]" value="1">
                            </div>
                            <div class="quantity__button quantity__button_plus">+</div>
                        </div>
                        <div class="mob-price" data-price="3100">3 100 ₴</div>

                    </div>

                    <div class="price" data-price="3100">3 100 ₴</div>

                    <div class="remove">
                        <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.24999 15.7499C2.24999 16.1641 2.58578 16.4999 2.99998 16.4999H11.9999C12.4142 16.4999 12.7499 16.1641 12.7499 15.7499V6.74996H2.24999V15.7499ZM11.2499 2.24999H12.7499C13.9926 2.24999 14.9999 3.25734 14.9999 4.49998V5.99997C14.9999 6.41418 14.6641 6.74996 14.2499 6.74996V15.7499C14.2499 16.9926 13.2426 17.9999 11.9999 17.9999H2.99998C1.75735 17.9999 0.749996 16.9926 0.749996 15.7499V6.74996C0.335788 6.74996 0 6.41418 0 5.99997V4.49998C0 3.25734 1.00736 2.24999 2.24999 2.24999H3.74998C3.74998 1.00736 4.75734 0 5.99997 0H8.99995C10.2426 0 11.2499 1.00736 11.2499 2.24999ZM3.74998 9.74995C3.74998 9.33572 4.08577 8.99995 4.49998 8.99995C4.91418 8.99995 5.24997 9.33572 5.24997 9.74995V13.4999C5.24997 13.9142 4.91418 14.2499 4.49998 14.2499C4.08577 14.2499 3.74998 13.9142 3.74998 13.4999V9.74995ZM6.74996 9.74995C6.74996 9.33572 7.08574 8.99995 7.49996 8.99995C7.91418 8.99995 8.24996 9.33572 8.24996 9.74995V13.4999C8.24996 13.9142 7.91418 14.2499 7.49996 14.2499C7.08574 14.2499 6.74996 13.9142 6.74996 13.4999V9.74995ZM9.74995 9.74995C9.74995 9.33572 10.0857 8.99995 10.4999 8.99995C10.9142 8.99995 11.2499 9.33572 11.2499 9.74995V13.4999C11.2499 13.9142 10.9142 14.2499 10.4999 14.2499C10.0857 14.2499 9.74995 13.9142 9.74995 13.4999V9.74995ZM5.99997 1.49999C5.58576 1.49999 5.24997 1.83578 5.24997 2.24999H9.74995C9.74995 1.83578 9.41417 1.49999 8.99995 1.49999H5.99997ZM1.49999 5.24997H13.4999V4.49998C13.4999 4.08577 13.1642 3.74998 12.7499 3.74998H2.24999C1.83578 3.74998 1.49999 4.08577 1.49999 4.49998V5.24997Z"
                                fill="#CDCDCD" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bot">
                <a href="#" class="to-checkout">Перейти до оформлення</a>
                <div class="total">Разом: <span>9 200 ₴</span></div>
            </div>
        </div>
    </div>


    <div class="popup popup_login">
        <div class="popup__content">
            <div class="popup__body">
                <div class="popup__close">×</div>
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.1968 30.1486C37.9554 27.9073 35.3294 26.1882 32.4672 25.0512C35.5206 22.58 37.4785 18.802 37.4785 14.5737C37.4785 7.14282 31.4339 1.09817 24.003 1.09817C16.5721 1.09817 10.5275 7.14282 10.5275 14.5737C10.5275 18.802 12.4854 22.58 15.5389 25.0512C12.6767 26.1882 10.0507 27.9073 7.80929 30.1486L7.80928 30.1486C3.48453 34.4735 1.10158 40.2263 1.10158 46.3425V46.901H1.66016H5.15123H5.7098V46.3425C5.7098 36.256 13.9166 28.0492 24.003 28.0492C34.0895 28.0492 42.2962 36.256 42.2962 46.3425V46.901H42.8548H46.3459H46.9044V46.3425C46.9044 40.2263 44.5215 34.4735 40.1968 30.1486L39.8019 30.5436L40.1968 30.1486ZM24.003 23.441C19.1141 23.441 15.1357 19.4627 15.1357 14.5737C15.1357 9.68469 19.1141 5.70638 24.003 5.70638C28.8919 5.70638 32.8703 9.68469 32.8703 14.5737C32.8703 19.4627 28.8919 23.441 24.003 23.441Z" fill="white" stroke="white" stroke-width="1.11714"/>
                    </svg>
                </div>
                <div class="message">
                    <h3>Увійти або зареєструватися</h3>
                    <div class="phone">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.0526 7.90106C10.3124 7.90106 9.58738 7.78548 8.90021 7.55873C8.56484 7.44315 8.184 7.53221 7.96359 7.75706L6.60127 8.7859C5.03811 7.9516 4.03769 6.95179 3.21475 5.4L4.21579 4.0699C4.46779 3.8179 4.55812 3.44905 4.45012 3.10358C4.22148 2.412 4.10528 1.68632 4.10528 0.947369C4.10528 0.425043 3.68023 0 3.15791 0H0.947369C0.425043 0 0 0.425043 0 0.947369C0 7.04147 4.95853 12 11.0526 12C11.575 12 12 11.575 12 11.0526V8.84843C12 8.3261 11.575 7.90106 11.0526 7.90106Z" fill="#333333"/>
                        </svg>
                        <input type="text" placeholder="+38 ___ ___ __ __">
                    </div>
                    <a href="#sms" class="green-btn sms _popup-link">Отримати код в СМС</a>
                </div>
            </div>
        </div>
    </div>
    <div class="popup popup_sms">
        <div class="popup__content">
            <div class="popup__body">
                <div class="popup__close">×</div>
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.1968 30.1486C37.9554 27.9073 35.3294 26.1882 32.4672 25.0512C35.5206 22.58 37.4785 18.802 37.4785 14.5737C37.4785 7.14282 31.4339 1.09817 24.003 1.09817C16.5721 1.09817 10.5275 7.14282 10.5275 14.5737C10.5275 18.802 12.4854 22.58 15.5389 25.0512C12.6767 26.1882 10.0507 27.9073 7.80929 30.1486L7.80928 30.1486C3.48453 34.4735 1.10158 40.2263 1.10158 46.3425V46.901H1.66016H5.15123H5.7098V46.3425C5.7098 36.256 13.9166 28.0492 24.003 28.0492C34.0895 28.0492 42.2962 36.256 42.2962 46.3425V46.901H42.8548H46.3459H46.9044V46.3425C46.9044 40.2263 44.5215 34.4735 40.1968 30.1486L39.8019 30.5436L40.1968 30.1486ZM24.003 23.441C19.1141 23.441 15.1357 19.4627 15.1357 14.5737C15.1357 9.68469 19.1141 5.70638 24.003 5.70638C28.8919 5.70638 32.8703 9.68469 32.8703 14.5737C32.8703 19.4627 28.8919 23.441 24.003 23.441Z" fill="white" stroke="white" stroke-width="1.11714"/>
                    </svg>
                </div>
                <div class="message">
                    <h3>Увійти або зареєструватися</h3>
                    <div class="phone">
                        <input type="text" placeholder="Введіть код з СМС">
                    </div>
                    <div class="nosms">
                        <a href="#login" class="_popup-link">Не прийшло СМС?</a>
                        <div class="error">Не вірний код</div>
                    </div>
                    <a href="#auth" class="green-btn sms _popup-link">Увійти</a>
                </div>
            </div>
        </div>
    </div>
    <div class="popup popup_auth">
        <div class="popup__content">
            <div class="popup__body">
                <div class="popup__close">×</div>
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.1968 30.1486C37.9554 27.9073 35.3294 26.1882 32.4672 25.0512C35.5206 22.58 37.4785 18.802 37.4785 14.5737C37.4785 7.14282 31.4339 1.09817 24.003 1.09817C16.5721 1.09817 10.5275 7.14282 10.5275 14.5737C10.5275 18.802 12.4854 22.58 15.5389 25.0512C12.6767 26.1882 10.0507 27.9073 7.80929 30.1486L7.80928 30.1486C3.48453 34.4735 1.10158 40.2263 1.10158 46.3425V46.901H1.66016H5.15123H5.7098V46.3425C5.7098 36.256 13.9166 28.0492 24.003 28.0492C34.0895 28.0492 42.2962 36.256 42.2962 46.3425V46.901H42.8548H46.3459H46.9044V46.3425C46.9044 40.2263 44.5215 34.4735 40.1968 30.1486L39.8019 30.5436L40.1968 30.1486ZM24.003 23.441C19.1141 23.441 15.1357 19.4627 15.1357 14.5737C15.1357 9.68469 19.1141 5.70638 24.003 5.70638C28.8919 5.70638 32.8703 9.68469 32.8703 14.5737C32.8703 19.4627 28.8919 23.441 24.003 23.441Z" fill="white" stroke="white" stroke-width="1.11714"/>
                    </svg>
                </div>
                <div class="message">
                    <h3>Ви успішно авторизувались!</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="popup popup_view_featured_unlogin">
        <div class="popup__content">
            <div class="popup__body">
                <div class="icon">
                    <svg width="34" height="30" viewBox="0 0 34 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2 3.33333C6.44446 3.33333 3.4 6.3181 3.4 10C3.4 10.051 3.40058 10.1018 3.40174 10.1525C3.40224 10.1745 3.40229 10.1965 3.40191 10.2185C3.40064 10.2903 3.4 10.3635 3.4 10.4381C3.4 15.8871 6.41491 19.934 9.79928 22.6924C11.4865 24.0676 13.2271 25.0875 14.6356 25.759C15.3396 26.0946 15.9449 26.3356 16.403 26.4887C16.735 26.5997 16.9227 26.6414 16.9933 26.6572C16.9956 26.6577 16.9977 26.6581 16.9997 26.6586C17.0018 26.6581 17.004 26.6576 17.0064 26.6571C17.0771 26.6413 17.2645 26.5994 17.5958 26.4884C18.0539 26.335 18.6593 26.0934 19.3633 25.7571C20.772 25.0844 22.5128 24.0629 24.2003 22.6865C27.5856 19.9254 30.6 15.8783 30.6 10.4381C30.6 10.3636 30.5994 10.2905 30.5981 10.2187C30.5977 10.1967 30.5978 10.1747 30.5983 10.1526C30.5994 10.1019 30.6 10.0511 30.6 10C30.6 6.3181 27.5555 3.33333 23.8 3.33333C21.5767 3.33333 19.6027 4.37766 18.3591 6.00032C18.038 6.41933 17.5346 6.66586 17 6.66586C16.4654 6.66586 15.962 6.41933 15.6409 6.00032C14.3974 4.37766 12.4233 3.33333 10.2 3.33333ZM0 10C0 4.47715 4.5667 0 10.2 0C12.813 0 15.1966 0.964378 17 2.54652C18.8034 0.964379 21.187 0 23.8 0C29.4333 0 34 4.47715 34 10C34 10.0646 33.9994 10.1291 33.9981 10.1935C33.9994 10.2743 34 10.3558 34 10.4381C34 17.2167 30.2144 22.1173 26.3747 25.249C24.4497 26.8191 22.4718 27.9804 20.8523 28.7538C20.0423 29.1407 19.3063 29.438 18.6952 29.6427C18.1575 29.8228 17.5218 30 17 30C16.479 30 15.8439 29.8235 15.306 29.6438C14.6949 29.4396 13.9589 29.1429 13.1488 28.7567C11.5292 27.9846 9.55102 26.8249 7.62572 25.2557C3.78509 22.1254 0 17.2246 0 10.4381C0 10.3558 0.000625396 10.2742 0.00187649 10.1934C0.000627118 10.1291 0 10.0646 0 10Z" fill="white"/>
                    </svg>
                </div>
                <div class="popup__close"></div>
                <div class="message">
                    Для того, щоб побачити 
                    список обраного, необхідно 
                    <a href="#login" class="_popup-link">авторизуватись</a> на сайті
                </div>
            </div>
        </div>
    </div>

    {!! Theme::footer() !!}

    <script>
        window.trans = {
            "Views": "{{ __('Views') }}",
            "Read more": "{{ __('Read more') }}",
            "days": "{{ __('days') }}",
            "hours": "{{ __('hours') }}",
            "mins": "{{ __('mins') }}",
            "sec": "{{ __('sec') }}",
            "No reviews!": "{{ __('No reviews!') }}"
        };
    </script>

    <?php //print_r($_SERVER); ?>

    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/assets/swiper-bundle.min.js"></script> --}}
    <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/dynamicAdapt.js"></script>
    <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/popup.js"></script>
    <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/common.js"></script>

    @if($_SERVER['REQUEST_URI'] == '/')
        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/index.js"></script>
    @elseif(str_contains($_SERVER['REQUEST_URI'], 'product-categories') || str_contains($_SERVER['REQUEST_URI'], 'products'))
        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/nouislider.js"></script>
        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/wNumb.min.js"></script>
        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/select.js"></script>

        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/main.js"></script>
        <script defer src="<?php echo $_SERVER['APP_URL']; ?>/themes/wowy/js/shop.js"></script>
    @endif
    {!! Theme::place('footer') !!}
</body>

</html>
