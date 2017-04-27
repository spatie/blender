@component('front._layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    @slot('mainTitle')
        <h1>{{ $article->name }}</h1>
    @endslot

    @slot('mainImages')
        @include('front._partials.images', ['item' => $article])
    @endslot

    @slot('mainDownloads')
        @include('front._partials.downloads', ['item' => $article])
    @endslot

    {!! $article->text !!}
@endcomponent
