@component('front.layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])

    {!! $article->text !!}

    {!! schema()->company() !!}

    @include('front.contact.partials.form')

    @include('front.partials.downloads', ['item' => $article])

@endcomponent

