<h2>{{ fragment('back.statistics.sources') }}</h2>
@if (count($referrerData))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.source') }}</th>
        <th>{{ fragment('back.statistics.numberOfVisitors') }}</th>
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
    {!! HTML::info(fragment('back.statistics.noData')) !!}
@endif

