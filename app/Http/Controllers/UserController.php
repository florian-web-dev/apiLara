<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // return $users->toJson(JSON_PRETTY_PRINT);


        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $nbUser = User::all()->count();
        $pw = $request->password;
        $pwHash = Hash::make($pw);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pwHash,
        ]);
        $nbUserNew = User::all()->count();

        if ($nbUser != $nbUserNew) {
            return response()->json([
                'succes' => 'User crée'
            ], 200);
        } else {
            return response()->json([
                'error' => 'User no created',
                'statut' => http_response_code(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return User::find($user);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ($user->update($request->all())) {
            return response()->json([
                'succes' => 'User modifier'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user->delete()) {
            return response()->json([
                'succes' => 'User supprimé'
            ], 200);
        }
    }
}
