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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="{{ asset('css/relatorio.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <div id='info'>
            <div>
                <h3>{{ $countryInfo->{'alpha2Code'}.' - '.$countryInfo->{'alpha3Code'}.' - '.$countryInfo->{'name'} }}</h1>
                <p>Capital: {{ $countryInfo->{'capital'} }}</p>
                <p>Região: {{ $countryInfo->{'region'} }}</p>
                <p>Sub-região: {{ $countryInfo->{'subregion'} }}</p>
                <p>Nome nativo: {{ $countryInfo->{'nativeName'} }}</p>
                <p>População: {{ formatadorDeMilhar($countryInfo->{'population'}) }}</p>
                <p>Total de casos confirmados: {{ formatadorDeMilhar($currentConfirmed) }}</p>
                <p>Total de mortes: {{ formatadorDeMilhar($currentDeaths) }}</p>
                <p>Day One em: {{ convertDateWithYear($dayOne) }}</p>
                <p>Casos por milhões de habitantes: {{ round($currentConfirmed / ($countryInfo->{'population'} / 1000000 ), 0) }}</p>
                <p>Mortes por milhões de habitantes: {{ round($currentDeaths / ($countryInfo->{'population'} / 1000000 ), 0) }}</p>
                <img src="{{ $countryInfo->{'flag'} }}" alt="flag" id="flag"/>
            </div>
            <div class='column'>
                @foreach($charts as $chart)
                    @component('components.lineChart', [
                        'chart' => $chart
                    ])
                    @endcomponent
                @endforeach
            </div>           
        </div>
    </body>
</html>