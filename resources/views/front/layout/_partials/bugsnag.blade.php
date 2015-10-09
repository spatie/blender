@if(config('bugsnag.api_key_js') != '' && app()->environment() === 'production')
    <script src="//d2wy8f7a9ursnm.cloudfront.net/bugsnag-2.min.js"
            data-apikey="{{ config('bugsnag.api_key_js') }}"></script>
    <script>
        Bugsnag.releaseStage = "{{ getenv('APP_ENV') }}";
        @if($currentUser)
        Bugsnag.user = {
            id: {{ $currentUser->id }},
            email: "{{ $currentUser->email }}"
        };
        @endif
    </script>
@endif
