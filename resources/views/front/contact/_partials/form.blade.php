{{ html()->form()->open() }}

{{ html()->formGroup()->text('name', __('form.name')) }}
{{ html()->formGroup()->text('telephone', __('form.telephone')) }}
{{ html()->formGroup()->email('email', __('form.email')) }}
{{ html()->formGroup()->text('address', __('form.address')) }}

<p>
    <div class="grid">
        <div class="grid__cell -width-1/4">
            {{ html()->formGroup()->text('postal', __('form.postal')) }}
        </div>
        <div class="grid__cell  -width-3/4">
            {{ html()->formGroup()->text('city', __('form.city')) }}
        </div>
    </div>
</p>
<p>
    {{ html()->formGroup()->textarea('remarks', __('form.remarks')) }}
</p>
<p>
{!! Recaptcha::render(['lang' => locale()]) !!}
{{ html()->error($errors->first('g-recaptcha-response')) }}
</p>
<p>
    {{ html()->button(__('contact.button'), 'submit')->class('button--primary') }}
</p>

{{ html()->form()->close() }}

<p class="alert--info">
    @lang('form.fieldsAreRequired')
</p>
