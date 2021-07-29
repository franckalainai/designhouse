<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function attemptLogin(Request $request)
    {
        // tenter d'émettre un jeton à l'utilisateur en fonction des informations d'identification
        $token = $this->guard()->attempt($this->credentials($request));

        // verifions s'il y a un token
        if (!$token) {
            return false;
        }
        // si l'utilisateur existe, obtenir l'utilisateur authentifié
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            return false;
        }
        // définir le jeton de l'utilisateur
        $this->guard()->setToken($token);
        return true;
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        //obtenir le jeton de la guard d'authentification
        $token = (string)$this->guard()->getToken();

        // extraire la date d'expiration du jeton
        $expiration = $this->guard()->getPayload()->get('exp');
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $expiration
        ]);
    }

    protected function sendFailedLoginResponse()
    {
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            return response()->json([
                "errors" => [
                    "verification" => "You need to verify your email account"
                ]
            ]);
        }
        throw ValidationException::withMessages([
            $this->username() => "Invalid credentials"
        ]);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(["message" => "Logged out successfully"]);
    }
}
