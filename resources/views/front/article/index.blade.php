@component('front._layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    {!! $article->text !!}

     @include('front._partials.images', ['item' => $article])

     @include('front._partials.downloads', ['item' => $article])
@endcomponent
