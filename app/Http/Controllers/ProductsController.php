<?php

namespace App\Http\Controllers;

use App\products;
use Illuminate\Http\Request;
use App\sections;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $products = products::all();
        return view('products.products', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'product_name' => 'required|max:255',
            ],

            [

                'product_name.required' => 'يرجي ادخال اسم المنتج',

            ]
        );


        Products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validatedData = $request->validate(
            [
                'product_name' => 'required|max:255',
            ],

            [

                'product_name.required' => 'يرجي ادخال اسم المنتج',

            ]
        );

        $id = sections::where('section_name', $request->section_name)->first()->id;
        $products = products::findOrFail($request->pro_id);
        $products->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'id' => $id
        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = products::findorfail($request->pro_id);
        $products->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return back();
    }
}
