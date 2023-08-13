<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = DB::table('products')->get();
        return response($data);
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
        $data = $this->getdata();
        $newdata = $request->all();
        $data->push(collect($newdata));
        return response($data);
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
    public function update(Request $request, string $id)
    {
        $data = $this->getdata();
        $form = $request->all();
        $selectdata = $data->where('id', $id)->first();
        $selectdata = $selectdata->merge(collect($form));
        return response($selectdata);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->getdata();
        $data = $data->filter(function($product) use ($id){
            return $product['id'] != $id;
        });
        return response($data->values());
    }

    public function getdata()
    {
        return collect([
            collect([ "id" => 0,
                "title" => "test1",
                "price" => 1000]),
            collect([   "id" => 1,
                "title" => "test2",
            "price" => 2000]) 
        ]);
    }
}
