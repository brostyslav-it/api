<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User\Enums\UserAbilities;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        /** @var $user User */
        $user = User::create($request->all());

        return response()->json([
            'token' => $user->createToken(
               'auth',
                UserAbilities::ABILITIES[$user->{'role'}],
                now()->addWeek(),
            )->plainTextToken,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->all())) {
            return response()->json(['error' => 'Wrong credentials'], 400);
        }

        /** @var $user User */
        $user = Auth::user();

        return response()->json([
            'token' => $user->createToken(
               'auth',
                UserAbilities::ABILITIES[$user->{'role'}],
                now()->addWeek(),
            )->plainTextToken,
        ]);
    }
}
