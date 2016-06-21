<h2>{{ fragment('back.statistics.mostUsedBrowsers') }}</h2>

@if (count($browsers))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.browsers') }}</th>
        <th>{{ fragment('back.statistics.sessions') }}</th>
        </thead>
        <tbody>
        @foreach($browsers as $browser)
            <tr>
                <td>
                    {{ $browser['browser'] }}
                </td>
                <td>
                    {{ $browser['sessions'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    {!! HTML::info(fragment('back.statistics.noData')) !!}
@endif
