<?php
namespace App\Services\Login;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class LoginService{
    private $request;
    
    public function __construct(AuthRequest $request){
        $this->request = $request;
    }

    public function auth($data){
        if (Auth::attempt($data)) {
            $this->request->session()->regenerate();

            return response(Auth::user(), 200);
        }
        return response([
            'message' => 'Не верный логин\пароль'
        ], 422);
    }
}
