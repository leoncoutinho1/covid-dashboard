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

    public function principal($country=null) {
        $title = 'Painel COVID-19';
        $data = consultCountry($country); 

        $charts = createlineChartsPrincipal($data['countryDataset']);
        $consolidatedCharts = createlineChartsConsolidated($data['countryDataset']);
        return view('layouts.principal', [
            'title' => $title,
            'charts' => $charts,
            'consolidatedCharts' => $consolidatedCharts,
            'countryInfo' => $data['countryInfo'],
            'currentConfirmed' => $data['currentConfirmed'],
            'currentDeaths' => $data['currentDeaths'],
            'dayOne' => $data['dayOne'],
            'countries' => $data['countries'],
            'country' => $data['country']            
        ]);
    }
}

