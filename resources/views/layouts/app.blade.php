<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesome-notifications/3.1.1/style.min.css" integrity="sha512-OFAsS5R1Fx+HUK9/h/ChqnFDrJGI0Y7nO05gg9E+Mv1UAzvAMvQdtOuPLhgPgDPHOgKWBvbovxT3eQSCr5hlLw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

        <!-- Scripts -->
        <script src="{{ URL::asset('messages.js') }}" ></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/awesome-notifications/3.1.1/modern.min.js" integrity="sha512-PjlyZT7z5pyhvudKh6rGlxvHKGow4MEDGVehJtjZTjrVvXlpuMt2wmna/PnUnNSWYsgqXuzM86tu9v4+rNHsSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js" integrity="sha512-G3jAqT2eM4MMkLMyQR5YBhvN5/Da3IG6kqgYqU9zlIH4+2a+GuMdLb5Kpxy6ItMdCfgaKlo2XFhI0dHtMJjoRw==" crossorigin="anonymous"></script> --}}

    </head>
    <body class="font-sans antialiased" x-data="dataApp()" x-cloak>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

<script type="text/javascript">
    let user_id = "{{ Auth::user()->id }}";
    let username = "{{ Auth::user()->name }}";
    let locale = "{{ app()->getLocale() ?? 'en' }}";

    function dataApp() {
        return {
            init() {
            },
            navigateTo(link) {
                window.location.assign(link);
            },
        }
    };
</script>
