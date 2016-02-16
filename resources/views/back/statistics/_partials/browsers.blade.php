<h2>{{ fragment('back.statistics.mostUsedBrowsers') }}</h2>
@if (count($browserData))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>{{ fragment('back.statistics.browsers') }}</th>
        <th>{{ fragment('back.statistics.sessions') }}</th>
        </thead>
        <tbody>
        @foreach($browserData as $browserRow)
            <tr>
                <td>
                    {{ $browserRow['browser'] }}
                </td>
                <td>
                    {{ $browserRow['sessions'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

   {{--
@section('extraJs')
    @parent
    <script>
        (function() {
            var ctx = document.getElementById('browserChart').getContext('2d');
            var data = [
                @foreach($browserData as $browserRow)
                {
                    value: {!! $browserRow['sessions'] !!},
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: '{!! $browserRow['browser'] !!}'
                },
                @endforeach
            ]

            new Chart(ctx).Pie(data, {});

        })();
    </script>
    @stop
--}}
@else
    {!! HTML::info(fragment('back.statistics.noData')) !!}
@endif
