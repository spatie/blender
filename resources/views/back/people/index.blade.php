@extends('back._layouts.master')

@section('pageTitle', fragment('back.people.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.people.title') }}</h1>

            <a href="{{ action('Back\PersonController@create') }}" class="button">{{ fragment('back.people.new') }}</a>

            <table data-sortable="{{ action('Back\PersonController@changeOrder') }}">
                <thead>
                <tr>
                    <th>{{ fragment('back.people.name') }}</th>
                    <th data-orderable="false"></th>
                </tr>

                <tbody>
                @foreach($people as $person)
                    <tr data-row-id="{{ $person->id }}" >
                        <td>
                            {!! Html::onlineIndicator($person->online) !!}
                            <a href="{!! action('Back\PersonController@edit', [$person->id]) !!}">{{ $person->name }}</a>
                        </td>
                        <td class="-right">
                            {!! Html::deleteButton(action('Back\PersonController@destroy', $person->id)) !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop
