@component('back._layouts.master', [
    'title' => 'Dashboard'
])
    <section>
        <div class="grid">
            <h1>Dashboard</h1>

            @if (isset($visitors))
                @include('back.dashboard._partials.visitors')
            @else
                <div class="alerts">
                    {{ html()->info(__('Analytics is nog niet geconfigureerd')) }}
                </div>
            @endif

            @if(count($logItems))
                <h2>@lang('Recente activiteit')</h2>
                <table class="-datatable -compact">
                    <thead>
                    <tr>
                        <th>@lang('Tijdstip')</th>
                        <th>@lang('Beschrijving')</th>
                        <th>@lang('Gebruiker')</th>
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
                    @lang('Bekijk het hele log')
                </a>
            @endif
        </div>
    </section>
@endcomponent
