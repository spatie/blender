<h3>{{ __('newsletter.title') }}</h3>

<p>
    {{ __('newsletter.description') }}
</p>

<form
    class="newsletter"
    data-newsletter
    method="POST"
    action="{{ action('Front\NewsletterApiController@subscribe') }}"
>
    <input data-newsletter-email type="email" name="email">
    <button class="button">{{ __('newsletter.subscribe') }}</button>
    <div
        data-newsletter-message
        data-newsletter-error-email="{{ __('newsletter.invalidEmail') }}"
        data-newsletter-error-ajax="{{ __('newsletter.failed') }}"
    ></div>
</form>

