@component('back.layouts.app', [
    'title' => 'Dashboard'
])
    <section>
        <div class="grid">
            <h1>Dashboard</h1>

            @if (isset($visitors))
                @include('back.dashboard.partials.visitors')
            @else
                <div class="alerts">
                    <div class="alert--info">
                        Analytics hasn't been configured yet.
                    </div>
                </div>
            @endif

            @if(count($logItems))
                <h2>Recent activity</h2>
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
                <a href="{{ action('Back\ActivitylogController@index') }}">
                    View the entire log
                </a>
            @endif
        </div>
    </section>
@endcomponent
