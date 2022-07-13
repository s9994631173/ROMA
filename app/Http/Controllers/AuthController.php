<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Services\Login\LoginService;

class AuthController extends Controller
{
    public function auth(AuthRequest $request, LoginService $service){
        $validated = $request->safe()->only(['email', 'password']);

        return $service->auth($validated);
    }
}
