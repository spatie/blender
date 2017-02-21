@component('front._layouts.main', [
    'title' => __('auth.titleRegister')
])
    {{ html()->form()->open() }}

    {{ html()->formGroup()->required()->text('first_name', __('auth.firstName')) }}
    {{ html()->formGroup()->required()->text('last_name', __('auth.lastName')) }}
    {{ html()->formGroup()->required()->text('address', __('auth.address')) }}

    <div class="grid">
        <div class="grid__cell -width-1/4">
            {{ html()->formGroup()->required()->text('postal', __('auth.postal')) }}
        </div>
        <div class="grid__cell  -width-3/4">
            {{ html()->formGroup()->required()->text('city', __('auth.city')) }}
        </div>
    </div>

    {{ html()->formGroup()->required()->text('country', __('auth.country')) }}
    {{ html()->formGroup()->required()->text('telephone', __('auth.telephone')) }}
    {{ html()->formGroup()->required()->text('email', __('auth.email')) }}
    {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
    {{ html()->formGroup()->required()->password('password_confirmation', __('auth.passwordConfirm')) }}
    {{ html()->button(__('auth.register'), 'submit')->class('button--primary') }}

    <a href="{{ login_url() }}">@lang('auth.toLogin')</a>

    {{ html()->form()->close() }}
@endcomponent
