<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // A User modell importálása
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'string|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ]);

        return response()->json([
            'message' => 'Regisztráció sikeres!',
            'user' => $user
        ], 201);
    }

    public function getUsers(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|string|max:255',
            'password'=>'required|string|max:6'
        ]);
    }
}