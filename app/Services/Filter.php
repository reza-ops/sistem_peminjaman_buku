<?php

namespace App\Services;

use App\GlobalFunction\Filter\Buku;

class Filter {
    public function initialize(string $filter_type, $request){
        switch($filter_type){
            case 'buku' :
                return new Buku;
                break;
        }
    }
}
