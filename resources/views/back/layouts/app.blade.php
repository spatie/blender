<!DOCTYPE html>
<html lang="{{ locale() }}">
@include('front.layouts.partials.hiddenCredits')
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('pageDescription')">
    <title>{{ isset($title) ? $title  . ' | ' : '' }} Blender</title>

    <link rel="stylesheet" href="{{ mix('css/back.css') }}">

    <script defer src="{{ mix('js/back.app.js') }}"></script>

    @include('front.layouts.partials.head.favicons')
</head>
<body>
    @auth
        @include('back.layouts.partials.menu')
        <div class="grid">
            @if(html()->flashMessage())
                <div class="h-margin-bottom">
                    {{ html()->flashMessage() }}
                </div>
            @endif
            <nav class="breadcrumbs">
                {{ $breadcrumbs ?? '' }}
            </nav>
        </div>
    @endauth
    <main class="main" id="app">
        {{ $slot }}
    </main>
    @auth
        @include('back.layouts.partials.footer')
    @endauth
</body>
</html>
