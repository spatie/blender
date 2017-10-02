<h2>Top browsers</h2>

@if (count($browsers))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>Browsers</th>
        <th>Sessions</th>
        </thead>
        <tbody>
        @foreach($browsers as $browser)
            <tr>
                <td>{{ $browser['browser'] }}</td>
                <td>{{ $browser['sessions'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert--info">
        There's no data available yet.
    </div>
@endif
