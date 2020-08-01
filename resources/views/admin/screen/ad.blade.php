@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description??'' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="{{ route('admin_banner.index') }}" class="btn  btn-flat btn-default"
                               title="List"><i class="fa fa-list"></i><span
                                        class="hidden-xs"> {{trans('admin.back_list')}}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal"
                      id="form-main" enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="fields-group">


                            <div class="form-group   {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="url" class="col-sm-2 col-form-label">{{ trans('ad.link') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="name" name="name"
                                               value="{{ old()?old('name'):$ad['name']??'' }}" class="form-control"
                                               placeholder=""/>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group   {{ $errors->has('link') ? ' has-error' : '' }}">
                                <label for="url" class="col-sm-2 col-form-label">{{ trans('ad.link') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="link" name="link"
                                               value="{{ old()?old('link'):$ad['link']??'' }}" class="form-control"
                                               placeholder=""/>
                                    </div>
                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                                {{ $errors->first('link') }}
                                            </span>
                                    @endif
                                </div>
                            </div>
                            @php
                                $descriptions = $ad?$ad->descriptions->keyBy('lang')->toArray():[];
                            @endphp

                            @foreach ($languages as $code => $language)

                                <legend>{{ $language->name }} {!! sc_image_render($language->icon,'20px','20px', $language->name) !!}</legend>
                                <div class="form-group  {{ $errors->has('descriptions.'.$code.'.body') ? ' has-error' : '' }}">
                                    <label for="{{ $code }}__body"
                                           class="col-sm-2 col-form-label">{{ trans('ad.body') }}</label>
                                    <div class="col-sm-8">
                                        <textarea id="{{ $code }}__body" class="editor"
                                                  name="descriptions[{{ $code }}][body]">{!! old('descriptions.'.$code.'.body',($descriptions[$code]['body']??'')) !!}</textarea>
                                        @if ($errors->has('descriptions.'.$code.'.body'))
                                            <span class="help-block">
                                          {{ $errors->first('descriptions.'.$code.'.body') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group   {{ $errors->has('descriptions.'.$code.'.image') ? ' has-error' : '' }}">
                                    <label for="image" class="col-sm-2 col-form-label">{{ trans('ad.image') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="{{ $code }}__image"
                                                   name="descriptions[{{ $code }}][image]"
                                                   value="{!! old('descriptions.'.$code.'.image',($descriptions[$code]['image']??'')) !!}"
                                                   class="form-control input-sm image" placeholder=""/>
                                            <span class="input-group-btn">
                                         <a data-input="{{ $code }}__image" data-preview="{{ $code }}__preview_image" data-type="ad"
                                            class="btn btn-sm btn-primary lfm">
                                           <i class="fa fa-picture-o"></i> {{trans('product.admin.choose_image')}}
                                         </a>
                                       </span>
                                        </div>
                                        @if ($errors->has('descriptions.'.$code.'.image'))
                                            <span class="help-block">
                                                {{ $errors->first('descriptions.'.$code.'.image') }}
                                            </span>
                                        @endif
                                        <div id="{{ $code }}__preview_image" class="img_holder">
                                            @if (old('image',$descriptions[$code]['image']??''))
                                                <img src="{{ asset(old('image',$descriptions[$code]['image']??'')) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @endforeach


                            <div class="form-group  ">
                                <label for="status" class="col-sm-2 col-form-label">{{ trans('ad.status') }}</label>
                                <div class="col-sm-8">
                                    <input class="input" type="checkbox"
                                           name="status" {{ old('ad',(empty($ad['status'])?0:1))?'checked':''}}>
                                </div>
                            </div>

                            <!-- /.box-body -->

                            <div class="box-footer">
                                @csrf
                                <div class="col-md-2">
                                </div>

                                <div class="col-md-8">
                                    <div class="btn-group pull-right">
                                        <button type="submit"
                                                class="btn btn-primary">{{ trans('admin.submit') }}</button>
                                    </div>

                                    <div class="btn-group pull-left">
                                        <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
                                    </div>
                                </div>
                            </div>

                            <!-- /.box-footer -->
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

    @include('admin.component.ckeditor_js')

    <script type="text/javascript">
        $('textarea.editor').ckeditor(
            {
                filebrowserImageBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=ad',
                filebrowserImageUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=ad&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}?type=Files',
                filebrowserUploadUrl: '{{ route('admin.home').'/'.config('lfm.url_prefix') }}/upload?type=file&_token={{csrf_token()}}',
                filebrowserWindowWidth: '900',
                filebrowserWindowHeight: '500'
            }
        );
    </script>

@endpush