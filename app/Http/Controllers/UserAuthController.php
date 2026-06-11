<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください（XXXX@XXXX.com）',
            'password.required' => 'パスワードを入力してください',
        ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // トークンを生成
            $user = Auth::user();
            $token = $user->createToken('user-token')->plainTextToken;

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ])
        ->withInput();
    }

    public function logout(Request $request) {

        // トークンを削除
        if (Auth::check()) {

            Auth::user()->tokens()->delete();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegister() {
        return view('registration');
    }

    public function showRegisterConfirm() {
        return view('registrationconfirm');
    }

    public function confirmRegister(Request $request) {

        // 入力データのバリデーション
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'tel' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'post' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ],
        [
            'name.required' => 'ユーザー名を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください（XXXX@XXXX.com）',
            'email.unique' => 'このメールアドレスは既に使用されています',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '半角数字で入力してください',
            'post.required' => '郵便番号を入力してください',
            'post.regex' => '半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password_confirmation.required' => 'パスワードを入力してください',
            'password_confirmation.same' => 'パスワードが一致しません',
        ]
        );

        return view('registrationconfirm', compact('data'));
    }

    public function showRegisterComplete() {
        return view('registrationcomplete');
    }

    public function completeRegister(Request $request) {

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'tel' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'post' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ],
        [
            'name.required' => 'ユーザー名を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください（XXXX@XXXX.com）',
            'email.unique' => 'このメールアドレスは既に使用されています',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '半角数字で入力してください',
            'post.required' => '郵便番号を入力してください',
            'post.regex' => '半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ]
        );

        // ユーザーを登録
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'post' => $data['post'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);

        return view('registrationcomplete');
    }
}
