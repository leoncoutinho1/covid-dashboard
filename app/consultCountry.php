<?php

    function consultCountry($country) {
        $countries = consultApi("https://api.covid19api.com/countries");
            
        if(!isset($country)) {
            $country = 'brazil';
        }
                        
        $data = consultApi("https://api.covid19api.com/total/country/$country");
                                
        $index = array_search($country, array_column($countries, 'Slug'));
        $iso2 = $countries[$index]->{'ISO2'};

        $countryInfo = consultApi("https://restcountries.eu/rest/v2/alpha/$iso2");
        if (count($data) > 0) {
            $countryDataset = getCountryDataset($data);
            $currentConfirmed = end($countryDataset['weekConfirmedTotal']);
            $currentDeaths = end($countryDataset['weekDeathsTotal']);
            $dayOne = $countryDataset['dayOne'];
        } else {
            $countryDataset = null;
            $currentConfirmed = null;
            $currentDeaths = null;
            $dayOne = null;
        }

        return [
            'countryInfo' => $countryInfo,
            'countryDataset' => $countryDataset,
            'currentConfirmed' => $currentConfirmed,
            'currentDeaths' => $currentDeaths,
            'dayOne' => $dayOne,
            'countries' => $countries
        ];
    }