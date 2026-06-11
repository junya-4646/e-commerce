<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $admins = Admin::all();
        return view('adminuseredit', compact('users', 'admins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'tel' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                'post' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                'address' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8',],
                'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
                'user_type' => ['required', 'in:user,admin'],
            ],
            [
                'name.required' => 'ユーザー名を入力してください',
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレス形式で入力してください(XXXX@XXXX.XX)',
                'tel.required' => '電話番号を入力してください',
                'tel.regex' => '半角数字で入力してください',
                'post.required' => '郵便番号を入力してください',
                'post.regex' => '半角数字で入力してください',
                'address.required' => '住所を入力してください',
                'password.required' => 'パスワードを入力してください',
                'password.min' => 'パスワードは8文字以上で入力してください',
                'password_confirmation.required' => 'パスワードを入力してください',
                'password_confirmation.same' => 'パスワードが一致しません',
                'user_type.required' => 'ユーザー種別を選択してください',
            ]
        );

        $createData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'post' => $data['post'] ?? null,
            'address' => $data['address'] ?? null,
            'password' => Hash::make($data['password']),
        ];

        // ユーザー種別に応じて、AdminまたはUserを作成
        if ($data['user_type'] == 'admin') {
            Admin::create($createData);
        } else {
            User::create($createData);
        }

        return redirect()->route('admin.useredit');
    }


    public function edit($user_type, $id) {
        if ($user_type === 'admin') {
            $editUser = Admin::findOrFail($id);
        } else {
            $editUser = User::findOrFail($id);
        }
    
        return view('adminuseredit', compact('editUser', 'user_type'));
    } 

    public function update(Request $request, $user_type, $id) {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
                'tel' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                'post' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                'address' => ['required', 'string', 'max:255'],
                'password' => ['nullable', 'string', 'min:8',],
                'user_type' => ['required', 'in:user,admin'],
            ],
            [
                'name.required' => 'ユーザー名を入力してください',
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレス形式で入力してください(XXXX@XXXX.XX)',
                'tel.required' => '電話番号を入力してください',
                'tel.regex' => '半角数字で入力してください',
                'post.required' => '郵便番号を入力してください',
                'post.regex' => '半角数字で入力してください',
                'address.required' => '住所を入力してください',
                'password.required' => 'パスワードを入力してください',
                'password.min' => 'パスワードは8文字以上で入力してください',
                'user_type.required' => 'ユーザー種別を選択してください',
            ]
        );

        if ($data['user_type'] === 'admin') {
            $targetUser = Admin::findOrFail($id);
        } else {
            $targetUser = User::findOrFail($id);
        }   

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'post' => $data['post'] ?? null,
            'address' => $data['address'] ?? null,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $targetUser->update($updateData);

        return redirect()->route('admin.home');
    }

    public function destroy(Request $request, $id) {

        $request->validate([
            'user_type' => ['required', 'in:user,admin'],
        ]);

        if ($request->user_type === 'admin') {
            Admin::findOrFail($id)->delete();
        } else {
            User::findOrFail($id)->delete();
        }
    
        return redirect()->route('admin.home');
    }
}
