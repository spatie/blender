
<h2>{{ trans('back-statistics.mostVisitedPages') }}</h2>

@if (count($pagesData))
    <table  class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ trans('back-statistics.page') }}</th>
        <th>{{ trans('back-statistics.numberOfVisitors') }}</th>
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
    {!! HTML::info(trans('back-statistics.noData')) !!}
@endif
