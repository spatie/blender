@component('back._layouts.master', [
    'title' => __('Reacties'),
])
    <section>
        <div class="grid">
            <h1>@lang('Reacties')</h1>

            {{ html()->info()->open() }}
            @php($recipients = collect(config('mail.recipients.questionForm'))->implode(', '))

            @if(! $recipients)
                @lang('Momenteel worden reacties nog niet gemaild omdat er geen bestemming werd ingesteld.')
            @else
                {{ __('Reacties worden gemaild naar :recipients.', compact('recipients')) }}
            @endif
            {{ html()->info()->close() }}

            <div class="form__group -buttons">
                {{ html()->form('POST', action('Back\FormResponsesController@download'))->open() }}

                {{ html()->submit(__('Download reacties'))->class('button') }}

                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endcomponent
