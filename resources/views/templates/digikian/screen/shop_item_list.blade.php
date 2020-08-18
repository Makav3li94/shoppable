@php
    /*
    $layout_page = item_list
    $itemsList: paginate
    Use paginate: $itemsList->appends(request()->except(['page','_token']))->links()
    */
@endphp

@extends($templatePath.'.layout')

@section('main')

    <!--Section Category Post-->
    <section class="row category-post mt-1 mt-md-2">
        <div class="col-12 p-0">
        @if (!empty($itemsList))

            <!--Article-->
                <div class="row">
                    @foreach ($itemsList as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-4">
                            <article class="cart-shadow-radius">
                                <div class="header">
                                    <a href="#">
                                        <img src="{{ asset($item->getImage()) }}" class="img-fluid" alt="{{ $item->name }}">
                                        <span class="detail">
                                    <span class="name-category">{{ $item->name }}</span>
                                    <span class="statistics">
                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-comment"></i>۱۲</span>
                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-heart"></i>۳۵</span>
                                        <span><i class="d-inline-flex align-middle ml-1 mdi mdi-eye"></i>۶۱۲</span>
                                    </span>
                                </span>
                                    </a>
                                </div>

                            </article>
                        </div>
                    @endforeach
                </div>
                <!--End Article-->

        @endif
        <!--Pagination-->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="pagination">
                        {{ $itemsList->appends(request()->except(['page','_token']))->links() }}
                    </div>
                </div>
            </div>
            <!--End Pagination-->

        </div>
    </section>
    <!--End Section Category Post-->

@endsection