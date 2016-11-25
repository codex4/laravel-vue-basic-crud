<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email')
        ]);

        return response()->json([
            'message' => 'user created successfully',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);

        $user->update($request->all());

        return response()->json([
            'message' => 'user updated successfully'
        ]);
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
