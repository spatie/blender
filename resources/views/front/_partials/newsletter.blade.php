<h3>{{ fragment('newsletter.form.title') }}</h3>

{{ fragment('newsletter.form.description') }}

<form class="newsletter"
      data-newsletter
      method="POST"
      action="{{ action('Front\NewsletterApiController@subscribe') }}"
        >
    <input data-newsletter-email type="email" name="email">
    <button class="button">{{ fragment('newsletter.form.button') }}</button>

    <div data-newsletter-message
         data-newsletter-error-email="{{ fragment('newsletter.form.invalidEmail') }}"
         data-newsletter-error-ajax="{{ fragment('newsletter.form.submissionFailed') }}">
    </div>
</form>

