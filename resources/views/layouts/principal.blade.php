<!DOCTYPE html>
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
        <div class="aside">
            @component('components.option', [
                    'countries' => $countries
                ])
            @endcomponent
            @component('components.card', [
                'title' => ($countryInfo->{'alpha2Code'}.' - '.$countryInfo->{'alpha3Code'}.' - '.$countryInfo->{'name'})
                ])
                @component('components.countryInfo', [
                    'dayOne' => (isset($countryDataset) ? $countryDataset['dayOne'] : '-/-'),
                    'countryInfo' => $countryInfo,
                    'currentConfirmed' => $currentConfirmed,
                    'currentDeaths' => $currentDeaths
                ])
                @endcomponent
            @endcomponent
            @if(isset($countryDataset))
                @component('components.card', [
                    'title' => 'Informações adicionais'
                    ])
                    <div>
                    <p>Casos por milhões de habitantes: {{ round($currentConfirmed / ($countryInfo->{'population'} / 1000000 ), 0) }}</p>
                    <p>Mortes por milhões de habitantes: {{ round($currentDeaths / ($countryInfo->{'population'} / 1000000 ), 0) }}</p>
                    </div>
                @endcomponent
                @component('components.card', [
                    'title' => 'Mortes versus Casos'
                    ])
                    @component('components.piechart', [
                        'id' => 'deathsByConfirmed',
                        'labels' => ['Mortes', 'Casos'],
                        'values' => [$currentDeaths, $currentConfirmed]
                    ])
                    @endcomponent
                @endcomponent
            @endif
        </div>
        <div class="dashboard">
            @if(isset($countryDataset))
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
            @else
                <div id='noDataMessage'>
                    <p>A base não possui dados deste país referentes à COVID19.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
