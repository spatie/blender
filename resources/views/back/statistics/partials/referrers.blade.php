<h2>Referrers</h2>
@if (count($referrers))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>Referrer</th>
        <th>Visitors</th>
        </thead>
        <tbody>
        @foreach($referrers as $referrer)
            <tr>
                <td>{{ $referrer['url'] }}</td>
                <td>{{ $referrer['pageViews'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert--info">
        There's no data available yet.
    </div>
@endif

