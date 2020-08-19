@extends('admin.layout')

@section('main')
<style>
    #start-add {
        margin: 20px;
    }

    .select-product {
        margin: 10px 0;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $title_description??'' }}</h2>

                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ route('admin_product.index') }}" class="btn  btn-flat btn-default" title="List"><i
                                class="fa fa-list"></i><span class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admin_product.edit',['id'=>$product['id']]) }}" method="post" accept-charset="UTF-8"
                class="form-horizontal" id="form-main" enctype="multipart/form-data">

@if (sc_config('product_kind'))
            <div class="col-xs-12" id="start-add">
                <div class="col-md-4"></div>
                <div class="col-md-4 form-group">
                    <div class="input-group input-group-sm" style="width: 300px;text-align: center;">
                        <b>{{ trans('product.type') }}:</b> {{ $kinds[$product->kind]??'' }}
                    </div>
                </div>
            </div>    
@endif


                <div class="box-body">
                    <div class="fields-group">

                        {{-- Descriptions --}}
                        @php
                        $descriptions = $product->descriptions->keyBy('lang')->toArray();
                        @endphp

                        @foreach ($languages as $code => $language)
                        <legend>{{ $language->name }} {!! sc_image_render($language->icon,'20px','20px', $language->name) !!}</legend>

                        <div class="form-group   {{ $errors->has('descriptions.'.$code.'.name') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__name"
                                class="col-sm-2 col-form-label">{{ trans('product.name') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>

                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__name" name="descriptions[{{ $code }}][name]"
                                        value="{!!old('descriptions.'.$code.'.name',($descriptions[$code]['name']??'')) !!}"
                                        class="form-control {{ $code.'__name' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.name'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.name') }}
                                </span>
                                @else
                                    <span class="help-block">
                                        <i class="fa fa-info-circle"></i> {{ trans('admin.max_c',['max'=>200]) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.keyword') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__keyword"
                                class="col-sm-2 col-form-label">{{ trans('product.keyword') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="{{ $code }}__keyword"
                                        name="descriptions[{{ $code }}][keyword]"
                                        value="{!! old('descriptions.'.$code.'.keyword',($descriptions[$code]['keyword']??'')) !!}"
                                        class="form-control {{ $code.'__keyword' }}" placeholder="" />
                                </div>
                                @if ($errors->has('descriptions.'.$code.'.keyword'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.keyword') }}
                                </span>
                                @else
                                    <span class="help-block">
                                        <i class="fa fa-info-circle"></i> {{ trans('admin.max_c',['max'=>200]) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div
                            class="form-group   {{ $errors->has('descriptions.'.$code.'.description') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__description"
                                class="col-sm-2 col-form-label">{{ trans('product.description') }} <span class="seo" title="SEO"><i class="fa fa-coffee" aria-hidden="true"></i></span></label>
                            <div class="col-sm-8">
                                    <textarea  id="{{ $code }}__description"
                                        name="descriptions[{{ $code }}][description]"
                                        class="form-control {{ $code.'__description' }}" placeholder="" />{{ old('descriptions.'.$code.'.description',($descriptions[$code]['description']??'')) }}</textarea>
                                @if ($errors->has('descriptions.'.$code.'.description'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.description') }}
                                </span>
                                @else
                                    <span class="help-block">
                                        <i class="fa fa-info-circle"></i> {{ trans('admin.max_c',['max'=>300]) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($product->kind == SC_PRODUCT_SINGLE)
                        <div
                            class="form-group {{ $errors->has('descriptions.'.$code.'.content') ? ' has-error' : '' }}">
                            <label for="{{ $code }}__content"
                                class="col-sm-2 col-form-label">{{ trans('product.content') }}</label>
                            <div class="col-sm-8">
                                <textarea id="{{ $code }}__content" class="editor"
                                    name="descriptions[{{ $code }}][content]">
                                    {!! old('descriptions.'.$code.'.content',($descriptions[$code]['content']??'')) !!}</textarea>
                                @if ($errors->has('descriptions.'.$code.'.content'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>
                                    {{ $errors->first('descriptions.'.$code.'.content') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @endforeach
                        {{-- //Descriptions --}}

                        <hr>
                        {{-- Category --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)

                            <div class="form-group  kind kind0 kind1 {{ $errors->has('category') ? ' has-error' : '' }}">
                                <hr>
                                <label for="category" class="col-sm-2 asterisk control-label">
                                    {{ trans('product.admin.select_category') }}
                                </label>
                                <div class="col-sm-8">
                                    <div id="tree">
                                        {!! $categoriesCheck !!}
                                    </div>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                                <i class="fa fa-info-circle"></i> {{ $errors->first('category') }}
                                            </span>
                                    @endif
                                    @php

                                        $categoriesOld = old('category',$product->categories->pluck('id')->toArray());
                                        $cats = '';
                                        foreach ($categoriesOld as $categoryOld){
                                            $cats .= "$categoryOld".",";
                                        }
                                        $cats = rtrim($cats,',');

                                    @endphp
                                    <input type="hidden" id="cat_manager" name="cat_manager" value="{{$cats}}"/>

                                    <input type="hidden" id="cat_manager_org" name="cat_manager_org" value="{{$cats}}"/>
                                </div>
                            </div>
                        @endif
                        {{-- //Category --}}

                        {{-- Images --}}
                        <div class="form-group   {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-sm-2 col-form-label">{{ trans('product.image') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="image" name="image"
                                        value="{!! old('image',$product->image) !!}" class="form-control input-sm image"
                                        placeholder="" />
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="preview_image" data-type="product"
                                            class="btn btn-sm btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                        </a>
                                    </span>
                                </div>
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('image') }}
                                </span>
                                @endif
                                <div id="preview_image" class="img_holder">
                                    @if (old('image',$product->image))
                                        <img src="{{ asset(old('image',$product->image)) }}">
                                    @endif
                                </div>
                                @php
                                $listsubImages = old('sub_image',$product->images->pluck('image')->all());
                                @endphp
                                @if (!empty($listsubImages))
                                @foreach ($listsubImages as $key => $sub_image)
                                @if ($sub_image)
                                <div class="group-image">
                                    <div class="input-group"><input type="text" id="sub_image_{{ $key }}"
                                            name="sub_image[]" value="{!! $sub_image !!}"
                                            class="form-control input-sm sub_image" placeholder="" /><span
                                            class="input-group-btn"><span><a data-input="sub_image_{{ $key }}"
                                                    data-preview="preview_sub_image_{{ $key }}" data-type="product"
                                                    class="btn btn-sm btn-flat btn-primary lfm"><i
                                                        class="fa fa-picture-o"></i>
                                                    {{trans('product.admin.choose_image')}}</a></span><span
                                                title="Remove" class="btn btn-flat btn-sm btn-danger removeImage"><i
                                                    class="fa fa-times"></i></span></span></div>
                                    <div id="preview_sub_image_{{ $key }}" class="img_holder"><img
                                            src="{{ asset($sub_image) }}"></div>
                                </div>

                                @endif
                                @endforeach
                                @endif
                                <button type="button" id="add_sub_image" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_sub_image') }}
                                </button>

                            </div>
                        </div>
                        {{-- //Images --}}


                        {{-- Sku --}}
                        <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                            <label for="sku" class="col-sm-2 col-form-label">{{ trans('product.sku') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="sku" name="sku"
                                        value="{!! old('sku',$product->sku) !!}" class="form-control input-sm sku"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sku'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sku') }}
                                </span>
                                @else
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ trans('product.sku_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Sku --}}


                        {{-- Alias --}}
                        <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
                            <label for="alias" class="col-sm-2 col-form-label">{!! trans('product.alias') !!}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" id="alias" name="alias"
                                        value="{!! old('alias', $product->alias) !!}" class="form-control input-sm alias"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('alias'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('alias') }}
                                </span>
                                @else
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ trans('product.alias_validate') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Alias --}}

@if (sc_config('product_brand'))
                        {{-- Brand --}}
                        <div class="form-group  {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                            <label for="brand_id" class="col-sm-2 col-form-label">{{ trans('product.brand') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm brand_id select2" style="width: 100%;"
                                    name="brand_id">
                                    <option value=""></option>
                                    @foreach ($brands as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('brand_id') ==$k || (!old() && $product->brand_id ==$k) ) ? 'selected':'' }}>
                                        {{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('brand_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Brand --}}
@endif

@if (sc_config('product_supplier'))
                        {{-- Supplier --}}
                        <div class="form-group  {{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                            @php
                            $listSupplier = [];
                            $supplier_id = old('supplier_id', explode(',', $product->supplier_id));
                            if(is_array($supplier_id)){
                                foreach($supplier_id as $value){
                                    $listSupplier[] = (int)$value;
                                }
                            }
                            @endphp
                            <label for="supplier_id" class="col-sm-2 col-form-label">{{ trans('product.supplier') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm supplier_id select2" multiple="multiple"
                                    data-placeholder="{{ trans('product.admin.select_supplier') }}" style="width: 100%;"
                                    name="supplier_id[]">
                                    <option value=""></option>
                                    @foreach ($suppliers as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (count($listSupplier) && in_array($v->id, $listSupplier))?'selected':'' }}>{{ $v->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_id'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('supplier_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Supplier --}}
@endif
                        {{-- select guarantees --}}
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('guarantee_id') ? ' has-error' : '' }}">

                            <label for="guarantee_id"
                                   class="col-sm-2 col-form-label">{{ trans('product.guarantee') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm guarantee_id select2"
                                        data-placeholder="{{ trans('product.admin.select_guarantee') }}"
                                        style="width: 100%;"
                                        name="guarantee_id">
                                    <option value=""></option>
                                    @foreach ($guarantees as $k => $v)
                                        <option value="{{ $k }}"
                                                {{ (old('guarantee_id') == $k || (!old() && $product->guarantee_id == $k) ) ? 'selected':'' }}>
                                            {{ $v->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('guarantee_id'))
                                    <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('guarantee_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{--// select guarantees --}}
@if (sc_config('product_cost'))
                        {{-- Cost --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE)
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-sm-2 col-form-label">{{ trans('product.cost') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="cost" name="cost"
                                        value="{!! old('cost',$product->cost) !!}" class="form-control input-sm cost"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('cost'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('cost') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Cost --}}
@endif

@if (sc_config('product_price'))
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        {{-- Price --}}
                        <div class="form-group   {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-sm-2 col-form-label">{{ trans('product.price') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="price" name="price"
                                        value="{!! old('price',$product->price) !!}" class="form-control input-sm price"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('price'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('price') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Price --}}
@endif

@if (sc_config('product_tax'))
                    @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        {{-- Tax --}}
                        <div class="form-group  {{ $errors->has('tax_id') ? ' has-error' : '' }}">
                            <label for="tax_id" class="col-sm-2 col-form-label">{{ trans('product.tax') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm tax_id select2" style="width: 100%;"
                                    name="tax_id">
                                    <option value="0" {{ (old('tax_id', $product->tax_id) == 0) ? 'selected':'' }}>{{ trans('tax.admin.non_tax') }}</option>
                                    <option value="auto" {{ (old('tax_id', $product->tax_id) == 'auto') ? 'selected':'' }}>{{ trans('tax.admin.auto') }}</option>
                                    @foreach ($taxs as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('tax_id') ==$k || (!old() && $product->tax_id ==$k) ) ? 'selected':'' }}>
                                        {{ $v->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tax_id'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('tax_id') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Tax --}}
                    @endif
@endif

@if (sc_config('product_promotion'))
                        {{-- price promotion --}}
                        <div class="form-group  kind kind0 kind1">
                            <label for="price"
                                class="col-sm-2 col-form-label">{{ trans('product.price_promotion') }}</label>
                            <div class="col-sm-8">
                                @if (old('price_promotion') || $product->promotionPrice)
                                <div class="price_promotion">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="number" style="width: 100px;" id="price_promotion"
                                            name="price_promotion"
                                            value="{!! old('price_promotion',$product->promotionPrice->price_promotion ?? '') !!}"
                                            class="form-control input-sm price_promotion" placeholder="" />
                                        <span title="Remove" class="btn btn-flat btn-sm btn-danger removePromotion"><i
                                                class="fa fa-times"></i></span>
                                    </div>

                                    <div class="form-inline">


                                        <div class="input-group">
                                            {{ trans('product.price_promotion_start') }}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="price_promotion_start"
                                                    name="price_promotion_start"
                                                    value="{!!old('price_promotion_start',$product->promotionPrice->date_start ?? '')!!}"
                                                    class="form-control input-sm date_available date_time"
                                                    placeholder="" />

                                            </div>
                                        </div>

                                        <div class="input-group">
                                            {{ trans('product.price_promotion_end') }}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar fa-fw"></i></span>
                                                <input type="text" style="width: 100px;" id="price_promotion_end"
                                                    name="price_promotion_end"
                                                    value="{!!old('price_promotion_end',$product->promotionPrice->date_end ?? '')!!}"
                                                    class="form-control input-sm date_available date_time"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-inline">
                                        <div class="input-group">
                                            {{trans("product.price_promotion_time_start")}}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o fa-fw"></i>
                                                </span>
                                                <input type="text"
                                                       class="form-control input-sm timepickeralt clockpicker"
                                                       placeholder=""
                                                       value="{!!old('start_time',$product->promotionPrice->start_time ?? '')!!}"
                                                       name="start_time">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            {{trans("product.price_promotion_time_end")}}<br>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o fa-fw"></i>
                                                </span>
                                                <input type="text"
                                                       class="form-control input-sm timepickeralt clockpicker"
                                                       placeholder=""
                                                       value="{!!old('end_time',$product->promotionPrice->end_time ?? '')!!}"
                                                       name="end_time">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            {{ trans('product.is_amazing') }}<br>
                                            <div class="input-group">
                                                <input type="checkbox" name="is_amazing" value="on" {{ old('is_amazing',$product->promotionPrice->is_amazing == 1)?'checked':''}}>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <button type="button" style="display: none;" id="add_product_promotion"
                                    class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product_promotion') }}
                                </button>
                                @else
                                <button type="button" id="add_product_promotion" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product_promotion') }}
                                </button>
                                @endif

                            </div>
                        </div>
                        {{-- //price promotion --}}
                        @endif
@endif

@if (sc_config('product_stock'))
                        {{-- Stock --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div class="form-group  {{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label for="stock" class="col-sm-2 col-form-label">{{ trans('product.stock') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="stock" name="stock"
                                        value="{!! old('stock',$product->stock) !!}" class="form-control input-sm stock"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('stock'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('stock') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Stock --}}
@endif

@if (sc_config('product_weight'))
                        {{-- weight --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)

                        <div class="form-group  {{ $errors->has('weight_class') ? ' has-error' : '' }}">
                            <label for="weight_class" class="col-sm-2 col-form-label">{{ trans('product.weight_class') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm weight_class select2" style="width: 100%;"
                                    name="weight_class">
                                    <option value="">{{ trans('product.select_weight') }}<option>
                                    @foreach ($listWeight as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('weight_class') == $k || (!old() && $product->weight_class ==$k) ) ? 'selected':'' }}>
                                        {{ $v }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('weight_class'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('weight_class') }}
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group  {{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label for="weight" class="col-sm-2 col-form-label">{{ trans('product.weight') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="weight" name="weight"
                                        value="{!! old('weight',$product->weight) !!}" class="form-control input-sm weight"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('weight'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('weight') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        @endif
                        {{-- //weight --}}
@endif


@if (sc_config('product_length'))
                        {{-- length --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)

                        <div class="form-group  {{ $errors->has('length_class') ? ' has-error' : '' }}">
                            <label for="length_class" class="col-sm-2 col-form-label">{{ trans('product.length_class') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm length_class select2" style="width: 100%;"
                                    name="length_class">
                                    <option value="">{{ trans('product.select_length') }}<option>
                                    @foreach ($listLength as $k => $v)
                                    <option value="{{ $k }}"
                                        {{ (old('length_class') == $k || (!old() && $product->length_class ==$k) ) ? 'selected':'' }}>
                                        {{ $v }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('length_class'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('length_class') }}
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group  {{ $errors->has('length') ? ' has-error' : '' }}">
                            <label for="length" class="col-sm-2 col-form-label">{{ trans('product.length') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="length" name="length"
                                        value="{!! old('length',$product->length) !!}" class="form-control input-sm length"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('length'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('length') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group  {{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="col-sm-2 col-form-label">{{ trans('product.height') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="height" name="height"
                                        value="{!! old('height',$product->height) !!}" class="form-control input-sm height"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('height'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('height') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group  {{ $errors->has('width') ? ' has-error' : '' }}">
                            <label for="width" class="col-sm-2 col-form-label">{{ trans('product.width') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="width" name="width"
                                        value="{!! old('width',$product->width) !!}" class="form-control input-sm width"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('width'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('width') }}
                                </span>
                                @endif
                            </div>
                        </div>                        

                        @endif
                        {{-- //length --}}
@endif


@if (sc_config('product_virtual'))
                        {{-- Virtual --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div class="form-group  kind kind0 kind1  {{ $errors->has('virtual') ? ' has-error' : '' }}">
                            <label for="virtual" class="col-sm-2 col-form-label">{{ trans('product.virtual') }}</label>
                            <div class="col-sm-8">
                                @foreach ( $virtuals as $key => $virtual)
                                <label class="radio-inline"><input type="radio" name="virtual" value="{{ $key }}"
                                        {{ (old('virtual',$product->virtual) == $key)?'checked':'' }}>{{ $virtual }}</label>
                                @endforeach
                                @if ($errors->has('virtual'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('virtual') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Virtual --}}
@endif

@if (sc_config('product_available'))
                        {{-- Date vailalable --}}
                        @if ($product->kind == SC_PRODUCT_SINGLE || $product->kind == SC_PRODUCT_BUILD)
                        <div
                            class="form-group  kind kind0 kind1  {{ $errors->has('date_available') ? ' has-error' : '' }}">
                            <label for="date_available"
                                class="col-sm-2 col-form-label">{{ trans('product.date_available') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                    <input type="text" style="width: 100px;" id="date_available" name="date_available"
                                        value="{!!old('date_available',$product->date_available)!!}"
                                        class="form-control input-sm date_available date_time" placeholder="" />
                                </div>
                                @if ($errors->has('date_available'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('date_available') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        {{-- //Date vailalable --}}
@endif

                        {{-- minimum --}}
                        <div class="form-group   {{ $errors->has('minimum') ? ' has-error' : '' }}">
                            <label for="minimum" class="col-sm-2 col-form-label">{{ trans('product.minimum') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="minimum" name="minimum"
                                        value="{!! old('minimum',$product['minimum']) !!}" class="form-control minimum"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('minimum'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('minimum') }}
                                </span>
                                @else
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ trans('product.minimum_help') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //minimum --}}

                        {{-- Sort --}}
                        <div class="form-group   {{ $errors->has('sort') ? ' has-error' : '' }}">
                            <label for="sort" class="col-sm-2 col-form-label">{{ trans('product.sort') }}</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="number" style="width: 100px;" id="sort" name="sort"
                                        value="{!! old('sort',$product['sort']) !!}" class="form-control sort"
                                        placeholder="" />
                                </div>
                                @if ($errors->has('sort'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('sort') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //Sort --}}

                        {{-- Status --}}
                        <div class="form-group  ">
                            <label for="status" class="col-sm-2 col-form-label">{{ trans('product.status') }}</label>
                            <div class="col-sm-8">
                                @if (old())
                                <input class="input" type="checkbox" name="status" {{ old('status',$product['status'])?'checked':''}}>
                                @else
                                <input class="input" type="checkbox" name="status" checked>
                                @endif

                            </div>
                        </div>
                        {{-- //Status --}}

@if (sc_config('product_kind'))
                        @if ($product->kind == SC_PRODUCT_GROUP)
                        {{-- List product in groups --}}
                        <hr>
                        <div class="form-group {{ $errors->has('productInGroup') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-8"><label>{{ trans('product.admin.select_product_in_group') }}</label>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('productInGroup') ? ' has-error' : '' }}">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                @php
                                $listgroups= [];
                                $groups = old('productInGroup',$product->groups->pluck('product_id')->toArray());
                                if(is_array($groups)){
                                foreach($groups as $value){
                                $listgroups[] = (int)$value;
                                }
                                }
                                @endphp
                                @if ($listgroups)
                                @foreach ($listgroups as $pID)
                                @if ((int)$pID)
                                @php
                                $newHtml = str_replace('value="'.(int)$pID.'"', 'value="'.(int)$pID.'" selected',
                                $htmlSelectGroup);
                                @endphp
                                {!! $newHtml !!}
                                @endif
                                @endforeach
                                @endif
                                <div id="position_group_flag"></div>
                                @if ($errors->has('productInGroup'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productInGroup') }}
                                </span>
                                @endif
                                <button type="button" id="add_product_in_group" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product') }}
                                </button>
                                @if ($errors->has('productInGroup'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productInGroup') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //end List product in groups --}}
                        @endif



                        @if ($product->kind == SC_PRODUCT_BUILD)
                        <hr>
                        {{-- List product build --}}
                        <div class="form-group {{ $errors->has('productBuild') ? ' has-error' : '' }}">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-8">
                                <label>{{ trans('product.admin.select_product_in_build') }}</label>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('productBuild') ? ' has-error' : '' }}">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="row"></div>

                                @php
                                $listBuilds= [];
                                $groups = old('productBuild',$product->builds->pluck('product_id')->toArray());
                                $groupsQty = old('productBuildQty',$product->builds->pluck('quantity')->toArray());
                                if(is_array($groups)){
                                foreach($groups as $key => $value){
                                $listBuilds[] = (int)$value;
                                $listBuildsQty[] = (int)$groupsQty[$key];
                                }
                                }
                                @endphp

                                @if ($listBuilds)
                                @foreach ($listBuilds as $key => $pID)
                                @if ((int)$pID && $listBuildsQty[$key])
                                @php
                                $newHtml = str_replace('value="'.(int)$pID.'"', 'value="'.(int)$pID.'" selected',
                                $htmlSelectBuild);
                                $newHtml = str_replace('name="productBuildQty[]" value="1" min=1',
                                'name="productBuildQty[]" value="'.$listBuildsQty[$key].'"', $newHtml);
                                @endphp
                                {!! $newHtml !!}
                                @endif
                                @endforeach
                                @endif
                                <div id="position_build_flag"></div>
                                @if ($errors->has('productBuild'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productBuild') }}
                                </span>
                                @endif
                                <button type="button" id="add_product_in_build" class="btn btn-flat btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{ trans('product.admin.add_product') }}
                                </button>
                                @if ($errors->has('productBuild') || $errors->has('productBuildQty'))
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i> {{ $errors->first('productBuild') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- //end List product build --}}
                        @endif
@endif


@if (sc_config('product_attribute'))
                    @if ($product->kind == SC_PRODUCT_SINGLE)
                        {{-- List product attributes --}}
                        <hr>
                        @if (!empty($attributeGroup))
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label>{{ trans('product.attribute') }}
                            </div>
                            <div class="col-sm-8">

                                @php
                                $getDataAtt = $product->attributes->groupBy('attribute_group_id')->toArray();
                                $arrAtt = [];
                                foreach ($getDataAtt as $groupId => $row) {
                                    foreach ($row as $key => $value) {
                                        $arrAtt[$groupId]['name'][] = $value['name'];
                                        $arrAtt[$groupId]['add_price'][] = $value['add_price'];
                                    }
                                }
                                $dataAtt = old('attribute', $arrAtt);
                                @endphp

                                @foreach ($attributeGroup as $attGroupId => $attName)
                                    <table width="100%">
                                        <tr>
                                            <td colspan="3"><p><b>{{ $attName }}:</b></p></td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('product.admin.add_attribute_place') }}</td>
                                            <td>{{ trans('product.admin.add_price_place') }}</td>
                                        </tr>
                                    @if (!empty($dataAtt[$attGroupId]['name']))
                                        @foreach ($dataAtt[$attGroupId]['name'] as $key => $attValue)
                                            @php
                                            $newHtml = str_replace('attribute_group', $attGroupId, $htmlProductAtrribute);
                                            $newHtml = str_replace('attribute_value', $attValue, $newHtml);
                                            $newHtml = str_replace('add_price_value', $dataAtt[$attGroupId]['add_price'][$key], $newHtml);
                                            @endphp
                                            {!! $newHtml !!}
                                        @endforeach
                                    @endif
                                        <tr>
                                            <td colspan="3"><br><button type="button"
                                                    class="btn btn-flat btn-success add_attribute"
                                                    data-id="{{ $attGroupId }}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    {{ trans('product.admin.add_attribute') }}
                                                </button><br><br></td>
                                        </tr>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        {{-- //end List product attributes --}}
                    @endif
@endif

                    </div>
                </div>



                <!-- /.box-body -->

                <div class="box-footer">
                    @csrf
                    <div class="col-md-2"></div>

                    <div class="col-md-8">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
                        </div>

                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
                        </div>
                    </div>
                </div>

                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>



@endsection

@push('styles')

{{-- input image --}}
{{-- <link rel="stylesheet" href="{{ asset('admin/plugin/fileinput.min.css')}}"> --}}
<style type="text/css">
    /*******************************************************************************
* Tree container
*/

    ul.dynatree-container {
        font-family: tahoma, arial, helvetica;
        font-size: 10pt; /* font size should not be too big */
        white-space: nowrap;
        padding: 3px;
        margin: 0; /* issue 201 */
        background-color: white;
        border: 1px dotted gray;
        overflow: auto;
        /*	height: 100%; /* issue 263, 470 */
        min-height: 0%;
    }

    ul.dynatree-container ul {
        padding: 0 0 0 16px;
        margin: 0;
    }

    ul.dynatree-container li {
        list-style-image: none;
        list-style-position: outside;
        list-style-type: none;
        -moz-background-clip: border;
        -moz-background-inline-policy: continuous;
        -moz-background-origin: padding;
        background-attachment: scroll;
        background-color: transparent;
        background-repeat: repeat-y;
        background-image: url("{{ asset('admin/plugin/dynatree/img/vline.gif')}}");
        background-position: 0 0;
        /*
        background-image: url("icons_96x256.gif");
        background-position: -80px -64px;
        */
        margin: 0;
        padding: 1px 0 0 0;
    }

    /* Suppress lines for last child node */
    ul.dynatree-container li.dynatree-lastsib {
        background-image: none;
    }

    /* Suppress lines if level is fixed expanded (option minExpandLevel) */
    ul.dynatree-no-connector > li {
        background-image: none;
    }

    /* Style, when control is disabled */
    .ui-dynatree-disabled ul.dynatree-container {
        opacity: 0.5;
        /*	filter: alpha(opacity=50); /* Yields a css warning */
        background-color: silver;
    }

    /*******************************************************************************
     * Common icon definitions
     */
    span.dynatree-empty,
    span.dynatree-vline,
    span.dynatree-connector,
    span.dynatree-expander,
    span.dynatree-icon,
    span.dynatree-checkbox,
    span.dynatree-radio,
    span.dynatree-drag-helper-img,
    #dynatree-drop-marker {
        width: 16px;
        height: 16px;
        /*	display: -moz-inline-box; /* @ FF 1+2 removed for issue 221 */
        /*	-moz-box-align: start; /* issue 221 */
        display: inline-block; /* Required to make a span sizeable */
        vertical-align: top;
        background-repeat: no-repeat;
        background-position: left;
        background-image: url("{{ asset('admin/plugin/dynatree/img/icons.gif')}}");
        background-position: 0 0;
    }

    /** Used by 'icon' node option: */
    ul.dynatree-container img {
        width: 16px;
        height: 16px;
        margin-left: 3px;
        vertical-align: top;
        border-style: none;
    }

    /*******************************************************************************
     * Lines and connectors
     */

    span.dynatree-connector {
        background-position: -16px -64px;
    }

    /*******************************************************************************
     * Expander icon
     * Note: IE6 doesn't correctly evaluate multiples class names,
     *		 so we create combined class names that can be used in the CSS.
     *
     * Prefix: dynatree-exp-
     * 1st character: 'e': expanded, 'c': collapsed
     * 2nd character (optional): 'd': lazy (Delayed)
     * 3rd character (optional): 'l': Last sibling
     */

    span.dynatree-expander {
        background-position: 0px -80px;
        cursor: pointer;
    }

    .dynatree-exp-cl span.dynatree-expander /* Collapsed, not delayed, last sibling */
    {
        background-position: 0px -96px;
    }

    .dynatree-exp-cd span.dynatree-expander /* Collapsed, delayed, not last sibling */
    {
        background-position: -64px -80px;
    }

    .dynatree-exp-cdl span.dynatree-expander /* Collapsed, delayed, last sibling */
    {
        background-position: -64px -96px;
    }

    .dynatree-exp-e span.dynatree-expander, /* Expanded, not delayed, not last sibling */
    .dynatree-exp-ed span.dynatree-expander /* Expanded, delayed, not last sibling */
    {
        background-position: -32px -80px;
    }

    .dynatree-exp-el span.dynatree-expander, /* Expanded, not delayed, last sibling */
    .dynatree-exp-edl span.dynatree-expander /* Expanded, delayed, last sibling */
    {
        background-position: -32px -96px;
    }

    .dynatree-loading span.dynatree-expander /* 'Loading' status overrides all others */
    {
        background-position: 0 0;
        background-image: url("{{ asset('admin/plugin/dynatree/img/loading.gif')}}");
    }

    /*******************************************************************************
     * Checkbox icon
     */
    span.dynatree-checkbox {
        margin-left: 3px;
        background-position: 0px -32px;
    }

    span.dynatree-checkbox:hover {
        background-position: -16px -32px;
    }

    .dynatree-partsel span.dynatree-checkbox {
        background-position: -64px -32px;
    }

    .dynatree-partsel span.dynatree-checkbox:hover {
        background-position: -80px -32px;
    }

    .dynatree-selected span.dynatree-checkbox {
        background-position: -32px -32px;
    }

    .dynatree-selected span.dynatree-checkbox:hover {
        background-position: -48px -32px;
    }

    /*******************************************************************************
     * Radiobutton icon
     * This is a customization, that may be activated by overriding the 'checkbox'
     * class name as 'dynatree-radio' in the tree options.
     */
    span.dynatree-radio {
        margin-left: 3px;
        background-position: 0px -48px;
    }

    span.dynatree-radio:hover {
        background-position: -16px -48px;
    }

    .dynatree-partsel span.dynatree-radio {
        background-position: -64px -48px;
    }

    .dynatree-partsel span.dynatree-radio:hover {
        background-position: -80px -48px;
    }

    .dynatree-selected span.dynatree-radio {
        background-position: -32px -48px;
    }

    .dynatree-selected span.dynatree-radio:hover {
        background-position: -48px -48px;
    }

    /*******************************************************************************
     * Node type icon
     * Note: IE6 doesn't correctly evaluate multiples class names,
     *		 so we create combined class names that can be used in the CSS.
     *
     * Prefix: dynatree-ico-
     * 1st character: 'e': expanded, 'c': collapsed
     * 2nd character (optional): 'f': folder
     */

    span.dynatree-icon /* Default icon */
    {
        margin-left: 3px;
        background-position: 0px 0px;
    }

    .dynatree-ico-cf span.dynatree-icon /* Collapsed Folder */
    {
        background-position: 0px -16px;
    }

    .dynatree-ico-ef span.dynatree-icon /* Expanded Folder */
    {
        background-position: -64px -16px;
    }

    /* Status node icons */

    .dynatree-statusnode-wait span.dynatree-icon {
        background-image: url("{{ asset('admin/plugin/dynatree/img/loading.gif')}}");
    }

    .dynatree-statusnode-error span.dynatree-icon {
        background-position: 0px -112px;
        /*	background-image: url("ltError.gif");*/
    }

    /*******************************************************************************
     * Node titles
     */

    /* @Chrome: otherwise hit area of node titles is broken (issue 133)
       Removed again for issue 165; (133 couldn't be reproduced) */
    span.dynatree-node {
        /*	display: -moz-inline-box; /* issue 133, 165, 172, 192. removed for issue 221*/
        /*	-moz-box-align: start; /* issue 221 */
        display: inline-block; /* issue 373 Required to make a span sizeable */
        vertical-align: top;
    }

    /* Remove blue color and underline from title links */
    ul.dynatree-container a
        /*, ul.dynatree-container a:visited*/
    {
        color: black; /* inherit doesn't work on IE */
        text-decoration: none;
        vertical-align: top;
        margin: 0px;
        margin-left: 3px;
        /*	outline: 0; /* @ Firefox, prevent dotted border after click */
    }

    ul.dynatree-container a:hover {
        /*	text-decoration: underline; */
        background-color: #F2F7FD; /* light blue */
        border-color: #B8D6FB; /* darker light blue */
    }

    span.dynatree-node a {
        font-size: 10pt; /* required for IE, quirks mode */
        display: inline-block; /* Better alignment, when title contains <br> */
        /*	vertical-align: top;*/
        padding-left: 3px;
        padding-right: 3px; /* Otherwise italic font will be outside bounds */
        /*	line-height: 16px; /* should be the same as img height, in case 16 px */
    }

    span.dynatree-folder a {
        font-weight: bold;
    }

    ul.dynatree-container a:focus,
    span.dynatree-focused a:link /* @IE */
    {
        background-color: #EFEBDE; /* gray */
    }

    span.dynatree-has-children a {
    }

    span.dynatree-expanded a {
    }

    span.dynatree-selected a {
        color: green;
        font-style: italic;
    }

    span.dynatree-active a {
        background-color: #3169C6 !important;
        color: white !important; /* @ IE6 */
    }

    /*******************************************************************************
     * Drag'n'drop support
     */

    /*** Helper object ************************************************************/
    div.dynatree-drag-helper {
    }

    div.dynatree-drag-helper a {
        border: 1px solid gray;
        background-color: white;
        padding-left: 5px;
        padding-right: 5px;
        opacity: 0.8;
    }

    span.dynatree-drag-helper-img {
        /*
        position: relative;
        left: -16px;
        */
    }

    div.dynatree-drag-helper /*.dynatree-drop-accept*/
    {

        /*    border-color: green;
            background-color: red;*/
    }

    div.dynatree-drop-accept span.dynatree-drag-helper-img {
        background-position: -32px -112px;
    }

    div.dynatree-drag-helper.dynatree-drop-reject {
        border-color: red;
    }

    div.dynatree-drop-reject span.dynatree-drag-helper-img {
        background-position: -16px -112px;
    }

    /*** Drop marker icon *********************************************************/

    #dynatree-drop-marker {
        width: 24px;
        position: absolute;
        background-position: 0 -128px;
        margin: 0;
        /*	border: 1px solid red; */
    }

    #dynatree-drop-marker.dynatree-drop-after,
    #dynatree-drop-marker.dynatree-drop-before {
        width: 64px;
        background-position: 0 -144px;
    }

    #dynatree-drop-marker.dynatree-drop-copy {
        background-position: -64px -128px;
    }

    #dynatree-drop-marker.dynatree-drop-move {
        background-position: -64px -128px;
    }

    /*** Source node while dragging ***********************************************/

    span.dynatree-drag-source {
        /* border: 1px dotted gray; */
        background-color: #e0e0e0;
    }

    span.dynatree-drag-source a {
        color: gray;
    }

    /*** Target node while dragging cursor is over it *****************************/

    span.dynatree-drop-target {
        /*border: 1px solid gray;*/
    }

    span.dynatree-drop-target a {
    }

    span.dynatree-drop-target.dynatree-drop-accept a {
        /*border: 1px solid green;*/
        background-color: #3169C6 !important;
        color: white !important; /* @ IE6 */
        text-decoration: none;
    }

    span.dynatree-drop-target.dynatree-drop-reject {
        /*border: 1px solid red;*/
    }

    span.dynatree-drop-target.dynatree-drop-after a {
    }

    /*******************************************************************************
     * Custom node classes (sample)
     */

    span.custom1 a {
        background-color: maroon;
        color: yellow;
    }

    .dynatree-container.dynatree-rtl .dynatree-title {
        unicode-bidi: bidi-override; /* optional: reverse title letters */
    }

    ul.dynatree-container.dynatree-rtl ul {
        padding: 0 16px 0 0;
    }

    ul.dynatree-container.dynatree-rtl li {
        background-position: right 0;
        background-image: url("{{ asset('admin/plugin/dynatree/img/vline-rtl.gif')}}");
    }

    .dynatree-container.dynatree-rtl span.dynatree-connector,
    .dynatree-container.dynatree-rtl span.dynatree-expander,
    .dynatree-container.dynatree-rtl span.dynatree-icon,
    .dynatree-container.dynatree-rtl span.dynatree-drag-helper-img,
    .dynatree-container.dynatree-rtl #dynatree-drop-marker {
        background-image: url("{{ asset('admin/plugin/dynatree/img/icons-rtl.gif')}}");
    }

    .dynatree-icon {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
@include('admin.component.ckeditor_js')



{{-- input image --}}
{{-- <script src="{{ asset('admin/plugin/fileinput.min.js')}}"></script> --}}





<script type="text/javascript">
    // Promotion
$('#add_product_promotion').click(function(event) {
    $(this).before('<div class="price_promotion">\n' +
        '    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span><input\n' +
        '            type="number" style="width: 100px;" id="price_promotion" name="price_promotion" value="0"\n' +
        '            class="form-control input-sm price" placeholder="" /><span title="Remove"\n' +
        '            class="btn btn-flat btn-sm btn-danger removePromotion"><i class="fa fa-times"></i></span></div>\n' +
        '    <div class="form-inline">\n' +
        '        <div class="input-group">{{ trans("product.price_promotion_start") }}<br>\n' +
        '            <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span><input\n' +
        '                    type="text" style="width: 100px;" id="price_promotion_start" name="price_promotion_start" value=""\n' +
        '                    class="form-control input-sm date_available date_time" placeholder="" /></div>\n' +
        '        </div>\n' +
        '        <div class="input-group">{{ trans("product.price_promotion_end") }}<br>\n' +
        '            <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span><input\n' +
        '                    type="text" style="width: 100px;" id="price_promotion_end" name="price_promotion_end" value=""\n' +
        '                    class="form-control input-sm date_available date_time" placeholder="" /></div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div class="form-inline">\n' +
        '        <div class="input-group">\n' +
        '            {{trans("product.price_promotion_time_start")}}<br>\n' +
        '            <div class="input-group">\n' +
        '                <span class="input-group-addon">\n' +
        '                    <i class="fa fa-time fa-fw"></i>\n' +
        '                </span>\n' +
        '                <input type="text" class="form-control input-sm  timepickeralt clockpicker" placeholder="" name="start_time">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '\n' +
        '        <div class="input-group">\n' +
        '            {{trans("product.price_promotion_time_end")}}<br>\n' +
        '            <div class="input-group">\n' +
        '                <span class="input-group-addon">\n' +
        '                    <i class="fa fa-time fa-fw"></i>\n' +
        '                </span>\n' +
        '                <input type="text" class="form-control input-sm timepickeralt clockpicker" placeholder="" name="end_time">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '\n' +
        '        <div class="input-group">\n' +
        '            {{trans("product.is_amazing")}}<br>\n' +
        '            <div class="input-group">\n' +
        '                <input  type="checkbox" name="is_amazing" value="on">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>');
    $(this).hide();
    $('.removePromotion').click(function(event) {
        $(this).closest('.price_promotion').remove();
        $('#add_product_promotion').show();
    });
    $('.date_time').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
});
$('.removePromotion').click(function(event) {
    $('#add_product_promotion').show();
    $(this).closest('.price_promotion').remove();
});
//End promotion

// Add sub images
var id_sub_image = {{ old('sub_image')?count(old('sub_image')):0 }};
$('#add_sub_image').click(function(event) {
    id_sub_image +=1;
    $(this).before('<div class="group-image"><div class="input-group"><input type="text" id="sub_image_'+id_sub_image+'" name="sub_image[]" value="" class="form-control input-sm sub_image" placeholder=""  /><span class="input-group-btn"><span><a data-input="sub_image_'+id_sub_image+'" data-preview="preview_sub_image_'+id_sub_image+'" data-type="product" class="btn btn-sm btn-flat btn-primary lfm"><i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}</a></span><span title="Remove" class="btn btn-flat btn-sm btn-danger removeImage"><i class="fa fa-times"></i></span></span></div><div id="preview_sub_image_'+id_sub_image+'" class="img_holder"></div></div>');
    $('.removeImage').click(function(event) {
        $(this).closest('div').remove();
    });
    $('.lfm').filemanager();
});
    $('.removeImage').click(function(event) {
        $(this).closest('.group-image').remove();
    });
//end sub images

// Select product in group
$('#add_product_in_group').click(function(event) {
    var htmlSelectGroup = '{!! $htmlSelectGroup !!}';
    $(this).before(htmlSelectGroup);
    $('.select2').select2();
    $('.removeproductInGroup').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductInGroup').click(function(event) {
    $(this).closest('table').remove();
});
//end select in group

// Select product in build
$('#add_product_in_build').click(function(event) {
    var htmlSelectBuild = '{!! $htmlSelectBuild !!}';
    $(this).before(htmlSelectBuild);
    $('.select2').select2();
    $('.removeproductBuild').click(function(event) {
        $(this).closest('table').remove();
    });
});
$('.removeproductBuild').click(function(event) {
    $(this).closest('table').remove();
});
//end select in build


// Select product attributes
$('.add_attribute').click(function(event) {
    var htmlProductAtrribute = '{!! $htmlProductAtrribute??'' !!}';
    var attGroup = $(this).attr("data-id");
    htmlProductAtrribute = htmlProductAtrribute.replace(/attribute_group/gi, attGroup);
    htmlProductAtrribute = htmlProductAtrribute.replace("attribute_value", "");
    htmlProductAtrribute = htmlProductAtrribute.replace("add_price_value", "0");
    $(this).closest('tr').before(htmlProductAtrribute);
    $('.removeAttribute').click(function(event) {
        $(this).closest('tr').remove();
    });
});
$('.removeAttribute').click(function(event) {
    $(this).closest('tr').remove();
});
//end select attributes

$(document).ready(function() {
    $('.select2').select2()
});

//Date picker
$('.date_time').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
})

$('textarea.editor').ckeditor(
    {
        filebrowserImageBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=product',
        filebrowserImageUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=product&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=Files',
        filebrowserUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
        filebrowserWindowWidth: '900',
        filebrowserWindowHeight: '500'
    }
);
</script>
<script src="{{ asset('admin/plugin/dynatree/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin/plugin/dynatree/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{ asset('admin/plugin/dynatree/js/jquery.cookie.js')}}"></script>
<script src="{{ asset('admin/plugin/dynatree/js/jquery.dynatree.js')}}"></script>
<script>
    $(function () {

        try {
            $("#tree").dynatree({
                extensions: ["select"],
                checkbox: true,
                selectMode: 2,
                // autoCollapse: true,
                persist: false,
                onSelect: function (select, node) {
                    var selNodes = node.tree.getSelectedNodes();
                    var selKeys = $.map(selNodes, function (node) {
                        return node.data.key;
                    });
                    $('#cat_manager').val(selKeys.join(", ").toString().replace(/catid_/gi, ""));
                },
                onPostInit: function () {
                    //if ($('body').attr('data-dir') == '0')
                    this.$tree.find("ul.dynatree-container").attr("DIR", "RTL").addClass("dynatree-rtl");
                    $("#tree").dynatree("getRoot").visit(function (node) {
                        node.expand(false);
                    });
                }
            });

            //
            // $.each($('#cat_manager').val().trim().split(','), function (index, val) {
            //     alert(index);
            //     if (val.length > 0)
            //         $("#tree").dynatree("getTree").getNodeByKey(val).select(true);
            //
            //
            // });

            var vals = $('#cat_manager').val().trim().split(',');

            for (var t in vals) {
                $("#tree").dynatree("getTree").getNodeByKey(vals[t]).select(true);
            }
        } catch (exeption) {
        }
    });
</script>
@endpush