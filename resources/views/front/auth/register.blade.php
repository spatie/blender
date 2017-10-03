@component('front._layouts.main', [
    'title' => __('auth.register')
])
    {{ html()->form()->open() }}

    {{ html()->formGroup()->required()->text('email', __('auth.email')) }}

    <div class="grid">
        <div class="grid__cell -width-1/2--s">
            {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
        </div>
        <div class="grid__cell  -width-1/2--s">
            {{ html()->formGroup()->required()->password('password_confirmation', __('auth.confirmPassword')) }}
        </div>
    </div>

    <div class="grid">
        <div class="grid__cell -width-1/4--s">
            {{ html()->formGroup()->required()->text('first_name', __('auth.firstName')) }}
        </div>
        <div class="grid__cell  -width-3/4--s">
            {{ html()->formGroup()->required()->text('last_name', __('auth.lastName')) }}
        </div>
    </div>

    {{ html()->formGroup()->text('address', __('auth.address')) }}

    <div class="grid">
        <div class="grid__cell -width-1/4--s">
            {{ html()->formGroup()->text('postal', __('auth.postal')) }}
        </div>
        <div class="grid__cell  -width-3/4--s">
            {{ html()->formGroup()->text('city', __('auth.city')) }}
        </div>
    </div>

    {{ html()->formGroup()->text('country', __('auth.country')) }}
    {{ html()->formGroup()->text('telephone', __('auth.telephone')) }}

    {{ html()->formGroup()->submit(__('auth.register')) }}

    {{ html()->form()->close() }}

    <p>
        <a href="{{ route('login') }}">
            {{ __('auth.toLogin') }}
        </a>
    </p>
@endcomponent
