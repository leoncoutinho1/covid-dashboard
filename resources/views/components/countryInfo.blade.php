<div class='info'>
    <div>
        <p>População: {{ formatadorDeMilhar($countryInfo->{'population'}) }}</p>
        <p>Capital: {{ $countryInfo->{'capital'} }}</p>
        <p>Região: {{ $countryInfo->{'region'} }}</p>
        <p>Day One em: {{ substr($dayOne, 8, 2).'-'.substr($dayOne, 5, 2).'-'.substr($dayOne, 0, 4) }}</p>
    </div>
    <img src="{{ $countryInfo->{'flag'} }}" alt="flag"/>
</div>