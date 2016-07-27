
<h2>{{ fragment('back.statistics.mostVisitedPages') }}</h2>

@if (count($pages))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.page') }}</th>
        <th>{{ fragment('back.statistics.numberOfVisitors') }}</th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>
                    {{ $page['url'] }}
                </td>
                <td>
                    {{ $page['pageViews'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! Html::info(fragment('back.statistics.noData')) !!}
@endif
