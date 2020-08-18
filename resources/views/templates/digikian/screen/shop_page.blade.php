@php
/*
$layout_page = shop_page
$page: no paginate
*/ 
@endphp

@extends($templatePath.'.layout')

@section('main')
    <section class="row">

        <!--Content-->
        <div class="col-12 box-page wrapper-text p-3 p-md-4">
            <h1 class="title-page">{{ $title }}</h1>
            <hr>
            {!! sc_html_render($page->content) !!}

        </div>
        <!--End Content-->

    </section>


@endsection
