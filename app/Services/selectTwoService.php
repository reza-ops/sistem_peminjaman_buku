<?php

namespace App\Services;

use App\GlobalFunction\SelectTwo\Pengunjung;

class SelectTwoService{
    public function initialize(string $select_type, $request){
        switch($select_type){
            case 'pengunjung':
                return new Pengunjung($request);
                break;
        }
    }
}
