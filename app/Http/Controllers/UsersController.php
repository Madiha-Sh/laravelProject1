<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $user = new User();
        return view('user.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        //
        $user = new User();
        if(!$request->name || !$request->email || !$request->password) {
            return response()->json(['Error' => 'Please enter complete details'], 400);
        }
        if($request->name && $request->email && $request->password) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            // return redirect('/api/users');
            // return $user;
            return response()->json(['users'=>$user], 201);
        }
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
        $user = User::findOrFail($id);
        if($user) {
            return response()->json(['User' => $user], 200);
        }
        else {
            return response()->json(["Error" => "User with id $id not found"], 400);
        }
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
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        if($user && $request->password) {
            $user->password = $request->input("password");
            $user->save();
            return response()->json(["msg"=>"User's password is updated successfuly"], 201);
        }
        else {
            return response()->json(["error"=>"Please enter details to update user's password."], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        if($user) {
            $user->delete();
            return response()->json([
                "msg" => "User with id $id is deleted successfully"
            ], 200);
        }
        else {
            return response()->json([
                "error" => "User with id $id is not found"
            ], 400);
        }
    }
}
