<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use PDF;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this::middleware('auth');
    }

    public function geraPdf($countryInfo, $countryDataset) {
        
        $name = 'relatCovid'.$countryInfo->name;
        $pdf = PDF::loadview('layouts.pdf', [
            'countryInfo' => $countryInfo,
            'countryDataset' => $countryDataset
        ]);
        return $pdf->setPaper('a4')->stream($name);
    }

    public function principal($country=null, $pdf=null) {
        $title = 'Painel COVID-19';
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
        }       

        if ($pdf == 'pdf') {
            $this::geraPdf($countryInfo, $countryDataset);
        } else {
            $charts = createlineChartsPirncipal($countryDataset);
            return view('layouts.principal', [
                'title' => $title,
                'countries' => $countries,
                'countryInfo' => $countryInfo,
                'currentConfirmed' => $currentConfirmed,
                'currentDeaths' => $currentDeaths,
                'dayOne' => $dayOne,
                'charts' => $charts
            ]);
        }               
    }
}

