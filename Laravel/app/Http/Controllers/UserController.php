<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Response([
            'user' => new UserResource(Auth::user()),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $auth_user = Auth::user();
        $user = User::findOrFail($auth_user->id);

        if (!$user) {
            return new Response([
                'message' => 'Unable to find user with id ' .$auth_user->id,
            ], 404);
        }

        $user = User::where('id', $auth_user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return new Response([
            'user' => new UserResource($user),
            'message' => 'Successfully updated user ' .$user->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $auth_user = Auth::user();
        $user = User::findOrFail($auth_user->id);

        if (!$user) {
            return new Response([
                'message' => 'Unable to find user with id ' .$auth_user->id,
            ], 404);
        }

        $user->delete();

        return new Response([
            'message' => 'Successfully deleted user ' .$auth_user->id,
        ], 200);
    }
}
