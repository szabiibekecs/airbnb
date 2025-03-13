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
            'password' => Hash::make($request->password),
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
}