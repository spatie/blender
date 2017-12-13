@component('front._layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])

    {!! $article->text !!}

    {!! schema()->company() !!}

    @include('front.contact._partials.form')

    @include('front._partials.downloads', ['item' => $article])

@endcomponent

