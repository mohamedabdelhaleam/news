<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>


    @include('components.website.css')

    @yield('css')

</head>

<body>
    @include('components.website.header')
    <main>
        @yield('content')
    </main>
    @yield('script')
    @include('components.website.scripts')
</body>

</html>
