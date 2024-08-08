{{ html()->modelForm($logged_in_user, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
@method('PATCH')

<div class="row">
    <div class="col">
        <div class="form-group">
            <label>Logo</label>
            <div class="d-flex align-items-center">
                <div>
                    <img src="{{ $logged_in_user->picture }}" class="user-profile-image" />
                </div>
                <div class="ml-4">
                    {{ html()->file('avatar_location')->class('form-control') }}
                    <input type="hidden" name="avatar_type" value="storage">
                </div>
            </div>
            <div>
{{--                <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar--}}
{{--                <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload--}}
            </div>
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

            {{ html()->text('first_name')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.first_name'))
                ->attribute('maxlength', 191)
                ->required()
                ->autofocus() }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

            {{ html()->text('last_name')
                ->class('form-control')
                ->placeholder(__('validation.attributes.frontend.last_name'))
                ->attribute('maxlength', 191)
                ->required() }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email">Practice/Business Name</label>
            <div>
                <input type="text" name="business_name" id="business_name" value="{{$logged_in_user->business_name}}" placeholder="Enter Practice/Business Name" maxlength="191" required="required" class="form-control">
            </div>
        </div><!--form-group-->
    </div><!--col-->
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email">Country</label>

            <div>
                <country-select value="{{$logged_in_user->country}}"/>
            </div>
        </div><!--form-group-->
    </div><!--col-->
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email">Profession</label>

            <div>
                <profession-select value="{{$logged_in_user->profession}}"/>
            </div>
        </div><!--form-group-->
    </div><!--col-->
</div>

@if ($logged_in_user->canChangeEmail())
    <div class="row">
        <div class="col">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
            </div>

            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                {{ html()->email('email')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.email'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
@endif

<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix text-right">
            {{ form_submit(__('labels.general.buttons.update')) }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
<input type="hidden" name="active_tab" value="password"/>
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        // $(function () {
        //     var avatar_location = $("#avatar_location");
        //
        //     if ($('input[name=avatar_type]:checked').val() === 'storage') {
        //         avatar_location.show();
        //     } else {
        //         avatar_location.hide();
        //     }
        //
        //     $('input[name=avatar_type]').change(function () {
        //         if ($(this).val() === 'storage') {
        //             avatar_location.show();
        //         } else {
        //             avatar_location.hide();
        //         }
        //     });
        // });
    </script>
@endpush
