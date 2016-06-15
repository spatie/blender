<footer class="footer">
    <div class="grid">
        <div class="footer_border">
            <div class="footer_version">
                <img src="/images/svg/blender.svg" class="footer_brand"> <a href="https://github.com/spatie-custom/blender"  target="blender">Blender v. <span title="Laravel v. {{ app()->version() }}">{{ config('blender.version') }}</span></a> – {{ fragment('back.since') }} {{ config('blender.installDate') }}
                <span class="footer_status {{ app()->environment() == 'production' ? ' -production' : '-non-production' }}">
                    {{  fragment('back.environment.' . (app()->environment() == 'production' ? 'production' : 'test')) }}
                </span>
            </div>
            <div class="footer_colofon">
                <a href="https://spatie.be" target="blender">© {{ roman_year() }} spatie.be</a>
            </div>
        </div>
    </div>
</footer>
