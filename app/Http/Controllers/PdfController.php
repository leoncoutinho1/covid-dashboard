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
        $tables = createlineChartsPrincipal($data['countryDataset']);

        $pdf = PDF::loadView('layouts.pdf', [
            'title' => 'Relatório',
            'countryInfo' => $data['countryInfo'],
            'currentConfirmed' => $data['currentConfirmed'],
            'currentRecovered' => $data['currentRecovered'],
            'currentDeaths' => $data['currentDeaths'],
            'dayOne' => $data['dayOne'],
            'countries' => $data['countries']
        ]);
        $pdfName = 'Relatório - ' . $data['countryInfo']->{"name"} . '.pdf';

        return $pdf->stream($pdfName);

        /* return view('layouts.pdf', [
            'title' => 'Relatório',
            'charts' => $charts,
            'countryInfo' => $data['countryInfo'],
            'currentConfirmed' => $data['currentConfirmed'],
            'currentDeaths' => $data['currentDeaths'],
            'dayOne' => $data['dayOne'],
            'countries' => $data['countries'] 
        ]); */
    }
}
