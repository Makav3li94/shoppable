@extends('admin.layout')

@section('main')
    <section id="pjax-container" class="table-list">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="box-title">{{ $title_description??'' }}</h2>

                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('admin_product_type.index') }}" class="btn  btn-flat btn-default"
                                   title="List"><i class="fa fa-list"></i><span
                                            class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main">
                        <div class="box-body">
                            <div class="fields-group">

                                <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name"
                                           class="col-sm-3  control-label">{{ trans('attribute_group.name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" id="name" name="name"
                                                   value="{!! old('name',($obj['name']??'')) !!}"
                                                   class="form-control name"
                                                   placeholder=""/>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <hr>

                            </div>

                        </div>

                        <!-- /.box-body -->

                        <div class="box-footer">
                            @csrf
                            <div class="col-md-2">
                            </div>

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

                    <hr>
                    @php
                        $page = explode('/',request()->path());
                         $page = $page[2];
                    @endphp
                    @if($page != 'create')
                        <div class="box">
                            <div class="box-body">
                                <div class="btn-group pull-right">
                                    {{--                                <a href="{{route('admin_product_group_type.create')}}" class="btn btn-primary">افزودن گروه</a>--}}

                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#exampleModal">
                                        افزودن گروه
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{route('admin_product_group_type.create')}}"
                                                      method="post" accept-charset="UTF-8" class="form-horizontal"
                                                      id="form-main">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">افزودن گروه</h5>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="box-body">
                                                            <div class="fields-group">

                                                                <div class="form-group  {{ $errors->has('type') ? ' has-error' : '' }}">
                                                                    <label for="type"
                                                                           class="col-sm-3 control-label">{{ trans('attribute_group.type') }}</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="input-group">

                                                                            <select name="type_id" id="type_id"
                                                                                    class="form-control" disabled>
                                                                                @if(!empty($product_types))
                                                                                    @foreach($product_types as $key=> $product_type)
                                                                                        <option value="{{$key}}" {{$obj['id'] == $key ? 'selected="selected"' : ''}}>{{$product_type}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                                <input type="hidden" name="type_id"
                                                                                       value="{{!empty($obj['id']) ? $obj['id'] : ''}}">
                                                                            </select>
                                                                        </div>
                                                                        @if ($errors->has('type_id'))
                                                                            <span class="help-block">
                                                                       {{ $errors->first('type_id') }}
                                                                         </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                                                    <label for="name"
                                                                           class="col-sm-3  control-label">{{ trans('attribute_group.name') }}</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="input-group">
                                                                        <span class="input-group-addon"><i
                                                                                    class="fa fa-pencil fa-fw"></i></span>
                                                                            <input type="text" id="name" name="name"
                                                                                   value=""
                                                                                   class="form-control name"
                                                                                   placeholder="" required/>
                                                                        </div>
                                                                        @if ($errors->has('name'))
                                                                            <span class="help-block">
                                                                 {{ $errors->first('name') }}
                                                                         </span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <hr>

                                                            </div>

                                                        </div>
                                                        <!-- /.box-body -->

                                                        <div class="box-footer">
                                                            @csrf
                                                            <div class="col-md-2">
                                                            </div>
                                                        </div>

                                                        <!-- /.box-footer -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            انصراف
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <table class="table table-bordered table-striped table-responsive">

                                    <thead>

                                    <th>ردیف</th>
                                    <th>نام گروه</th>
                                    <th>ویژگی های گروه</th>
                                    <th>عملیات</th>

                                    </thead>
                                    <tbody>
                                    @if(!empty($groups))
                                        @foreach($groups as $key=> $group)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>
                                                    {{$group->name}}
                                                    <button type="button" class="btn btn-sm btn-success pull-right"
                                                            data-toggle="modal"
                                                            data-target="#addAttrModal"
                                                            onclick="addAttrGroupToFrom({{$group->id}})">
                                                        ویژگی جدید <i class="fa fa-plus"></i>
                                                    </button>

                                                    <!-- Modal -->

                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <table class="table table-responsive">
                                                            @foreach($group->productsAttr as $productAttr)
                                                                <tr>
                                                                    <td class="col-sm-6 col-md-6">{{$productAttr->name}}</td>
                                                                    <td class="col-sm-6 col-md-6">


                                                                        <button type="button"
                                                                                class="btn btn-sm btn-info"
                                                                                data-toggle="modal"
                                                                                data-target="#editAttrModal"
                                                                                onclick="editAttr({{$productAttr->id}})">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <span onclick="deleteItem({{$productAttr->id}})"
                                                                              title="' . trans('attribute_group.admin.delete') . '"
                                                                              class="btn btn-sm btn-flat btn-danger">
                                                                    <i class="fa fa-trash"></i></span>
                                                                    </td>
                                                                    <td>

                                                                    </td>

                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>

                                                </td>
                                                <td>
                                                    {{--                                            <a href="{{route('admin_product_group_type.edit',$group->id)}}" class="btn btn-sm btn-info">--}}
                                                    {{--                                                <i class="fa fa-pencil"></i>--}}
                                                    {{--                                            </a>--}}
                                                    <button type="button" class="btn btn-sm btn-info"
                                                            onclick="editGroup({{$group->id}})">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    {{--                        --}}

                                                    <span onclick="deleteGroup({{$group->id}})"
                                                          class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if($page != 'create')
        <div class="modal fade" id="addAttrModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('admin_product_type_attrs.create')}}"
                          method="post" accept-charset="UTF-8"
                          class="form-horizontal"
                          id="form-main">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">افزودن ویژگی</h5>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="fields-group">
                                    <div class="form-group  {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                        <label for="type"
                                               class="col-sm-3 control-label">{{ trans('attribute_group.type') }}</label>
                                        <div class="col-sm-7">
                                            <div class="">

                                                <select name="type_id" id="group_type_id" class="form-control" disabled>
                                                    <option value="">انتخاب کنید.</option>
                                                    @if(!empty($product_types))
                                                        @foreach($product_types as $key=> $product_type)
                                                            <option value="{{$key}}" {{$obj['id'] == $key ? "selected='selected'" : ''}}>{{$product_type}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" name="type_id"
                                                       value="{{!empty($obj['id']) ? $obj['id'] : ''}}">
                                            </div>
                                            @if ($errors->has('type_id'))
                                                <span class="help-block">
                                                {{ $errors->first('type_id') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group  {{ $errors->has('group_id') ? ' has-error' : '' }}">
                                        <label for="type"
                                               class="col-sm-3 control-label">گروه</label>
                                        <div class="col-sm-7">
                                            <div class="">
                                                <select name="group_id" id="group_group_id" class="form-control"
                                                        readonly="">
                                                    @if(!empty($obj))
                                                        @foreach($obj->typeGroup as $typeGroup)
                                                            <option value="{{$typeGroup->id}}">{{$typeGroup->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {{--                                            <input type="hidden" name="group_id" value="{{$typeGroup->id}}">--}}
                                            </div>
                                            @if ($errors->has('type_id'))
                                                <span class="help-block">
                                                {{ $errors->first('type_id') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.name') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="name" name="name" value=""
                                                       class="form-control name"
                                                       placeholder="" required/>
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group  ">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.searchable') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">

                                                <input type="checkbox" id="searchable" name="searchable" value="1">

                                            </div>
                                            @if ($errors->has('searchable'))
                                                <span class="help-block">
                                                {{ $errors->first('searchable') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group  ">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.required') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">

                                                <input type="checkbox" id="required" name="required" value="1">

                                            </div>
                                            @if ($errors->has('required'))
                                                <span class="help-block">
                                                {{ $errors->first('required') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                        <label for="type_id"
                                               class="col-sm-3 control-label">نوع ورودی</label>
                                        <div class="col-sm-7">
                                            <div class="">


                                                <select name="input_type" id="input_type" class="form-control"
                                                        onchange="inputType()">
                                                    <option value="text">متن</option>
                                                    <option value="select">انتخابی</option>
                                                    <option value="relational">ارتباطی</option>
                                                    <option value="enumeration">ثابت ها</option>
                                                </select>


                                            </div>
                                            @if ($errors->has('type_id'))
                                                <span class="help-block">
                                                {{ $errors->first('type_id') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group hidden showInput input_type_value">
                                        <label for="input_type_value" class="col-sm-3 control-label"></label>
                                        <button class=" btn btn-sm btn-success" type="button"
                                                style="padding: 0px 5px;" onclick="addInput()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <div class="col-sm-7 add_input_box">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <button class=" btn btn-sm btn-danger" type="button"
                                                        style="padding: 0px 5px;" onclick="removeInput(this)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                                <input type="text" name="input_type_value[]" value=""
                                                       class="form-control "
                                                       placeholder=""/>
                                            </div>

                                        </div>
                                    </div>


                                    <hr>

                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                @csrf
                                <div class="col-md-2">
                                </div>
                            </div>

                            <!-- /.box-footer -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade " id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="post" accept-charset="UTF-8" class="form-horizontal"
                          id="form_group_edit">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ویرایش گروه</h5>
                        </div>
                        <div class="modal-body">

                            <div class="box-body">
                                <div class="fields-group">

                                    <div class="form-group  {{ $errors->has('type') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="type"
                                                   class="col-sm-3 control-label">{{ trans('attribute_group.type') }}</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">

                                                    <select name="type_id" id="group_type_id"
                                                            class="form-control" disabled>
                                                        @if(!empty($product_types))
                                                            @foreach($product_types as $key=> $product_type)
                                                                <option value="{{$key}}">{{$product_type}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" name="type_id" id="hidden_group_type_id"
                                                           value="">
                                                </div>
                                                @if ($errors->has('type_id'))
                                                    <span class="help-block">
                                                    {{ $errors->first('type_id') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="name"
                                                   class="col-sm-3  control-label">{{ trans('attribute_group.name') }}</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-pencil fa-fw"></i>
                                                </span>
                                                    <input type="text" id="groupName" name="name" value=""
                                                           class="form-control name" placeholder=""/>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                    {{ $errors->first('name') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <hr>

                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                @csrf
                                <div class="col-md-2">
                                </div>
                            </div>

                            <!-- /.box-footer -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">
                                انصراف
                            </button>
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade " id="editAttrModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="post" accept-charset="UTF-8" class="form-horizontal"
                          id="form_attr_edit">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ویرایش ویژگی</h5>
                        </div>
                        <div class="modal-body">

                            <div class="box-body">
                                <div class="fields-group">
                                    <div class="form-group  {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                        <label for="type"
                                               class="col-sm-3 control-label">{{ trans('attribute_group.type') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <select name="type_id" id="attr_type_id" class="form-control" disabled>
                                                    <option value="">انتخاب کنید.</option>
                                                    @if(!empty($product_types))
                                                        @foreach($product_types as $key=> $product_type)
                                                            <option value="{{$key}}" {{$obj['id'] == $key ? "selected='selected'" : ''}}>{{$product_type}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" id="hidden_attr_type_id" name="type_id" value="">
                                            </div>
                                            @if ($errors->has('type_id'))
                                                <span class="help-block">
                                                {{ $errors->first('type_id') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group  {{ $errors->has('group_id') ? ' has-error' : '' }}">
                                        <label for="type"
                                               class="col-sm-3 control-label">{{ trans('attribute_group.type') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <select name="group_id" id="attr_group_id" class="form-control"
                                                        disabled>
                                                    @if(!empty($obj))
                                                        @foreach($obj->typeGroup as $typeGroup)
                                                            <option value="{{$typeGroup->id}}">{{$typeGroup->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" id="hidden_attr_group_id" name="group_id" value="">
                                            </div>
                                            @if ($errors->has('group_id'))
                                                <span class="help-block">
                                                {{ $errors->first('group_id') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group  ">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.name') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" id="attr_name" name="name" value=""
                                                       class="form-control name" placeholder=""/>
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group  ">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.searchable') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">

                                                <input type="checkbox" id="attr_searchable"  name="searchable" value="1" >

                                            </div>
                                            @if ($errors->has('searchable'))
                                                <span class="help-block">
                                                {{ $errors->first('searchable') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group  ">
                                        <label for="name"
                                               class="col-sm-3  control-label">{{ trans('attribute_group.required') }}</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">

                                                <input type="checkbox" id="attr_required" name="required" value="1">

                                            </div>
                                            @if ($errors->has('required'))
                                                <span class="help-block">
                                                {{ $errors->first('required') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <label for="type_id"
                                                   class="col-sm-3 control-label">نوع ورودی</label>
                                            <div class="col-sm-7">
                                                <div class="">

                                                    <select name="input_type" id="edit_input_type"
                                                            class="form-control input_type"
                                                            onchange="inputType()">
                                                        <option value="text">متن</option>
                                                        <option value="select">انتخابی</option>
                                                        <option value="relational">ارتباطی</option>
                                                        <option value="enumeration">ثابت ها</option>
                                                    </select>

                                                </div>
                                                @if ($errors->has('type_id'))
                                                    <span class="help-block">
                                                {{ $errors->first('type_id') }}
                                            </span>
                                                @endif
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-7 edit_input_box">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group hidden showInput input_type_value">
                                        <label for="input_type_value" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-7 add_input_box">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <button class=" btn btn-sm btn-success" type="button"
                                                        style="padding: 0px 5px;" onclick="addInput()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                                <input type="text" name="input_type_value[]" value=""
                                                       class="form-control "
                                                       placeholder=""/>
                                            </div>

                                        </div>
                                    </div>


                                    <hr>

                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                @csrf
                                <div class="col-md-2">
                                </div>
                            </div>

                            <!-- /.box-footer -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">
                                انصراف
                            </button>
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
@endpush

@push('scripts')
    {{-- //Pjax --}}
    <script src="{{ asset('admin/plugin/jquery.pjax.js')}}"></script>
    <script type="text/javascript">

        $('.grid-refresh').click(function () {
            $.pjax.reload({container: '#pjax-container'});
        });

        $(document).on('submit', '#button_search', function (event) {
            $.pjax.submit(event, '#pjax-container')
        })

        $(document).on('pjax:send', function () {
            $('#loading').show()
        })
        $(document).on('pjax:complete', function () {
            $('#loading').hide()
        })

        // tag a
        $(function () {
            $(document).pjax('a.page-link', '#pjax-container')
        })


        $(document).ready(function () {
            // does current browser support PJAX
            if ($.support.pjax) {
                $.pjax.defaults.timeout = 2000; // time in milliseconds
            }
        });

        {!! $script_sort??'' !!}

        $(document).on('ready pjax:end', function (event) {
            $('.table-list input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        })

    </script>
    {{-- //End pjax --}}
    <script type="text/javascript">
                {{-- sweetalert2 --}}
        var selectedRows = function () {
                var selected = [];
                $('.grid-row-checkbox:checked').each(function () {
                    selected.push($(this).data('id'));
                });

                return selected;
            }

        $('.grid-trash').on('click', function () {
            var ids = selectedRows().join();
            deleteItem(ids);
        });

        function deleteGroup(ids) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'آیا از حذف این آیتم اطمینان دارید ؟',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، پاک گن',
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'خیر !',
                reverseButtons: true,

                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.ajax({
                            method: 'post',
                            url: '{{route('admin_product_group_type.delete')}}',
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function (data) {
                                if (data.error == 1) {
                                    swalWithBootstrapButtons.fire(
                                        'کنسل شد',
                                        data.msg,
                                        'error'
                                    )
                                    $.pjax.reload('#pjax-container');
                                    return;
                                } else {
                                    $.pjax.reload('#pjax-container');
                                    resolve(data);
                                }

                            }
                        });
                    });
                }

            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'پاک شد !!',
                        'آیتم با موفقیت حذف شذ.',
                        'success'
                    )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //   'Cancelled',
                    //   'Your imaginary file is safe :)',
                    //   'error'
                    // )
                }
            })
        }

        function deleteItem(ids) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
                title: 'آیا از حذف این آیتم اطمینان دارید ؟',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، پاک گن',
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'خیر !',
                reverseButtons: true,

                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.ajax({
                            method: 'post',
                            url: '{{route("admin_product_type_attrs.delete")}}',
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function (data) {
                                if (data.error == 1) {
                                    swalWithBootstrapButtons.fire(
                                        'کنسل شد',
                                        data.msg,
                                        'error'
                                    )
                                    $.pjax.reload('#pjax-container');
                                    return;
                                } else {
                                    $.pjax.reload('#pjax-container');
                                    resolve(data);
                                }

                            }
                        });
                    });
                }

            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        'پاک شد !!',
                        'آیتم با موفقیت حذف شذ.',
                        'success'
                    )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons.fire(
                    //   'Cancelled',
                    //   'Your imaginary file is safe :)',
                    //   'error'
                    // )
                }
            })
        }
        {{--/ sweetalert2 --}}


    </script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
    <script>
        function addGroup() {
            $.ajax({
                url: "{{route('admin_product_group_type.create')}}",
                type: "POST",
                data: {"product_type": product_type, "_token": "{{csrf_token()}}"},
                async: false,
                success: function (data) {
                }
            })
        };

        function editGroup(groupID) {
            $.ajax({
                url: "{{route('admin_product_type_get_group')}}",
                type: "POST",
                data: {"groupID": groupID, "_token": "{{csrf_token()}}"},
                async: false,
                success: function (data) {

                    $('#groupName').val(data['name']);
                    $('#hidden_group_type_id').val(data['type_id']);

                    $("select#group_type_id > option[value=" + data['type_id'] + "]").prop("selected", true);
                    $('#editGroupModal').modal().show();
                    $('#form_group_edit').attr('action', '/sarir/dashboard/product_group_type/edit/' + data['id']);
                }
            })

        }
    </script>
    <script>
        $('#group_type_id').on('change', function () {
            var typeId = this.value;
            $.ajax({
                url: "{{route('get.group.ajax')}}",
                type: "POST",
                data: {"type_id": typeId, "_token": "{{csrf_token()}}"},
                async: false,
                success: function (data) {
                    // alert(data);
                    $('#group_group_id').prop("disabled", false);

                    $("#group_group_id").html("");

                    for (var i in data) {
                        $("#group_group_id").append($("<option>").val(i).html(data[i]));
                    }
                }
            });
        });

        function addAttrGroupToFrom(groupID) {
            $('#group_group_id option[value="' + groupID + '"]').attr("selected", "selected");
        }


        function editAttr(attrId) {
            $.ajax({
                url: "{{route('get.attr.ajax')}}",
                type: "POST",
                data: {"attr_id": attrId, "_token": "{{csrf_token()}}"},
                success: function (data) {
                    if (data['input_type'] == 'select') {
                        $('#edit_input_type option[value="' + data['input_type'] + '"]').prop("selected", true);
                    } else {
                        $('#edit_input_type option[value="' + data['input_type'] + '"]').prop("selected", true);
                    }

                    if (data['searchable'] == 1) {

                        $('#attr_searchable').prop('checked',true)
                        $('#attr_searchable').closest("div").addClass('checked');
                    }else{
                        $('#attr_searchable').prop('checked',false)
                        $('#attr_searchable').closest("div").removeClass('checked')
                    }
                    if (data['required'] == 1) {
                        $('#attr_required').prop('checked',true)
                        $('#attr_required').closest("div").addClass('checked');
                    }else{
                        $('#attr_required').prop('checked',false)
                        $('#attr_required').closest("div").removeClass('checked');
                    }

                    $('#attr_type_id option[value="' + data['type_id'] + '"]').attr("selected", "selected");
                    $('#hidden_attr_type_id').val(data['type_id']);
                    $('#attr_group_id option[value="' + data['group_id'] + '"]').attr("selected", "selected");
                    $('#hidden_attr_group_id').val(data['group_id']);
                    $('#attr_name').val(data['name']);
                    $('#form_attr_edit').attr('action', '/shop_admin/product_type_attrs/edit/' + data['id']);

                    if (data['input_type'] == 'select') {
                        $.ajax({
                            url: "{{route('admin_product_type_get_input')}}",
                            type: "POST",
                            data: {"attr_id": attrId, "_token": "{{csrf_token()}}"},
                            success: function (inputs) {
                                $('.edit_input_box').html("");
                                for (var v in inputs) {
                                    onput = "  <div class=\"input-group\">\n" +
                                        "           <span class=\"input-group-addon\">\n" +
                                        "             <button class=\"add-attribute btn btn-sm btn-success\" type='button' style=\"padding: 0px 5px;\" onclick=\"addEditInput()\">\n" +
                                        "              <i class=\"fa fa-plus\"></i>\n" +
                                        "             </button>\n" +
                                        "             <button class=\"remove-attribute btn btn-sm btn-danger\" style=\"padding: 0px 5px;\" type='button' onclick=\"removeInput(this)\">\n" +
                                        "              <i class=\"fa fa-minus\"></i>\n" +
                                        "             </button>\n" +
                                        "            </span>\n" +
                                        "            <input type=\"text\"  name=\"input_type_value[]\" value='" + inputs[v]['input'] + "' class=\"form-control \" placeholder=\"\"/>\n" +
                                        "            <input type=\"hidden\"  name=\"input_attr_id[]\" value='" + inputs[v]['id'] + "' class=\"form-control \" placeholder=\"\"/>\n" +
                                        "           </div>"
                                    $('.edit_input_box').append(onput);
                                }
                            }
                        })
                    } else {
                        $('.edit_input_box').html("");
                    }
                }
            })
        }

        function inputType() {

            var inputType = $('#input_type').val();
            var edit_input_type = $('#edit_input_type').val();
            if (inputType == 'select' || edit_input_type == 'select') {
                $('.showInput').removeClass("hidden");
            } else if ( (inputType == 'text' || edit_input_type == 'text') || (inputType == 'relational' || edit_input_type == 'relational') ) {
                $('.showInput').addClass("hidden");
            }
        }

        function addInput() {
            var input = "  <div class=\"input-group\">\n" +
                "           <span class=\"input-group-addon\">\n" +

                "             <button class=\"remove-attribute btn btn-sm btn-danger\" style=\"padding: 0px 5px;\" type='button' onclick=\"removeInput(this)\">\n" +
                "              <i class=\"fa fa-minus\"></i>\n" +
                "             </button>\n" +
                "            </span>\n" +
                "            <input type=\"text\"  name=\"input_type_value[]\" value=\"\" class=\"form-control \" placeholder=\"\"/>\n" +
                "           </div>"
            $('.add_input_box').append(input);
            // return false;
        }

        function addEditInput() {
            var input = "  <div class=\"input-group\">\n" +
                "           <span class=\"input-group-addon\">\n" +
                "             <button class=\"add-attribute btn btn-sm btn-success\" type='button' style=\"padding: 0px 5px;\" onclick=\"addEditInput()\">\n" +
                "              <i class=\"fa fa-plus\"></i>\n" +
                "             </button>\n" +
                "             <button class=\"remove-attribute btn btn-sm btn-danger\" style=\"padding: 0px 5px;\" type='button' onclick=\"removeInput(this)\">\n" +
                "              <i class=\"fa fa-minus\"></i>\n" +
                "             </button>\n" +
                "            </span>\n" +
                "            <input type=\"text\"  name=\"input_type_value[]\" value=\"\" class=\"form-control \" placeholder=\"\"/>\n" +
                "           </div>"
            $('.edit_input_box').append(input);
        }

        function removeInput(element) {
            $(element).closest("div.input-group").remove();
        }
    </script>
@endpush
