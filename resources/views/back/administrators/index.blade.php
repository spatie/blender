@component('back.layouts.app', [
    'title' => 'Administrators'
])
    <section>
        <div class="grid">
            <h1>Administrators</h1>

            <a href="{{ action('Back\AdministratorsController@create') }}" class="button">
                New administrator
            </a>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>E-mail</th>
                    <th>Name</th>
                    <th>Last activity</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ action('Back\AdministratorsController@edit', [$user->id]) }}">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            {{ html()->avatar($user)->class('-small') }}
                            <span>{{ $user->name }}</span>
                        </td>
                        <td>
                            {{ $user->lastActivityDate }}
                        </td>
                        <td class="-right">
                            @if(! $user->isCurrentUser())
                                {{ html()->deleteButton(action('Back\AdministratorsController@destroy', $user->id)) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
