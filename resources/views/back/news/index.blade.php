@component('back._layouts.master', [
    'pageTitle' => __('Nieuws'),
])
    <section>
        <div class="grid">
            <h1>@lang('Nieuws')</h1>

            <a href="{{ action('Back\NewsController@create') }}" class="button">
                @lang('Nieuw nieuwsbericht')
            </a>

            <table data-datatable data-order='[[ 1, "desc" ]]'>
                <thead>
                <tr>
                    <th>@lang('Naam')</th>
                    <th>@lang('Publicatiedatum')</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $newsItem)
                    <tr data-row-id="{{ $newsItem->id }}">
                        <td>
                            {{ html()->onlineIndicator($newsItem->online) }}
                            <a href="{{ action('Back\NewsController@edit', [$newsItem->id]) }}">
                                {{ $newsItem->name }}
                            </a>
                        </td>
                        <td data-order="{{ $newsItem->publish_date }}">
                            {{ $newsItem->publish_date->format('d/m/Y') }}
                        </td>
                        <td class="-right">
                            {{ html()->deleteButton(action('Back\NewsController@destroy', $newsItem->id)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
