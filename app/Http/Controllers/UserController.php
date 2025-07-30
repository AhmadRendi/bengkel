<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getAllUser(){
        $users = User::all()->where('is_active', true);
        return $users;
    }

    public function findUserById($id)
    {
        // dd($id);
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

    public function resetPassword($id){
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $newPassword = 'user123';
        $user->password = bcrypt($newPassword);
        $user->save();

        return response()->json(['message' => 'Success'], 200);
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->input('id'));
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->id= $request->input('id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->deleteUserById($id)) {
            return response()->json(['message' => 'Success'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete user'], 500);
        }
    }
}
