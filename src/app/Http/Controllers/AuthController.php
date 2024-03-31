<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller implements CreatesNewUsers
{
    public function create(array $input): Authenticatable
    {
        $validatedData = Validator::make($input, [
            'name' => 'required|string|max:255|regex:/^[^ ]+ [^ ]+(?: [^ ]+)?$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ])->validate();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return $user;
    }

    // public function store(Request $request): Authenticatable
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     //新しいユーザーの情報をセッションに保存
    //     session()->put('new_user', $user);

    //     // ユーザーインスタンスを返す
    //     return $user;
    // }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);
    //     // 新しいユーザーの情報をセッションに保存
    //     session()->put('new_user', $user);

    //     // ホームページにリダイレクト
    //     return redirect()->route('home');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'failed',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
