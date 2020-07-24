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
                'title' => 'Novos casos confirmados / semana'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['weekDates'],
                    'values' => $countryDataset['weekConfirmedDaily'],
                    'id' => 'weekConfirmedDaily',
                    'label' => 'Novos casos confirmados',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
            @component('components.card', [
                'title' => 'Número de mortes / semana'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['weekDates'],
                    'values' => $countryDataset['weekDeathsDaily'],
                    'id' => 'weekDeathsDaily',
                    'label' => 'Número de mortes',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
            @component('components.card', [
                'title' => 'Total de casos confirmados / semana'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['weekDates'],
                    'values' => $countryDataset['weekConfirmedTotal'],
                    'id' => 'weekConfirmedTotal',
                    'label' => 'Total de casos confirmados',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
            @component('components.card', [
                'title' => 'Total de mortes / semana'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['weekDates'],
                    'values' => $countryDataset['weekDeathsTotal'],
                    'id' => 'weekDeathsTotal',
                    'label' => 'Total de mortes',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
            @component('components.card', [
                'title' => 'Total de casos confirmados / mês'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['mounthDates'],
                    'values' => $countryDataset['mounthConfirmed'],
                    'id' => 'mounthConfirmed',
                    'label' => 'Total de casos confirmados',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
            @component('components.card', [
                'title' => 'Total de mortes / mês'
                ])
                @component('components.lineChart', [
                    'dates' => $countryDataset['mounthDates'],
                    'values' => $countryDataset['mounthDeaths'],
                    'id' => 'mounthDeaths',
                    'label' => 'Total de mortes',
                    'bgColor' => 'rgb(205, 212, 228)',
                    'borderColor' => 'rgb(145, 166, 180)'
                ])
                @endcomponent
            @endcomponent
        </div>
    </div>
</body>
</html>
