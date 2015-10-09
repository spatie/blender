@extends('back.layout.master')

@section('pageTitle', trans('back-formResponses.title'))

@section('content')
    <section>
        <div class="grid">

            <h1>{{ trans('back-formResponses.title') }}</h1>

            {!! HTML::info(trans('back-formResponses.info', ['recipients' => implode(', ', (new Illuminate\Support\Collection(config('mail.questionFormRecipients')))->toArray() )]))  !!}

            <div class="form_group -buttons">
                {!! HTML::formButton(URL::action('Back\FormResponseController@download'), trans('back-formResponses.download'), 'POST') !!}
            </div>
        </div>
    </section>
@stop
