<h2>@lang('Bronnen')</h2>
@if (count($referrers))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>@lang('Bron')</th>
        <th>@lang('Aantal bezoekers')</th>
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
    {{ html()->info(__('Er zijn nog geen gegevens beschikbaar.')) }}
@endif

