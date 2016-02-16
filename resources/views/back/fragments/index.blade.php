@extends('back.layout.master')

@section('pageTitle', fragment('back.fragments.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.fragments.title') }}</h1>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>{{ fragment('back.fragments.name') }}</th>
                    <th>{{ fragment('back.fragments.content') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fragments as $fragment)
                    <tr>
                        <td><a href="{{ action('Back\FragmentController@edit', [$fragment->id]) }}">{{ $fragment->name }}</a></td>
                        <td  class="-small">{!! $fragment->present()->shortenedText !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="form_group -buttons">
                {!! HTML::formButton(URL::action('Back\FragmentController@download'), 'Download fragments', 'POST') !!}
            </div>
        </div>
    </section>
@stop
