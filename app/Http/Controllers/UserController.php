<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getAllUser(){
        $users = User::all();
        // $users = [
        //     [
        //         'id' => 1,
        //         'name' => 'Rendi',
        //         'email' => '',
        //         'role' => 'Admin',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-01',
        //         'updated_at' => '2023-10-01',
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Budi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-02',
        //         'updated_at' => '2023-10-02',
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Siti',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Inactive',
        //         'created_at' => '2023-10-03',
        //         'updated_at' => '2023-10-03',
        //     ],
        //     [
        //         'id' => 4,
        //         'name' => 'Andi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-04',
        //         'updated_at' => '2023-10-04',
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'Dewi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-05',
        //         'updated_at' => '2023-10-05',
        //     ],
        //     [
        //         'id' => 6,
        //         'name' => 'Joko',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Inactive',
        //         'created_at' => '2023-10-06',
        //         'updated_at' => '2023-10-06',
        //     ],
        //     [
        //         'id' => 7,
        //         'name' => 'Tina',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-07',
        //         'updated_at' => '2023-10-07',
        //     ],
        //     [
        //         'id' => 8,
        //         'name' => 'Rina',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-08',
        //         'updated_at' => '2023-10-08',
        //     ],
        //     [
        //         'id' => 9,
        //         'name' => 'Budi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Inactive',
        //         'created_at' => '2023-10-09',
        //         'updated_at' => '2023-10-09',
        //     ],
        //     [
        //         'id' => 10,
        //         'name' => 'Siti',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-10',
        //         'updated_at' => '2023-10-10',
        //     ],
        //     [
        //         'id' => 11,
        //         'name' => 'Andi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Active',
        //         'created_at' => '2023-10-11',
        //         'updated_at' => '2023-10-11',
        //     ],
        //     [
        //         'id' => 12,
        //         'name' => 'Dewi',
        //         'email' => '',
        //         'role' => 'User',
        //         'status' => 'Inactive',
        //         'created_at' => '2023-10-12',
        //         'updated_at' => '2023-10-12',
        //     ],
            
        // ];

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

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
