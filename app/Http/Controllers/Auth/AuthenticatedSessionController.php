<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        if ($request->user()) {
            // User is already authenticated
            $user = $request->user();
            $token = $user->currentAccessToken()->plainTextToken;

            return response([
                'message' => 'User is already logged in',
                'user' => $user,
                'token' => $token
            ]);
        }

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth()->user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
