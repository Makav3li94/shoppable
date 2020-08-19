@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ $title_description??'' }}</h2>

                    <div class="box-tools">
                        <div class="btn-group pull-admin_guarantee" style="margin-right: 5px">
                            <a href="{{ route('admin_banner.index') }}" class="btn  btn-flat btn-default"
                               title="List"><i class="fa fa-list"></i><span
                                        class="hidden-xs"> {{trans('guarantee.back_list')}}</span></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal"
                      id="form-main" enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="fields-group">


                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="url" class="col-sm-2 col-form-label">{{ trans('ad.link') }}</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text" id="title" name="title"
                                               value="{{ old()?old('title'):$guaranntee['title']??'' }}" class="form-control"
                                               placeholder=""/>
                                    </div>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                                {{ $errors->first('title') }}
                                            </span>
                                    @endif
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