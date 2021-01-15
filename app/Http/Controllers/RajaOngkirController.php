<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function getCost()
    {
        $cost = [
            RajaOngkir::ongkosKirim([
                'origin'        => 155,
                'destination'   => 80,
                'weight'        => 1300,
                'courier'       => 'pos'
            ])->get()[0],

            RajaOngkir::ongkosKirim([
                'origin'        => 155,
                'destination'   => 80,
                'weight'        => 1300,
                'courier'       => 'jne'
            ])->get()[0],

            RajaOngkir::ongkosKirim([
                'origin'        => 155,
                'destination'   => 80,
                'weight'        => 1300,
                'courier'       => 'tiki'
            ])->get()[0],
        ];


        return response()->json($cost);
    }
}
