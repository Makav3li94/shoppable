@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description??'' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_product_group_type.index') }}" class="btn  btn-flat btn-default"
                               title="List"><i class="fa fa-list"></i><span
                                        class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal"
                      id="form-main">
                    <div class="box-body">
                        <div class="fields-group">

                            <div class="form-group  {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type"
                                       class="col-sm-2 control-label">{{ trans('attribute_group.type') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">

                                        <select name="type_id" id="type_id" class="form-control">
                                            <option value="">انتخاب کنید.</option>
                                            @foreach($product_types as $key=> $product_type)
                                                <option value="{{$key}}" {{!empty($obj['id']) == $key ? "selected='selected'" : ''}}>{{$product_type}}</option>
                                            @endforeach
                                        </select>
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
                                       class="col-sm-2 control-label">{{ trans('attribute_group.type') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">

                                        <select name="group_id" id="group_id" class="form-control" >
                                            <option value=""></option>
                                            @if($page == 'edit')
                                                <option value="{{$obj['group_id']}}" selected='selected'>{{$attrGroup}}</option>
                                            @endif
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
                                       class="col-sm-2  control-label">{{ trans('attribute_group.name') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="name" name="name"
                                               value="{!! old('name',($obj['name']??'')) !!}" class="form-control name"
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
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
{{--    @if($page == 'create')--}}
        <script>
            $('#type_id').on('change', function () {
                var typeId = this.value;
                $.ajax({
                    url: "{{route('get.group.ajax')}}",
                    type: "POST",
                    data: {"type_id": typeId, "_token": "{{csrf_token()}}"},
                    async: false,
                    success: function (data) {
                        // alert(data);
                        $('#group_id').prop("disabled", false);

                        $("#group_id").html("");

                        for (var i in data) {
                            $("#group_id").append($("<option>").val(i).html(data[i]));
                        }

                    }
                });
            });

        </script>
{{--    @endif--}}
@endpush
