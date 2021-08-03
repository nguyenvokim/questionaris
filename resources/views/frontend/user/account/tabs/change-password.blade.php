{{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                {{ html()->password('old_password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label('New Password')->for('password') }}

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
                {{ html()->label('Re-enter New Password')->for('password_confirmation') }}

                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix text-right">
                {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
    <input type="hidden" name="active_tab" value="password" />
{{ html()->form()->close() }}
