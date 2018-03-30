{{ html()->form()->open() }}

{{ html()->formGroup()->text('name', __('form.name')) }}

{{ html()->formGroup()->text('telephone', __('form.telephone')) }}

{{ html()->formGroup()->email('email', __('form.email')) }}

{{ html()->formGroup()->text('address', __('form.address')) }}

<div class="flex">
    <div class="md:w-1/4">
        {{ html()->formGroup()->text('postal', __('form.postal')) }}
    </div>
    <div class="md:w-3/4">
        {{ html()->formGroup()->text('city', __('form.city')) }}
    </div>
</div>

{{ html()->formGroup()->textarea('remarks', __('form.remarks')) }}

{!! Recaptcha::render(['lang' => locale()]) !!}

{{ html()->error($errors->first('g-recaptcha-response')) }}

{{ html()->button(__('contact.button'), 'submit')->class('button') }}

{{ html()->form()->close() }}

<p class="alert is-info">
    {{ __('form.fieldsAreRequired') }}
</p>
