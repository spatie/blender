<h2>{{ trans('back-statistics.sources') }}</h2>
@if (count($referrerData))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ trans('back-statistics.source') }}</th>
        <th>{{ trans('back-statistics.numberOfVisitors') }}</th>
        </thead>
        <tbody>
        @foreach($referrerData as $referrerRow)
            <tr>
                <td>
                    {{ $referrerRow['url'] }}
                </td>
                <td>
                    {{ $referrerRow['pageViews'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! HTML::info(trans('back-statistics.noData')) !!}
@endif

