<h2>{{ fragment('back.statistics.sources') }}</h2>
@if (count($referrers))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.source') }}</th>
        <th>{{ fragment('back.statistics.numberOfVisitors') }}</th>
        </thead>
        <tbody>
        @foreach($referrers as $referrer)
            <tr>
                <td>
                    {{ $referrer['url'] }}
                </td>
                <td>
                    {{ $referrer['pageViews'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! Html::info(fragment('back.statistics.noData')) !!}
@endif

