@component('back.layouts.app', [
    'title' => 'Responses',
])
    <section>
        <div class="grid">
            <h1>Responses</h1>

            @php($recipients = array_column(recipients('contactForm'), 'email'))

            {{ html()->info()->open() }}
                Responses will be sent to {{ implode(', ', $recipients) }}.
            {{ html()->info()->close() }}

            <div class="form__group -buttons">
                {{ html()->form('POST', action('Back\FormResponsesController@download'))->open() }}

                <button type="submit" class="button">
                    Download responses
                </button>

                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endcomponent
