<h2>{{ fragment('back.statistics.mostUsedKeywords') }}</h2>
@if (count($keywordData))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.keyword') }}</th>
        <th>{{ fragment('back.statistics.visits') }}</th>
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
    {!! HTML::info(fragment('back.statistics.noData')) !!}
@endif

