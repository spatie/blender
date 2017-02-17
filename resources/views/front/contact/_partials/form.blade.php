{{ html()->form()->open() }}

{{ html()->formGroup()->text('name', trans('form.name')) }}
{{ html()->formGroup()->text('telephone', trans('form.telephone')) }}
{{ html()->formGroup()->email('email', trans('form.email')) }}
{{ html()->formGroup()->text('address', trans('form.address')) }}

<p>
    <div class="grid">
        <div class="grid__cell -width-1/4">
            {{ html()->formGroup()->text('postal', trans('form.postal')) }}
        </div>
        <div class="grid__cell  -width-3/4">
            {{ html()->formGroup()->text('city', trans('form.city')) }}
        </div>
    </div>
</p>
<p>
    {{ html()->formGroup()->textarea('remarks', trans('form.remarks')) }}
</p>
<p>
{!! Recaptcha::render(['lang' => locale()]) !!}
{{ html()->error($errors->first('g-recaptcha-response')) }}
</p>
<p>
    {{ html()->button(trans('contact.button'), 'submit')->class('button--primary') }}
</p>

{{ html()->form()->close() }}

<p class="alert--info">
    @lang('form.fieldsAreRequired')
</p>
