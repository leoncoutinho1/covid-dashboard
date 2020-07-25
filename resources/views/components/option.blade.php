<?php
    function compare_name($a, $b) {
        return strnatcmp($a->{'Country'}, $b->{'Country'});
    }

    usort($countries, 'compare_name');
?>
<div class='selectCountry'>
    <select id=countries onchange="setCountry()">
        <option value="">--Selecione um país--</option>
        @foreach ($countries as $c)
            <option 
                value="country/{{ $c->{'Slug'} }}"
            >
                {{ $c->{'ISO2'} }} - {{ $c->{'Country'} }}
            </option>
        @endforeach
    </select>
</div>

    