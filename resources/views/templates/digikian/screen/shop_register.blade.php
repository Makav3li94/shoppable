@extends($templatePath.'.layout')

@section('main')
    <section class="row mt-2 mt-md-4">
        <div class="col-lg-12 p-0">
            <div class="bg-box-auth">
                <img class="logo-auth" src="{{asset($templateFile.'/images/logo.svg')}}" alt="">
                <div class="box-auth mb-2 mb-md-3">
                    <div class="header">
                        <p>{{ trans('account.title_register') }}</p>
                    </div>
                    <div class="body px-3 px-md-4 pt-3 pb-1">
                        <form>
                            @csrf
                            @if (sc_config('customer_lastname'))
                                <div class="form-group{{ $errors->has('reg_first_name') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.first_name') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt text-left {{ ($errors->has('reg_first_name'))?"input-error":"" }}"
                                           value="{{ old('reg_first_name') }}">
                                    @if ($errors->has('reg_first_name'))
                                        <span class="help-block">
                                            {{ $errors->first('reg_first_name') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('reg_last_name') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.last_name') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt text-left {{ ($errors->has('reg_last_name'))?"input-error":"" }}"
                                           value="{{ old('reg_last_name') }}">
                                    @if ($errors->has('reg_last_name'))
                                        <span class="help-block">
                                            {{ $errors->first('reg_last_name') }}
                                        </span>
                                    @endif
                                </div>

                            @else

                                <div class="form-group{{ $errors->has('reg_first_name') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.first_name') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt text-left {{ ($errors->has('reg_first_name'))?"input-error":"" }}"
                                           value="{{ old('reg_first_name') }}">
                                    @if ($errors->has('reg_first_name'))
                                        <span class="help-block">
                                            {{ $errors->first('reg_first_name') }}
                                        </span>
                                    @endif
                                </div>

                            @endif

                            <div class="form-group{{ $errors->has('reg_email') ? ' has-error' : '' }}">
                                <label class="icon icon-username">{{ trans('account.email') }}</label>
                                <input type="email" dir="ltr" class="form-control form-control-defualt text-left"
                                       value="{{ old('reg_email') }}">
                                @if ($errors->has('reg_email'))
                                    <span class="help-block">
                                        {{ $errors->first('reg_email') }}
                                    </span>
                                @endif
                            </div>

                            @if (sc_config('customer_phone'))
                                <div class="form-group{{ $errors->has('reg_phone') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.phone') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt text-left {{ ($errors->has('reg_phone'))?"input-error":"" }}"
                                           name="reg_phone" value="{{ old('reg_phone') }}">
                                    @if ($errors->has('reg_phone'))
                                        <span class="help-block">
                                         {{ $errors->first('reg_phone') }}
                                       </span>
                                    @endif
                                </div>
                            @endif

                            @if (sc_config('customer_postcode'))
                                <div class="form-group{{ $errors->has('reg_postcode') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.postcode') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt text-left {{ ($errors->has('reg_postcode'))?"input-error":"" }}"
                                           name="reg_postcode" value="{{ old('reg_postcode') }}">
                                    @if ($errors->has('reg_postcode'))
                                        <span class="help-block">
                                         {{ $errors->first('reg_postcode') }}
                                         </span>
                                    @endif
                                </div>
                            @endif


                            @if (sc_config('customer_address2'))
                                <div class="form-group{{ $errors->has('reg_address1') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.address1') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt {{ ($errors->has('reg_address1'))?"input-error":"" }}"
                                           name="reg_address1" value="{{ old('reg_address1') }}">
                                    @if ($errors->has('reg_address1'))
                                        <span class="help-block">
                                          {{ $errors->first('reg_address1') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('reg_address2') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.address2') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt {{ ($errors->has('reg_address2'))?"input-error":"" }}"
                                           name="reg_address2">
                                    @if ($errors->has('reg_address2'))
                                        <span class="help-block">
                                            {{ $errors->first('reg_address2') }}
                                        </span>
                                    @endif
                                </div>
                            @else

                                <div class="form-group{{ $errors->has('reg_address1') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.address1') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt {{ ($errors->has('reg_address1'))?"input-error":"" }}"
                                           name="reg_address1" value="{{ old('reg_address1') }}">
                                    @if ($errors->has('reg_address1'))
                                        <span class="help-block">
                                          {{ $errors->first('reg_address1') }}
                                        </span>
                                    @endif
                                </div>
                            @endif


                            @if (sc_config('customer_country'))
                                <div class="form-group  {{ $errors->has('reg_country') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.country') }}</label>
                                    <select class="form-control form-control-defualt reg_country" style="width: 100%;" name="reg_country">
                                        <option>__{{ trans('account.country') }}__</option>
                                        @foreach ($countries as $k => $v)
                                            <option value="{{ $k }}" {{ (old('reg_country') ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('reg_country'))
                                        <span class="help-block">
                                               {{ $errors->first('reg_country') }}
                                         </span>
                                    @endif
                                </div>
                            @endif

                            @if (sc_config('customer_sex'))
                                <div class="form-group{{ $errors->has('reg_sex') ? ' has-error' : '' }}">
                                    <label
                                            class="validate account_input {{ ($errors->has('reg_sex'))?"input-error":"" }}">{{ trans('account.sex') }}:
                                    </label>
                                    <label class="radio-inline"><input value="0" type="radio" name="reg_sex"
                                                {{ (old('reg_sex') == 0)?'checked':'' }}> {{ trans('account.sex_women') }}</label>
                                    <label class="radio-inline"><input value="1" type="radio" name="reg_sex"
                                                {{ (old('reg_sex') == 1)?'checked':'' }}> {{ trans('account.sex_men') }}</label>
                                    @if ($errors->has('reg_sex'))
                                        <span class="help-block">
                {{ $errors->first('reg_sex') }}
            </span>
                                    @endif
                                </div>
                            @endif

                            @if (sc_config('customer_birthday'))
                                <div class="form-group{{ $errors->has('reg_birthday') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.birthday') }}</label>

                                    <input type="date"
                                           class="form-control form-control-defualt {{ ($errors->has('reg_birthday'))?"input-error":"" }}"
                                           name="reg_birthday" data-date-format="YYYY-MM-DD" placeholder="{{ trans('account.birthday') }}"
                                           value="{{ old('reg_birthday','2015-08-09') }}">
                                    @if ($errors->has('reg_birthday'))
                                        <span class="help-block">
                                             {{ $errors->first('reg_birthday') }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            @if (sc_config('customer_group'))
                                <div class="form-group{{ $errors->has('reg_group') ? ' has-error' : '' }}">
                                    <label class="icon icon-username">{{ trans('account.group') }}</label>
                                    <input type="text"
                                           class="form-control form-control-defualt  {{ ($errors->has('reg_group'))?"input-error":"" }}"
                                           name="reg_group" value="{{ old('reg_group') }}">
                                    @if ($errors->has('reg_group'))
                                        <span class="help-block">
                                         {{ $errors->first('reg_group') }}
                                        </span>
                                    @endif
                                </div>
                            @endif


                            <div class="form-group{{ $errors->has('reg_password') ? ' has-error' : '' }}">
                                <label class="icon icon-password">{{ trans('account.password') }}</label>
                                <input type="password"
                                       class="form-control form-control-defualt text-left {{ ($errors->has('reg_password'))?"input-error":"" }}"
                                       name="reg_password" value="">
                                @if ($errors->has('reg_password'))
                                    <span class="help-block">
                                        {{ $errors->first('reg_password') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('reg_password_confirmation') ? ' has-error' : '' }}">
                                <label class="icon icon-password">{{ trans('account.password_confirm') }}</label>
                                <input type="password"
                                       class="form-control form-control-defualt text-left {{ ($errors->has('reg_password_confirmation'))?"input-error":"" }}"
                                        name="reg_password_confirmation" value="">
                                @if ($errors->has('reg_password_confirmation'))
                                    <span class="help-block">
                {{ $errors->first('reg_password_confirmation') }}
            </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info signup">{{ trans('account.signup') }}</button>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="rule" checked>
                                    <label class="custom-control-label" for="rule"><a href="#">حریم خصوصی</a> و <a
                                                href="#">شرایط
                                            و قوانین</a> استفاده از سرویس های سایت دیجی‌کیانی را مطالعه نموده و با
                                        کلیه
                                        موارد آن موافقم.</label>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="footer">
                        <p>قبلا در دیجی‌کیان ثبت‌نام کرده‌اید؟<a href="{{route('login')}}">وارد شویــد</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

