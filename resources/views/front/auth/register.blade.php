@component('front.layouts.main', [
    'title' => __('auth.register')
])
    {{ html()->form()->open() }}

    {{ html()->formGroup()->required()->text('email', __('auth.email')) }}

    <div class="flex">
        <div class="md:w-1/2">
            {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
        </div>
        <div class="md:w-1/2">
            {{ html()->formGroup()->required()->password('password_confirmation', __('auth.confirmPassword')) }}
        </div>
    </div>

    <div class="flex">
        <div class="md:w-1/4">
            {{ html()->formGroup()->required()->text('first_name', __('auth.firstName')) }}
        </div>
        <div class="md:w-3/4">
            {{ html()->formGroup()->required()->text('last_name', __('auth.lastName')) }}
        </div>
    </div>

    {{ html()->formGroup()->text('address', __('auth.address')) }}

    <div class="flex">
        <div class="md:w-1/4">
            {{ html()->formGroup()->text('postal', __('auth.postal')) }}
        </div>
        <div class="md:w-3/4">
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
