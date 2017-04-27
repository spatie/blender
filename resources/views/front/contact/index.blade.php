@component('front._layouts.main', [
    'meta' => $article->meta(),
    'subMenu' => Menu::articleSiblings($article),
])
    @slot('mainTitle')
        <h1>{{ $article->name }}</h1>
    @endslot

    @slot('mainDownloads')
        @include('front._partials.downloads', ['item' => $article])
    @endslot

    <section>
        <a href="mailto:{{ __('company.email') }}">{{ __('company.email') }}</a> <br>
        tel. <a href="tel:{{ __('company.telephone') }}">{{ __('company.telephone') }}</a> <br>
        fax. <a href="{{ __('company.fax') }}">{{ __('company.fax') }}</a> <br>
        See <a href="#">individual contact details below</a>
        {{ __('company.name') }} <br>
        {{ __('company.address') }} <br>
        {{ __('company.postal') }} {{ __('company.city') }} <br>
        {{ __('company.country') }} <br>
        {!! schema()->company() !!}
    </section>

    @include('front.contact._partials.form')
@endcomponent

