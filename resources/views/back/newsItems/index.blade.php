@extends('back.layout.master')

@section('pageTitle', trans('back-newsItems.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ trans('back-newsItems.title') }}</h1>
        <a href="{{ action('Back\NewsItemController@create') }}" class="button">{{ trans('back-newsItems.new') }}</a>

        <table data-datatable data-order='[[ 0, "asc" ]]'>
            <thead>
            <tr>
                <th>{{ trans('back-newsItems.name') }}</th>
                <th>{{ trans('back-newsItems.publish_date') }}</th>
                <th data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($newsItems as $newsItem)

                <tr data-row-id="{{ $newsItem->id }}">
                    <td>
                        <a href="{{ action('Back\NewsItemController@edit', [$newsItem->id]) }}">{{ $newsItem->translate(content_locale())->name }}</a>
                    </td>
                    <td data-order="{{ $newsItem->publish_date }}">
                        {{ $newsItem->publish_date->format('d/m/Y') }}
                    </td>
                    <td class="-right">
                        {!! HTML::formButton(action('Back\NewsItemController@destroy', [$newsItem->id]), '<span class="fa fa-remove"></span>', 'delete',
                            [
                                'class'=>'button -danger -small',
                                'id'=> 'delete_newsItem_' . $newsItem->id
                            ]
                        )!!}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
</section>
@stop
