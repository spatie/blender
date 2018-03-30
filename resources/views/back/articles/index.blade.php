@component('back.layouts.app', [
    'title' => 'Articles',
])
    <section>
        <div class="grid">
            <h1>Articles</h1>

            <a href="{{ action('Back\ArticlesController@create') }}" class="button">
                New article
            </a>

            <table data-sortable="{{ action('Back\ArticlesController@changeOrder') }}">
                <thead>
                <tr>
                    <th>Name</th>
                    <th data-orderable="false"></th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($models as $article)
                    <tr data-row-id="{{ $article->id }}">
                        <td>
                            {{ html()->onlineIndicator($article->online) }}
                            <a href="{{ action('Back\ArticlesController@edit', [$article->id]) }}">
                                {{ $article->translate('name', content_locale()) }}
                            </a>
                        </td>
                        <td class="-remark">
                            @if($article->parent)
                                Child of "{{ $article->parent->name }}"
                            @endif
                        </td>
                        <td class="-right">
                            @if(! $article->isSpecialArticle())
                                {{ html()->deleteButton(action('Back\ArticlesController@destroy', $article->id)) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endcomponent
