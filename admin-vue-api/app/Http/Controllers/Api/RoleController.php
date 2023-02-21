<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        $response = [
            'success' => true,
            'roles' => $roles,
            'data' => $roles
        ];

        return response($response, 200);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Role',
            'data' => $role,
        ], 200);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'role'  => $request->role_name,
        ]);

        if ($role) {
            return response()->json([
                'success' => true,
                'message' => 'Role Inserted Successfully',
                'data'    => $role
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role Failed to Save',
        ], 409);
    }

    public function update(Request $request, Role $role)
    {
        $r = Role::findOrFail($role->id);

        if ($r) {
            $r->update([
                'role'  => $request->role_name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Role Updated',
                'data'    => $r
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role Not Found',
        ], 404);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role) {
            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Role Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Role Not Found',
        ], 404);
    }
}
