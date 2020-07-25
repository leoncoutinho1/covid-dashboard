<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <div>
            <p>População: {{ $countryInfo->{'population'} }}</p>
            <p>Capital: {{ $countryInfo->{'capital'} }}</p>
            <p>Região: {{ $countryInfo->{'region'} }}</p>
            <p>Day One em: {{ substr($dayOne, 8, 2).'-'.substr($dayOne, 5, 2).'-'.substr($dayOne, 0, 4) }}</p>
        </div>
        <img src="{{ $countryInfo->{'flag'} }}" alt="flag"/>
        @component('components.card', [
            'title' => 'Índices diários / Semana'
            ])
            @component('components.lineChart', [
                'dates' => $countryDataset['weekDates'],
                'values' => $countryDataset['weekConfirmedDaily'],
                'id' => 'weekDaily',
                'label' => 'Quadro geral diário',
                'bgColor' => 'rgb(205, 212, 228)',
                'borderColor' => 'rgb(145, 166, 180)'
            ])
            @endcomponent
        @endcomponent
        @component('components.card', [
            'title' => 'Índices Totais / Semana'
            ])
            @component('components.lineChart', [
                'dates' => $countryDataset['weekDates'],
                'values' => $countryDataset['weekConfirmedDaily'],
                'id' => 'weekTotal',
                'label' => 'Novos casos confirmados',
                'bgColor' => 'rgb(205, 212, 228)',
                'borderColor' => 'rgb(145, 166, 180)'
            ])
            @endcomponent
        @endcomponent
        @component('components.card', [
            'title' => 'Índices Totais / Mês'
            ])
            @component('components.lineChart', [
                'dates' => $countryDataset['weekDates'],
                'values' => $countryDataset['weekConfirmedDaily'],
                'id' => 'monthTotal',
                'label' => 'Novos casos confirmados',
                'bgColor' => 'rgb(205, 212, 228)',
                'borderColor' => 'rgb(145, 166, 180)'
            ])
            @endcomponent
        @endcomponent
    </body>
</html>