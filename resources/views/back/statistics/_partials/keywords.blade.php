<h2>{{ trans('back-statistics.mostUsedKeywords') }}</h2>
@if (count($keywordData))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ trans('back-statistics.keyword') }}</th>
        <th>{{ trans('back-statistics.visits') }}</th>
        </thead>
        <tbody>
        @foreach($keywordData as $keywordRow)
            <tr>
                <td>
                    {{ $keywordRow['keyword'] }}
                </td>
                <td>
                    {{ $keywordRow['sessions'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! HTML::info(trans('back-statistics.noData')) !!}
@endif

