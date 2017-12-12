@component('front._layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    @slot('mainDownloads')
        @include('front._partials.downloads', ['item' => $article])
    @endslot

    {!! $article->text !!}

    {!! schema()->company() !!}

    @include('front.contact._partials.form')
@endcomponent

