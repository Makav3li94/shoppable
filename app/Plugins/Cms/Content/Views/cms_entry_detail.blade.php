@extends($templatePath.'.layout')

@section('main')
    <section class="row d-block bg-post mt-1 mt-md-2">
        <div class="row justify-content-between">

            <!--Main Content Post-->
            <div class="col-lg-9 h-100">
                <!--Article-->
                <article class="post cart-shadow-radius bg-white px-3 px-md-5 py-2 py-md-3">

                    <!--Breadcrumb-->
                    <div class="breadcrumb-defualt py-2 py-md-3">
                        <p><span><a href="index.html"><i class="d-inline-flex align-middle ml-1 mdi mdi-home"></i>دیجی کیان</a></span><span><a href="#">تکنولوژی</a></span><span><a href="#">موبایل و گجت</a></span>سایت‌های مطرح درباره‌ی گلکسی نوت ۹ چه می‌گویند؟</p>
                    </div>
                    <!--End Breadcrumb-->

                    <!--Post Content-->
                    <div class="header py-2">
                        <h1>{{$title}}</h1>
                        <ul>
                            <li class="thumb"><img src="asset/files/user/001.jpg" alt="">اشکان کیانی</li>
                            <li class="date"><i class="d-inline-flex align-middle ml-1 mdi mdi-clock"></i>۱۳۹۶/۰۷/۰۱ - ۱۴:۲۵</li>
                            <li class="view"><i class="d-inline-flex align-middle ml-1 mdi mdi-eye"></i>۳۹۶</li>
                            <li class="comment"><i class="d-inline-flex align-middle ml-1 mdi mdi-comment"></i>۱۲</li>
                            <li class="like"><i class="d-inline-flex align-middle ml-1 mdi mdi-heart"></i>۳۵</li>
                        </ul>
                    </div>
                  <div class="body wrapper-text">
                      {!! sc_html_render($entry_currently->content) !!}
                  </div>
                    <div class="footer">
                        <div class="score-like-share">
                            <div class="score">
                                <p class="mb-1">امتیاز خود را ثبت کنید.</p>
                                <div class="rating text-center">
                                    <label><input name="rating" value="5" type="radio"></label>
                                    <label class="selected"><input name="rating" value="4" type="radio"></label>
                                    <label><input name="rating" value="3" type="radio"></label>
                                    <label><input name="rating" value="2" type="radio"></label>
                                    <label><input name="rating" value="1" type="radio"></label>
                                </div>
                            </div>
                            <div class="like">
                                <p class="mb-1">می پسندم؟</p>
                                <i onclick="$(this).toggleClass('active')" class="mdi mdi-heart-outline mdi-24px"></i>
                            </div>
                            <div class="share">
                                <p class="mb-1">به اشتراک بگذارید.</p>
                                <ul>
                                    <li><a href="#"><i class="mdi mdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="mdi mdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="mdi mdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="mdi mdi-telegram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <p class="tags">برچسب ها:
                            <a href="#">قالب فروشگاهی</a>
                            <a href="#">به روزرسانی منظم</a>
                            <a href="#">کدنویسی اختصاصی</a>
                            <a href="#">قالب دیجی کیان</a>
                            <a href="#">اشکان کیانی</a>
                            <a href="#">بوت استرپ 4.1</a>
                            <a href="#">ریسپانسیو کامل</a>
                            <a href="#">سئو</a>
                            <a href="#">بهینه سازی</a>
                            <a href="#">Sass</a>
                            <a href="#">Gulp</a>
                            <a href="#">سرعت لود بالا</a>
                            <a href="#">اورجینال</a>
                            <a href="#">انتخاب برتر</a>
                            <a href="#">HTML5</a>
                            <a href="#">مخصوص لاراول</a>
                            <a href="#">Git</a>
                            <a href="#">مخصوص دات نت</a>
                        </p>
                    </div>
                    <!--End Post Content-->
                </article>
                <!--End Article-->

                <!--Tab Question-->
                <div class="bg-white mt-3 p-2 p-md-3" id="questions">
                    <p class="title"><i class="d-inline-flex align-middle ml-1 mdi mdi-comment-text-multiple-outline mdi-36px"></i>دیدگاه خود را در مورد نوشته مطرح نمایید.</p>

                    <!--Send Question-->
                    <form class="mb-2 mb-md-5" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="نام و نام خانوادگی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" dir="ltr" class="form-control text-left" placeholder="پست الکترونیکی">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="فارسی را پاس بداریم."></textarea>
                        </div>
                        <div class="form-group send-qustion">
                            <button type="submit" class="btn btn-dark">ثبت دیدگاه</button>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="QuestionCheck">
                                <label class="custom-control-label" for="QuestionCheck">اولین پاسخی که به پرسش من داده شد، از طریق ایمیل به من اطلاع دهید.<br/>با انتخاب دکمه “ثبت پرسش”، موافقت خود را با قوانین انتشار محتوا در دیجی کیان اعلام می کنم.</label>
                            </div>
                        </div>
                    </form>
                    <!--End Send Question-->

                    <!--List Question-->
                    <div class="col-12 list-question">
                        <div class="row main-header-list-comment">
                            <p>دیدگاه های کاربران<span>( ۲ دیدگاه )</span></p>
                        </div>
                        <div class="row item">
                            <div class="col-12 p-0">
                                <ul>
                                    <!--Item Question-->
                                    <li>
                                        <!--Question-->
                                        <div class="question">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-comment-processing-outline"></i></div>
                                                <p class="type">دیدگاه</p>
                                                <p class="name">اصغر محمدی</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>حدود یک ماه هست که گوشی رو دارم و ازش کاملا راضیم ، تجربه کار با فیس آیدی خیلی جذاب و لذت بخشه . دوربین با کیفیت ، بدنه ی زیبا و سیستم عامل روان آی او اس از جمله ویژگی های بارز این محصول هستن.</p>
                                                    <p> به دوستانی که قبلا آیفون داشتن و الان به فکر ارتقا هستن و با قیمتش مشکلی ندارن پیشنهاد می کنم.</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۴ تیر ۱۳۹۷</p>
                                                    <a rel="nofollow" data-toggle="collapse" href="#collapseQuestion-1" role="button" aria-expanded="false" aria-controls="collapseQuestion-1">به این دیدگاه پاسخ دهید</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Answer-->
                                        <div class="collapse" id="collapseQuestion-1">
                                            <div class="answer">
                                                <div class="right">
                                                    <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i></div>
                                                    <p class="type">پاسخ</p>
                                                </div>
                                                <div class="left px-2 p-md-3">
                                                    <div class="col-12 p-0 first-col">
                                                        <p>به این دیدگاه پاسخ دهید</p>
                                                        <form class="mt-2 mt-md-4" action="">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="9"></textarea>
                                                            </div>
                                                            <div class="form-group send-reply">
                                                                <button type="submit" class="btn btn-info btn-lg">ثبت پاسخ</button>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="answerCheck-1" type="checkbox">
                                                                    <label class="custom-control-label" for="answerCheck-1">با انتخاب دکمه "ثبت پاسخ"، موافقت خود را با<br><a href="">قوانین انتشار محتوا</a> در دیجی‌کیان اعلام می‌کنم.</label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Reply-->
                                        <div class="reply">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i>
                                                </div>
                                                <p class="type">پاسخ</p>
                                                <p class="name">جواد عباس آبادی</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>برای گوشی آیفون چه برنامه ای نصب کنم تا با این ساعت کانکت بشه ؟</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۱۰ آبان ۱۳۹۶</p>
                                                    <div class="is-helpful">
                                                        <p>آیا این نظر برایتان مفید بود؟</p>
                                                        <button class="btn m-2">۷۴ بله</button>
                                                        <button class="btn">۱۶ خیر</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!--End Item Question-->
                                    <li>
                                        <div class="question">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-comment-processing-outline"></i>
                                                </div>
                                                <p class="type">دیدگاه</p>
                                                <p class="name">محمد رضا رشیدی</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>این گوشی حرف نداره فوق العاده ای هست بهترین محصول اپل اونایی که از سامسونگ یا سام هنگ تعریف میکنن هنوز این گوشی دستشون نگرفتن .خرید آن را توصیه کنیم احتمالاً هیچ خریداری از خرید آیفون 10 پشیمان نخواهد شد.</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۱۳ شهریور ۱۳۹۶</p>
                                                    <a rel="nofollow" data-toggle="collapse" href="#collapseQuestion-2" role="button" aria-expanded="false" aria-controls="collapseQuestion-1">به این دیدگاه پاسخ دهید</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseQuestion-2">
                                            <div class="answer">
                                                <div class="right">
                                                    <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i></div>
                                                    <p class="type">پاسخ</p>
                                                </div>
                                                <div class="left px-2 p-md-3">
                                                    <div class="col-12 p-0 first-col">
                                                        <p>به این دیدگاه پاسخ دهید</p>
                                                        <form class="mt-2 mt-md-4" action="">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="9"></textarea>
                                                            </div>
                                                            <div class="form-group send-reply">
                                                                <button type="submit" class="btn btn-info btn-lg">ثبت پاسخ</button>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="answerCheck-2" type="checkbox">
                                                                    <label class="custom-control-label" for="answerCheck-2">با انتخاب دکمه "ثبت پاسخ"، موافقت خود را با<br><a href="">قوانین انتشار محتوا</a> در دیجی‌کیان اعلام می‌کنم.</label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="question">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-comment-processing-outline"></i></div>
                                                <p class="type">دیدگاه</p>
                                                <p class="name">قاسم دهقان دهنوی</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>این گوشی از همه نظر عالی هست، قیمتش یکم بالا هست که اونم شخصا راضیم چون باعث میشه خاص باشه ، هیچ ایرادی نمی تونم پیدا کنم و واقعا بدون هیچ تعصبی نسبت به مارکش میگم عالیه، پرچمدارای برندهای دیگه رو هم داشتم و اصلا قابل مقایسه واسم نیستن، کسایی که میتونن بخرن شک نکنن و مطمئن باشن از خریدشون نهایت لذت رو میبرن</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۲۰ شهریور ۱۳۹۶</p>
                                                    <a rel="nofollow" data-toggle="collapse" href="#collapseQuestion-3" role="button" aria-expanded="false" aria-controls="collapseQuestion-3">به این دیدگاه پاسخ دهید</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseQuestion-3">
                                            <div class="answer">
                                                <div class="right">
                                                    <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i></div>
                                                    <p class="type">پاسخ</p>
                                                </div>
                                                <div class="left px-2 p-md-3">
                                                    <div class="col-12 p-0 first-col">
                                                        <p>به این دیدگاه پاسخ دهید</p>
                                                        <form class="mt-2 mt-md-4" action="">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="9"></textarea>
                                                            </div>
                                                            <div class="form-group send-reply">
                                                                <button type="submit" class="btn btn-info btn-lg">ثبت پاسخ</button>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="answerCheck-3" type="checkbox">
                                                                    <label class="custom-control-label" for="answerCheck-3">با انتخاب دکمه "ثبت پاسخ"، موافقت خود را با<br><a href="">قوانین انتشار محتوا</a> در دیجی‌کیان اعلام می‌کنم.</label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i></div>
                                                <p class="type">پاسخ</p>
                                                <p class="name">پوریا حسن افشاری</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>سلام.این دسته به PS4 pro می خوره یا نه؟</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۲۰ فروردین ۱۳۹۷</p>
                                                    <div class="is-helpful">
                                                        <p>آیا این نظر برایتان مفید بود؟</p>
                                                        <button class="btn m-2">۱ بله</button>
                                                        <button class="btn">۰ خیر</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i></div>
                                                <p class="type">پاسخ</p>
                                                <p class="name">سعید حیدری راد</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>سلام من یه تلویزیون اندروید سونی دارم میخوام از بازی های خود تلویزیون استفاده کنم آیا این دسته بازی بهش وصل میشه؟</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۴ آبان ۱۳۹۶</p>
                                                    <div class="is-helpful">
                                                        <p>آیا این نظر برایتان مفید بود؟</p>
                                                        <button class="btn m-2">۱ بله</button>
                                                        <button class="btn">۲- خیر</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply">
                                            <div class="right">
                                                <div class="icon"><i class="mdi mdi-lightbulb-on-outline"></i>
                                                </div>
                                                <p class="type">پاسخ</p>
                                                <p class="name">علی نادری</p>
                                            </div>
                                            <div class="left px-2 p-md-3">
                                                <div class="header wrapper-text">
                                                    <p>من خودم ایفون داشتم بدون شک کیفیت محصولات اپل فوق العاده هستن ولی باید منصفانه صحبت کنیم که محصولات اپل از طرف امریکا برای ایران تحریم هست یعنی مواجه شدن با ارور 1009 و برداشتن اپلیکیشن های ایرانی از اپ استور . بنده به شخصه با پشتیبانی اپل داخل امریکا تماس گرفتم و در مورد این که چرا اپلیکیشن های ایرانی بسته شدن و قابل دانلود نبودن باهاشون صحبت کردم و گفتن بهم که شما برا چی گوشی ای که هیچ نمایندگی و خدماتی داخل کشورتون نداره رو خریداری میکنید منم گفتم به دلیل کیفیت بالایی که داره و گفتن به دلیل مشکلات سیاستی که بین کشور ما و شما وجود داره متاسفانه هیچ راهی برای برداشتن ارور های 1009 و گذاشتن اپ های ایرانی نیس . دیگه بازم به سلیقه خودتون بستگی داره و بس .</p>
                                                </div>
                                                <div class="footer">
                                                    <p>۱ اردیبهشت ۱۳۹۷</p>
                                                    <div class="is-helpful">
                                                        <p>آیا این نظر برایتان مفید بود؟</p>
                                                        <button class="btn m-2">۵۱ بله</button>
                                                        <button class="btn">۲۵ خیر</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End List Question-->
                </div>
                <!--End Tab Question-->

            </div>
            <!--End Main Content Post-->

            <!--Sidebar-->
            <div class="col-lg-3 mt-3 mt-lg-0 pr-lg-0 sidebar-post">
                <div class="box-sidebar cart-shadow-radius bg-white p-3 mb-3">
                    <div class="title"><p><span>پیشنهاد سردبیر</span></p></div>
                    <div class="related-post">
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/001.jpg" class="img-thumbnail" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">گلکسی نوت ۹ در مقایسه با نسل قبلی خود چه تفاوتی هایی داشته است؟</h3>
                            </div>
                        </a>
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/002.jpg" class="img-thumbnail" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">کیفیت عکس‌های گرفته‌شده با دو گوشی  سامسونگ ایج و تشابه های آنها</h3>
                            </div>
                        </a>
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/003.jpg" class="img-thumbnail" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">خرید لپ تاپ جدید با دلار 4 هزار تومان منطقی است؟</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="box-sidebar cart-shadow-radius bg-white p-3 mb-3">
                    <div class="title"><p><span>مطالب مرتبط</span></p></div>
                    <div class="related-post">
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/005.jpg" class="rounded-circle" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">شما بگویید؛ سامسونگ گلکسی نوت ۹ یا آیفون ایکس؟</h3>
                                <p class="date"><i class="d-inline-flex align-middle ml-1 mdi mdi-clock"></i>۱۳۹۶/۰۷/۰۱ - ۱۴:۲۵</p>
                            </div>
                        </a>
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/004.jpg" class="rounded-circle" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">نگاه نزدیک به گوشی پیکسل ۳ ایکس‌ال گوگل پیش از رونمایی رسمی</h3>
                                <p class="date"><i class="d-inline-flex align-middle ml-1 mdi mdi-clock"></i>۱۳۹۶/۰۷/۰۱ - ۱۴:۲۵</p>
                            </div>
                        </a>
                        <a href="#" class="item">
                            <img src="asset/files/article/285-180/006.jpg" class="rounded-circle" alt="">
                            <div class="content">
                                <h3 class="shave-related-post">بررسی فصل نهم سریال مردگان متحرک؛ یک شروع تازه</h3>
                                <p class="date"><i class="d-inline-flex align-middle ml-1 mdi mdi-clock"></i>۱۳۹۶/۰۷/۰۱ - ۱۴:۲۵</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="box-sidebar cart-shadow-radius bg-white p-3 mb-3">
                    <div class="title"><p><span>معرفی من</span></p></div>
                    <div class="wrapper-text">
                        <p class="text-justify">دیجی کیان به عنوان یکی از قدیمی‌ترین فروشگاه های اینترنتی با بیش از یک دهه تجربه، با پایبندی به سه اصل کلیدی، پرداخت در محل، 7 روز ضمانت بازگشت کالا و تضمین اصل‌بودن کالا، موفق شده تا همگام با فروشگاه‌های معتبر جهان، به بزرگ‌ترین فروشگاه اینترنتی ایران تبدیل شود. به محض ورود به دیجی کیان با یک سایت پر از کالا رو به رو می‌شوید! هر آنچه که نیاز دارید و به ذهن شما خطور می‌کند در اینجا پیدا خواهید کرد.</p>
                    </div>
                </div>
                <div class="box-sidebar cart-shadow-radius bg-white p-3">
                    <div class="title"><p><span>بنر تبلیغاتی</span></p></div>
                    <img class="d-block mx-auto mb-1 img-fluid" src="asset/files/article/category/001.jpg" alt="">
                    <img class="d-block mx-auto mb-1 img-fluid" src="asset/files/article/category/002.jpg" alt="">
                    <img class="d-block mx-auto img-fluid" src="asset/files/article/category/003.jpg" alt="">
                </div>
            </div>
            <!--End Sidebar-->

        </div>
    </section>

@endsection

