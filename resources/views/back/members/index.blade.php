@component('back._layouts.master', [
    'title' => __('Leden'),
])
    <section>
        <div class="grid">
            <h1>@lang('Leden')</h1>

            <a href="{{ action('Back\MembersController@create') }}" class="button">
                @lang('Nieuw lid')
            </a>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>E-mail</th>
                    <th>@lang('Naam')</th>
                    <th>@lang('Laatste activiteit')</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="{{ action('Back\MembersController@edit', [$user->id]) }}">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->last_activity_date }}
                        </td>
                        <td class="-right">
                            {{ html()->deleteButton(action('Back\MembersController@destroy', $user->id)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
