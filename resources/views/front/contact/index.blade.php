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

    <section>
        <a href="mailto:{{ fragment('company.email') }}">{{ fragment('company.email') }}</a> <br>
        tel. <a href="tel:{{ fragment('company.telephone') }}">{{ fragment('company.telephone') }}</a> <br>
        fax. <a href="{{ fragment('company.fax') }}">{{ fragment('company.fax') }}</a> <br>
        See <a href="#">individual contact details below</a>
        {{ fragment('company.name') }} <br>
        {{ fragment('company.address') }} <br>
        {{ fragment('company.postal') }} {{ fragment('company.city') }} <br>
        {{ fragment('company.country') }} <br>
        {!! schema()->company() !!}
    </section>

    @include('front.contact._partials.form')
@endcomponent

