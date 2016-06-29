@extends('back._layouts.master')

@section('pageTitle', 'Log')

@section('content')

    <section>
        <div class="grid">
            <h1>Log</h1>

            {!! $logItems->render() !!}

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
                        <td>{!! ($logItem->causer ? link_to_action('Back\BackUserController@edit', $logItem->causer->email, [$logItem->causer->id]) : '') !!}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>

            {!! $logItems->render() !!}
        </div>
    </section>

@stop
