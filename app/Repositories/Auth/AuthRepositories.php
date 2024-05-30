<?php

namespace App\Repositories\Auth;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthRepositories
{
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            return $user->createToken(Str::random(60))->plainTextToken;
        }
        return null;
    }
}
