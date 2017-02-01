@component('back._layouts.master', [
    'pageTitle' => fragment('back.tags.title'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.tags.title') }}</h1>
            <a href="{{ URL::action('Back\TagsController@create') }}" class="button">{{ fragment('back.tags.new') }}</a>

            <div class="alert--info -small h-margin-top">
                Zorg ervoor dat alle items van een tag ontkoppeld zijn alvorens hem te verwijderen.
            </div>

            @foreach($tags as $name => $type)
                <table data-sortable="{{ URL::action('Back\TagsController@changeOrder') }}">
                    <caption>{{ fragment("back.tags.types.{$name}") }}</caption>
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($type as $tag)

                        <tr data-row-id="{{ $tag->id }}">
                            <td>
                                <a href="{{ Url::action('Back\TagsController@edit', [$tag->id]) }}">
                                    {{ $tag->name }}
                                </a>
                            </td>
                            <td class="-remark">
                                @if($tag->taggable_count > 0)
                                    Gekoppeld aan {{ $tag->taggable_count }} item(s)
                                @endif
                            </td>
                            <td class="-right">
                                @if($tag->taggable_count === 0)
                                    {!! Html::deleteButton(action('Back\TagsController@destroy', $tag->id)) !!}
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            @endforeach

        </div>
    </section>

@endcomponent
