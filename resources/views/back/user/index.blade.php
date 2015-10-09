@extends('back.layout.master')

@section('pageTitle', trans('back-users.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans("back-users.title") }}</h1>

            {!! Navigation::getBackUserRoleMenu() !!}

            <a href="{{ URL::action('Back\UserController@create', ['role' => $role]) }}" class="button">{{ trans("back-users.role.{$role}.new") }}</a>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>E-mail</th>
                    <th>{{ trans('back-users.name') }}</th>
                    @if($role != \App\Models\Enums\UserRole::ADMIN)
                        <th>Status</th>
                    @endif
                    <th>{{ trans('back-users.lastActivity') }}</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ URL::action('Back\UserController@edit', [$user->id]) }}">{{ $user->email }}</a></td>
                        <td>{!! HTML::avatar($user, '-small') !!}  <span>{{ $user->present()->fullName }}</span></td>
                        @if($role != \App\Models\Enums\UserRole::ADMIN)
                            <td>{{ $user->present()->status }}</td>
                        @endif
                        <td>{{ $user->present()->lastActivityDate }}</td>
                        <td class="-right">
                            @unless ($user->isCurrentUser())
                                {!! HTML::formButton(URL::action('Back\UserController@destroy', [$user->id]), '<span class="fa fa-remove"></span>', 'delete',
                                ['class'=>'button -danger -small', 'id'=>"delete_user_{$user->id}"]) !!}
                            @endunless

                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </section>
@endsection
