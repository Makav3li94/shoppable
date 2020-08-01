@php
    $categories = $modelCategory->start()->getList(['status' => 1]);
    $categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
@endphp
<header>

    <!--Menu Nav Mobile-->
    <section id="menu-nav-xs" class="menu-nav-xs">
        <div class="logo">
            <a href="{{route('home')}}"><img src="{{ asset(sc_store('logo')) }}" alt=""></a>
        </div>
        <div class="main-menu-xs">
            <ul>
                <li><a>کالای دیجیتال</a>
                    <ul>
                        <li><a href="#">لوازم جانبی گوشی</a></li>
                        <li><a href="#">کیف و کاور گوشی</a></li>
                        <li><a>پاور بانک (شارژر همراه)</a>
                            <ul>
                                <li><a href="#">اسکوتر برقی</a></li>
                                <li><a href="#">کیف و کاور گوشی</a></li>
                                <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                <li><a href="#">پایه نگهدارنده گوشی</a></li>
                            </ul>
                        </li>
                        <li><a>هندزفری، هدفون، هدست</a>
                            <ul>
                                <li><a href="#">واقعیت مجازی</a></li>
                                <li><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                <li><a href="#">هدفون، هدست، هندزفری</a></li>
                                <li><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                <li><a href="#">اسکوتر برقی</a></li>
                            </ul>
                        </li>
                        <li><a href="#">پایه نگهدارنده گوشی</a></li>
                        <li><a href="#">گوشی موبایل</a></li>
                    </ul>
                </li>
                <li><a href="#">آیفون اپل</a></li>
                <li><a href="#">سامسونگ</a></li>
                <li><a>واقعیت مجازی</a>
                    <ul>
                        <li><a href="#">لوازم جانبی گوشی</a></li>
                        <li><a href="#">کیف و کاور گوشی</a></li>
                        <li><a>پاور بانک (شارژر همراه)</a>
                            <ul>
                                <li><a href="#">لوازم جانبی گوشی</a></li>
                                <li><a href="#">کیف و کاور گوشی</a></li>
                                <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                <li><a href="#">پایه نگهدارنده گوشی</a></li>
                                <li><a href="#">گوشی موبایل</a></li>
                                <li><a href="#">آیفون اپل</a></li>
                                <li><a href="#">سامسونگ</a></li>
                                <li><a href="#">واقعیت مجازی</a></li>
                                <li><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                <li><a href="#">هدفون، هدست، هندزفری</a></li>
                                <li><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                <li><a href="#">اسکوتر برقی</a></li>
                            </ul>
                        </li>
                        <li><a>هندزفری، هدفون، هدست</a>
                            <ul>
                                <li><a href="#">لوازم جانبی گوشی</a></li>
                                <li><a href="#">کیف و کاور گوشی</a></li>
                                <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                <li><a href="#">پایه نگهدارنده گوشی</a></li>
                                <li><a href="#">گوشی موبایل</a></li>
                                <li><a href="#">آیفون اپل</a></li>
                                <li><a href="#">سامسونگ</a></li>
                                <li><a href="#">واقعیت مجازی</a></li>
                                <li><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                <li><a href="#">هدفون، هدست، هندزفری</a></li>
                                <li><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                <li><a href="#">اسکوتر برقی</a></li>
                            </ul>
                        </li>
                        <li><a href="#">پایه نگهدارنده گوشی</a></li>
                        <li><a href="#">گوشی موبایل</a></li>
                    </ul>
                </li>
                <li><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                <li><a href="#">هدفون، هدست، هندزفری</a></li>
                <li><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                <li><a href="#">اسکوتر برقی</a></li>
            </ul>
            <ul class="promotions">
                <li><a href="promotion.html">شگفت‌انگیزها</a></li>
                <li><a href="promotion.html">فروش ویژه</a></li>
            </ul>
        </div>
    </section>
    <!--Menu Nav Mobile-->

    <!--Section Header-->
    <section class="container-fluid bg-header">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 header">

                    <div class="right">
                        <!--Logo-->
                        <div class="logo"><a href="{{route('home')}}"><img src="{{ asset(sc_store('logo')) }}" alt=""></a></div>
                        <!-- Logo-->

                        <!--Search and Result Search-->
                        <div class="search">
                            <!--Search-->
                            <form action="">
                                <div class="input-group">
                                    <input onclick="$(this).addClass('active');$('.result-search').slideDown(); $('#mask-gray-body').toggleClass('active')"
                                           onblur="$(this).removeClass('active');$('.result-search').slideUp();"
                                           type="text" class="form-control"
                                           placeholder="نام محصول برند و یا دسته مورد علاقه خود را جستجو کنید…">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                 x="0px" y="0px" viewBox="0 0 451 451"
                                                 style="enable-background:new 0 0 451 451;" xml:space="preserve"
                                                 width="26px" height="26px"><g>
                                                    <path d="M447.05,428l-109.6-109.6c29.4-33.8,47.2-77.9,47.2-126.1C384.65,86.2,298.35,0,192.35,0C86.25,0,0.05,86.3,0.05,192.3 s86.3,192.3,192.3,192.3c48.2,0,92.3-17.8,126.1-47.2L428.05,447c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4 C452.25,441.8,452.25,433.2,447.05,428z M26.95,192.3c0-91.2,74.2-165.3,165.3-165.3c91.2,0,165.3,74.2,165.3,165.3 s-74.1,165.4-165.3,165.4C101.15,357.7,26.95,283.5,26.95,192.3z"
                                                          fill="#FFFFFF"/>
                                                </g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g>
                                                <g></g></svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--End Search-->

                            <!--Result Search Desktop-->
                            <div class="result-search">
                                <div class="result-search-category">
                                    <ul>
                                        <li><a href="#">کنسول در دسته <strong>کنسول خانگی</strong></a></li>
                                        <li><a href="#">همه کالاها دسته‌بندی <strong>کنسول</strong></a></li>
                                    </ul>
                                </div>
                                <div class="result-search-item">
                                    <ul>
                                        <li><a href="#">کنسول بازی</a></li>
                                        <li><a href="#">کنسول بازی سونی</a></li>
                                        <li><a href="#">کنسول بازی سونی مدل</a></li>
                                        <li><a href="#">کنسول بازی سونی مدل playstation</a></li>
                                        <li><a href="#">کنسول بازی سونی مدل playstation 4</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--End Result Search Desktop-->
                        </div>
                        <!--End Search and Result Search-->
                    </div>

                    <div class="left">
                        <!--Auth-->
                        <div class="auth">
                            @guest
                                {{trans('front.login')}} / {{trans('front.sign_up')}}
                            @else

                            @endguest
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="15px"
                                 height="15px">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"
                                          fill="#6f6f6f"/>
                                </g>
                            </svg>
                            <div class="panel">
                                @guest
                                <div class="header">
                                    <a href="signin.html" class="btn btn-info btn-lg btn-block">{{trans('front.login')}}</a>
                                    <p>{{trans('front.new_user')}}<a href="signup.html">{{trans('front.sigh_up')}}</a></p>
                                </div>
                                @else
                                <div class="body">

                                    <a href="{{ route('member.index') }}">
                                        <i class="d-inline-flex align-middle ml-2 mdi mdi-account-outline"></i>
                                        {{ trans('front.account') }}
                                    </a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="d-inline-flex align-middle ml-2 mdi mdi-account-outline"></i>
                                        {{ trans('front.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">@csrf</form>
                                    <a href="profile-order.html"><i
                                                class="d-inline-flex align-middle ml-2 mdi mdi-cart-outline"></i>پیگیری
                                        سفارش</a>
                                    <!--<a href="profile-order.html"><i class="d-inline-flex align-middle ml-2 mdi mdi-basket"></i>سفارش‌های من</a>-->
                                    <!--<a href="#"><i class="d-inline-flex align-middle ml-2 mdi mdi-logout"></i>خروج</a>-->
                                </div>
                                @endguest
                            </div>
                        </div>

                        <!--End Auth-->

                        <!--Basket Cart-->
                        <!--note: Class basket-cart Count Product => basket-cart Get count class -->
                        <div class="basket-cart <!--count-->">
                            <!--note: Tag a is Zero(0) Product => Tag a Get href="" and GoTo cart.html -->
                            <a onclick="$('.basket-cart').toggleClass('active');" class="btn btn-outline-info">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 486.569 486.569"
                                     style="enable-background:new 0 0 486.569 486.569;" xml:space="preserve"
                                     width="24px" height="24px"><g>
                                        <path d="M146.069,320.369h268.1c30.4,0,55.2-24.8,55.2-55.2v-112.8c0-0.1,0-0.3,0-0.4c0-0.3,0-0.5,0-0.8c0-0.2,0-0.4-0.1-0.6 c0-0.2-0.1-0.5-0.1-0.7s-0.1-0.4-0.1-0.6c-0.1-0.2-0.1-0.4-0.2-0.7c-0.1-0.2-0.1-0.4-0.2-0.6c-0.1-0.2-0.1-0.4-0.2-0.6 c-0.1-0.2-0.2-0.4-0.3-0.7c-0.1-0.2-0.2-0.4-0.3-0.5c-0.1-0.2-0.2-0.4-0.3-0.6c-0.1-0.2-0.2-0.3-0.3-0.5c-0.1-0.2-0.3-0.4-0.4-0.6 c-0.1-0.2-0.2-0.3-0.4-0.5c-0.1-0.2-0.3-0.3-0.4-0.5s-0.3-0.3-0.4-0.5s-0.3-0.3-0.4-0.4c-0.2-0.2-0.3-0.3-0.5-0.5 c-0.2-0.1-0.3-0.3-0.5-0.4c-0.2-0.1-0.4-0.3-0.6-0.4c-0.2-0.1-0.3-0.2-0.5-0.3s-0.4-0.2-0.6-0.4c-0.2-0.1-0.4-0.2-0.6-0.3 s-0.4-0.2-0.6-0.3s-0.4-0.2-0.6-0.3s-0.4-0.1-0.6-0.2c-0.2-0.1-0.5-0.2-0.7-0.2s-0.4-0.1-0.5-0.1c-0.3-0.1-0.5-0.1-0.8-0.1 c-0.1,0-0.2-0.1-0.4-0.1l-339.8-46.9v-47.4c0-0.5,0-1-0.1-1.4c0-0.1,0-0.2-0.1-0.4c0-0.3-0.1-0.6-0.1-0.9c-0.1-0.3-0.1-0.5-0.2-0.8 c0-0.2-0.1-0.3-0.1-0.5c-0.1-0.3-0.2-0.6-0.3-0.9c0-0.1-0.1-0.3-0.1-0.4c-0.1-0.3-0.2-0.5-0.4-0.8c-0.1-0.1-0.1-0.3-0.2-0.4 c-0.1-0.2-0.2-0.4-0.4-0.6c-0.1-0.2-0.2-0.3-0.3-0.5s-0.2-0.3-0.3-0.5s-0.3-0.4-0.4-0.6c-0.1-0.1-0.2-0.2-0.3-0.3 c-0.2-0.2-0.4-0.4-0.6-0.6c-0.1-0.1-0.2-0.2-0.3-0.3c-0.2-0.2-0.4-0.4-0.7-0.6c-0.1-0.1-0.3-0.2-0.4-0.3c-0.2-0.2-0.4-0.3-0.6-0.5 c-0.3-0.2-0.6-0.4-0.8-0.5c-0.1-0.1-0.2-0.1-0.3-0.2c-0.4-0.2-0.9-0.4-1.3-0.6l-73.7-31c-6.9-2.9-14.8,0.3-17.7,7.2 s0.3,14.8,7.2,17.7l65.4,27.6v61.2v9.7v74.4v66.5v84c0,28,21,51.2,48.1,54.7c-4.9,8.2-7.8,17.8-7.8,28c0,30.1,24.5,54.5,54.5,54.5 s54.5-24.5,54.5-54.5c0-10-2.7-19.5-7.5-27.5h121.4c-4.8,8.1-7.5,17.5-7.5,27.5c0,30.1,24.5,54.5,54.5,54.5s54.5-24.5,54.5-54.5 s-24.5-54.5-54.5-54.5h-255c-15.6,0-28.2-12.7-28.2-28.2v-36.6C126.069,317.569,135.769,320.369,146.069,320.369z M213.269,431.969 c0,15.2-12.4,27.5-27.5,27.5s-27.5-12.4-27.5-27.5s12.4-27.5,27.5-27.5S213.269,416.769,213.269,431.969z M428.669,431.969 c0,15.2-12.4,27.5-27.5,27.5s-27.5-12.4-27.5-27.5s12.4-27.5,27.5-27.5S428.669,416.769,428.669,431.969z M414.169,293.369h-268.1 c-15.6,0-28.2-12.7-28.2-28.2v-66.5v-74.4v-5l324.5,44.7v101.1C442.369,280.769,429.669,293.369,414.169,293.369z"
                                              fill="#00bfd6"/>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                                سبد خرید<span class="badge badge-light">۲</span></a>
                            <div class="basket-box">
                                <div class="top">
                                    <p>مبلغ کل خرید:<span>۲۹۲,۰۰۰ تومان</span></p>
                                    <a href="add-to-cart.html">مشاهده سبد خرید<span class="basket-arrow"></span></a>
                                </div>
                                <div class="center">
                                    <div class="item">
                                        <div class="box-right">
                                            <a class="delete" href="#"><i class="mdi mdi-close"></i></a>
                                            <a class="thumb" href="#"><img src="asset/files/product/350-350/002.jpg"
                                                                           alt=""></a>
                                        </div>
                                        <div class="box-left">
                                            <a href="#" class="title">ساعت هوشمند اسمارت لایف مدل V9</a>
                                            <p class="desc"><span>1 عدد</span><span>رنگ مشکی</span></p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="box-right">
                                            <a class="delete" href="#"><i class="mdi mdi-close"></i></a>
                                            <a class="thumb" href="#"><img src="asset/files/product/350-350/001.jpg"
                                                                           alt=""></a>
                                        </div>
                                        <div class="box-left">
                                            <a href="#" class="title">ساعت هوشمند اسمارت لایف مدل V9</a>
                                            <p class="desc"><span>1 عدد</span><span>رنگ مشکی</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <a href="shipping.html">ورود و ثبت سفارشی</a>
                                </div>
                            </div>
                        </div>
                        <!--End Basket Cart-->

                        <!--Category Logo Mobile (Sidebar Menu)-->
                        <div class="category-logo-xs">
                            <p rel="nofollow" onclick="openNav()">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512;" xml:space="preserve" width="40px"
                                     height="24px"><g>
                                        <g>
                                            <path d="M491.318,235.318H20.682C9.26,235.318,0,244.577,0,256s9.26,20.682,20.682,20.682h470.636 c11.423,0,20.682-9.259,20.682-20.682C512,244.578,502.741,235.318,491.318,235.318z"
                                                  fill="#b0bec5"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M491.318,78.439H20.682C9.26,78.439,0,87.699,0,99.121c0,11.422,9.26,20.682,20.682,20.682h470.636 c11.423,0,20.682-9.26,20.682-20.682C512,87.699,502.741,78.439,491.318,78.439z"
                                                  fill="#b0bec5"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M491.318,392.197H20.682C9.26,392.197,0,401.456,0,412.879s9.26,20.682,20.682,20.682h470.636 c11.423,0,20.682-9.259,20.682-20.682S502.741,392.197,491.318,392.197z"
                                                  fill="#b0bec5"/>
                                        </g>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                                دسته بندی ها
                            </p>
                            <a href="index.html"><img src="images/logo.svg" alt=""></a>
                        </div>
                        <!--End Category Logo Mobile (Sidebar Menu)-->

                        <!--Auth and Basket Cart and Search and Result Search-->
                        <div class="account-search-xs">
                            <div class="search-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 488.139 488.139"
                                     style="enable-background:new 0 0 488.139 488.139;" xml:space="preserve"
                                     width="29px" height="29px"><g>
                                        <g>
                                            <g>
                                                <path d="M290.513,0.004C181.378,0.004,92.916,88.466,92.916,197.6c0,46.967,16.477,90.043,43.836,124.03 L6.156,452.196c-8.208,8.238-8.208,21.553,0,29.761c8.208,8.238,21.553,8.238,29.761,0l130.596-130.566 c33.926,27.329,77.032,43.806,124.03,43.806c109.134,0,197.597-88.462,197.597-197.597S399.616,0.004,290.513,0.004z M290.513,364.797c-92.232,0-167.197-74.996-167.197-167.197S198.341,30.403,290.513,30.403S457.71,105.399,457.71,197.6 S382.714,364.797,290.513,364.797z"
                                                      fill="#b0bec5"/>
                                            </g>
                                        </g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                                <form action="">
                                    <input onclick="$('.search-xs').addClass('active');$('.result-search').slideDown();"
                                           onblur="$('.search-xs').removeClass('active');$('.result-search').slideUp();"
                                           type="text" class="form-control" placeholder="جستجو از میان همه کالاها">
                                </form>
                                <!--Result Search Mobile-->
                                <div class="result-search">
                                    <div class="result-search-category">
                                        <ul>
                                            <li><a href="#">کنسول در دسته <strong>کنسول خانگی</strong></a></li>
                                            <li><a href="#">همه کالاها دسته‌بندی <strong>کنسول</strong></a></li>
                                        </ul>
                                    </div>
                                    <div class="result-search-item">
                                        <ul>
                                            <li><a href="#">کنسول بازی</a></li>
                                            <li><a href="#">کنسول بازی سونی</a></li>
                                            <li><a href="#">کنسول بازی سونی مدل</a></li>
                                            <li><a href="#">کنسول بازی سونی مدل playstation</a></li>
                                            <li><a href="#">کنسول بازی سونی مدل playstation 4</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--End Result Search Mobile-->
                            </div>
                            <a href="add-to-cart.html">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 486.569 486.569"
                                     style="enable-background:new 0 0 486.569 486.569;" xml:space="preserve"
                                     width="24px" height="24px"><g>
                                        <path d="M146.069,320.369h268.1c30.4,0,55.2-24.8,55.2-55.2v-112.8c0-0.1,0-0.3,0-0.4c0-0.3,0-0.5,0-0.8c0-0.2,0-0.4-0.1-0.6 c0-0.2-0.1-0.5-0.1-0.7s-0.1-0.4-0.1-0.6c-0.1-0.2-0.1-0.4-0.2-0.7c-0.1-0.2-0.1-0.4-0.2-0.6c-0.1-0.2-0.1-0.4-0.2-0.6 c-0.1-0.2-0.2-0.4-0.3-0.7c-0.1-0.2-0.2-0.4-0.3-0.5c-0.1-0.2-0.2-0.4-0.3-0.6c-0.1-0.2-0.2-0.3-0.3-0.5c-0.1-0.2-0.3-0.4-0.4-0.6 c-0.1-0.2-0.2-0.3-0.4-0.5c-0.1-0.2-0.3-0.3-0.4-0.5s-0.3-0.3-0.4-0.5s-0.3-0.3-0.4-0.4c-0.2-0.2-0.3-0.3-0.5-0.5 c-0.2-0.1-0.3-0.3-0.5-0.4c-0.2-0.1-0.4-0.3-0.6-0.4c-0.2-0.1-0.3-0.2-0.5-0.3s-0.4-0.2-0.6-0.4c-0.2-0.1-0.4-0.2-0.6-0.3 s-0.4-0.2-0.6-0.3s-0.4-0.2-0.6-0.3s-0.4-0.1-0.6-0.2c-0.2-0.1-0.5-0.2-0.7-0.2s-0.4-0.1-0.5-0.1c-0.3-0.1-0.5-0.1-0.8-0.1 c-0.1,0-0.2-0.1-0.4-0.1l-339.8-46.9v-47.4c0-0.5,0-1-0.1-1.4c0-0.1,0-0.2-0.1-0.4c0-0.3-0.1-0.6-0.1-0.9c-0.1-0.3-0.1-0.5-0.2-0.8 c0-0.2-0.1-0.3-0.1-0.5c-0.1-0.3-0.2-0.6-0.3-0.9c0-0.1-0.1-0.3-0.1-0.4c-0.1-0.3-0.2-0.5-0.4-0.8c-0.1-0.1-0.1-0.3-0.2-0.4 c-0.1-0.2-0.2-0.4-0.4-0.6c-0.1-0.2-0.2-0.3-0.3-0.5s-0.2-0.3-0.3-0.5s-0.3-0.4-0.4-0.6c-0.1-0.1-0.2-0.2-0.3-0.3 c-0.2-0.2-0.4-0.4-0.6-0.6c-0.1-0.1-0.2-0.2-0.3-0.3c-0.2-0.2-0.4-0.4-0.7-0.6c-0.1-0.1-0.3-0.2-0.4-0.3c-0.2-0.2-0.4-0.3-0.6-0.5 c-0.3-0.2-0.6-0.4-0.8-0.5c-0.1-0.1-0.2-0.1-0.3-0.2c-0.4-0.2-0.9-0.4-1.3-0.6l-73.7-31c-6.9-2.9-14.8,0.3-17.7,7.2 s0.3,14.8,7.2,17.7l65.4,27.6v61.2v9.7v74.4v66.5v84c0,28,21,51.2,48.1,54.7c-4.9,8.2-7.8,17.8-7.8,28c0,30.1,24.5,54.5,54.5,54.5 s54.5-24.5,54.5-54.5c0-10-2.7-19.5-7.5-27.5h121.4c-4.8,8.1-7.5,17.5-7.5,27.5c0,30.1,24.5,54.5,54.5,54.5s54.5-24.5,54.5-54.5 s-24.5-54.5-54.5-54.5h-255c-15.6,0-28.2-12.7-28.2-28.2v-36.6C126.069,317.569,135.769,320.369,146.069,320.369z M213.269,431.969 c0,15.2-12.4,27.5-27.5,27.5s-27.5-12.4-27.5-27.5s12.4-27.5,27.5-27.5S213.269,416.769,213.269,431.969z M428.669,431.969 c0,15.2-12.4,27.5-27.5,27.5s-27.5-12.4-27.5-27.5s12.4-27.5,27.5-27.5S428.669,416.769,428.669,431.969z M414.169,293.369h-268.1 c-15.6,0-28.2-12.7-28.2-28.2v-66.5v-74.4v-5l324.5,44.7v101.1C442.369,280.769,429.669,293.369,414.169,293.369z"
                                              fill="#b0bec5"/>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </a>
                            <a href="profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 482.9 482.9"
                                     style="enable-background:new 0 0 482.9 482.9;" xml:space="preserve" width="24px"
                                     height="24px"><g>
                                        <g>
                                            <path d="M239.7,260.2c0.5,0,1,0,1.6,0c0.2,0,0.4,0,0.6,0c0.3,0,0.7,0,1,0c29.3-0.5,53-10.8,70.5-30.5 c38.5-43.4,32.1-117.8,31.4-124.9c-2.5-53.3-27.7-78.8-48.5-90.7C280.8,5.2,262.7,0.4,242.5,0h-0.7c-0.1,0-0.3,0-0.4,0h-0.6 c-11.1,0-32.9,1.8-53.8,13.7c-21,11.9-46.6,37.4-49.1,91.1c-0.7,7.1-7.1,81.5,31.4,124.9C186.7,249.4,210.4,259.7,239.7,260.2z M164.6,107.3c0-0.3,0.1-0.6,0.1-0.8c3.3-71.7,54.2-79.4,76-79.4h0.4c0.2,0,0.5,0,0.8,0c27,0.6,72.9,11.6,76,79.4 c0,0.3,0,0.6,0.1,0.8c0.1,0.7,7.1,68.7-24.7,104.5c-12.6,14.2-29.4,21.2-51.5,21.4c-0.2,0-0.3,0-0.5,0l0,0c-0.2,0-0.3,0-0.5,0 c-22-0.2-38.9-7.2-51.4-21.4C157.7,176.2,164.5,107.9,164.6,107.3z"
                                                  fill="#b0bec5"/>
                                            <path d="M446.8,383.6c0-0.1,0-0.2,0-0.3c0-0.8-0.1-1.6-0.1-2.5c-0.6-19.8-1.9-66.1-45.3-80.9c-0.3-0.1-0.7-0.2-1-0.3 c-45.1-11.5-82.6-37.5-83-37.8c-6.1-4.3-14.5-2.8-18.8,3.3c-4.3,6.1-2.8,14.5,3.3,18.8c1.7,1.2,41.5,28.9,91.3,41.7 c23.3,8.3,25.9,33.2,26.6,56c0,0.9,0,1.7,0.1,2.5c0.1,9-0.5,22.9-2.1,30.9c-16.2,9.2-79.7,41-176.3,41 c-96.2,0-160.1-31.9-176.4-41.1c-1.6-8-2.3-21.9-2.1-30.9c0-0.8,0.1-1.6,0.1-2.5c0.7-22.8,3.3-47.7,26.6-56 c49.8-12.8,89.6-40.6,91.3-41.7c6.1-4.3,7.6-12.7,3.3-18.8c-4.3-6.1-12.7-7.6-18.8-3.3c-0.4,0.3-37.7,26.3-83,37.8 c-0.4,0.1-0.7,0.2-1,0.3c-43.4,14.9-44.7,61.2-45.3,80.9c0,0.9,0,1.7-0.1,2.5c0,0.1,0,0.2,0,0.3c-0.1,5.2-0.2,31.9,5.1,45.3 c1,2.6,2.8,4.8,5.2,6.3c3,2,74.9,47.8,195.2,47.8s192.2-45.9,195.2-47.8c2.3-1.5,4.2-3.7,5.2-6.3 C447,415.5,446.9,388.8,446.8,383.6z"
                                                  fill="#b0bec5"/>
                                        </g>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </a>
                        </div>
                        <!--End Auth and Basket Cart and Search and Result Search-->
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End Section Header-->

    <!--Section Menu and Sub Menu and Promotions-->
    <section class="container-fluid menu-header">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 menu-header">

                    <!--Menu and Sub Menu-->
                    <div class="main-menu">
                        <ul>
                            <li><a href="#">کالای دیجیتال</a>
                                <!--Sub Menu-->
                                <div class="row sub-menu" style="background: #FFF url('asset/files/menu/001.png')">
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">لوازم جانبی گوشی</a></li>
                                            <li><a href="#">کیف و کاور گوشی</a></li>
                                            <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                            <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                            <li><a href="#">پایه نگهدارنده گوشی</a></li>
                                            <li class="title"><a href="#">گوشی موبایل</a></li>
                                            <li><a href="#">آیفون اپل</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li class="title"><a href="#">واقعیت مجازی</a></li>
                                            <li class="title"><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                            <li class="title"><a href="#">هدفون، هدست، هندزفری</a></li>
                                            <li class="title"><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                            <li class="title"><a href="#">اسکوتر برقی</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">هارد، فلش و SSD</a></li>
                                            <li class="title"><a href="#">دوربین</a></li>
                                            <li><a href="#">دوربین عکاسی دیجیتال</a></li>
                                            <li><a href="#">دوربین‌ ورزشی و فیلم برداری</a></li>
                                            <li><a href="#">دوربین‌ چاپ سریع</a></li>
                                            <li class="title"><a href="#">لوازم جانبی دوربین</a></li>
                                            <li><a href="#">لنز</a></li>
                                            <li><a href="#">کیف</a></li>
                                            <li><a href="#">کارت حافظه</a></li>
                                            <li><a href="#">کاغذ چاپ عکس</a></li>
                                            <li class="title"><a href="#">دوربین‌های تحت شبکه</a></li>
                                            <li class="title"><a href="#">دوربین دو چشمی و شکاری</a></li>
                                            <li class="title"><a href="#">تلسکوپ</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">XBox, PS4 و بازی</a></li>
                                            <li class="title"><a href="#">لپ تاپ</a></li>
                                            <li class="title"><a href="#">لوازم جانبی لپتاپ</a></li>
                                            <li><a href="#">کیف، کوله و کاور</a></li>
                                            <li><a href="#">کابل‌های رابط و مبدل</a></li>
                                            <li><a href="#">کابل‌ صدا، AUX و HDMI</a></li>
                                            <li class="title"><a href="#">مودم و تجهیزات شبکه</a></li>
                                            <li class="title"><a href="#">کامپیوتر و تجهیزات جانبی</a></li>
                                            <li><a href="#">تجهیزات مخصوص بازی</a></li>
                                            <li><a href="#">مانیتور</a></li>
                                            <li><a href="#">کیس‌های اسمبل شده</a></li>
                                            <li><a href="#">قطعات داخلی کامپیوتر</a></li>
                                            <li><a href="#">ماوس</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">تبلت</a></li>
                                            <li><a href="#">لنوو</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li><a href="#">ایسوس</a></li>
                                            <li class="title"><a href="#">کیف، کاور، لوازم جانبی تبلت</a></li>
                                            <li class="title"><a href="#">ماشین های اداری</a></li>
                                            <li><a href="#">لوازم جانبی پرینتر</a></li>
                                            <li><a href="#">تلفن، بی سیم و سانترال</a></li>
                                            <li><a href="#">فکس</a></li>
                                            <li><a href="#">پرینتر</a></li>
                                            <li><a href="#">لیبل زن و لوازم جانبی</a></li>
                                            <li class="title"><a href="#">کتابخوان فیدیبوک</a></li>
                                            <li class="title"><a href="#">کارت هدیه خرید از دیجی کیان</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-12"><a href="#" class="more">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="#19bfd3" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                            </svg>
                                            همه دسته‌بندی‌های کالای دیجیتال</a></div>
                                </div>
                                <!--End Sub Menu-->
                            </li>
                            <li><a href="#">وسایل نقلیه، ابزار و اداری</a>
                                <div class="row sub-menu" style="background: #FFF url('asset/files/menu/002.png')">
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">لوازم جانبی گوشی</a></li>
                                            <li><a href="#">کیف و کاور گوشی</a></li>
                                            <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                            <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                            <li><a href="#">پایه نگهدارنده گوشی</a></li>
                                            <li class="title"><a href="#">گوشی موبایل</a></li>
                                            <li><a href="#">آیفون اپل</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li class="title"><a href="#">واقعیت مجازی</a></li>
                                            <li class="title"><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                            <li class="title"><a href="#">هدفون، هدست، هندزفری</a></li>
                                            <li class="title"><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                            <li class="title"><a href="#">اسکوتر برقی</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">هارد، فلش و SSD</a></li>
                                            <li class="title"><a href="#">دوربین</a></li>
                                            <li><a href="#">دوربین عکاسی دیجیتال</a></li>
                                            <li><a href="#">دوربین‌ ورزشی و فیلم برداری</a></li>
                                            <li><a href="#">دوربین‌ چاپ سریع</a></li>
                                            <li class="title"><a href="#">لوازم جانبی دوربین</a></li>
                                            <li><a href="#">لنز</a></li>
                                            <li><a href="#">کیف</a></li>
                                            <li><a href="#">کارت حافظه</a></li>
                                            <li><a href="#">کاغذ چاپ عکس</a></li>
                                            <li class="title"><a href="#">دوربین‌های تحت شبکه</a></li>
                                            <li class="title"><a href="#">دوربین دو چشمی و شکاری</a></li>
                                            <li class="title"><a href="#">تلسکوپ</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">XBox, PS4 و بازی</a></li>
                                            <li class="title"><a href="#">لپ تاپ</a></li>
                                            <li class="title"><a href="#">لوازم جانبی لپتاپ</a></li>
                                            <li><a href="#">کیف، کوله و کاور</a></li>
                                            <li><a href="#">کابل‌های رابط و مبدل</a></li>
                                            <li><a href="#">کابل‌ صدا، AUX و HDMI</a></li>
                                            <li class="title"><a href="#">مودم و تجهیزات شبکه</a></li>
                                            <li class="title"><a href="#">کامپیوتر و تجهیزات جانبی</a></li>
                                            <li><a href="#">تجهیزات مخصوص بازی</a></li>
                                            <li><a href="#">مانیتور</a></li>
                                            <li><a href="#">کیس‌های اسمبل شده</a></li>
                                            <li><a href="#">قطعات داخلی کامپیوتر</a></li>
                                            <li><a href="#">ماوس</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">تبلت</a></li>
                                            <li><a href="#">لنوو</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li><a href="#">ایسوس</a></li>
                                            <li class="title"><a href="#">کیف، کاور، لوازم جانبی تبلت</a></li>
                                            <li class="title"><a href="#">ماشین های اداری</a></li>
                                            <li><a href="#">لوازم جانبی پرینتر</a></li>
                                            <li><a href="#">تلفن، بی سیم و سانترال</a></li>
                                            <li><a href="#">فکس</a></li>
                                            <li><a href="#">پرینتر</a></li>
                                            <li><a href="#">لیبل زن و لوازم جانبی</a></li>
                                            <li class="title"><a href="#">کتابخوان فیدیبوک</a></li>
                                            <li class="title"><a href="#">کارت هدیه خرید از دیجی کیان</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-12"><a href="#" class="more">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="#19bfd3" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                            </svg>
                                            همه دسته‌بندی‌های کالای دیجیتال</a></div>
                                </div>
                            </li>
                            <li><a href="#">آرایشی، بهداشتی و سلامت</a></li>
                            <li><a href="#">مد و پوشاک</a></li>
                            <li><a href="#">خانه و آشپزخانه</a></li>
                            <li><a href="#">کتاب، لوازم تحریر و هنر</a></li>
                            <li><a href="#">اسباب بازی، کودک و نوزاد</a></li>
                            <li><a href="#">ورزش و سفر</a>
                                <!--Sub Menu-->
                                <div class="row sub-menu" style="background: #FFF url('asset/files/menu/001.png')">
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">لوازم جانبی گوشی</a></li>
                                            <li><a href="#">کیف و کاور گوشی</a></li>
                                            <li><a href="#">پاور بانک (شارژر همراه)</a></li>
                                            <li><a href="#">هندزفری، هدفون، هدست</a></li>
                                            <li><a href="#">پایه نگهدارنده گوشی</a></li>
                                            <li class="title"><a href="#">گوشی موبایل</a></li>
                                            <li><a href="#">آیفون اپل</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li class="title"><a href="#">واقعیت مجازی</a></li>
                                            <li class="title"><a href="#">مچ‌بند و ساعت هوشمند</a></li>
                                            <li class="title"><a href="#">هدفون، هدست، هندزفری</a></li>
                                            <li class="title"><a href="#">اسپیکر بلوتوث و با سیم</a></li>
                                            <li class="title"><a href="#">اسکوتر برقی</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">هارد، فلش و SSD</a></li>
                                            <li class="title"><a href="#">دوربین</a></li>
                                            <li><a href="#">دوربین عکاسی دیجیتال</a></li>
                                            <li><a href="#">دوربین‌ ورزشی و فیلم برداری</a></li>
                                            <li><a href="#">دوربین‌ چاپ سریع</a></li>
                                            <li class="title"><a href="#">لوازم جانبی دوربین</a></li>
                                            <li><a href="#">لنز</a></li>
                                            <li><a href="#">کیف</a></li>
                                            <li><a href="#">کارت حافظه</a></li>
                                            <li><a href="#">کاغذ چاپ عکس</a></li>
                                            <li class="title"><a href="#">دوربین‌های تحت شبکه</a></li>
                                            <li class="title"><a href="#">دوربین دو چشمی و شکاری</a></li>
                                            <li class="title"><a href="#">تلسکوپ</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">XBox, PS4 و بازی</a></li>
                                            <li class="title"><a href="#">لپ تاپ</a></li>
                                            <li class="title"><a href="#">لوازم جانبی لپتاپ</a></li>
                                            <li><a href="#">کیف، کوله و کاور</a></li>
                                            <li><a href="#">کابل‌های رابط و مبدل</a></li>
                                            <li><a href="#">کابل‌ صدا، AUX و HDMI</a></li>
                                            <li class="title"><a href="#">مودم و تجهیزات شبکه</a></li>
                                            <li class="title"><a href="#">کامپیوتر و تجهیزات جانبی</a></li>
                                            <li><a href="#">تجهیزات مخصوص بازی</a></li>
                                            <li><a href="#">مانیتور</a></li>
                                            <li><a href="#">کیس‌های اسمبل شده</a></li>
                                            <li><a href="#">قطعات داخلی کامپیوتر</a></li>
                                            <li><a href="#">ماوس</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <ul>
                                            <li class="title"><a href="#">تبلت</a></li>
                                            <li><a href="#">لنوو</a></li>
                                            <li><a href="#">سامسونگ</a></li>
                                            <li><a href="#">ایسوس</a></li>
                                            <li class="title"><a href="#">کیف، کاور، لوازم جانبی تبلت</a></li>
                                            <li class="title"><a href="#">ماشین های اداری</a></li>
                                            <li><a href="#">لوازم جانبی پرینتر</a></li>
                                            <li><a href="#">تلفن، بی سیم و سانترال</a></li>
                                            <li><a href="#">فکس</a></li>
                                            <li><a href="#">پرینتر</a></li>
                                            <li><a href="#">لیبل زن و لوازم جانبی</a></li>
                                            <li class="title"><a href="#">کتابخوان فیدیبوک</a></li>
                                            <li class="title"><a href="#">کارت هدیه خرید از دیجی کیان</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-12"><a href="#" class="more">
                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path fill="#19bfd3" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                            </svg>
                                            همه دسته‌بندی‌های کالای دیجیتال</a></div>
                                </div>
                                <!--End Sub Menu-->
                            </li>
                        </ul>
                    </div>
                    <!--End Menu and Sub Menu-->

                    <!--Promotions-->
                    <div class="promotions">
                        <ul>
                            <li><a href="promotion.html">شگفت‌انگیزها</a></li>
                            <li><a href="promotion.html">فروش ویژه</a></li>
                        </ul>
                    </div>
                    <!--End Promotions-->

                </div>
            </div>
        </div>
    </section>
    <!--End Section Menu and Sub Menu and Promotions-->
</header>