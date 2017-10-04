<h2>Most visited pages</h2>

@if(count($pages))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>Page</th>
        <th>Visitors</th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page['url'] }}</td>
                <td>{{ $page['pageViews'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert--info">
        There's no data available yet.
    </div>
@endif
