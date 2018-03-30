@component('back.layouts.app', [
    'title' => 'Recipients',
])
    <section>
        <div class="grid">
            <h1>Recipients</h1>

            <a href="{{ action('Back\RecipientsController@create') }}" class="button">
                New recipient
            </a>

            <table data-datatable data-order='[[ 1, "desc" ]]'>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Form</th>
                    <th>Email</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $recipient)
                    <tr data-row-id="{{ $recipient->id }}">
                        <td>
                            <a href="{{ action('Back\RecipientsController@edit', [$recipient->id]) }}">
                                {{ $recipient->name }}
                            </a>
                        </td>
                        <td>
                            {{ config('forms.types')[$recipient->form] }}
                        </td>
                        <td>
                            {{ $recipient->email }}
                        </td>
                        <td class="-right">
                            {{ html()->deleteButton(action('Back\RecipientsController@destroy', $recipient->id)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
