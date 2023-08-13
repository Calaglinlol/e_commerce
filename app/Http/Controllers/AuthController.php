<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //註冊
    public function signup(CreateUser $request)
    {
        $validateData = $request->validated();
        $user = new User([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
        ]);
        $user->save();
        return response('success', 201);
    }

    //信箱密碼登入&產生Token
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if(!Auth::attempt($validateData)) {
            return response('授權失敗', 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();
        return response(['token' => $tokenResult->accessToken]);
    }

    //驗證Token
    public function user(Request $request)
    {
        return response(
            $request->user()
        );
    }

    //登出
    public function logout(Request $request) 
    {
        $request->user()->token()->revoke();
        return response(
            ['message' => '成功登出']
        );
    }
}
