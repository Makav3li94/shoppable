@extends($templatePath.'.layout')

@section('main')

    <section class="row mt-2 mt-md-4">
        <div class="col-lg-12 p-0">
            <div class="bg-box-auth">
                <img class="logo-auth" src="{{asset($templateFile.'/images/logo.svg')}}" alt="">
                <div class="box-auth mb-2 mb-md-4">
                    <div class="header">
                        <p>{{ trans('account.title_login') }}</p>
                    </div>
                    <div class="body px-3 px-md-4 pt-3 pb-1">
                        <form action="{{ route('postLogin') }}" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="icon icon-username">{{ trans('account.email') }}</label>
                                <input type="email" dir="ltr"
                                       class="form-control form-control-defualt validate text-left {{ ($errors->has('email'))?"input-error":"" }}"
                                       value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                          {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="icon icon-password">{{ trans('account.password') }}</label>
                                <input type="password" dir="ltr" class="form-control form-control-defualt text-left {{ ($errors->has('password'))?"input-error":"" }}"
                                      >
                                @if ($errors->has('password'))
                                    <span class="help-block">
            {{ $errors->first('password') }}
        </span>
                                @endif
                                <a class="forget-password" href="{{ route('forgot') }}">      {{ trans('account.password_forgot') }}</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info login">{{ trans('account.login') }}</button>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
{{--                                    <input type="checkbox" class="custom-control-input" id="remmber-me" checked>--}}
{{--                                    <label class="custom-control-label" for="remmber-me">مرا به خاطر داشته باش</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                    <div class="footer">
                        <p> کاربر جدید هستید؟<a href="{{route('register')}}">ثبت‌نام در دیجی‌کیان</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--form-->
    {{--<div class="container">--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-12">--}}
    {{--            <h2 class="title-page">{{ $title }}</h2>--}}
    {{--        </div>--}}
    {{--        <div class="col-12 col-sm-12 btn-tab-cs">--}}
    {{--            <button class="btn btn-link active btn-tab-login" type="button" data-tab="tab-login">--}}
    {{--                {{ trans('account.title_login') }}--}}
    {{--            </button>--}}
    {{--            <button class="btn btn-link btn-tab-login" type="button" data-tab="tab-signup">--}}
    {{--                {{ trans('account.title_register') }}--}}
    {{--            </button>--}}
    {{--        </div>--}}
    {{--        <div class="col-12 col-sm-12">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-12 col-sm-12 col-md-6 active" id="tab-login">--}}
    {{--                    <div class="login-form">--}}
    {{--                        <!--login form-->--}}
    {{--                        @include($templatePath.'.auth.login')--}}
    {{--                    </div>--}}
    {{--                    <!--/login form-->--}}
    {{--                </div>--}}
    {{--                <div class="col-12 col-sm-12 col-md-6" id="tab-signup">--}}
    {{--                    <div class="signup-form">--}}
    {{--                        <!--sign up form-->--}}
    {{--                        @include($templatePath.'.auth.register')--}}
    {{--                    </div>--}}
    {{--                    <!--/sign up form-->--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
    <!--/form-->
@endsection

