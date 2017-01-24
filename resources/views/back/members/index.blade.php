@component('back._layouts.master', [
    'pageTitle' => fragment('back.members.title'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.members.title') }}</h1>
            <a href="{{ action('Back\MembersController@create') }}" class="button">
                {{ fragment('back.members.new') }}
            </a>
            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>E-mail</th>
                    <th>{{ fragment('back.members.name') }}</th>
                    <th>{{ fragment('back.members.lastActivity') }}</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ action('Back\MembersController@edit', [$user->id]) }}">{{ $user->email }}</a>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->lastActivityDate }}
                        </td>
                        <td class="-right">
                            {!! Html::deleteButton(action('Back\MembersController@destroy', $user->id)) !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endcomponent
