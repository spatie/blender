@component('back.layouts.app', [
    'title' => 'Log'
])
    <section>
        <div class="grid">
            <h1>Log</h1>
            {!! $logItems->render() !!}
            <table class="-datatable -compact">
                <thead>
                <tr>
                    <th>Time</th>
                    <th>Description</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logItems as $logItem)
                    <tr>
                        <td>{{ diff_date_for_humans($logItem->created_at) }}</td>
                        <td>{!! $logItem->description !!}</td>
                        <td>
                            @if($logItem->causer)
                                <a href="{{ action('Back\AdministratorsController@edit', $logItem->causer->id) }}">
                                    {{ $logItem->causer->email }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $logItems->render() !!}
        </div>
    </section>
@endcomponent
