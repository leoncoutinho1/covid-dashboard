<?php

    function consultCountry($country) {
        $expiration = 720; //minutos

        $countries = Cache::remember('countries', $expiration, function() {
            return consultApi("https://api.covid19api.com/countries");
        });
            
        if(!isset($country)) {
            $country = 'brazil';
        }
                        
        $data = Cache::remember($country, $expiration, function() use ($country) {
            return consultApi("https://api.covid19api.com/total/country/$country");
        });
                                
        $index = array_search($country, array_column($countries, 'Slug'));
        $iso2 = $countries[$index]->{'ISO2'};

        $countryInfo = Cache::remember($country.'Info', $expiration, function() use ($iso2) {
            return consultApi("https://restcountries.eu/rest/v2/alpha/$iso2");
        });

        if (count($data) > 0) {
            $countryDataset = getCountryDataset($data);
            $currentConfirmed = end($countryDataset['weekConfirmedTotal']);
            $currentRecovered = end($countryDataset['weekRecoveredTotal']);
            $currentDeaths = end($countryDataset['weekDeathsTotal']);
            $dayOne = $countryDataset['dayOne'];
        } else {
            $countryDataset = null;
            $currentConfirmed = null;
            $currentDeaths = null;
            $dayOne = null;
        }
        
        return [
            'data' => $data,
            'country' => $country,
            'countryInfo' => $countryInfo,
            'countryDataset' => $countryDataset,
            'currentConfirmed' => $currentConfirmed,
            'currentRecovered' => $currentRecovered,
            'currentDeaths' => $currentDeaths,
            'dayOne' => $dayOne,
            'countries' => $countries
        ];
    }