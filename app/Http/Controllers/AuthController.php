<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\AuthSignupRequest;
use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    /**
     * Benutzer anlegen
     * 
     * @param [string] email
     * @param [string] password
     * @param [string] password_confirmation
     * @return [string] message
     */
    public function signup(AuthSignupRequest $request) 
    {
        $user = new User([
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT)
        ]);
        
        $user->save();
        
        return response()->json([
            'message' => 'User successfuly created.'
        ], 201);
    }
    
    /**
     * Benutzer einloggen und Token erzeugen
     * 
     * @param [string] email
     * @param [string] password
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(AuthLoginRequest $request)
    {        
        $credentials = request(['email', 'password']);
        
        if ( Auth::attempt($credentials) === false ) {
            
            return response()->json([
                'message' => 'Login and/or password wrong.'
            ], 401);
        }
        
        $user = $request->user();
        
        $tokenResult = $user->createToken('MyJWT');
        
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
