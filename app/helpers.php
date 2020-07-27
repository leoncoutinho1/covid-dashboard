<?php

    function consultApi($url) {
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
    
    function formatadorDeMilhar($number) {
        return number_format($number, 0, ',', '.');
    }

    function convertDate($date) {
        $date = substr($date, 8, 2).'-'.substr($date, 5, 2);
        return $date;
    }

    function convertDateWithYear($date) {
        $date = substr($date, 8, 2).'-'.substr($date, 5, 2).'-'.substr($date, 0, 4);
        return $date;
    }


    function getCountryDataset($data) {
        $countryDataset = [
            'dayOne' => '',
            'weekDates' => [],
            'weekConfirmedTotal' => [],
            'weekConfirmedDaily' => [],
            'weekDeathsTotal' => [],
            'weekDeathsDaily' => [],
            'weekRecoveredTotal' => [],
            'weekRecoveredDaily' => [],
            'weekActiveTotal' => [],
            'weekActiveDaily' => [],
            'monthDates' => [], 
            'monthConfirmed' => [],
            'monthDeaths' => [],
            'monthRecovered' => [],
            'monthActive' => []            
        ];

        $total = count($data) - 1;

        for($i = 0; $i < count($data); $i++) {
            if($data[$i]->{'Confirmed'} != 0) {
                $countryDataset['dayOne'] = $data[$i]->{'Date'};
                break;
            }
        }

        for($i = 0; $i <= 6; $i++) {
            array_unshift($countryDataset['weekDates'], convertDate($data[$total - $i]->{'Date'}));
            array_unshift($countryDataset['weekConfirmedTotal'], $data[$total - $i]->{'Confirmed'});
            array_unshift($countryDataset['weekConfirmedDaily'], ($data[$total - $i]->{'Confirmed'} - $data[$total - $i - 1]->{'Confirmed'}));
            array_unshift($countryDataset['weekDeathsTotal'], $data[$total - $i]->{'Deaths'});
            array_unshift($countryDataset['weekDeathsDaily'], ($data[$total - $i]->{'Deaths'} - $data[$total - $i - 1]->{'Deaths'}));
            array_unshift($countryDataset['weekRecoveredTotal'], $data[$total - $i]->{'Recovered'});
            array_unshift($countryDataset['weekRecoveredDaily'], ($data[$total - $i]->{'Recovered'} - $data[$total - $i - 1]->{'Recovered'}));
            array_unshift($countryDataset['weekActiveTotal'], $data[$total - $i]->{'Active'});
            array_unshift($countryDataset['weekActiveDaily'], ($data[$total - $i]->{'Active'} - $data[$total - $i - 1]->{'Active'}));
        }

        for($i = 0; $i <= 6; $i++) {
            array_unshift($countryDataset['monthDates'], convertDate($data[$total - ($i * 30)]->{'Date'}));
            array_unshift($countryDataset['monthConfirmed'], $data[$total - ($i * 30)]->{'Confirmed'});
            array_unshift($countryDataset['monthDeaths'], $data[$total - ($i * 30)]->{'Deaths'});
            array_unshift($countryDataset['monthRecovered'], $data[$total - ($i * 30)]->{'Recovered'});
            array_unshift($countryDataset['monthActive'], $data[$total - ($i * 30)]->{'Active'});
        }

        return $countryDataset;
    }

    function getDailyInfo($data) {
        $daily = [
            'confirmed' => [],
            'deaths' => [],
            'date' => []
        ];
        
        $total = count($data) - 1;
        for($i = 0; $i < count($data) - 1; $i++) {
            array_push($daily['confirmed'], ($data[$i + 1]->{'Confirmed'} - $data[$i]->{'Confirmed'}));
            array_push($daily['deaths'], ($data[$i + 1]->{'Deaths'} - $data[$i]->{'Deaths'}));
            $date = substr($data[$i]->{'Date'}, 0, 10);
            array_push($daily['date'], $date);
        }
        return $daily;
    }

    function createlineChartsPrincipal($dataset) {
        
        $bgConfirmed = '#8bd466a6';
        $confirmed = '#4eb92a';
        $bgActive = '#fdfd2d8c';
        $active = '#fdfd2d';
        $bgRecovered = '#409efc8e';
        $recovered = '#409efc';
        $bgDeaths = '#fa4b4b9a';
        $deaths = '#fa4b4b';

        $charts = array();

        array_push($charts, [
            'title' => 'Novos casos confirmados / semana',
            'id' => 'weekConfirmedDaily',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Novos casos confirmados',
                    'bgColor' => $bgConfirmed,
                    'color' => $confirmed,
                    'values' => $dataset['weekConfirmedDaily']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Número de mortes / semana',
            'id' => 'weekDeathsDaily',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Número de mortes',
                    'bgColor' => $bgDeaths,
                    'color' => $deaths,
                    'values' => $dataset['weekDeathsDaily']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Total casos confirmados / semana',
            'id' => 'weekConfirmedTotal',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de casos confirmados',
                    'bgColor' => $bgConfirmed,
                    'color' => $confirmed,
                    'values' => $dataset['weekConfirmedTotal']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Total de mortes / semana',
            'id' => 'weekDeathsTotal',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de mortes',
                    'bgColor' => $bgDeaths,
                    'color' => $deaths,
                    'values' => $dataset['weekDeathsTotal']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Total casos confirmados / mes',
            'id' => 'monthConfirmed',
            'labels' => $dataset['monthDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de casos confirmados',
                    'bgColor' => $bgConfirmed,
                    'color' => $confirmed,
                    'values' => $dataset['monthConfirmed']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Total de mortes / mes',
            'id' => 'monthDeaths',
            'labels' => $dataset['monthDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de mortes',
                    'bgColor' => $bgDeaths,
                    'color' => $deaths,
                    'values' => $dataset['monthDeaths']
                ]
            ]
        ]);

        return $charts;
    }


    function createlineChartsConsolidated($dataset) {
        
        $bgTransparent = 'transparent';
        $bgConfirmed = '#8bd466a6';
        $confirmed = '#4eb92a';
        $bgActive = '#fdfd2d8c';
        $active = '#fdfd2d';
        $bgRecovered = '#409efc8e';
        $recovered = '#409efc';
        $bgDeaths = '#fa4b4b9a';
        $deaths = '#fa4b4b';

        $charts = array();

        /* array_push($charts, [
            'title' => 'Índices diários na semana',
            'id' => 'ConsolidateWeekDaily',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Novos casos confirmados',
                    'bgColor' => $bgTransparent,
                    'color' => $confirmed,
                    'values' => $dataset['weekConfirmedDaily']
                ],
                1 => [
                    'label' => 'Recuperados',
                    'bgColor' => $bgTransparent,
                    'color' => $recovered,
                    'values' => $dataset['weekRecoveredDaily']
                ],
                2 => [
                    'label' => 'Mortes',
                    'bgColor' => $bgTransparent,
                    'color' => $deaths,
                    'values' => $dataset['weekDeathsDaily']
                ]
            ]
        ]); */

        array_push($charts, [
            'title' => 'Índices totais na semana',
            'id' => 'ConsolidateWeekTotal',
            'labels' => $dataset['weekDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de casos confirmados',
                    'bgColor' => $bgTransparent,
                    'color' => $confirmed,
                    'values' => $dataset['weekConfirmedTotal']
                ],
                1 => [
                    'label' => 'Ativos',
                    'bgColor' => $bgTransparent,
                    'color' => $active,
                    'values' => $dataset['weekActiveTotal']
                ],
                2 => [
                    'label' => 'Recuperados',
                    'bgColor' => $bgTransparent,
                    'color' => $recovered,
                    'values' => $dataset['weekRecoveredTotal']
                ],
                3 => [
                    'label' => 'Mortes',
                    'bgColor' => $bgTransparent,
                    'color' => $deaths,
                    'values' => $dataset['weekDeathsTotal']
                ]
            ]
        ]);

        array_push($charts, [
            'title' => 'Índices mensais',
            'id' => 'ConsolidateMonth',
            'labels' => $dataset['monthDates'],
            'dataset' => [
                0 => [
                    'label' => 'Total de casos confirmados',
                    'bgColor' => $bgTransparent,
                    'color' => $confirmed,
                    'values' => $dataset['monthConfirmed']
                ],
                1 => [
                    'label' => 'Ativos',
                    'bgColor' => $bgTransparent,
                    'color' => $active,
                    'values' => $dataset['monthActive']
                ],
                2 => [
                    'label' => 'Recuperados',
                    'bgColor' => $bgTransparent,
                    'color' => $recovered,
                    'values' => $dataset['monthRecovered']
                ],
                3 => [
                    'label' => 'Mortes',
                    'bgColor' => $bgTransparent,
                    'color' => $deaths,
                    'values' => $dataset['monthDeaths']
                ]
            ]
        ]);

        return $charts;
    }