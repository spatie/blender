@component('back._layouts.master', [
    'pageTitle' => __('Administrators')
])
    <section>
        <div class="grid">
            <h1>@lang('Administrators')</h1>
            <a href="{{ action('Back\AdministratorsController@create') }}" class="button">
                @lang('Nieuwe administrator')
            </a>
            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>@lang('E-mail')</th>
                    <th>@lang('Naam')</th>
                    <th>@lang('Laatste activiteit')}</th>
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
