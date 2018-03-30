<footer class="p-8 bg-grey-light text-grey-dark">
    <section>
        <strong>{{ __('company.name') }}</strong> <br>
        {{ __('company.address') }} <br>
        {{ __('company.postal') }} {{ __('company.city') }} <br>
        {{ __('company.country') }} <br>
        tel. <a href="tel:{{ __('company.telephone') }}">{{ __('company.telephone') }}</a>
        <a href="mailto:{{ __('company.email') }}">{{ __('company.email') }}</a>
        {!! schema()->company() !!}
    </section>
    <small>
        © {{ date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
    </small>
</footer>
