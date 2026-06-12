<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        
        $products = Product::all(); 

        return view('adminitemedit', compact('products'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'val' => ['required', 'regex:/^[0-9]+$/'],
            'explanation' => ['required', 'string', 'max:5000'],
            'genre' => ['required',  'in:1,2,3,4,5,6,7,8,9'],
            'picture' => ['required', 'image'],
        ],
        [
            'name.required' => '商品名を入力して下さい',
            'val.required' => '税抜き価格を入力して下さい',
            'val.regex' => '半角数字で入力して下さい',
            'explanation.required' => '説明を入力して下さい',
            
        ]);

        $genres = [
            1 => 'Tシャツ',
            2 => 'Yシャツ',
            3 => 'セーター',
            4 => 'ロング',
            5 => 'コート',
            6 => 'ジャケット',
            7 => 'パンツ',
            8 => 'シューズ',
            9 => 'アクセサリー',
        ];

        $fileName = $request->file('picture')->getClientOriginalName();
        Product::create([
            'name' => $data['name'],
            'val' => $data['val'],
            'explanation' => $data['explanation'],
            'genre' => $genres[$data['genre']],
            'picture' => 'images/' . $fileName,
        ]);

        return redirect()->route('admin.home');
    }

    public function edit($id)
    {

        $editProduct = Product::findOrFail($id);

        return view('adminitemedit', compact('editProduct'));
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'val' => ['required', 'regex:/^[0-9]+$/'],
            'explanation' => ['required', 'string', 'max:5000'],
            'genre' => ['required',  'in:1,2,3,4,5,6,7,8,9'],
            'picture' => ['nullable', 'image'],
        ],
        [
            'name.required' => '商品名を入力して下さい',
            'val.required' => '税抜き価格を入力して下さい',
            'val.regex' => '半角数字で入力して下さい',
            'explanation.required' => '説明を入力して下さい',
            
        ]);

        $genres = [
            1 => 'Tシャツ',
            2 => 'Yシャツ',
            3 => 'セーター',
            4 => 'ロング',
            5 => 'コート',
            6 => 'ジャケット',
            7 => 'パンツ',
            8 => 'シューズ',
            9 => 'アクセサリー',
        ];

        $updateData = [
            'name' => $data['name'],
            'val' => $data['val'],
            'explanation' => $data['explanation'],
            'genre' => $genres[$data['genre']],
        ];

        if ($request->hasFile('picture')) {
            $fileName = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move(public_path('images'), $fileName);
            
            $updateData['picture'] = 'images/' . $fileName;
        }

        $product->update($updateData);

        return redirect()->route('admin.home');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.home');
    }
}

