@component('front._layouts.main', [
    'title' => $article->seo('title'),
    'seo' => $article->renderSeoTags(),
    'subMenu' => Menu::articleSiblings($article),
])

    @slot('mainTitle')
        <h1>{{ $article->name }}</h1>
    @endslot

    @slot('mainDownloads')
        @include('front._partials.downloads', ['item' => $article])
    @endslot

    @include('front.contact._partials.form')

@endcomponent

