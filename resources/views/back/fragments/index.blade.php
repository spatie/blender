@component('back._layouts.master', [
    'pageTitle' => fragment('back.fragments.title'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.fragments.title') }}</h1>

            <table data-datatable data-order='[[ 0, "asc" ]]'>
                <thead>
                <tr>
                    <th>{{ fragment('back.fragments.name') }}</th>
                    <th>{{ fragment('back.fragments.content') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fragments as $fragment)
                    <tr>
                        <td>
                            <a href="{{ action('Back\FragmentsController@edit', [$fragment->id]) }}">{{ $fragment->fullName }}</a>
                        </td>
                        <td class="-small">{!! $fragment->tease !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="form__group -buttons">
                {!! Form::openButton([
                    'action' => 'Back\FragmentsController@download',
                    'method' => 'post'
                ]) !!}
                {{ fragment('back.fragments.download') }}
                {!! Form::closeButton() !!}
            </div>
        </div>
    </section>

@endcomponent
