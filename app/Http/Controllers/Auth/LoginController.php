<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{



    use AuthenticatesUsers;

    public function attemptLogin(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        // $token = Auth::attempt($credentials);
        $token = $this->guard()->attempt($this->credentials($request));
        if (!$token) {
            return false;
        }
        $user = $this->guard()->user();
        // $user = Auth::user();
        if($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()){
            return false;
        }
        $this->guard()->setToken($token);
        return true;
    }
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        // get the token
        $token = (string)$this->guard()->getToken();

        // extract the expiry date
        $expiration = $this->guard()->getPayload()->get('exp');

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $expiration
        ]);
    }

    public function sendFailedLoginResponse()
    {
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {

            return response()->json([
                'errors' => 'need to verify your account credentials'
            ]);
        }
        throw ValidationException::withMessages([
            $this->username() => "auth failed"
            ]
        );
    }
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
}
