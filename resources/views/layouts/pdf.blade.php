<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            background-color: #fff;
            color: #3e494e;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .content table {
            margin: 0 auto;
        }

        .content table tr th {
            padding: 3px;
            border: 1px solid rgb(52, 99, 138);
            width: 600px;
        }

        .content table tr td:first-child {
            width: 350px;
        }

        .content table tr:nth-child(even) {
            background-color: rgb(204, 204, 204)
        }

    </style>
</head>
<body>
<div class="content">
    <table>
        <tr>
            <th colspan='2'><h3>{{ $countryInfo->{'alpha2Code'}.' - '.$countryInfo->{'alpha3Code'}.' - '.$countryInfo->{'name'} }}</h1></th>
        </tr>
        <tr><td>Capital: </td><td>{{ $countryInfo->{'capital'} }}</td></tr>
        <tr><td>Região: </td><td>{{ $countryInfo->{'region'} }}</td></tr>
        <tr><td>Sub-região: </td><td>{{ $countryInfo->{'subregion'} }}</td></tr>
        <tr><td>Nome nativo: </td><td>{{ $countryInfo->{'nativeName'} }}</td></tr>
        <tr><td>População: </td><td>{{ formatadorDeMilhar($countryInfo->{'population'}) }}</td></tr>
        <tr><td>Área: </td><td>{{ formatadorDeMilhar($countryInfo->{'area'}) }}km<sup>2</sup></td></tr>
        <tr><td>Habitantes por km<sup>2</sup>: </td><td>{{ round($countryInfo->{'population'} / $countryInfo->{'area'}, 2) }}</td></tr>
        <tr><td>Total de casos confirmados: </td><td>{{ formatadorDeMilhar($currentConfirmed) }}</td></tr>
        <tr><td>Total de recuperados: </td><td>{{ formatadorDeMilhar($currentRecovered) }}</td></tr>
        <tr><td>Total de mortes: </td><td>{{ formatadorDeMilhar($currentDeaths) }}</td></tr>
        <tr><td>Day One em: </td><td>{{ convertDateWithYear($dayOne) }}</td></tr>
        <tr><td>Casos por milhões de habitantes: </td><td>{{ round($currentConfirmed / ($countryInfo->{'population'} / 1000000 ), 0) }}</td></tr>
        <tr><td>Mortes por milhões de habitantes: </td><td>{{ round($currentDeaths / ($countryInfo->{'population'} / 1000000 ), 0) }}</td></tr>
    </table> 
</div>
</body>
</html>
