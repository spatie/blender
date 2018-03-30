@component('back.layouts.app', [
    'title' => 'Fragments',
])
    <section>
        <div class="grid">
            <h1>Fragments</h1>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Contents</th>
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
