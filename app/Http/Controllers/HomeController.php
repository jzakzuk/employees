<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function test(){


        $dep = City::all();

        $r = '';

        foreach( $dep as $d ){

            $r.= "[
                'id' => ".$d->id.",
                'department_id' => ".$d->department_id.",
                'code' => '".$d->code."',
                'name' => '".$d->name."'
            ],<br>";

        }

        echo $r; exit();

        print_r($dep);
        exit();











        $user = User::create([
            'name' => 'John Doe',
            'email' => 'sample@sample.com',
            'password' => Hash::make('nomelase'),
        ]);

        $user->assignRole('presidente');

        dd( $user );
    }
    public function home(){
        return view('website.home');
    }

    public function dashboard(){

        $bodyClasses = '';
        return view('dashboard.dashboard', compact('bodyClasses'));
    }
}
