@component('back._layouts.master', [
    'title' => 'Responses',
])
    <section>
        <div class="grid">
            <h1>Responses</h1>

            {{ html()->info()->open() }}
            @php($recipients = collect()->implode(', '))

            @if(! $recipients)
                Responses aren't sent by mail because there are no recipients specified.
            @else
                Responses will be sent to {{ implode(', ', config('mail.recipients.questionForm')) }}.
            @endif
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
