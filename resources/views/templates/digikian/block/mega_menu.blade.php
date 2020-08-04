@php
    $modelCategory = (new \App\Models\ShopCategory);
    $categories = $modelCategory->getList();
    $categoriesTop = $modelCategory->getCategoriesTop();
@endphp
@if ($categoriesTop->count())

    <div class="main-menu">

        @php
            $menus = (new \App\Models\ShopMegaMenu());
            $menus = $menus->getList();
        @endphp

        <ul>
            @foreach ($menus[0] as $key=>$level0)
                <li><a href="#">{{ sc_language_render($level0->title) }}</a>
                    <!--Sub Menu-->
                    <div class="row sub-menu" style="background: #FFF url()">
                        @if (isset($menus[$level0->id]) && count($menus[$level0->id]))
                            @foreach ($menus[$level0->id] as $level1)
                                @if($level1->block == 1)
                                    <div class="col-sm-6 col-md-3">

                                        <ul>
                                            <li class="title">
                                                <a href="{{$level1->url}}" class="">
                                                    {{ sc_language_render($level1->title) }}
                                                </a>
                                            </li>

                                            @if (isset($menus[$level1->id]) && count($menus[$level1->id]))
                                                @foreach ($menus[$level1->id] as $level2)
                                                    <li>
                                                        <a href="{{ $level2->url?sc_url_render($level2->url):'#' }}">
                                                            {{ sc_language_render($level2->title) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @if($level1->block == 2)
                                    <div class="col-sm-6 col-md-3">

                                        <ul>
                                            <li class="title">
                                                <a href="{{$level1->url}}" class="">
                                                    {{ sc_language_render($level1->title) }}
                                                </a>
                                            </li>

                                            @if (isset($menus[$level1->id]) && count($menus[$level1->id]))
                                                @foreach ($menus[$level1->id] as $level2)
                                                    <li>
                                                        <a href="{{ $level2->url?sc_url_render($level2->url):'#' }}">
                                                            {{ sc_language_render($level2->title) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @if($level1->block == 3)
                                    <div class="col-sm-6 col-md-3">

                                        <ul>
                                            <li class="title">
                                                <a href="{{$level1->url}}" class="">
                                                    {{ sc_language_render($level1->title) }}
                                                </a>
                                            </li>

                                            @if (isset($menus[$level1->id]) && count($menus[$level1->id]))
                                                @foreach ($menus[$level1->id] as $level2)
                                                    <li>
                                                        <a href="{{ $level2->url?sc_url_render($level2->url):'#' }}">
                                                            {{ sc_language_render($level2->title) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @if($level1->block == 4)
                                    <div class="col-sm-6 col-md-3">

                                        <ul>
                                            <li class="title">
                                                <a href="{{$level1->url}}" class="">
                                                    {{ sc_language_render($level1->title) }}
                                                </a>
                                            </li>

                                            @if (isset($menus[$level1->id]) && count($menus[$level1->id]))
                                                @foreach ($menus[$level1->id] as $level2)
                                                    <li>
                                                        <a href="{{ $level2->url?sc_url_render($level2->url):'#' }}">
                                                            {{ sc_language_render($level2->title) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif


                            @endforeach
                        @endif

                        <div class="col-12">
                            <a href="{{$level0->url}}" class="more">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="#19bfd3" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                </svg>
                                همه دسته‌بندی‌های {{ sc_language_render($level0->title) }}
                            </a>
                        </div>
                    </div>
                    <!--End Sub Menu-->
                </li>
            @endforeach
        </ul>

    </div>

@endif