<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this::middleware('auth');
    }

    public function consult($url) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public function convertDate($date) {
        $date = substr($date, 8, 2).'-'.substr($date, 5, 2);
        return $date;
    }

    public function getCountryDataset($data) {
        $countryDataset = [
            'dayOne' => '',
            'weekDates' => [],
            'weekConfirmedTotal' => [],
            'weekConfirmedDaily' => [],
            'weekDeathsTotal' => [],
            'weekDeathsDaily' => [],
            'mounthDates' => [],
            'mounthConfirmed' => [],
            'mounthDeaths' => []
        ];

        $total = count($data) - 1;

        for($i = 0; $i < count($data); $i++) {
            if($data[$i]->{'Confirmed'} != 0) {
                $countryDataset['dayOne'] = $data[$i]->{'Date'};
                break;
            }
        }

        for($i = 0; $i <= 6; $i++) {
            array_unshift($countryDataset['weekDates'], $this::convertDate($data[$total - $i]->{'Date'}));
            array_unshift($countryDataset['weekConfirmedTotal'], $data[$total - $i]->{'Confirmed'});
            array_unshift($countryDataset['weekConfirmedDaily'], ($data[$total - $i]->{'Confirmed'} - $data[$total - $i - 1]->{'Confirmed'}));
            array_unshift($countryDataset['weekDeathsTotal'], $data[$total - $i]->{'Deaths'});
            array_unshift($countryDataset['weekDeathsDaily'], ($data[$total - $i]->{'Deaths'} - $data[$total - $i - 1]->{'Deaths'}));
        }

        for($i = 0; $i <= 4; $i++) {
            array_unshift($countryDataset['mounthDates'], $this::convertDate($data[$total - ($i * 30)]->{'Date'}));
            array_unshift($countryDataset['mounthConfirmed'], $data[$total - ($i * 30)]->{'Confirmed'});
            array_unshift($countryDataset['mounthDeaths'], $data[$total - ($i * 30)]->{'Deaths'});
        }

        return $countryDataset;
    }

    public function principal($country=null) {
        $title = 'Painel COVID-19';
        $countries = $this::consult("https://api.covid19api.com/countries");
        
        if(!isset($country)) {
            $country = 'brazil';
        }
                        
        $data = $this::consult("https://api.covid19api.com/total/country/$country");
                                
        $index = array_search($country, array_column($countries, 'Slug'));
        $iso2 = $countries[$index]->{'ISO2'};

        $countryInfo = $this::consult("https://restcountries.eu/rest/v2/alpha/$iso2");
        if (count($data) > 0) {
            $countryDataset = $this::getCountryDataset($data);
            $currentConfirmed = end($countryDataset['weekConfirmedTotal']);
            $currentDeaths = end($countryDataset['weekDeathsTotal']);
        } else {
            $countryDataset = null;
            $currentConfirmed = null;
            $currentDeaths = null;
        }       
                
        return view('layouts.principal', [
            'title' => $title,
            'countries' => $countries,
            'countryInfo' => $countryInfo,
            'currentConfirmed' => $currentConfirmed,
            'currentDeaths' => $currentDeaths,
            'countryDataset' => $countryDataset            
        ]);

    }
}
