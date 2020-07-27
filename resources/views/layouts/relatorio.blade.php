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
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">
    <link href="{{ asset('css/option.css') }}" rel="stylesheet">
    <link href="{{ asset('css/relatorio.css') }}" rel="stylesheet">
</head>
<body>
    @component('layouts.header', [
        'country' => $country
    ])
    @endcomponent
    <div id='content'>
        <div class="aside">
            @component('components.option', [
                    'countries' => $countries,
                    'page' => 'report'
                ])
            @endcomponent
            @component('components.card', [
                'title' => ($countryInfo->{'alpha2Code'}.' - '.$countryInfo->{'alpha3Code'}.' - '.$countryInfo->{'name'})
                ])
                @component('components.countryInfo', [
                    'dayOne' => (isset($dayOne) ? $dayOne : '-/-'),
                    'countryInfo' => $countryInfo,
                    'currentConfirmed' => $currentConfirmed,
                    'currentDeaths' => $currentDeaths
                ])
                @endcomponent
            @endcomponent
            @if(isset($dayOne))
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
                @component('components.card', [
                    'title' => 'Selecionar datas'
                    ])
                    <input type="date" name="beginDate" id="beginDate" value='{{$beginDate}}' min={{reset($daily['date'])}} max={{end($daily['date'])}}>     
                    <input type="date" name="endDate" id="endDate" value='{{$endDate}}' min={{reset($daily['date'])}} max={{end($daily['date'])}}>
                    <input type='hidden' id='country' value='{{$country}}'>
                    <div id="btnSearch" onclick="search()">Pesquisar</div>
                @endcomponent
            @endif
        </div>
        <div class="dashboard">
            @if(isset($dayOne))
                                                             
                @component('components.card', [
                    'title' => 'Novos casos confirmados'
                    ])
                    @component('components.barChart', [
                        'id' => 'confirmed',
                        'dates' => $daily['date'],
                        'values' => $daily['confirmed'],
                        'text' => 'Novos casos confirmados',
                        'label' => 'Casos confirmados',
                        'beginDate' => $beginDate,
                        'endDate' => $endDate
                    ])
                    @endcomponent
                @endcomponent
                @component('components.card', [
                    'title' => 'Mortes diárias'
                    ])
                    @component('components.barChart', [
                        'id' => 'deaths',
                        'dates' => $daily['date'],
                        'values' => $daily['deaths'],
                        'text' => 'Mortes diárias',
                        'label' => 'Mortes',
                        'beginDate' => $beginDate,
                        'endDate' => $endDate
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
    @component('layouts.footer')
    @endcomponent
</body>
</html>
