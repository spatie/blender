@component('back._layouts.master', [
    'pageTitle' => fragment('back.people.title'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.people.title') }}</h1>

            <a href="{{ action('Back\PeopleController@create') }}" class="button">{{ fragment('back.people.new') }}</a>

            <table data-sortable="{{ action('Back\PeopleController@changeOrder') }}">
                <thead>
                <tr>
                    <th>{{ fragment('back.people.name') }}</th>
                    <th data-orderable="false"></th>
                </tr>

                <tbody>
                @foreach($models as $person)
                    <tr data-row-id="{{ $person->id }}">
                        <td>
                            {!! Html::onlineIndicator($person->online) !!}
                            <a href="{!! action('Back\PeopleController@edit', [$person->id]) !!}">{{ $person->name }}</a>
                        </td>
                        <td class="-right">
                            {!! Html::deleteButton(action('Back\PeopleController@destroy', $person->id)) !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endcomponent
