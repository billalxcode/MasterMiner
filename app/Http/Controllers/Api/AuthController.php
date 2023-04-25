<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $auth;
    function __construct()
    {
        $this->auth = auth('api');
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthLoginRequest $request) {
        $validated = $request->validated();

        $token = $this->auth->attempt($validated);
        if (!$token) {
            return $this->response('username or password does not match', status:false);
        } else {
            return $this->response('successfully to login', [
                'access_token' => $token,
                'type' => 'bearer',
                'expires_in' => config('jwt.ttl')
            ]);
        }
    }

    public function register(AuthRegisterRequest $request) {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $validated['pin'] = sha1($validated['pin']);

        User::create($validated);

        return $this->response('successfully register new account', [
            $validated
        ]);
    }

    public function me() {
        $user = User::find($this->auth->id());

        return $this->response('your account information', [
            $user
        ]);
    }
}
