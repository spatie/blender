@extends('front._layouts.master')



@section('main')
    <main class="h-padding-medium">
        <div class="grid">
            <div class="grid__col">
                @yield('mainTitle')

                @yield('mainImages')

                @yield('mainContent')

                @yield('mainDownloads')
            </div>
        </div>
    </main>
@endsection
