@component('back._layouts.master', [
    'title' => __('Tags'),
])
    <section>
        <div class="grid">
            <h1>@lang('Tags')</h1>

            <a href="{{ action('Back\TagsController@create') }}" class="button">
                @lang('Nieuwe tag')
            </a>

            {{ html()->info()
                ->text(__('Zorg ervoor dat alle items van een tag ontkoppeld zijn alvorens hem te verwijderen.'))
                ->class('h-margin-top') }}

            @foreach($tags as $name => $type)
                <table data-sortable="{{ action('Back\TagsController@changeOrder') }}">
                    <caption>
                        {{ trans("back.tagTypes.{$name}") }}
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
                                    {{ __('Gekoppeld aan :amount item(s)', ['amount' => $tag->taggable_count]) }}
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
