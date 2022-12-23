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

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/awesome-notifications/3.1.1/modern.min.js" integrity="sha512-PjlyZT7z5pyhvudKh6rGlxvHKGow4MEDGVehJtjZTjrVvXlpuMt2wmna/PnUnNSWYsgqXuzM86tu9v4+rNHsSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    function dataApp() {
        return {
            init(){

            },
            navigateTo(link) {
                window.location.assign(link);
            },
        }
    };
</script>
