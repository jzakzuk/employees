<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(string $search = null){

        $cities = [];

        if( !empty( $search ) ){
            $cities = City::where('name', 'like', '%'.$search.'%')->orWhereHas('department', function( $department ) use ( $search ){
                $department->where('name', 'like', '%'.$search.'%');
            })->get();
        }

        return view('dashboard.users.city-list', compact('cities'));

    }
}
