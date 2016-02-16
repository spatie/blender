@extends('back.layout.master')

@section('pageTitle', fragment('back.tags.title'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.tags.title') }}</h1>
            <a href="{{ URL::action('Back\TagController@create') }}" class="button">{{ fragment('back.tags.new') }}</a>

            @foreach($tags as $name => $type)



                <table data-sortable="{{ URL::action('Back\TagController@changeOrder') }}">
                    <caption>{{ trans("back-tags.types.{$name}") }}</caption>
                    <thead>
                    <tr>
                        <th></th>
                        <th data-orderable="false"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($type as $tag)

                        <tr data-row-id="{{ $tag->id }}" >
                            <td>
                                <a href="{{ Url::action('Back\TagController@edit', [$tag->id]) }}">{{ $tag->translate(content_locale())->name }}</a>
                            </td>
                            <td class="-right">
                                {!! HTML::formButton(URL::action('Back\TagController@destroy', [$tag->id]), '<span class="fa fa-remove"></span>', 'delete',
                                    [
                                        'class'=>'button -danger -small',
                                        'id'=> 'delete_tag_' . $tag->id
                                    ]
                                )!!}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            @endforeach

        </div>
    </section>
@stop
