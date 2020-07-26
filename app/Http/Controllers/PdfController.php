<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function __construct() {
        $this::middleware('auth');
    }

    public function index($country) {
        $data = consultCountry($country); 
        $charts = createlineChartsPdf($data['countryDataset']);

        return view('layouts.pdf', [
            'title' => 'Relatório',
            'charts' => $charts,
            'countryInfo' => $data['countryInfo'],
            'currentConfirmed' => $data['currentConfirmed'],
            'currentDeaths' => $data['currentDeaths'],
            'dayOne' => $data['dayOne'],
            'countries' => $data['countries'] 
        ]);
    }
}
