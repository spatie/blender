@extends('back.layout.master')

@section('pageTitle', trans('back-backUsers.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans('back-backUsers.title') }}</h1>
            <a href="{{ action('Back\BackUserController@create') }}" class="button">
                {{ trans('back-backUsers.new') }}
            </a>
            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>{{ trans('back-backUsers.name') }}</th>
                        <th>{{ trans('back-backUsers.lastActivity') }}</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ action('Back\BackUserController@edit', [$user->id]) }}">{{ $user->email }}</a>
                        </td>
                        <td>
                            {!! HTML::avatar($user, '-small') !!}  <span>{{ $user->present()->fullName }}</span>
                        </td>
                        <td>
                            {{ $user->present()->lastActivityDate }}
                        </td>
                        <td class="-right">
                            @unless ($user->isCurrentUser())
                            {!! HTML::formButton(
                                action('Back\BackUserController@destroy', [$user->id]),
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
