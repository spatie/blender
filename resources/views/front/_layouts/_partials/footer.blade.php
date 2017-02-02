<section>
    <strong>{{ fragment('company.name') }}</strong> <br>
    {{ fragment('company.address') }} <br>
    {{ fragment('company.postal') }} {{ fragment('company.city') }} <br>
    {{ fragment('company.country') }} <br>
    tel. <a href="tel:{{ fragment('company.telephone') }}">{{ fragment('company.telephone') }}</a>
    <a href="mailto:{{ fragment('company.email') }}">{{ fragment('company.email') }}</a>
    {!! schema()->company() !!}
</section>

<footer class="footer h-padding h-align-center">
    <small>
        © {{ date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
    </small>
</footer>
