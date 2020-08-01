@php
    $banners = $modelBanner->start()->getBanner()->getData()
@endphp
@if (!empty($banners))
    <!--Slider Home-->
    <div class="col-12 slider-home p-0 mb-3">
        <div class="slick-slider-home cart-shadow-radius">
            @foreach ($banners as $key => $banner)
                <a href="{{ route('banner.click',['id' => $banner->id]) }}" class="cart-shadow-radius"
                   target="{{ $banner->target }}" style="background-image: url({{ asset($banner->image) }})"></a>
            @endforeach
        </div>
        <div id="slick-slider-home-arrow-next" class="d-none d-md-block d-md-flex slick-slider-home-arrow next">
            <i class="mdi mdi-chevron-left"></i>
        </div>
        <div id="slick-slider-home-arrow-prev" class="d-none d-md-block d-md-flex slick-slider-home-arrow prev">
            <i class="mdi mdi-chevron-right"></i>
        </div>
    </div>
@endif

