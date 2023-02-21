<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        $response = [
            'success' => true,
            'users' => $users,
            'data' => $users
        ];

        return response($response, 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data User',
            'data' => $user,
        ], 200);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'level_id'  => $request->level_id,
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Inserted Successfully',
                'data'    => $user
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'User Failed to Save',
        ], 409);
    }

    public function update(Request $request, User $user)
    {
        $u = User::findOrFail($user->id);

        if ($u) {
            $u->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'level_id'  => $request->level_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User Updated',
                'data'    => $u
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }
}
