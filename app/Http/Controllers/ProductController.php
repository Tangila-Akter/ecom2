<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $shop = Shop::all();
        return view('admin.pages.product.index', compact('product', 'shop'));
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
        $product = new product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->website = $request->website;
        $product->shop_id = $request->shop_id;
        // save image
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . 'product' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('image')->storeAs('product', $filename, 'public');
            $product->image = '/storage/' . $path;
        }
        $product->save();

        if ($product) {
            // return a success response back
            return redirect()->back()->with('success', 'about created successfully');
        } else {
            // return a error response back
            return redirect()->route('about.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $shop = Shop::all();
        return view('admin.pages.product.edit', compact("product", "shop"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->website = $request->website;
        $product->shop_id = $request->shop_id;
        // delete old image and upload new image
        if ($request->hasFile('image')) {
            $old_image = public_path($product->image);
            File::delete($old_image);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = time() . '_' . 'product' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('image')->storeAs('product/image', $filename, 'public');
            $product->image = '/storage/' . $path;
        }

        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (public_path($product->logo)) {
            unlink(public_path($product->logo));
        }
        $product->delete();
        return redirect()->back();
    }
}
