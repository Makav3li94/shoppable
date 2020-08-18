@extends($templatePath.'.layout')

@section('main')

    <!--Section Main Page-->
    <section class="row">

        <!--Content-->
        <div class="col-12 box-page wrapper-text p-3 p-md-4">

        </div>
        <!--End Content-->
        <div class="col-12 box-page wrapper-text p-3 p-md-4">
            <form method="post" action="{{ route('contact.post') }}" class="contact-form">
                {{ csrf_field() }}
                <div id="contactFormWrapper" style="margin: 30px;">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>{{ trans('front.contact_form.name') }}:</label>
                            <input type="text" class="form-control {{ ($errors->has('name'))?"input-error":"" }}"
                                   name="name" placeholder="Your name..." value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>{{ trans('front.contact_form.email') }}:</label>
                            <input type="email" class="form-control {{ ($errors->has('email'))?"input-error":"" }}"
                                   name="email" placeholder="Your email..." value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label>{{ trans('front.contact_form.phone') }}:</label>
                            <input type="telephone" class="form-control {{ ($errors->has('phone'))?"input-error":"" }}"
                                   name="phone" placeholder="Your phone..." value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                {{ $errors->first('phone') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('front.contact_form.subject') }}:</label>
                            <input type="text" class="form-control {{ ($errors->has('title'))?"input-error":"" }}"
                                   name="title" placeholder="Subject..." value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                {{ $errors->first('title') }}
                            </span>
                            @endif
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('front.contact_form.content') }}:</label>
                            <textarea class="form-control {{ ($errors->has('content'))?"input-error":"" }}" rows="5"
                                      cols="75" name="content" placeholder="Your Message...">{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                {{ $errors->first('content') }}
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="btn-toolbar form-group">
                        <input type="submit" value="{{ trans('front.contact_form.submit') }}" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--End Section Main Page-->

    <!--Background Code and Modal List-->
    <div id="mask-gray-body" class="mask-gray-body"></div>
    <div id="mask-filter" class="mask-filter">
        <div class="box-filter-looking">
            <img src="{{ asset('images/logo-xs.svg') }}" alt="">
            <p>لطفا منتظر باشید...</p>
        </div>
    </div>
@endsection