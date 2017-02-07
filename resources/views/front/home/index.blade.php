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
            <div class="banner" style="background-image: url('{{ $cover->getUrl() }}')" alt="{{ $cover->name }}">
            </div>
        @endif
    @endslot

    @slot('mainDownloads')
        @include('front._partials.downloads',  ['item' => $article])
    @endslot

    {!! $article->text !!}

@endcomponent

