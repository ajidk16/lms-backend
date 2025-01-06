<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd('heeedeeeh');
        $per_page = $request->input('per_page', $request->per_page);
        $users = User::paginate($per_page);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'user successfully',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $user = User::find($id);
        if ($user) {
            $user->delete(); // User tidak dihapus dari database, hanya ditandai sebagai dihapus
            return response()->json(['message' => 'User deleted with soft delete']);
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }

    public function trashedUsers()
    {
        $users = User::onlyTrashed()->get(); // Hanya user yang sudah soft deleted
        return response()->json([
            'message' => 'user successfully',
            'data' => $users
        ]);
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id); // Mencari user termasuk yang sudah dihapus
        if ($user) {
            $user->restore(); // Mengembalikan user yang dihapus
            return response()->json(['message' => 'User restored']);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function forceDeleteUser($id)
    {
        $user = User::withTrashed()->find($id); // Mencari user termasuk yang sudah dihapus
        if ($user) {
            $user->forceDelete(); // Menghapus user secara permanen dari database
            return response()->json(['message' => 'User permanently deleted']);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
