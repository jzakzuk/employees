<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::when($request->search, function( $query ) use ( $request ) {
            return $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('identification', 'like', '%'.$request->search.'%')
                        ->orWhere('lastname', 'like', '%'.$request->search.'%')
                        ->orWhere('email', 'like', '%'.$request->search.'%')
                        ->orWhere('phone', 'like', '%'.$request->search.'%')
                        ->orWhereRaw("concat(name, ' ', lastname) rlike replace(?, ' ', '|') ", [$request->search]);
        })->paginate(6);
        return view('dashboard.users.index', compact('users'));
    }

    public function edit(User $user){
        $bosses = User::where('id', '!=', $user->id)->get();
        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'bosses', 'roles'));
    }

    public function create(){
        $roles = Role::all();
        $bosses = User::all();
        return view('dashboard.users.create', compact('roles', 'bosses', 'roles'));
    }

    public function delete( User $user ){
        if( !Auth::user()->hasRole('presidente') ) 
            return response()->json(['message' => 'No tienes permisso de eliminar usuarios'], 422);
        try{
            $user->delete();
            return response()->json(['message' => 'Se ha eliminado el usuario'], 200);
        }catch( \Exception $e ){
            return response()->json(['message' => 'Ha ocurrido un error'], 422);
        }
    }

    public function deleteCollaborator( User $user ){
        if( !Auth::user()->hasRole('presidente') ) 
            return response()->json(['message' => 'No tienes permisso de eliminar usuarios'], 422);
        try{
            $user->delete();
            return response()->json(['message' => 'Ha ocurrido un error'], 200);
        }catch( \Exception $e ){
            return response()->json(['message' => 'Ha ocurrido un error'], 422);
        }
    }

    public function view(User $user){
        return view('dashboard.users.view', compact('user'));
    }

    public function viewCollaborators(User $user, Request $request){
        $users = User::whereHas('boss', function( $boss ) use ( $user ){
            return $boss->where('id', $user->id);
        })->when($request->search, function( $query ) use ( $request ) {
            return $query->whereRaw("concat(name, ' ', lastname) rlike replace(?, ' ', '|') ", [$request->search]);
        })->paginate(8);
        return view('dashboard.users.collaborators.index', compact('users', 'user'));
    }

    public function store(Request $request){

       $validator = Validator::make( $request->all(),
       [
        'name' => 'required|string|max:255',
        'roles' => 'required',
        'lastname' => 'required|string|max:255',
        'identification' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city_id' => 'required|numeric',
        'email' => 'required|string|email|max:255|unique:users,email',
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
        'email.required' => 'este campo es requerido',
        'roles.*' => 'este campo es requerido',
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

        $user->roles()->sync( $request->roles );

        //we assign the booss (user_id) to the user only if present and only if user not 'presidente'
        if( !empty( $request->user_id ) && !$user->hasRole('presidente') ){
            $user->user_id = $request->user_id;
            $user->save();
        }

        return response()->json([
            'user' => $user,
            'message' => 'Usuario creado correctamente',
            'goto' => route('users.view', $user->id)
        ], 201);

    }

    public function update(User $user, Request $request){

        $validator = Validator::make( $request->all(),
       [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'identification' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city_id' => 'required|numeric',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'roles' => 'required',
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
        'email.required' => 'este campo es requerido',
        'roles.*' => 'este campo es requerido',
       ] );

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $user->update( $request->all() );

        //sync user roles
        $user->roles()->sync( $request->roles );

        //if user is presidente, we set the boss (user_id) as null, as a president cannot have a boss
        if( $user->hasRole('presidente') ){
            $user->user_id = null;
            $user->save();
        }

        //we assign the booss (user_id) to the user only if present and only if user not 'presidente'
        if( !empty( $request->user_id ) && !$user->hasRole('presidente') ){
            $user->user_id = $request->user_id;
            $user->save();
        }

        return response()->json([
            'user' => $user,
            'message' => 'Usuario actualizado correctamente',
            'goto' => route('users.view', $user->id)
        ], 201);

    }
}
