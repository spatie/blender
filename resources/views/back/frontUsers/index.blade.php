@extends('back.layout.master')

@section('pageTitle', trans('back-frontUsers.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans('back-frontUsers.title') }}</h1>
            <a href="{{ action('Back\FrontUserController@create') }}" class="button">
                {{ trans('back-frontUsers.new') }}
            </a>
            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>{{ trans('back-frontUsers.name') }}</th>
                        <th>{{ trans('back-frontUsers.lastActivity') }}</th>
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
                            @unless ($user->isCurrentUser())
                            {!! HTML::formButton(
                                action('Back\FrontUserController@destroy', [$user->id]),
                                '<span class="fa fa-remove"></span>',
                                'delete',
                                ['class'=>'button -danger -small', 'id'=>"delete_user_{$user->id}"]
                            ) !!}
                            @endunless
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
