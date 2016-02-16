@extends('back.layout.master')

@section('pageTitle', 'Dashboard')

@section('content')
    <section>
        <div class="grid">

            <h1>Dashboard</h1>

            @if (isset($visitors))
                @include('back.dashboard._partials.visitors')
            @else
                <div class="alerts">
                    {!! HTML::info(trans('back-statistics.notConfigured')) !!}
                </div>
            @endif

            @if(count($logItems))
                <h2>{{ trans('back-log.recentActivity') }}</h2>
                <table class="-datatable -compact">
                    <thead>
                    <tr>
                        <th>{{ trans('back-log.time') }}</th>
                        <th>{{ trans('back-log.description') }}</th>
                        <th>{{ trans('back-log.user') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($logItems as $logItem)
                            <tr>
                                <td>{{ diff_date_for_humans($logItem->created_at) }}</td>
                                <td>{!! $logItem->text !!}</td>
                                <td>{!! ($logItem->user ? link_to_action('Back\BackUserController@edit', $logItem->user->present()->fullName, [$logItem->user->id]) : '') !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ URL::action('Back\ActivitylogController@index') }}">{{ trans('back-log.fullLog') }}</a>
            @endif
        </div>
    </section>
@endsection
