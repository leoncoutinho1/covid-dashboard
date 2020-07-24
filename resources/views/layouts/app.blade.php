<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noticia+Text:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">
    <link href="{{ asset('css/option.css') }}" rel="stylesheet">
</head>
<body>
    @component('layouts.header')
    @endcomponent
    <div id='content'>
        <div id='aside'>
            @component('components.option', [
                    'countries' => $countries
                ])
            @endcomponent

            @component('components.card', [
                'title' => ($countryInfo->{'alpha2Code'}.' - '.$countryInfo->{'alpha3Code'}.' - '.$countryInfo->{'name'})
                ])
                @component('components.countryInfo', [
                    'countryInfo' => $countryInfo
                ])
                @endcomponent
            @endcomponent
        </div>
        <div id='dashboard'>
            @component('components.card', [
                'title' => 'Line Chart'
                ])
                @component('components.lineChart', [
                    'countryDataset' => $countryDataset
                ])
                @endcomponent
            @endcomponent
        </div>
    </div>
</body>
</html>