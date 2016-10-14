@extends('back._layouts.master')

@section('pageTitle', fragment('back.redirects.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.redirects.title') }}</h1>
            <a href="{{ action('Back\RedirectController@create') }}"
               class="button">{{ fragment('back.redirects.new') }}</a>

            <table data-sortable="{{ action('Back\RedirectController@changeOrder') }}">
                <thead>
                <tr>
                    <th>{{ fragment('back.redirects.old_url') }}</th>
                    <th>{{ fragment('back.redirects.new_url') }}</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($redirects as $redirect)
                    <tr data-row-id="{{ $redirect->id }}">
                        <td>
                            <a href="{{ action('Back\RedirectController@edit', [$redirect->id]) }}">{{ $redirect->old_url }}</a>
                            <td>{{ $redirect->new_url }}</td>
                        </td>
                        <td class="-right">
                            {!! Html::deleteButton(action('Back\RedirectController@destroy', $redirect->id)) !!}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    </section>
@stop
