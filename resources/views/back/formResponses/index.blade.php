@component('back._layouts.master', [
    'pageTitle' => fragment('back.formResponses.title'),
])

    <section>
        <div class="grid">

            <h1>{{ fragment('back.formResponses.title') }}</h1>

            {!! Html::info(fragment('back.formResponses.info', [
                'recipients' => collect(config('mail.recipients.questionForm'))->implode(', '),
            ])) !!}

            <div class="form__group -buttons">
                {!! Form::openButton([
                    'action' => 'Back\FormResponsesController@download',
                    'method' => 'post',
                ]) !!}
                {{ fragment('back.formResponses.download') }}
                {!! Form::closeButton() !!}
            </div>
        </div>
    </section>

@endcomponent
