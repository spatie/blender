@component('back.layouts.app', [
    'title' => 'Tags',
])
    <section>
        <div class="grid">
            <h1>Tags</h1>

            <a href="{{ action('Back\TagsController@create') }}" class="button">
                New tag
            </a>

            <div class="alert--info h-margin-top">
                Make sure all associated items are removed from a tag before deleting it.
            </div>

            @foreach($tags as $name => $type)
                <table data-sortable="{{ action('Back\TagsController@changeOrder') }}">
                    <caption>
                        {{ __("back.tags.{$name}") }}
                    </caption>
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
                                <a href="{{ action('Back\TagsController@edit', [$tag->id]) }}">
                                    {{ $tag->name }}
                                </a>
                            </td>
                            <td class="-remark">
                                @if($tag->taggable_count)
                                    Associated to {{ $tag->taggable_count }} {{ $tag->taggable_count == 1 ? 'item' : 'items' }}
                                @endif
                            </td>
                            <td class="-right">
                                @if($tag->taggable_count === 0)
                                    {{ html()->deleteButton(action('Back\TagsController@destroy', $tag->id)) }}
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
