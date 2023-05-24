<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'success' => false,
                'message' => ['These credential do not match our records.']
            ], 404);
        }

        $token = $user->createToken('ApiToken')->plainTextToken;

        $response = [
            'success' => true,
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'level_id'  => $request->role_id,
            'password'  => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Created Successfully',
                'data'    => $user
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'User Failed to Created',
        ], 409);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'success' => true
        ], 200);
    }
}
