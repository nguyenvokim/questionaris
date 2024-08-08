@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.auth.register_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="first_name">{{ __('validation.attributes.frontend.first_name') }}</label>
                                    <input
                                            type="text"
                                            id="first_name"
                                            name="first_name"
                                            class="form-control"
                                            placeholder="{{ __('validation.attributes.frontend.first_name') }}"
                                            required
                                            @if(!empty($preFirstName)) value="{{$preFirstName}}" readonly  @endif
                                    >
                                </div><!--col-->
                            </div><!--row-->

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">{{ __('validation.attributes.frontend.last_name') }}</label>
                                    <input type="text"
                                           id="last_name"
                                           name="last_name"
                                           class="form-control"
                                           placeholder="{{ __('validation.attributes.frontend.last_name') }}"
                                           required
                                           @if(!empty($preLastName)) value="{{$preLastName}}" readonly  @endif
                                    >
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">{{ __('validation.attributes.frontend.email') }}</label>
                                    <input type="text"
                                           id="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="{{ __('validation.attributes.frontend.email') }}"
                                           required
                                           @if(!empty($preEmail)) value="{{$preEmail}}" readonly  @endif
                                    >
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Practice/Business Name</label>
                                    <div>
                                        <input type="text" name="business_name" id="business_name" value="" placeholder="Enter Practice/Business Name" maxlength="191" required="required" class="form-control">
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Country</label>

                                    <div>
                                        <country-select value="AU" />
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Profession</label>

                                    <div>
                                        <profession-select value="0" />
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.registration'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.frontend.auth.register_button')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                    @if(!empty($code)) <input type="hidden" value="{{ $code }}" name="code">  @endif
                    {{ html()->form()->close() }}

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                @include('frontend.auth.includes.socialite')
                            </div>
                        </div><!--/ .col -->
                    </div><!-- / .row -->
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
