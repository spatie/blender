<h2>@lang('Meest bezochte pagina\'s')</h2>

@if(count($pages))
    <table class="-compact" data-datatable data-order='[[ 1, "desc" ]]'>
        <thead>
        <th>@lang('Pagina')</th>
        <th>@lang('Aantal bezoekers')</th>
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
    {{ html()->info(__('Er zijn nog geen gegevens beschikbaar.')) }}
@endif
