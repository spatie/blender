<footer class="footer">
    <div class="grid">
        <div class="footer__border">
            <div class="footer__version">
                <img src="/images/svg/blender.svg" class="footer__brand"> <a href="https://github.com/spatie-custom/blender"  target="blender">Blender v. <span title="Laravel v. {{ app()->version() }}">{{ config('blender.version') }}</span></a> – {{ fragment('back.since') }} {{ config('blender.installDate') }}
                <span class="footer__status {{ app()->environment() == 'production' ? ' -production' : '-non-production' }}">
                    {{  fragment('back.environment.' . (app()->environment() == 'production' ? 'production' : 'test')) }}
                </span>
            </div>
            <div class="footer__colofon">
                <a href="https://spatie.be" target="blender">© {{ roman_year() }} spatie.be</a>
            </div>
        </div>
    </div>
</footer>
