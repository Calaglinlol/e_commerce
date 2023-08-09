<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $form = $request->all();
        $messages = [
            'required' => ':attribute 是必要的',   //改為顯示中文訊息
            'between' => ':attribute 的輸入 :input 不在 :min 與 :max 之間',
        ];
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',   
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10',
        ], $messages);                            //把顯示中文引入
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $validatedData = $validator->validate();
        DB::table('cart_items')->insert(['cart_id' => $validatedData['cart_id'],
                                         'product_id' => $validatedData['product_id'],
                                         'quantity' => $form['quantity'],
                                         'created_at' => now(),
                                         'updated_at' => now()]);
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartItem $request, string $id)
    {
        $form = $request->validated();
        DB::table('cart_items')->where('id', $id)
                               ->update(['quantity' => $form['quantity'],
                                         'updated_at' => now()]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('cart_items')->where('id', $id)
                               ->delete();
        return response()->json(true);
    }
}
