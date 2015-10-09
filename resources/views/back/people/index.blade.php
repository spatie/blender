@extends('back.layout.master')

@section('pageTitle', trans('back-people.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans('back-people.title') }}</h1>

            <a href="{{ action('Back\PersonController@create') }}" class="button">{{ trans('back-people.new') }}</a>

            <table data-sortable="{{ action('Back\PersonController@changeOrder') }}">
                <thead>
                <tr>
                    <th>{{ trans('back-people.name') }}</th>
                    <th>{{ trans('back-people.function') }}</th>
                    <th data-orderable="false"></th>
                </tr>

                <tbody>
                @foreach($people as $person)
                    <tr data-row-id="{{ $person->id }}" >
                        <td><a href="{!! action('Back\PersonController@edit', [$person->id]) !!}">{{ $person->name }}</a></td>
                        <td>{{ $person->function }}</td>
                        <td class="-right">
                            {!! HTML::formButton(action('Back\PersonController@destroy', [$person->id]), '<span class="fa fa-remove"></span>', 'delete',
                            [
                            'class'=>'button -danger -small',
                            'id'=> 'delete_person_' . $person->id
                            ]
                            ); !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop
