<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Country;

class CountryController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this::middleware('auth');
    }

    public function create($code=null) {
        $expiration = 480;
        
        $countries = Cache::remember('countries', $expiration, function() {
           return consultApi("https://api.covid19api.com/countries");
        });            

        if(!isset($code)) {
            $code = 'brazil';
        }
        
        $data = Cache::remember($code, $expiration, function() use ($code) {
            return consultApi("https://api.covid19api.com/total/country/$code");
        });
                
        $index = array_search($code, array_column($countries, 'Slug'));
        $iso2 = $countries[$index]->{'ISO2'};
        
        $countryInfo = Cache::remember($iso2, $expiration, function() use ($iso2) {
            return consultApi("https://restcountries.eu/rest/v2/alpha/$iso2");
        });
        
        return Inertia::render('Country', [
            'user' => Auth::user()->name,
            'csrf' => csrf_token(),
            'title' => 'Painel_COVID19',
            'country' => $code,
            'countryInfo' => $countryInfo,
            'countryDataset' => $data,
            'countries' => $countries,
        ]);
    }
}
