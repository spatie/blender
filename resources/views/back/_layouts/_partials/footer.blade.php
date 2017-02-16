<footer class="footer">
    <div class="grid">
        <div class="footer__border">
            <div class="footer__version">
                <img src="/images/svg/blender.svg" class="footer__brand">
                <a href="https://github.com/spatie-custom/blender" target="blender">
                    Blender v. <span title="Laravel v. {{ app()->version() }}">{{ config('blender.version') }}</span>
                </a> – @lang('sinds') {{ config('blender.installDate') }}
                @if(app()->environment() == 'production')
                    <span class="footer__status -production">
                        @lang('Productie')
                    </span>
               @else
                    <span class="footer__status -non-production">
                        @lang('Testomgeving')
                    </span>
               @endif
            </div>
            <div class="footer__colofon">
                <a href="https://spatie.be" target="blender">© {{ roman_year() }} spatie.be</a>
            </div>
        </div>
    </div>
</footer>
