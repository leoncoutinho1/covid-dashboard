<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $code = '';
    public $name = '';
    public $iso2 = '';
    public $iso3 = '';
    public $capital = '';
    public $region = '';
    public $subregion = '';
    public $nativeName = '';
    public $flag = '';
    public $population = 0;
    public $area = 0;
    public $datasets = [
        'dates' => [],
        'confirmedTotal' => [],
        'confirmedDaily' => [],
        'recoveredTotal' => [],
        'recoveredDaily' => [],
        'activeTotal' => [],
        'activeDaily' => [],
        'deathsTotal' => [],
        'deathsDaily' => []
    ];
    public $dayOne;
}
