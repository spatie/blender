@component('front.layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    {!! $article->text !!}

     @include('front.partials.images', ['item' => $article])

     @include('front.partials.downloads', ['item' => $article])
@endcomponent
