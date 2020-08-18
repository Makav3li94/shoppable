@php
    /*
    $layout_page = news_list
    $news: paginate
    Use paginate: $news->appends(request()->except(['page','_token']))->links()
    $products: paginate
    Use paginate: $products->appends(request()->except(['page','_token']))->links()
    */
@endphp


@extends($templatePath.'.layout')

@section('main')
    <!--Section Category Post-->
    <section class="row category-post mt-1 mt-md-2">
        <div class="col-12 p-0">

            <!--Article-->
            <div class="row">
                @if ($news->count())
                    @foreach ($news as $newsDetail)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-4">
                            <article class="cart-shadow-radius">
                                <div class="header">
                                    <a href="{{ $newsDetail->getUrl() }}">
                                        <img src="{{ asset($newsDetail->getThumb()) }}" class="img-fluid" alt="">
                                        <span class="detail">
                                    <span class="name-category">{{ $newsDetail->title }}</span>
                                    <span class="statistics">
{{--                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-comment"></i>۱۲</span>--}}
                                        {{--                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-heart"></i>۳۵</span>--}}
                                        {{--                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-eye"></i>۶۱۲</span>--}}
                                    </span>
                                </span>
                                    </a>
                                </div>
                                <div class="body p-2 p-md-3">
                                    <h2><a href="{{ $newsDetail->getUrl() }}"
                                           class="shave-aticle-title">{{ $newsDetail->title }}</a>
                                    </h2>
                                    <p class="shave-article-abstract">{{ $newsDetail->description }}</p>
                                </div>
                                <div class="footer">
                                    {{--                                    <span class="thumb"><img src="asset/files/user/001.jpg" alt="">اشکان کیانی</span>--}}
                                    <span class="date"><i class="d-inline-flex align-middle ml-1 mdi mdi-clock"></i>{{ $newsDetail->created_at }}</span>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    {!! trans('front.no_data') !!}
                @endif
            </div>
            <!--End Article-->

            <!--Pagination-->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="pagination">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
            <!--End Pagination-->

        </div>
    </section>
    <!--End Section Category Post-->
@endsection