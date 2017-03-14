<h2>@lang('Meeste gebruikte browsers')</h2>

@if (count($browsers))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>@lang('Browsers')</th>
        <th>@lang('Sessies')</th>
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
    {{ html()->info(__('Er zijn nog geen gegevens beschikbaar.')) }}
@endif
