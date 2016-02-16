@extends('back.layout.master')

@section('pageTitle', fragment('back.formResponses.title'))

@section('content')
    <section>
        <div class="grid">

            <h1>{{ fragment('back.formResponses.title') }}</h1>

            {!! HTML::info(fragment('back.formResponses.info', ['recipients' => implode(', ', (new Illuminate\Support\Collection(config('mail.questionFormRecipients')))->toArray() )]))  !!}

            <div class="form_group -buttons">
                {!! HTML::formButton(URL::action('Back\FormResponseController@download'), fragment('back.formResponses.download'), 'POST') !!}
            </div>
        </div>
    </section>
@stop
