/*----------------------------
 Preloader Before Loading
------------------------------*/
/*$(window).on("load", function () {
    preloaderFadeOutTime = 1000;
    function hidePreloader() {
        var preloader = $('.preloader');
        preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
});*/

/*----------------------------
 Loading Document
------------------------------*/
$(document).ready(function () {
    try {
        Themes();
        Slider();
        Range_price();
        Select2();
        Chart_Price();
    } catch (e) {

    }





});


/*----------------------------
 All Require Function
------------------------------*/
function Themes() {
    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Popover
    $('[data-toggle="popover"]').popover();

    // Shave Copyright
    if ($(window).width() > 768 && $(window).width() < 1050) {
        shave('.shave-copyright', 105, {character: ' ...'});
    }

    // Auth Toggle Menu Auth
    $('.auth').on('click', function (e) {
        e.stopPropagation();
        // show menu
        $(".panel").show();
        /** This section could be moved into its own function **/
        $(document.body).on('click.menuHide', function () {
            var $body = $(this);
            // hide menu
            $(".panel").hide();
            $body.off('click.menuHide');
        });
    });

    // Back To Top Windows
    $('#back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });

    // Back To Top Windows
    shave('.shave-aticle-title', 88, {character: ' ...'});
    shave('.shave-article-abstract', 85, {character: ' ...'});
    shave('.shave-related-post', 52, {character: ' ...'});
    shave('.shave-product-title', 60, {character: ' ...'});

    // Toggle View Product in Category
    $("#toggle-view-grid").click(function () {
        $("#toggle-view-list").removeClass("active");
        $("#toggle-view-grid").addClass("active");
        $("#type-view").removeClass("view-list");
        $("#type-view").addClass("view-grid");
    });
    $("#toggle-view-list").click(function () {
        $("#toggle-view-grid").removeClass("active");
        $("#toggle-view-list").addClass("active");
        $("#type-view").removeClass("view-grid");
        $("#type-view").addClass("view-list");
    });

    // Toggle Menu in Mobile
    $(".main-menu-xs li:has('ul') a").click(function (event) {
        event.preventDefault();
        $(this).toggleClass('active').parent().find('ul:first').toggleClass('active');
        $(this).parent().siblings().find('ul').removeClass('active');
        $(this).parent().siblings().find('a').removeClass('active');
    });

    // Hover Menu Is Background Set Mask Gray
    $(".menu-header .main-menu > ul > li").bind("mouseenter", function () {
        Mask.addClass("active");
    });
    $(".menu-header .main-menu > ul > li").bind("mouseleave", function () {
        Mask.removeClass("active");
    });

    // Zoom Product
    if($(window).width() > 1199){
        $('#ZoomProduct').elevateZoom({
            responsive: true,
            zoomWindowPosition: 10,
            easing: true,
            scrollZoom: true,
            lensFadeIn: 500,
            lensFadeOut: 500,
            zoomWindowWidth: 500,
            zoomWindowHeight: 500,
            borderSize: 2,
            borderColour: '#00bfd6',
            lensColour: '#00bfd6',
            lensOpacity: 0.1,
            cursor: 'crosshair',
        });
    }

    // lightBox Gallery Image
    lightGallery(document.getElementById('gallery-image-product'), {
        thumbnail: true,
        thumbWidth: 75,
        animateThumb: false,
        showThumbByDefault: false,
        cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        download: false,
    });

    // lightBox Gallery Video
    lightGallery(document.getElementById('gallery-video-product'), {
        thumbnail: true,
        thumbWidth: 75,
        animateThumb: false,
        showThumbByDefault: false,
        cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        download: false,
        zoom: false,
    });
    $('#ShowVideo').on('click', function () {
        $('#gallery-video-product li:first').trigger('click');
    });

    // Set Defualt False Check For Input Checkbox and Radio
    $( "input[type='checkbox'], input[type='radio']" ).prop( "checked", false );
    $( ".compare input" ).change(function() {
        $(this).prop( "checked", true );
        var ele = $( this );
        ele.parent().parent().toggleClass('active');
    });

}

/*----------------------------
 All Slider Slick
------------------------------*/
function Slider() {
    $('.slick-slider-home').slick({
        rtl: true,
        autoplay: true,
        autoplaySpeed: 4000,
        infinite: true,
        arrows: true,
        dots: true,
        fade: true,
        cssEase: 'linear',
        prevArrow: document.getElementById('slick-slider-home-arrow-prev'),
        nextArrow: document.getElementById('slick-slider-home-arrow-next'),
    });
    $('.slick-slider-amazing-xs').each(function () {
        var slick_slider_amazing_xs = $(this);
        slick_slider_amazing_xs.slick({
            rtl: true,
            infinite: false,
            arrows: false,
            dots: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 310,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
    $('.slick-slider-product').each(function () {
        var slick_slider_product = $(this);
        slick_slider_product.slick({
            rtl: true,
            infinite: false,
            arrows: true,
            dots: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: false,
            pauseOnFocus: false,
            pauseOnHover: false,
            nextArrow: slick_slider_product.parent().find(".next"),
            prevArrow: slick_slider_product.parent().find(".prev"),
            responsive: [
                {
                    breakpoint: 1050,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 680,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 310,
                    settings: {
                        dots: false,
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                }
            ]
        });
    });
    $('.slick-offer-moment').each(function () {
        var slick_offer_moment = $(this);
        slick_offer_moment.slick({
            rtl: true,
            infinite: false,
            arrows: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: false,
            pauseOnFocus: false,
            pauseOnHover: false,
            slickPlay: $("#offer-moment-timer").addClass("active"),
            nextArrow: slick_offer_moment.parent().find(".next"),
            prevArrow: slick_offer_moment.parent().find(".prev"),
            responsive: [
                {
                    breakpoint: 1201,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 1050,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 800,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 680,
                    settings: {
                        dots: false,
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 310,
                    settings: {
                        dots: false,
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                }
            ]
        });
    });
    $('.slick-slider-brand').each(function () {
        var slick_slider_brand = $(this);
        slick_slider_brand.slick({
            rtl: true,
            infinite: false,
            arrows: true,
            dots: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: false,
            pauseOnFocus: false,
            pauseOnHover: false,
            nextArrow: slick_slider_brand.parent().find(".next"),
            prevArrow: slick_slider_brand.parent().find(".prev"),
            responsive: [
                {
                    breakpoint: 1050,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                },
                {
                    breakpoint: 680,
                    settings: {
                        infinite: false,
                        dots: false,
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        draggable: true,
                        pauseOnFocus: true,
                        pauseOnHover: true,
                    }
                }
            ]
        });
    });
    shave('.shave-product-name', 50, {character: ' ...'});
    shave('.shave-product-name-view', 60, {character: ' ...'});
}

/*----------------------------
 Menu Mobile Toggle and Add Mask Gray
------------------------------*/
var Toggle = document.getElementById("menu-nav-xs");
var Mask = $("#mask-gray-body");

function openNav() {
    Toggle.style.width = "85%";
    Toggle.style.maxWidth = "300px";
    Mask.addClass("active");
}

function closeNav() {
    Toggle.style.width = "0";
    Mask.removeClass("active");
}

$(document).mouseup(function (e) {
    var Toggle = $("#menu-nav-xs");
    if (!Toggle.is(e.target) && Toggle.has(e.target).length === 0) {
        closeNav();
    }
});

/*----------------------------
 Amazing Slider in Index
------------------------------*/
$(document).ready(function () {
    var tab = $("#amazing-tab");
    var tab_item = $("#amazing-tab h3");
    var content = $("#amazing-content");
    var content_item = $("#amazing-content > div");
    tab_item.on('click', function (e) {
        content_item.removeClass("active");
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        var counter = $(this).attr("aria-label");
        content_item.eq(counter - 1).addClass("active");
    });

    function highlight_next_amazing() {
        var current = jQuery('#amazing-tab .active'); // get the current highlighted
        var next = current.next("h3");
        // if no next then we're at the end
        if (!next.length) {
            next = $("#amazing-tab h3:first"); // get the first li element in the parent
        }
        next.addClass('active');
        current.removeClass('active');
        var counter = next.attr("aria-label");
        content_item.removeClass("active");
        content_item.eq(counter - 1).addClass("active");
    }

    setInterval(highlight_next_amazing, 5000);
});

/*----------------------------
 Range Price Selector
------------------------------*/
function Range_price() {
    // Rang Price For Desktop
    var range_price = document.getElementById('range-price');
    noUiSlider.create(range_price, {
        start: [0, 10000000],
        direction: 'rtl',
        connect: true,
        step: 500000,
        range: {
            'min': 0,
            'max': 10000000
        },
        format: wNumb({
            decimals: 0,
            thousand: ',',
        }),
    });
    var range_price_values = [
        document.getElementById('range-price-value-lower'),
        document.getElementById('range-price-value-upper')
    ];
    range_price.noUiSlider.on('update', function (values, handle) {
        range_price_values[handle].innerHTML = values[handle];
    });

// Rang Price For Mobile in Modal
    var range_price_modal = document.getElementById('range-price-modal');
    noUiSlider.create(range_price_modal, {
        start: [0, 10000000],
        direction: 'rtl',
        connect: true,
        step: 500000,
        range: {
            'min': 0,
            'max': 10000000
        },
        format: wNumb({
            decimals: 0,
            thousand: ',',
        }),
    });
    var range_price_modal_values = [
        document.getElementById('range-price-value-lower-modal'),
        document.getElementById('range-price-value-upper-modal')
    ];
    range_price_modal.noUiSlider.on('update', function (values, handle) {
        range_price_modal_values[handle].innerHTML = values[handle];
    });





}

/*----------------------------
 Select 2
------------------------------*/
function Select2() {
    $('.select2-state, .select2-city').select2({
        theme: "bootstrap"
    });
}

/*----------------------------
 Star Rate
------------------------------*/
$('.rating input').change(function () {
    var $radio = $(this);
    $('.rating .selected').removeClass('selected');
    $radio.closest('label').addClass('selected');
});

/*----------------------------
 Toggle Short Long Content
------------------------------*/
function Toggle_Short_Long(x, y, s, f) {
    var elem1 = $(x);
    var elem2 = $(y);
    if (elem2.hasClass("short")) {
        elem2.removeClass("short").addClass("full");
        elem1.html(s);
    } else {
        elem2.removeClass("full").addClass("short");
        elem1.html(f);
    }
}

/*----------------------------
 Collapse Seller in Product
------------------------------*/
function Collapse_Seller() {
    var CS = $("#CollapseSeller");
    var CST = $("#CollapseSellerText");
    if (CS.hasClass("active")) {
        CS.removeClass("active");
        CST.html("مشاهده کمتر<i class=\"d-inline-flex align-middle mr-1 mdi mdi-chevron-up mdi-24px\"></i>");
    } else {
        CS.addClass("active");
        CST.html("مشاهده (۸) فروشنــــده / گارانتی بیشتـــــر<i class=\"d-inline-flex align-middle mr-1 mdi mdi-chevron-down mdi-24px\"></i>");
    }
}

/*----------------------------
 Satisfaction YES or NO
------------------------------*/
function yes_satisfaction() {
    $('#no-satisfaction, .separator').remove();
    $('#yes-satisfaction').css({
        'opacity': '0.65',
        'cursor': 'default',
    });
}

$('#ModalSatisfaction').on('hidden.bs.modal', function (e) {
    $('#yes-satisfaction, .separator').remove();
    $('#no-satisfaction').css({
        'opacity': '0.65',
        'cursor': 'default',
    });
    $('#no-satisfaction').removeAttr('data-target data-toggle');
});

/*----------------------------
 Chart Price
------------------------------*/
function Chart_Price(){
    Highcharts.chart('ChartPrice', {
        chart: {
            type: 'line',
            style: {
                fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                textAlign: 'right',
            },
            spacingBottom: 20,
            spacingTop: 20,
            spacingLeft: 20,
            spacingRight: 20,
            scrollablePlotArea: {
                minWidth: 600,
            }
        },
        title: {
            text: 'نمودار قیمت محصول',
            style: {
                fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                fontSize: '15px',
                direction: 'rtl',
                fontWeight: '500'
            },
        },
        subtitle: {
            text: 'تخفیف‌ها و قیمت جشنواره‌ها در قیمت فروش در نظر گرفته نمی‌شود.',
            style: {
                fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                fontSize: '12px',
                direction: 'rtl',
                fontWeight: '300'
            },
        },
        xAxis: {
            categories: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
            title: {
                text: 'یک سال اخیر',
                margin: 20,
                style: {
                    fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                    fontSize: '13px',
                    fontWeight: '500',
                    direction: 'rtl',
                },
            },
            labels: {
                style: {
                    fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                    color: '#959595',
                    fontSize: '11px',
                    fontWeight: '300',
                }
            }
        },
        yAxis: {
            title: {
                text: 'قیمت بدون تخفیف (هزار تومان)',
                margin: 20,
                style: {
                    fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                    fontSize: '13px',
                    fontWeight: '500',
                    direction: 'rtl',
                },
            },
            labels: {
                style: {
                    fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                    color: '#585858',
                    fontSize: '11px',
                    fontWeight: '300',
                },
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            rtl: true,
            useHTML: true,
            shadow: false,
            headerFormat: '<p class="m-0">ماه <strong dir="ltr"> {point.x}</strong></p>',
            pointFormat: '<p class="my-1"><span style="color:{point.color}">●</span> {series.name}</p>',
            footerFormat: '<p class="m-0"><strong dir="ltr"> {point.y}</strong> تومان</p>',
            style: {
                fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                whiteSpace: 'nowrap',
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                textAlign: 'center',
                fontSize: '10px',
                direction: 'rtl',
                letterSpacing: '-1px',
                wordSpacing: '-1px',
            },
        },
        legend: {
            rtl: true,
            backgroundColor: '#f7f7f7',
            itemMarginTop: 8,
            itemMarginBottom: 8,
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom',
            itemStyle: {
                fontFamily: 'IRANSans, Tahoma, aria, sans-serif',
                textAlign: 'right',
                fontWeight: '300',
                fontSize: '10px',
                itemMarginBottom: 4,
                letterSpacing: '-1px',
                wordSpacing: '-1px',
            }
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'نودیس پرداز | نقره ای | گارانتی اینوو',
            marker: {
                symbol: 'circle'
            },
            data: [2000, 2250, 2300, 2340, 2350, 1985, 2000, 2120, 2050, 2350, 1980, 1820],
        }, {
            name: 'دی جی لند | خاکستری | گارانتی مدیاپردازش',
            marker: {
                symbol: 'circle'
            },
            data: [2150, 2350, 1980, 1820, 2000, 2250, 2300, 2340, 2350, 1985, 2000, 2120]
        }, {
            name: 'سارینا دی همراه | خاکستری | گارانتی مدیاپردازش',
            marker: {
                symbol: 'circle'
            },
            data: [2340, 1850, 1985, 2000, 2120, 1985, 1820, 1985, 1985, 2050, 2150, 2500]
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 600,
                },
                chartOptions: {
                    xAxis: {
                        title: {
                            margin: 0,
                            style: {
                                fontSize: '11px',
                            },
                        },
                        labels: {
                            style: {
                                fontSize: '9px',
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            margin: 0,
                            style: {
                                fontSize: '11px',
                            },
                        },
                        labels: {
                            style: {
                                fontSize: '9px',
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '8px',
                        },
                    },
                }
            }]
        }
    });
}
