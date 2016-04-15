@extends('back._layouts.master')

@section('pageTitle', fragment('back.newsItems.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ fragment('back.newsItems.title') }}</h1>
        <a href="{{ action('Back\NewsItemController@create') }}" class="button">{{ fragment('back.newsItems.new') }}</a>

        <table data-datatable data-order='[[ 1, "desc" ]]'>
            <thead>
            <tr>
                <th>{{ fragment('back.newsItems.name') }}</th>
                <th>{{ fragment('back.newsItems.publish_date') }}</th>
                <th data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($newsItems as $newsItem)

                <tr data-row-id="{{ $newsItem->id }}">
                    <td>
                        {!! HTML::onlineIndicator($newsItem->online) !!}
                        <a href="{{ action('Back\NewsItemController@edit', [$newsItem->id]) }}">
                            {{ $newsItem->name }}
                        </a>
                    </td>
                    <td data-order="{{ $newsItem->publish_date }}">
                        {{ $newsItem->publish_date->format('d/m/Y') }}
                    </td>
                    <td class="-right">
                        {!! HTML::deleteButton(action('Back\NewsItemController@destroy', $newsItem->id)) !!}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
</section>
@stop
