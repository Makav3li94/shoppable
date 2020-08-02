@if (sc_config('SITE_STATUS') == 'off')
@include($templatePath . '.maintenance')
@else

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $description??sc_store('description') }}">
    <meta name="keyword" content="{{ $keyword??sc_store('keyword') }}">
    <title>{{$title??sc_store('title')}}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png" sizes="16x16">
    <meta property="og:image" content="{{ !empty($og_image)?asset($og_image):asset('images/org.jpg') }}"/>
    <meta property="og:url" content="{{ \Request::fullUrl() }}"/>
    <meta property="og:type" content="Website"/>
    <meta property="og:title" content="{{ $title??sc_store('title') }}"/>
    <meta property="og:description" content="{{ $description??sc_store('description') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- css default for item s-cart -->
@include($templatePath.'.common.css')
<!--//end css defaut -->

    <!--Module meta -->
@isset ($blocksContent['meta'])
    @foreach ( $blocksContent['meta'] as $layout)
        @php
            $arrPage = explode(',', $layout->page)
        @endphp
        @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
            @if ($layout->type =='html')
                {!! $layout->text !!}
            @endif
        @endif
    @endforeach
@endisset
<!--//Module meta -->
    <!-- css default for item s-cart -->
    <!--//end css default -->
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/bootstrap-v4-rtl/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/slick-carousel/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/nouislider/distribute/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/node_modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset($templateFile.'/node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset($templateFile.'/asset/css/style.css')}}">
@stack('styles')
<body>

@include($templatePath.'.header')
<main class="main-content pt-3 pb-3 pb-md-5">
    <div class="container-fluid">
        <div class="container">



            <!--breadcrumb-->
        @yield('breadcrumb')
        <!--//breadcrumb-->

            <!--fillter-->
        @yield('filter')
        <!--//fillter-->

            <!--Notice -->
        @include($templatePath.'.common.notice')
        <!--//Notice -->

            <!--body-->
            @section('main')
                @include($templatePath.'.center')
            @show
        </div>
    </div>
</main>


<!--Module top -->
@isset ($blocksContent['top'])
    @foreach ( $blocksContent['top'] as $layout)
        @php
            $arrPage = explode(',', $layout->page)
        @endphp
        @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
            @if ($layout->type =='html')
                {!! $layout->text !!}
            @elseif($layout->type =='view')
                @if (view()->exists($templatePath.'.block.'.$layout->text))
                    @include($templatePath.'.block.'.$layout->text)
                @endif
            @endif
        @endif
    @endforeach
@endisset
<!--//Module top -->


@include($templatePath.'.footer')

<!-- js default for item s-cart -->
@include($templatePath.'.common.js')
<!--//end js defaut -->


<!--Module bottom -->
@isset ($blocksContent['bottom'])
    @foreach ( $blocksContent['bottom'] as $layout)
        @php
            $arrPage = explode(',', $layout->page)
        @endphp
        @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
            @if ($layout->type =='html')
                {!! $layout->text !!}
            @elseif($layout->type =='view')
                @if (view()->exists($templatePath.'.block.'.$layout->text))
                    @include($templatePath.'.block.'.$layout->text)
                @endif
            @endif
        @endif
    @endforeach
@endisset
<!--//Module bottom -->
@stack('scripts')

<div id="sc-loading">
    <div class="sc-overlay"><i class="fa fa-spinner fa-pulse fa-5x fa-fw "></i></div>
</div>

</body>

</html>
@endif