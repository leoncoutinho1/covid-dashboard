<div>
    <p>População: {{ $countryInfo->{'population'} }}</p>
    <p>Capital: {{ $countryInfo->{'capital'} }}</p>
    <p>Região: {{ $countryInfo->{'region'} }}</p>
</div>
<img src="{{ $countryInfo->{'flag'} }}" alt="flag">