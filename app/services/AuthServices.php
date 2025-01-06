<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AuthServices{
    public function registerUser($data) 
    {
        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);    
    }

    public function loginUser($data) 
    {
        $user = User::where('email', $data['email'])->first();

        if($user && Hash::check($data['password'], $user->password)){
            return $user;
        }

        return null;
    }
}