<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    // Форма авторизации
    public function loginForm(): View
    {
        return view('auth.login');
    }

    // Авторизация
    public function login(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['auth' => 'Неверный логин или пароль.']);
        }

        return redirect()->route('courses.index');
    }
}
