@php
    $arrProductsLastView = array();
    $lastView = empty(\Cookie::get('productsLastView')) ? [] : json_decode(\Cookie::get('productsLastView'), true);
    if ($lastView) {
        arsort($lastView);
    }

    if ($lastView && count($lastView)) {
        $lastView = array_slice($lastView, 0, 5, true);
        $productsLastView = $modelProduct->start()->getProductFromListID(array_keys($lastView))->getData();
        foreach ($lastView as $pId => $time) {
            foreach ($productsLastView as $key => $product) {
                if ($product['id'] == $pId) {
                    $product['timelastview'] = $time;
                    $arrProductsLastView[] = $product;
                }
            }
        }
    }
@endphp

@if (!empty($arrProductsLastView))

    <div class="col-lg-2 px-0 pr-lg-2">
        <div class="cart-shadow-radius bg-white">
            <div class="col-12 offer-moment px-3 pt-4 pb-2">
                <div class="header">
                    <h2 id="offer-moment-timer">{{ trans('front.products_last_view') }}</h2>
                </div>
            </div>
            <div class="col-12 offer-moment">
                <div class="content">
                    <div class="slider-product">
                        <div class="slick-offer-moment" data-slick='{"autoplay": true, "autoplaySpeed": 6800}'>
                            @foreach ($arrProductsLastView as $product_lastView)
                                <div class="item">
                                    <a href="{{$product_lastView->getUrl()}}" title="{{$product_lastView->name}}">
                                        <img src="{{ asset($product_lastView->getThumb()) }}" class="img-fluid" alt="{{$product_lastView->name}}">
                                        <h2 class="shave-product-name">
                                            {{$product_lastView->name}}
                                        </h2>
                                        {{$product_lastView->showPrice()}}
                                        {{--<div class="old-price">--}}
                                        {{--<del>۹۹,۰۰۰</del>--}}
                                        {{--</div>--}}
                                        {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

