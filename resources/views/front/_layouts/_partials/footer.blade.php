<footer class="footer h-padding h-align-center">
    <section>
        <strong>@lang('company.name')</strong> <br>
        @lang('company.address') <br>
        @lang('company.postal') @lang('company.city') <br>
        @lang('company.country') <br>
        tel. <a href="tel:@lang('company.telephone')">@lang('company.telephone')</a>
        <a href="mailto:@lang('company.email')">@lang('company.email')</a>
        {!! schema()->company() !!}
    </section>

    <small>
        © {{ date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
    </small>
</footer>
