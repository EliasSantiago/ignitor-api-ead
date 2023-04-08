<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)])
                    : response()->json(['error' => __($status)], 422);
    }

    public function resetPassword(Request $request) {
      $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|max:100|confirmed',
      ]);

      $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
          $user->forceFill([
            'password' => bcrypt($password)
          ])->setRememberToken(Str::random(60));

          $user->save();

          event(new PasswordReset($user));
        }
      );

      return $status === Password::PASSWORD_RESET
                  ? response()->json(['message' => __($status)])
                  : response()->json(['error' => __($status)], 422);
    }
}
