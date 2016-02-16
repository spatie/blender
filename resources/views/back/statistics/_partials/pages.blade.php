
<h2>{{ fragment('back.statistics.mostVisitedPages') }}</h2>

@if (count($pagesData))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.page') }}</th>
        <th>{{ fragment('back.statistics.numberOfVisitors') }}</th>
        </thead>
        <tbody>
        @foreach($pagesData as $pageRow)
            <tr>
                <td>
                    {{ $pageRow['url'] }}
                </td>
                <td>
                    {{ $pageRow['pageViews'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! HTML::info(fragment('back.statistics.noData')) !!}
@endif
