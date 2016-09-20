@extends('back._layouts.master')

@section('pageTitle', fragment('back.formResponses.title'))

@section('content')
    <section>
        <div class="grid">

            <h1>{{ fragment('back.formResponses.title') }}</h1>

            @if(config('mail.questionFormRecipients')=="")
                {!! Html::info(fragment('back.formResponses.mailConfigMissing'))  !!}
            @else
                {!! Html::info(fragment('back.formResponses.info', ['recipients' => implode(', ', (new Illuminate\Support\Collection(config('mail.questionFormRecipients')))->toArray() )]))  !!}
            @endif

            <div class="form__group -buttons">
                {!! Form::openButton([
                    'action' => 'Back\FormResponseController@download',
                    'method' => 'post',
                ]) !!}
                    {{ fragment('back.formResponses.download') }}
                {!! Form::closeButton() !!}
            </div>
        </div>
    </section>
@stop
