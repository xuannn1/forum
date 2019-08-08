<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();

        if (! $user) {
            return redirect(route('threads'))
            ->with('flash', '验证失败');
        }

        $user->confirm();

        return redirect(route('threads'))
            ->with('flash', '你的账号已验证成功！');
    }
}
