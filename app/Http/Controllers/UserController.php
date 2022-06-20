<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::when($request->search, function( $query ) use ( $request ) {
            return $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('lastname', 'like', '%'.$request->search.'%')
                        ->orWhere('email', 'like', '%'.$request->search.'%')
                        ->orWhere('phone', 'like', '%'.$request->search.'%');
        })->paginate(6);
        return view('dashboard.users.index', compact('users'));
    }

    public function edit(User $user){
        return view('dashboard.users.edit', compact('user'));
    }

    public function create(){
        return view('dashboard.users.create');
    }

    public function view(User $user){
        return view('dashboard.users.view', compact('user'));
    }

    public function store(Request $request){

       $validator = Validator::make( $request->all(),
       [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'identification' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city_id' => 'required|numeric',
        'email' => 'required|string|email|max:255|unique:users',
       ],
       [
        'name.*' => 'este campo es requerido',
        'lastname.*' => 'este campo es requerido',
        'identification.*' => 'este campo es requerido',
        'phone.*' => 'este campo es requerido',
        'address.*' => 'este campo es requerido',
        'city_id.*' => 'este campo es requerido',
        'email.email' => 'ingresa un email valido',
        'email.unique' => 'el email ya existe',
        'email.required' => 'este campo es requerido'
       ] );

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'identification' => $request->identification,
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => Hash::make($request->identification)
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Usuario creado correctamente',
            'goto' => route('users.view', $user->id)
        ], 201);

    }

    public function update(User $user, Request $request){

    }
}
