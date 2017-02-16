@component('back._layouts.master', [
    'title' => __('Redirects'),
])
    <section>
        <div class="grid">
            <h1>@lang('Redirects')</h1>

            <a href="{{ action('Back\RedirectsController@create') }}" class="button">
                @lang('Nieuwe redirect')
            </a>

            <table data-sortable="{{ action('Back\RedirectsController@changeOrder') }}">
                <thead>
                <tr>
                    <th>@lang('Van')</th>
                    <th>@lang('Naar')</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $redirect)
                    <tr data-row-id="{{ $redirect->id }}">
                        <td>
                            <a href="{{ action('Back\RedirectsController@edit', [$redirect->id]) }}">
                                {{ $redirect->old_url }}
                            </a>
                        <td>
                            {{ $redirect->new_url }}
                        </td>
                        <td class="-right">
                            {{ html()->deleteButton(action('Back\RedirectsController@destroy', $redirect->id)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
