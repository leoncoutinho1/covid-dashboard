<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function __construct() {
        $this::middleware('auth');
    }

    public function index($country, $beginDate=null, $endDate=null) {
        $data = consultCountry($country); 
        $title = 'Painel COVID-19';
        $daily = getDailyInfo($data['data']);

        return view('layouts.relatorio', [
            'title' => $title,
            'countryInfo' => $data['countryInfo'],
            'currentConfirmed' => $data['currentConfirmed'],
            'currentDeaths' => $data['currentDeaths'],
            'dayOne' => $data['dayOne'],
            'countries' => $data['countries'],
            'country' => $country,           
            'daily' => $daily,
            'beginDate' => $beginDate,
            'endDate' => $endDate
        ]);
        
        }
}
