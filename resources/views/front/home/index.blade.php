@component('front.layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    @if($cover = $article->getFirstMedia('images'))
        <div class="banner" style="background-image: url('{{ $cover->getUrl() }}')" alt="{{ $cover->name }}">
        </div>
    @endif

    {!! $article->text !!}

@endcomponent

