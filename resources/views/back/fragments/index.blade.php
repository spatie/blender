@component('back._layouts.master', [
    'title' => __('Fragmenten'),
])
    <section>
        <div class="grid">
            <h1>@lang('Fragmenten')</h1>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>@lang('Naam')</th>
                    <th>@lang('Inhoud')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fragments as $fragment)
                    <tr>
                        <td>
                            <a href="{{ action('Back\FragmentsController@edit', [$fragment->id]) }}">
                                {{ $fragment->full_name }}
                            </a>
                        </td>
                        <td class="-small">
                            {{ $fragment->excerpt }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
