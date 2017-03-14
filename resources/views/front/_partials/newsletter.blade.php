<h3>@lang('newsletter.form.title')</h3>

@lang('newsletter.form.description')

<form
    class="newsletter"
    data-newsletter
    method="POST"
    action="{{ action('Front\NewsletterApiController@subscribe') }}"
>
    <input data-newsletter-email type="email" name="email">
    <button class="button">@lang('newsletter.form.button')</button>
    <div
        data-newsletter-message
        data-newsletter-error-email="@lang('newsletter.form.invalidEmail')"
        data-newsletter-error-ajax="@lang('newsletter.form.submissionFailed')"
    ></div>
</form>

