@php
    /*
    $layout_page = shop_home
    */
@endphp

@extends($templatePath.'.layout')
@php
    $productsNew = $modelProduct->start()->getProductLatest()->setlimit(8)->getData();
    $productsHot = $modelProduct->start()->getProductHot()->getData();
    $productsPromotion = $modelProduct->start()->getProductPromotion()->getData();
    $productsSell = $modelProduct->start()->getProductBestSell()->getData();
    $productsAmazing = $modelProduct->start()->getProductAmazing()->getData();
    $productsBuild = $modelProduct->start()->getProductBuild()->getData();
    $productsGroup = $modelProduct->start()->getProductGroup()->getData();

@endphp

@section('center')


    @php
        foreach ($ads as $key => $value) {
        if ($value->lang != app()->getLocale()){
         unset($ads[$key]);
           }
         }
    $newads = $ads->values();

    @endphp

    <!--Section Full Banner-->
    <section class="row mb-3 mb-md-3">
        <div class="col-12">
            <div class="row">
            @if($newads[0]->body == null && $newads[0]->image != null )
                <!--Banner Right-->
                    <a href="#" class="d-block w-100">
                        <img src="{{asset($newads[0]->image)}}" class="img-fluid cart-shadow-radius" alt=""
                             width="100%">
                    </a>
                    <!--End Banner Right-->
                @else
                    {!! $newads[0]->body !!}
                @endif
            </div>
        </div>
    </section>
    <!--End Section Sidebar and Slider and Amazing-->
    <section class="row fix-col-lg flex-column-reverse flex-lg-row">

        <!--Section Sidebar Banner and Promo Features-->
        <div class="col-md-12 col-lg-2 pl-0 pr-0">
        @if($newads[1]->body == null && $newads[1]->image != null )
            <!--Banner Right-->
                <a href="#" class="d-none d-lg-block mb-3">
                    <img src="{{asset($newads[1]->image)}}" class="img-fluid cart-shadow-radius" alt="">
                </a>
                <!--End Banner Right-->
        @else
            {!! $newads[1]->body !!}
        @endif
        <!--Banner Right-->

            <!--End Banner Right-->

            <!--Promo Features-->
        @include($templatePath.'.includes.promo')
        <!--End Promo Features-->

        </div>
        <!--End Section Sidebar Banner and Promo Features-->

        <!--Section Slider and Amazing-->
        <div class="col-md-12 col-lg-10 px-0 pr-md-0 pr-lg-3">

            <!--Module top -->
        @isset ($blocksContent['banner_top'])
            @foreach ( $blocksContent['banner_top'] as $layout)
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
            <!--End Slider Home-->

            <!--Amazing-->
            <div class="col-12">

                <!--Amazing Mobile-->
                <div class="row amazing-xs">
                    <div class="col-12 px-0 px-md-2">
                        <svg class="mr-2 mb-2 mt-2" viewBox="0 0 302 32" width="160px" height="22">
                            <path fill="#fe5353" class="inc_path1"
                                  d="M81.342 19.198c-0.023 0.569-0.080 1.129-0.171 1.68s-0.226 1.077-0.403 1.577c-0.177 0.5-0.42 0.945-0.729 1.336-0.4-0.241-0.766-0.454-1.098-0.638s-0.686-0.385-1.064-0.603c0.069-0.368 0.123-0.77 0.163-1.206s0.060-0.913 0.060-1.431c0-0.103 0-0.23 0-0.379s-0.011-0.287-0.034-0.414v-15.891h3.311v14.306c0 0.54-0.011 1.095-0.034 1.663zM71.236 18.172c-0.559-0.581-1.073-1.11-1.543-1.587s-0.97-0.991-1.499-1.542l3.042-3.085c0.558 0.567 1.084 1.099 1.576 1.598s0.988 0.995 1.488 1.487c-0.544 0.566-1.058 1.099-1.543 1.598s-0.992 1.010-1.521 1.531zM74.214 20.372l-0.001 3.295-43.213 0.049c-0.683-0.067-1.346-0.257-1.988-0.569-0.674-0.328-1.302-0.768-1.885-1.321-0.583 0.541-1.208 0.978-1.877 1.312-0.57 0.285-1.586 0.469-3.042 0.552v0.052l-11.764-0.008c-0.137 0.736-0.307 1.414-0.507 2.035s-0.444 1.15-0.73 1.587c-0.607 0.897-1.452 1.624-2.534 2.182s-2.419 0.837-4.011 0.837c-0.412 0-0.839-0.020-1.28-0.060s-0.902-0.106-1.383-0.198v-3.191c0.401 0.138 0.819 0.238 1.254 0.302s0.865 0.095 1.288 0.095c0.55 0 1.085-0.063 1.606-0.19s0.996-0.325 1.426-0.595c0.429-0.27 0.793-0.621 1.091-1.052s0.504-0.957 0.618-1.578c0.057-0.817 0.106-1.667 0.146-2.553s0.060-1.811 0.060-2.777c0-0.218 0-0.46 0-0.724 0-0.276-0.006-0.523-0.017-0.742v-5.951h3.315v6.658c0 0.161 0 0.351 0 0.569s-0.003 0.446-0.009 0.681c-0.006 0.236-0.012 0.472-0.017 0.707s-0.014 0.451-0.026 0.647l10.683-0.029c2.902-0.092 2.925-0.4 3.359-0.872 0.217-0.236 0.388-0.518 0.514-0.846s0.189-0.693 0.189-1.096v-6.422h3.273v6.422c0 0.403 0.066 0.768 0.197 1.096s0.303 0.61 0.514 0.846c0.211 0.236 0.46 0.429 0.745 0.578s0.583 0.248 0.891 0.293v0.035l24.681 0.009c0.48 0 0.9-0.072 1.26-0.215s0.654-0.336 0.883-0.577c0.229-0.241 0.4-0.513 0.514-0.818s0.172-0.611 0.172-0.921c0-0.333-0.060-0.657-0.18-0.973s-0.297-0.6-0.531-0.852c-0.234-0.252-0.529-0.453-0.883-0.603s-0.766-0.224-1.235-0.224h-9.448c-0.469 0.023-0.912-0.020-1.329-0.129s-0.783-0.281-1.097-0.517c-0.315-0.235-0.563-0.522-0.746-0.861s-0.274-0.732-0.274-1.179v-0.207c0-0.080 0.006-0.161 0.017-0.241 0.046-0.356 0.129-0.68 0.249-0.973s0.26-0.571 0.42-0.835c0.16-0.264 0.343-0.519 0.549-0.766s0.423-0.502 0.652-0.766c0.034-0.046 0.066-0.089 0.094-0.129s0.054-0.077 0.077-0.112c0.823-0.941 1.646-1.882 2.469-2.824s1.646-1.888 2.469-2.841c0.457 0.402 0.874 0.766 1.252 1.093s0.783 0.675 1.217 1.042l-5.984 6.921h9.482c0.869 0 1.675 0.158 2.418 0.474s1.383 0.738 1.92 1.265c0.537 0.528 0.96 1.145 1.269 1.851s0.463 1.444 0.463 2.213c0 0.666-0.217 1.567-0.652 2.703l12.943-0.065zM41.227 9.539c0.057-0.39 0.151-0.746 0.283-1.067s0.292-0.622 0.48-0.904c0.189-0.281 0.397-0.557 0.626-0.826s0.463-0.548 0.703-0.835l4.184-4.838 1.44 1.291-7.579 8.764c-0.16-0.493-0.206-1.021-0.137-1.584zM9.337 8.975c-0.559-0.582-1.074-1.112-1.545-1.591s-0.971-0.993-1.501-1.546l3.046-3.092c0.559 0.568 1.085 1.102 1.578 1.602s0.989 0.997 1.49 1.49c-0.545 0.568-1.059 1.102-1.545 1.602s-0.993 1.012-1.523 1.535zM20.594 28.797l2.839-2.807 2.839 2.807-2.839 2.807-2.839-2.807-2.839 2.807-2.839-2.807 2.839-2.807 2.839 2.807z"></path>
                            <path fill="#fe5353" class="inc_path2"
                                  d="M186.693 19.892c-0.326 0.716-0.764 1.346-1.314 1.89s-1.185 0.982-1.906 1.314c-0.721 0.333-1.482 0.521-2.284 0.567-0.79-0.023-1.568-0.203-2.335-0.541s-1.465-0.793-2.095-1.366c-0.664 0.642-1.371 1.106-2.12 1.392s-1.508 0.458-2.275 0.515c-0.756-0.011-1.517-0.18-2.284-0.507s-1.471-0.793-2.112-1.4c-0.584 0.538-1.213 0.974-1.889 1.306-0.644 0.317-1.313 0.508-2.009 0.575v0.026l-41.036-0.027c-0.684-0.067-1.345-0.255-1.983-0.566-0.67-0.327-1.302-0.765-1.897-1.315-0.584 0.538-1.21 0.974-1.88 1.306-0.57 0.283-1.162 0.465-1.777 0.549v0.052l-28.016-0.038v-3.297l27.689 0.036v-0.034c0.309-0.046 0.604-0.143 0.884-0.292s0.529-0.341 0.747-0.576c0.217-0.235 0.389-0.515 0.515-0.842s0.189-0.69 0.189-1.091v-6.392h3.297v6.392c0 0.401 0.063 0.765 0.189 1.091s0.298 0.607 0.515 0.842c0.217 0.235 0.466 0.427 0.747 0.576s0.575 0.247 0.884 0.292v0.034h3.022c-0.195-0.527-0.343-1.022-0.446-1.486s-0.154-0.891-0.154-1.28v-3.248c0-0.836 0.16-1.621 0.481-2.354s0.755-1.375 1.305-1.924c0.549-0.55 1.193-0.985 1.932-1.306s1.525-0.481 2.361-0.481c0.835 0 1.623 0.16 2.361 0.481s1.382 0.756 1.932 1.306c0.549 0.55 0.984 1.192 1.305 1.924s0.481 1.518 0.481 2.354v3.248c0 0.39-0.054 0.816-0.163 1.28s-0.26 0.96-0.455 1.486h18.423c0.481 0 0.901-0.071 1.262-0.215s0.655-0.335 0.884-0.576c0.229-0.241 0.4-0.513 0.515-0.816s0.172-0.61 0.172-0.919c0-0.332-0.060-0.656-0.18-0.971s-0.298-0.599-0.532-0.851c-0.235-0.252-0.53-0.452-0.884-0.601s-0.767-0.223-1.236-0.223h-9.461c-0.469 0.023-0.913-0.020-1.331-0.129s-0.784-0.281-1.099-0.516c-0.315-0.235-0.564-0.521-0.747-0.859s-0.275-0.73-0.275-1.177v-0.206c0-0.080 0.006-0.16 0.017-0.241 0.046-0.355 0.129-0.679 0.249-0.971s0.26-0.57 0.421-0.833c0.16-0.263 0.344-0.518 0.549-0.765s0.423-0.501 0.653-0.765c0.034-0.046 0.066-0.089 0.094-0.129s0.054-0.077 0.077-0.112c0.824-0.939 1.648-1.879 2.472-2.818s1.648-1.884 2.473-2.835c0.458 0.401 0.876 0.765 1.253 1.091s0.784 0.673 1.219 1.040l-5.992 6.908h9.495c0.87 0 1.677 0.158 2.421 0.473s1.385 0.736 1.923 1.263c0.538 0.527 0.962 1.143 1.271 1.847s0.464 1.441 0.464 2.208c0 0.665-0.218 1.564-0.653 2.698h2.953v-0.034c0.309-0.046 0.607-0.143 0.893-0.292s0.538-0.341 0.756-0.576c0.217-0.235 0.389-0.515 0.515-0.842s0.189-0.69 0.189-1.091v-6.392h3.279v6.392c0 0.447 0.080 0.848 0.24 1.203s0.369 0.653 0.627 0.893c0.258 0.241 0.552 0.424 0.884 0.55s0.67 0.189 1.013 0.189c0.343 0 0.681-0.063 1.013-0.189s0.627-0.309 0.884-0.55c0.258-0.24 0.466-0.538 0.627-0.893s0.24-0.756 0.24-1.203v-6.392h3.297v6.392c0 0.447 0.077 0.845 0.232 1.194s0.361 0.644 0.618 0.885c0.258 0.24 0.549 0.424 0.876 0.55s0.661 0.195 1.004 0.206c0.343-0.011 0.678-0.080 1.004-0.206s0.618-0.309 0.876-0.55c0.258-0.241 0.466-0.535 0.627-0.885s0.24-0.747 0.24-1.194v-6.392h3.279v6.461c0 0.813-0.163 1.578-0.489 2.294zM134.402 14.436c0-0.504-0.080-0.939-0.24-1.306s-0.369-0.667-0.627-0.902c-0.258-0.235-0.555-0.409-0.893-0.524s-0.678-0.166-1.022-0.155c-0.343 0.023-0.681 0.1-1.013 0.232s-0.627 0.318-0.884 0.558c-0.258 0.241-0.464 0.536-0.618 0.885s-0.232 0.753-0.232 1.211v3.11c0 0.447 0.077 0.845 0.232 1.194s0.361 0.644 0.618 0.885c0.257 0.241 0.552 0.427 0.884 0.558s0.67 0.204 1.013 0.215h-0.017c0.355 0.023 0.698-0.020 1.030-0.129s0.629-0.281 0.893-0.516c0.263-0.235 0.475-0.535 0.635-0.902s0.24-0.802 0.24-1.306v-3.11zM179.872 5.92l-3.131 3.113-3.131-3.113-3.131 3.113-3.131-3.113 3.131-3.113 3.131 3.113 3.131-3.113 3.131 3.113 3.131-3.113 3.131 3.113-3.131 3.113-3.131-3.113zM140.944 9.488c0.057-0.389 0.152-0.745 0.283-1.065s0.292-0.621 0.481-0.902c0.189-0.28 0.398-0.555 0.627-0.825s0.464-0.547 0.704-0.833l4.19-4.828 1.442 1.289-7.589 8.746c-0.16-0.492-0.206-1.019-0.137-1.581zM128.849 3.113l3.131-3.113 3.131 3.113-3.131 3.113-3.131-3.113zM93.744 15.13l-3.131 3.113-3.131-3.113 3.131-3.113 3.131 3.113 3.131-3.113 3.131 3.113-3.131 3.113-3.131-3.113z"></path>
                            <path fill="#5F5F5F" class="inc_path3"
                                  d="M301.706 19.859c-0.291 0.708-0.691 1.336-1.199 1.882s-1.105 0.99-1.79 1.329c-0.589 0.292-1.211 0.479-1.867 0.563v0.050h-12.7v-0.027c-0.684-0.067-1.346-0.256-1.988-0.569-0.675-0.328-1.303-0.768-1.886-1.321-0.583 0.541-1.208 0.979-1.877 1.312-0.571 0.285-1.586 0.469-3.043 0.553v0.052h-1.916l-3.778 0.033v-0.027c-0.684-0.067-1.344-0.257-1.981-0.57-0.669-0.328-1.295-0.769-1.878-1.323-0.641 0.588-1.329 1.049-2.067 1.383s-1.501 0.513-2.29 0.536c-0.789 0-1.561-0.173-2.316-0.519s-1.458-0.818-2.11-1.418c-0.686 0.646-1.398 1.115-2.136 1.409s-1.495 0.47-2.273 0.527c-0.755-0.011-1.512-0.182-2.273-0.51s-1.467-0.798-2.118-1.409c-0.583 0.542-1.209 0.98-1.878 1.314-0.637 0.319-1.304 0.511-1.998 0.579v0.009c-0.017-0.001-0.034-0.003-0.051-0.005-0.017 0.002-0.034 0.003-0.052 0.005v-0.009c-0.684-0.067-1.347-0.257-1.99-0.57-0.675-0.328-1.304-0.769-1.887-1.323-0.583 0.542-1.209 0.98-1.878 1.314-0.643 0.322-1.321 0.515-2.033 0.58v0.025h-25.507v-0.026c-0.75-0.067-1.451-0.262-2.101-0.588-0.68-0.34-1.275-0.784-1.784-1.331s-0.909-1.176-1.201-1.884-0.437-1.467-0.437-2.274v-14.471h3.276v14.402c0 0.404 0.066 0.77 0.197 1.098s0.303 0.611 0.515 0.847c0.211 0.236 0.46 0.43 0.746 0.579s0.583 0.248 0.892 0.294v0.035h2.436l-0.017-6.051c0-0.841 0.16-1.631 0.48-2.369s0.755-1.383 1.304-1.936 1.192-0.991 1.93-1.314c0.738-0.322 1.524-0.484 2.359-0.484 0.549 0 1.083 0.078 1.604 0.233s1.009 0.375 1.467 0.657c0.457 0.282 0.878 0.622 1.261 1.020s0.718 0.838 1.004 1.323h2.933c0.835 0 1.618 0.162 2.35 0.484s1.372 0.761 1.921 1.314c0.549 0.553 0.983 1.202 1.304 1.945s0.48 1.536 0.48 2.377l0.017 2.801h2.487v-0.035c0.309-0.046 0.606-0.144 0.892-0.294s0.537-0.343 0.755-0.579c0.217-0.236 0.389-0.519 0.515-0.847s0.189-0.694 0.189-1.098v-6.432h3.276v6.432c0 0.404 0.066 0.77 0.197 1.098s0.303 0.611 0.515 0.847c0.211 0.236 0.46 0.43 0.746 0.579 0.27 0.142 0.55 0.236 0.84 0.285 0.29-0.049 0.571-0.143 0.841-0.285 0.286-0.15 0.534-0.343 0.746-0.579s0.383-0.519 0.515-0.847c0.131-0.328 0.197-0.694 0.197-1.098v-6.432h3.276v6.432c0 0.45 0.080 0.853 0.24 1.21s0.369 0.657 0.626 0.899c0.257 0.242 0.551 0.427 0.883 0.553s0.669 0.19 1.012 0.19c0.343 0 0.678-0.063 1.004-0.19s0.618-0.311 0.875-0.553 0.466-0.542 0.626-0.899c0.16-0.357 0.24-0.761 0.24-1.21v-6.432h3.311v6.432c0 0.45 0.077 0.85 0.232 1.202s0.36 0.648 0.617 0.89c0.257 0.242 0.549 0.427 0.875 0.553s0.66 0.196 1.004 0.207c0.343-0.011 0.678-0.080 1.003-0.207s0.618-0.311 0.875-0.553c0.257-0.242 0.466-0.539 0.626-0.89s0.24-0.752 0.24-1.202v-6.432h3.276v6.432c0 0.404 0.066 0.77 0.197 1.098s0.303 0.611 0.515 0.847c0.211 0.236 0.457 0.43 0.738 0.579s0.575 0.248 0.883 0.294v0.034l3.349-0.028h1.454v-0.035c1.451-0.046 2.32-0.144 2.606-0.294s0.537-0.342 0.754-0.578c0.217-0.236 0.388-0.518 0.514-0.846s0.189-0.693 0.189-1.097v-6.423h3.274v6.423c0 0.403 0.066 0.768 0.197 1.097s0.303 0.61 0.514 0.846c0.211 0.236 0.46 0.429 0.746 0.579s0.583 0.248 0.891 0.294v0.035h12.271v-0.035c0.308-0.046 0.605-0.144 0.891-0.294s0.534-0.342 0.745-0.578c0.211-0.236 0.382-0.518 0.514-0.846s0.197-0.693 0.197-1.097v-6.423h3.272v6.492c0 0.806-0.146 1.563-0.437 2.27zM222.302 14.432c0-0.507-0.080-0.945-0.24-1.314s-0.369-0.671-0.626-0.908c-0.257-0.236-0.555-0.412-0.892-0.527s-0.678-0.167-1.021-0.156c-0.343 0.023-0.68 0.101-1.012 0.233s-0.626 0.32-0.883 0.562c-0.257 0.242-0.466 0.539-0.626 0.89s-0.24 0.758-0.24 1.219v5.999h2.779c0.343 0 0.68-0.052 1.012-0.156s0.626-0.274 0.883-0.51c0.257-0.236 0.466-0.536 0.626-0.899s0.24-0.798 0.24-1.305v-3.129zM230.587 17.596c0-0.346-0.063-0.689-0.189-1.029s-0.312-0.64-0.557-0.899c-0.246-0.259-0.546-0.469-0.901-0.631s-0.761-0.242-1.218-0.242h-2.11v2.818c0 0.392-0.054 0.821-0.163 1.288s-0.26 0.966-0.455 1.495h5.592v-2.801zM260.175 5.844l-3.129 3.12-3.129-3.12-3.129 3.12-3.129-3.121 3.129-3.12 3.129 3.12 3.129-3.12 3.129 3.12 3.129-3.12 3.129 3.12-3.129 3.121-3.129-3.12zM232.496 5.843l3.129-3.12 3.129 3.12-3.129 3.121-3.129-3.121zM201.9 21.893c-0.555 0.559-1.198 1.003-1.93 1.331s-1.51 0.493-2.333 0.493h-4.288v-3.32h4.22c0.48 0 0.901-0.083 1.261-0.251s0.658-0.383 0.892-0.648c0.234-0.265 0.412-0.568 0.532-0.908s0.186-0.677 0.197-1.011c-0.057-0.403-0.217-0.836-0.48-1.297s-0.592-0.925-0.986-1.392c-0.395-0.467-0.835-0.931-1.321-1.392s-0.975-0.899-1.467-1.314l2.316-2.576c0.595 0.507 1.192 1.072 1.793 1.694s1.146 1.28 1.638 1.971c0.492 0.692 0.898 1.406 1.218 2.144s0.503 1.47 0.549 2.196c0 0.819-0.163 1.597-0.489 2.334s-0.766 1.386-1.321 1.945zM273.097 28.879l3.129-3.12 3.129 3.121-3.129 3.121-3.129-3.12-3.129 3.12-3.129-3.121 3.129-3.121 3.129 3.12zM288.581 28.879l3.129-3.12 3.129 3.12 3.129-3.12 3.129 3.121-3.129 3.121-3.129-3.12-3.129 3.12-3.129-3.12-3.129 3.12-3.129-3.121 3.129-3.121 3.129 3.12z"></path>
                        </svg>
                        <div class="slider-product">
                            <div class="slick-slider-amazing-xs">
                                <div class="item cart-shadow-radius">
                                    <a href="#">
                                        <span class="discount">٪۵۷ تخفیف</span>
                                        <img class="img-fluid" alt="" src="asset/files/product/350-350/003.jpg">
                                        <h2>هدست بلوتوثی سوپر بی ساند مدل Q3</h2>
                                        <p class="price">۷۵,۹۰۰<span>تومان</span></p>
                                        <span class="old-price">
                                                    <del>۹۹,۰۰۰</del>
                                                </span>
                                        <div class="timer mt-2" dir="ltr">
                                                    <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item cart-shadow-radius">
                                    <a href="#">
                                        <span class="discount">٪۵۷ تخفیف</span>
                                        <img class="img-fluid" alt="" src="asset/files/product/350-350/003.jpg">
                                        <h2>هدست بلوتوثی سوپر بی ساند مدل Q3</h2>
                                        <p class="price">۷۵,۹۰۰<span>تومان</span></p>
                                        <span class="old-price">
                                                    <del>۹۹,۰۰۰</del>
                                                </span>
                                        <div class="timer mt-2" dir="ltr">
                                                    <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item cart-shadow-radius">
                                    <a href="#">
                                        <span class="discount">٪۵۷ تخفیف</span>
                                        <img class="img-fluid" alt="" src="asset/files/product/350-350/003.jpg">
                                        <h2>هدست بلوتوثی سوپر بی ساند مدل Q3</h2>
                                        <p class="price">۷۵,۹۰۰<span>تومان</span></p>
                                        <span class="old-price">
                                                    <del>۹۹,۰۰۰</del>
                                                </span>
                                        <div class="timer mt-2" dir="ltr">
                                                    <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item cart-shadow-radius">
                                    <a href="#">
                                        <span class="discount">٪۵۷ تخفیف</span>
                                        <img class="img-fluid" alt="" src="asset/files/product/350-350/003.jpg">
                                        <h2>هدست بلوتوثی سوپر بی ساند مدل Q3</h2>
                                        <p class="price">۷۵,۹۰۰<span>تومان</span></p>
                                        <span class="old-price">
                                                    <del>۹۹,۰۰۰</del>
                                                </span>
                                        <div class="timer mt-2" dir="ltr">
                                                    <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="item cart-shadow-radius">
                                    <a href="#">
                                        <span class="discount">٪۵۷ تخفیف</span>
                                        <img class="img-fluid" alt="" src="asset/files/product/350-350/003.jpg">
                                        <h2>هدست بلوتوثی سوپر بی ساند مدل Q3</h2>
                                        <p class="price">۷۵,۹۰۰<span>تومان</span></p>
                                        <span class="old-price">
                                                    <del>۹۹,۰۰۰</del>
                                                </span>
                                        <div class="timer mt-2" dir="ltr">
                                                    <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-info btn-block mx-auto mt-3 text-center">مشاهده بیشتر</a>
                    </div>
                </div>
                <!--End Amazing Mobile-->

                <!--Amazing Desktop-->
                <div class="row amazing cart-shadow-radius">
                    <div class="col-9 right bg-white" id="amazing-content">
                        @foreach($productsAmazing as $key=>$productAmazing)
                            <div class="item {{$key == 0 ? 'active' : ''}}">
                                <a href="{{$productAmazing->getUrl()}}" aria-label="{{$productAmazing->name}}" title="{{$productAmazing->name}}"></a>
                                <div class="row align-items-center h-100">
                                    <div class="col-md-5 col-lg-5">
                                        <img src="{{$productAmazing->getImage()}}" class="img-fluid"
                                             alt="{{$productAmazing->name}}">
                                    </div>
                                    <div class="col-md-7 offset-lg-1 col-lg-6 h-100 d-flex flex-column justify-content-around">
                                        <div class="price mt-2">
                                            {{--<p class="old-price">۲,۳۵۰,۰۰۰<span>تومان</span></p>--}}
                                            {{--<p class="value">۲۲,۵۰۰</p>--}}
                                            {{--<p class="currency">تومان</p>--}}
                                            {{--<p class="discount">٪۵۷<span>تخفیف</span></p>--}}
                                            {!! $productAmazing->showPrice() !!}
                                        </div>
                                        <div class="product mb-2">
                                            <h2>{{$productAmazing->name}}</h2>
                                            <ul>
                                                <li>محدوده ظرفیت: بیشتر از 2 هزار میلی‌آمپر‌ساعت</li>
                                                <li>قابلیت های ویژه: سرهت بالای سیستم</li>
                                            </ul>
                                        </div>
                                        <div class="timer mt-2" dir="ltr">
                                                <span class="counter counter-analog">
                                                        <span class="part part0">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit3">۳</span>
                                                        </span>
                                                        <span class="separator separator1">:</span>
                                                        <span class="part part2">
                                                            <span class="digit digit0">۰</span>
                                                            <span class="digit digit5">۵</span>
                                                        </span>
                                                        <span class="separator separator3">:</span>
                                                        <span class="part part4">
                                                            <span class="digit digit0 digit00">۲</span>
                                                            <span class="digit digit4 digit54">۴</span>
                                                        </span><span class="separator separator5">:</span>
                                                        <span class="part part6">
                                                            <span class="digit digit0 digit00">۱</span>
                                                            <span class="digit digit8 digit98">۸</span>
                                                        </span>
                                                    </span>
                                            <p>زمان باقیمانده تا پایان سفارش</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-3 left px-0 shave-amazing-name" id="amazing-tab">
                        @foreach($productsAmazing as $key=>$productAmazing)
                            <h3 aria-label="{{$key + 1}}" class="{{$key == 0 ? 'active' : ''}}"><strong>{{$productAmazing->name}}</strong></h3>
                        @endforeach

                        <a href="#">مشاهده همه شگفت‌انگیزها</a>
                    </div>
                </div>
                <!--End Amazing Desktop-->

            </div>
            <!--End Amazing-->

        </div>
        <!--End Section Slider and Amazing-->

    </section>

    <!--Section Adplacement-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 p-0">
            <div class="adplacement item-4">
            @if($newads[2]->body == null && $newads[2]->image != null )
                <!--Banner Right-->
                    <a href="#" class="d-none d-lg-block mb-3">
                        <img src="{{asset($newads[2]->image)}}" class="img-fluid cart-shadow-radius" alt="">
                    </a>
                    <!--End Banner Right-->
                @else
                    {!! $newads[2]->body !!}
                @endif
                {{--<a href="#"><img src="asset/files/banner/002.jpeg" class="img-fluid cart-shadow-radius" alt=""></a>--}}
                {{--<a href="#"><img src="asset/files/banner/003.jpeg" class="img-fluid cart-shadow-radius" alt=""></a>--}}
                {{--<a href="#"><img src="asset/files/banner/004.jpeg" class="img-fluid cart-shadow-radius" alt=""></a>--}}
                {{--<a href="#"><img src="asset/files/banner/005.jpeg" class="img-fluid cart-shadow-radius" alt=""></a>--}}
            </div>
        </div>
    </section>
    <!--Section Adplacement-->
    @if(isset($categories[0]))
        <!--Section Product and Offer Moment-->
        <section class="row mt-2 mt-md-4 fix-col-lg-10-2">

            <!--Product-->
            <div class="col-lg-10 bg-slider-product bg-white cart-shadow-radius">
                <div class="col-12 px-3 pt-4 pb-2">
                    <div class="header">
                        <h2>{{$categories[0]->description[0]->title}}</h2>
                    </div>
                </div>
                <div class="col-12 px-0 px-md-2">
                    <div class="content">
                        <div class="slider-product">
                            <div class="slick-slider-product">

                                @foreach($categories[0]->products as $product)
                                    <div class="item">
                                        <a href="{{ $product->getUrl() }}" title="{{$product->name}}">
                                            <img src="{{$product->getThumb()}}" class="img-fluid"
                                                 alt="{{$product->name}}">
                                            <h2 class="shave-product-name">
                                                {{$product->description[0]->name}}
                                            </h2>
                                            {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                            {!! $product->showPrice() !!}
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                        class="mdi mdi-chevron-left"></i></div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                        class="mdi mdi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Product-->

            <!--Offer Moment-->
        @include($templatePath.'.block.product_lastview')

        <!--End Offer Moment-->

        </section>
        <!--Section Product and Offer Moment-->
    @endif
    <!--Section Product Category-->
    @if(isset($categories[1]))
        <section class="row mt-2 mt-md-4">
            <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
                <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                    <div class="header">
                        <h2>{{$categories[1]->description[0]->title}}</h2>
                    </div>
                </div>
                <div class="col-12 px-0 px-md-2">
                    <div class="content">
                        <div class="slider-product">
                            <div class="slick-slider-product">
                                @foreach($categories[1]->products as $product)
                                    <div class="item">
                                        <a href="{{ $product->getUrl() }}" title="{{$product->name}}">
                                            <img src="{{$product->getThumb()}}" class="img-fluid"
                                                 alt="{{$product->name}}">
                                            <h2 class="shave-product-name">
                                                {{$product->description[0]->name}}
                                            </h2>
                                            {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                            {!! $product->showPrice() !!}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                        class="mdi mdi-chevron-left"></i></div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                        class="mdi mdi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Section Product Category-->
    @endif
    <!--Section Adplacement-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 p-0">
            <div class="adplacement item-4">
            @if($newads[3]->body == null && $newads[3]->image != null )
                <!--Banner Right-->
                    <a href="#" class="d-none d-lg-block mb-3">
                        <img src="{{asset($newads[3]->image)}}" class="img-fluid cart-shadow-radius" alt="">
                    </a>
                    <!--End Banner Right-->
                @else
                    {!! $newads[3]->body !!}
                @endif

            </div>
        </div>
    </section>
    <!--Section Adplacement-->

    <!--Section Product Category-->
    @if(isset($categories[2]))
        <section class="row mt-2 mt-md-4">
            <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
                <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                    <div class="header">
                        <h2>{{$categories[2]->description[0]->title}}</h2>
                    </div>
                </div>
                <div class="col-12 px-0 px-md-2">
                    <div class="content">
                        <div class="slider-product">
                            <div class="slick-slider-product">
                                @foreach($categories[2]->products as $product)
                                    <div class="item">
                                        <a href="{{ $product->getUrl() }}" title="{{$product->name}}">
                                            <img src="{{$product->getThumb()}}" class="img-fluid"
                                                 alt="{{$product->name}}">
                                            <h2 class="shave-product-name">
                                                {{$product->description[0]->name}}
                                            </h2>
                                            {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                            {!! $product->showPrice() !!}
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                        class="mdi mdi-chevron-left"></i></div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                        class="mdi mdi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Section Product Category-->
    @endif
    <!--Section Product Category-->
    @if(isset($categories[3]))
        <section class="row mt-2 mt-md-4">
            <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
                <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                    <div class="header">
                        <h2>{{$categories[3]->description[0]->title}}</h2>
                    </div>
                </div>
                <div class="col-12 px-0 px-md-2">
                    <div class="content">
                        <div class="slider-product">
                            <div class="slick-slider-product">

                                @foreach($categories[3]->products as $product)
                                    <div class="item">
                                        <a href="{{ $product->getUrl() }}" title="{{$product->name}}">
                                            <img src="{{$product->getThumb()}}" class="img-fluid"
                                                 alt="{{$product->name}}">
                                            <h2 class="shave-product-name">
                                                {{$product->description[0]->name}}
                                            </h2>
                                            {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                            {!! $product->showPrice() !!}
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                        class="mdi mdi-chevron-left"></i></div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                        class="mdi mdi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Section Product Category-->
    @endif
    <!--Section Adplacement-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 p-0">
            <div class="adplacement item-2">
            @if($newads[4]->body == null && $newads[4]->image != null )
                <!--Banner Right-->
                    <a href="#" class="d-block w-100">
                        <img src="{{asset($newads[4]->image)}}" class="img-fluid cart-shadow-radius" alt=""
                             width="100%">
                    </a>
                    <!--End Banner Right-->
                @else
                    {!! $newads[4]->body !!}
                @endif

            </div>
        </div>
    </section>
    <!--Section Adplacement-->

    <!--Section Product Category-->
    @if(isset($categories[4]))
        <section class="row mt-2 mt-md-4">
            <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
                <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                    <div class="header">
                        <h2>{{$categories[4]->description[0]->title}}</h2>
                    </div>
                </div>
                <div class="col-12 px-0 px-md-2">
                    <div class="content">
                        <div class="slider-product">
                            <div class="slick-slider-product">
                                @foreach($categories[4]->products as $product)
                                    <div class="item">
                                        <a href="{{ $product->getUrl() }}" title="{{$product->name}}">
                                            <img src="{{$product->getThumb()}}" class="img-fluid"
                                                 alt="{{$product->name}}">
                                            <h2 class="shave-product-name">
                                                {{$product->description[0]->name}}
                                            </h2>
                                            {{--<p>۷۵,۹۰۰<span>تومان</span></p>--}}
                                            {!! $product->showPrice() !!}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                        class="mdi mdi-chevron-left"></i></div>
                            <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                        class="mdi mdi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--End Section Product Category-->

    <!--Section Product Category-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
            <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                <div class="header">
                    <h2>
                        {{ trans('front.products_hot') }}
                    </h2>
                </div>
            </div>
            <div class="col-12 px-0 px-md-2">
                <div class="content">
                    <div class="slider-product">
                        <div class="slick-slider-product">
                            @foreach ($productsHot as $key => $product_hot)
                                <div class="item">
                                    <a href="{{$product_hot->getUrl()}}" title="{{$product_hot->name}}">
                                        <img src="{{asset($product_hot->getThumb())}}" class="img-fluid"
                                             alt="   {{$product_hot->name}}">
                                        <h2 class="shave-product-name">
                                            {{$product_hot->name}}
                                        </h2>
                                        {!! $product_hot->showPrice() !!}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                    class="mdi mdi-chevron-left"></i></div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                    class="mdi mdi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section Product Category-->

    <!--Section Adplacement-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 p-0">
            <div class="adplacement item-1">
            @if($newads[5]->body == null && $newads[5]->image != null )
                <!--Banner Right-->
                    <a href="#" class="d-block w-100">
                        <img src="{{asset($newads[5]->image)}}" class="img-fluid cart-shadow-radius" alt=""
                             width="100%">
                    </a>
                    <!--End Banner Right-->
                @else
                    {!! $newads[5]->body !!}
                @endif
            </div>
        </div>
    </section>
    <!--Section Adplacement-->

    <!--Section Product Category-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
            <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                <div class="header">
                    <h2>   {{ trans('front.features_items') }}</h2>
                </div>
            </div>
            <div class="col-12 px-0 px-md-2">
                <div class="content">
                    <div class="slider-product">
                        <div class="slick-slider-product">
                            @foreach ($productsNew as $key => $product_new)
                                <div class="item">
                                    <a href="{{$product_new->getUrl()}}" title="{{$product_new->name}}">
                                        <img src="{{asset($product_new->getThumb())}}" class="img-fluid"
                                             alt="       {{$product_new->name}}">
                                        <h2 class="shave-product-name">
                                            {{$product_new->name}}
                                        </h2>
                                        {!! $product_new->showPrice() !!}
                                    </a>
                                </div>
                            @endforeach

                        </div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                    class="mdi mdi-chevron-left"></i></div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                    class="mdi mdi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section Product Category-->

    <!--Section Product Category-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
            <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                <div class="header">
                    <h2>
                        {{trans('front.best_seller_items')}}
                    </h2>
                </div>
            </div>
            <div class="col-12 px-0 px-md-2">
                <div class="content">
                    <div class="slider-product">
                        <div class="slick-slider-product">
                            @foreach($productsSell  as $productSell)
                                <div class="item">
                                    <a href="{{$productSell->getUrl()}}" title="{{$productSell->name}}">
                                        <img src="{{asset($productSell->getThumb())}}" class="img-fluid"
                                             alt="       {{$productSell->name}}">
                                        <h2 class="shave-product-name">
                                            {{$productSell->name}}
                                        </h2>
                                        {!! $productSell->showPrice() !!}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                    class="mdi mdi-chevron-left"></i></div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                    class="mdi mdi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section Product Category-->

    <!--Section Product Category-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 bg-slider-brand bg-white cart-shadow-radius px-1 px-md-3">
            <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                <div class="header">
                    <h2>برندهای ویژه</h2>
                </div>
            </div>
            <div class="col-12 px-0 px-md-2">
                <div class="content">
                    <div class="slider-brand">
                        <div class="slick-slider-brand">
                            @foreach($brands as $brand)
                                <div class="item">
                                    <img src="{{$brand->image}}" class="img-fluid" alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                    class="mdi mdi-chevron-left"></i></div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                    class="mdi mdi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section Product Category-->

    <!--Section Best Product Offer-->
    <section class="row mt-2 mt-md-4">
        <div class="col-12 bg-slider-product bg-white cart-shadow-radius px-1 px-md-3">
            <div class="col-12 px-3 pt-3 pt-md-4 pb-2">
                <div class="header">
                    <h2>منتخب محصولات تخفیف و حراج</h2>
                    <a href="#">مشاهده همه</a>
                </div>
            </div>
            <div class="col-12 px-0 px-md-2">
                <div class="content">
                    <div class="slider-product">
                        <div class="slick-slider-product">
                            @foreach($productsPromotion as $productPromotion)
                                <div class="item">
                                    <a href="{{$productPromotion->getUrl()}}" title="{{$productPromotion->name}}">
                                        <img src="{{asset($productPromotion->getThumb())}}" class="img-fluid"
                                             alt="       {{$productPromotion->name}}">
                                        <h2 class="shave-product-name">
                                            {{$productPromotion->name}}
                                        </h2>
                                        {!! $productPromotion->showPrice() !!}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow next"><i
                                    class="mdi mdi-chevron-left"></i></div>
                        <div class="d-none d-md-block d-md-flex slick-slider-product-arrow prev"><i
                                    class="mdi mdi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section Best Product Offer-->
@endsection

@push('styles')
@endpush

@push('scripts')

@endpush


