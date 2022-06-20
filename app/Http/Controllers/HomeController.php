<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function test(){
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
