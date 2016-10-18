@extends('back._layouts.master')

@section('pageTitle', 'Dashboard')

@section('content')
    <section>
        <div class="grid">

            <h1>Dashboard</h1>

            @if (isset($visitors))
                @include('back.dashboard._partials.visitors')
            @else
                <div class="alerts">
                    {!! Html::info(fragment('back.statistics.notConfigured')) !!}
                </div>
            @endif

            @if(count($logItems))
                <h2>{{ fragment('back.log.recentActivity') }}</h2>
                <table class="-datatable -compact">
                    <thead>
                    <tr>
                        <th>{{ fragment('back.log.time') }}</th>
                        <th>{{ fragment('back.log.description') }}</th>
                        <th>{{ fragment('back.log.user') }}</th>
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
                <a href="{{ URL::action('Back\ActivitylogController@index') }}">{{ fragment('back.log.fullLog') }}</a>
            @endif
        </div>
    </section>
@endsection
