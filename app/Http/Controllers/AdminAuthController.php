<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{

    public function showAdminLogin()
    {
        return view('adminlogin');
    }
    
    public function index()
    {

        $users = User::all();
        $admins = Admin::all();

        return view('admin', compact('users', 'admins'));

    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください(XXXX@XXXX.com)',
            'password.required' => 'パスワードを入力してください',
        ]
        
        );

        // adminsテーブルからメールアドレスに一致する管理者を取得
        $admin = Admin::where('email', $credentials['email'])->first();
        if (!$admin) {
            return back()->withErrors([
                'email' => '該当ユーザーが見つかりません',
            ])->withInput();
        }
        
        // パスワードを検証
        if (!Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors([
                'password' => 'パスワードが違います',
            ])->withInput();
        }
        
        // 管理者としてログイン
        Auth::guard('admin')->login($admin);

        $request->session()->regenerate();

        // トークンの作成
        $token = $admin->createToken('admin-token')->plainTextToken;
        session(['admin_access_token' => $token]);

        return redirect()->route('admin.home');
    }
    
    public function logout(Request $request)
    {
        // トークンの削除
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->tokens()->delete();
        }

        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
    



}
