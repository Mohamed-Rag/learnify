<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = \App\Models\User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        // Fetch a single user by ID
        $user = \App\Models\User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // Validate and create a new user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20|unique:users',
            'role' => 'required|in:student,teacher',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = \App\Models\User::create($validatedData);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate and update an existing user
        $user = \App\Models\User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'country' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'role' => 'sometimes|required|in:student,teacher',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user);
    }


    public function destroy($id)
    {

        $user = \App\Models\User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
}






}
