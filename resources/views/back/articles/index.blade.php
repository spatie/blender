@extends('back._layouts.master')

@section('pageTitle', fragment('back.articles.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.articles.title') }}</h1>
            <a href="{{ action('Back\ArticlesController@create') }}"
               class="button">{{ fragment('back.articles.new') }}</a>

            <table data-sortable="{{ action('Back\ArticlesController@changeOrder') }}">
                <thead>
                <tr>
                    <th>{{ fragment('back.articles.name') }}</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($models as $article)
                    <tr data-row-id="{{ $article->id }}">
                        <td>
                            {!! Html::onlineIndicator($article->online) !!}
                            <a href="{{ action('Back\ArticlesController@edit', [$article->id]) }}">{{ $article->translate('name', content_locale()) }}</a>
                        </td>
                        <td class="-right">
                            @if(! $article->isSpecialArticle())
                                {!! Html::deleteButton(action('Back\ArticlesController@destroy', $article->id)) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    </section>
@stop
