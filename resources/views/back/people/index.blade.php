@component('back._layouts.master', [
    'title' => __('Team'),
])
    <section>
        <div class="grid">
            <h1>@lang('Team')</h1>

            <a href="{{ action('Back\PeopleController@create') }}" class="button">
                @lang('Nieuw persoon')
            </a>

            <table data-sortable="{{ action('Back\PeopleController@changeOrder') }}">
                <thead>
                <tr>
                    <th>@lang('Naam')</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $person)
                    <tr data-row-id="{{ $person->id }}">
                        <td>
                            {{ html()->onlineIndicator($person->online) }}
                            <a href="{{ action('Back\PeopleController@edit', [$person->id]) }}">
                                {{ $person->name }}
                            </a>
                        </td>
                        <td class="-right">
                            {{ html()->deleteButton(action('Back\PeopleController@destroy', $person->id)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
