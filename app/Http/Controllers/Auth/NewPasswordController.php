<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

/**
 * Class NewPasswordController
 *
 * This controller handles the password reset process.
 *
 * @package App\Http\Controllers\Auth
 */
class NewPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * This method validates the incoming request data, attempts to reset the user's password,
     * and returns a JSON response indicating the result of the operation.
     *
     * @param Request $request The incoming HTTP request.
     *
     * @throws ValidationException If the validation fails.
     *
     * @return JsonResponse A JSON response indicating the result of the operation.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // If the validation fails, return a JSON response with the validation errors.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt to reset the user's password.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // If the password reset is successful, update the password on the user model and persist it to the database.
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Dispatch a password reset event.
                event(new PasswordReset($user));
            }
        );

        // If the password reset is not successful, return a JSON response with the error message.
        if ($status != Password::PASSWORD_RESET) {
            return response()->json(['errors' => [trans($status)]], 400);
        }

        // If the password reset is successful, return a JSON response with the status message.
        return response()->json(['status' => trans($status)]);
    }
}
