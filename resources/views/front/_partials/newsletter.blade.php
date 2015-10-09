<h3>{{ fragment('newsletter.form.title') }}</h3>

{{ fragment('newsletter.form.description') }}

<form class="form-newsletter form-inline"
      data-newsletter = "subscribe"
      data-form-autofocus="false"
      method="POST"
      action="{{ action('Front\NewsletterApiController@subscribe') }}"
        >
    <span class="form-newsletter-field form-inline-input">
        <input class="input-footer" type="email" name="email">
    </span>
    <button class="button form-newsletter-button button-green">
        {{ fragment('newsletter.form.button') }}
    </button>

    <div class="form-newsletter-response message"
         data-newsletter="response"
         style="display:none">
    </div>
</form>

