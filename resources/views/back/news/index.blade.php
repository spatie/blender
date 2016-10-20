@extends('back._layouts.master')

@section('pageTitle', fragment('back.news.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ fragment('back.news.title') }}</h1>
        <a href="{{ action('Back\NewsController@create') }}" class="button">
            {{ fragment('back.news.new') }}
        </a>
        <table data-datatable data-order='[[ 1, "desc" ]]'>
            <thead>
            <tr>
                <th>{{ fragment('back.news.name') }}</th>
                <th>{{ fragment('back.news.publish_date') }}</th>
                <th data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $newsItem)
                <tr data-row-id="{{ $newsItem->id }}">
                    <td>
                        {!! Html::onlineIndicator($newsItem->online) !!}
                        <a href="{{ action('Back\NewsController@edit', [$newsItem->id]) }}">
                            {{ $newsItem->name }}
                        </a>
                    </td>
                    <td data-order="{{ $newsItem->publish_date }}">
                        {{ $newsItem->publish_date->format('d/m/Y') }}
                    </td>
                    <td class="-right">
                        {!! Html::deleteButton(action('Back\NewsController@destroy', $newsItem->id)) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
@stop
