@extends('back._layouts.master')

@section('pageTitle', fragment('back.frontUsers.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.frontUsers.title') }}</h1>
            <a href="{{ action('Back\FrontUserController@create') }}" class="button">
                {{ fragment('back.frontUsers.new') }}
            </a>
            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>{{ fragment('back.frontUsers.name') }}</th>
                        <th>{{ fragment('back.frontUsers.lastActivity') }}</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ action('Back\FrontUserController@edit', [$user->id]) }}">{{ $user->email }}</a>
                        </td>
                        <td>
                            {{ $user->present()->fullName }}
                        </td>
                        <td>
                            {{ $user->present()->lastActivityDate }}
                        </td>
                        <td class="-right">
                            {!! Html::deleteButton(action('Back\FrontUserController@destroy', $user->id)) !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
