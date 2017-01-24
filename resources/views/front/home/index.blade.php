@component('front._layouts.main', [
    'title' => $article->seo('title'),
    'seo' => $article->renderSeoTags(),
    'subMenu' => Menu::articleSiblings($article),
])

    @slot('mainTitle')
        <h1>{{ $article->name }}</h1>
    @endslot

    @slot('mainImages')
        @if($cover = $article->getFirstMedia('images'))
            <img src="{{ $cover->getUrl('thumb') }}" alt="{{ $cover->name }}">
        @endif
    @endslot

    @slot('mainDownloads')
        @include('front._partials.downloads',  ['item' => $article])
    @endslot

    {!! $article->text !!}

@endcomponent

