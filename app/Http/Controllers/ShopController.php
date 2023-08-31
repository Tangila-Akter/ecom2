<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Shop::all();
        return view('admin.pages.shop.index', compact('shop'));
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
        $shop = new Shop;

        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->email = $request->email;
        $shop->description = $request->description;
        $shop->website = $request->website;
        // save image
        if ($request->hasFile('logo')) {
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = time() . '_' . 'logo' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('logo')->storeAs('shop/image', $filename, 'public');
            $shop->logo = '/storage/' . $path;
        }
        $shop->save();

        if ($shop) {
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
        $products = Product::where('shop_id', $id)->get();
        return view('admin.pages.shop.products_lists', compact("products"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('admin.pages.shop.edit', compact("shop"));
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
        $shop = shop::find($request->id);
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->email = $request->email;
        $shop->description = $request->description;
        $shop->website = $request->website;

        // delete old image and upload new image
        if ($request->hasFile('logo')) {
            $old_image = public_path($shop->logo);
            File::delete($old_image);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = time() . '_' . 'shop' . '.' . $extension;
            // Save the file to the storage directory with the unique filename
            $path = $request->file('image')->storeAs('shop/image', $filename, 'public');
            $shop->logo = '/storage/' . $path;
        }

        $shop->save();
        return redirect()->route('shop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);

        if (public_path($shop->logo)) {
            unlink(public_path($shop->logo));
        }
        $shop->delete();
        return redirect()->back();
    }


    // addToCart
    public function addToCart(Request $request)
    {

        $product = Product::find($request->id);
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $request->id => [
                    "name" => $product->name,
                    "quantity" => $request->quantity,
                    "price" => $product->price,
                    "image" => $product->image,
                    "shop_id" => $product->shop_id,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request->id] = [
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "image" => $product->image,
            "shop_id" => $product->shop_id,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // updateCart
    public function updateCart(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }

        return redirect()->back();
    }

    // removeCart
    public function removeCart(Request $request)
    {
        // return $request->all();
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back();
    }

    // checkout
    public function checkout()
    {
        return view('admin.pages.shop.checkout');
    }

    // create invoice
    public function createInvoice(Request $request)
    {
        $cart = session()->get('cart');
        $total = 0;
        $shop_id = 0;
        foreach ($cart as $key => $value) {
            $total += $value['quantity'];
            $shop_id = $value['shop_id'];
        }

        // generate invoice no
        $invoice_no = 'INV-' . time();
        $invoice = new Invoice();
        $invoice->shop_id = $shop_id;
        $invoice->invoice_no = $invoice_no;
        $invoice->save();

        // generate invoice items
        foreach ($cart as $key => $value) {
            DB::table('invoice_items')->insert([
                'invoice_id' => $invoice->id,
                'product_id' => $key,
                'quantity' => $value['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // clear cart
        session()->forget('cart');
        return redirect()->route('shop.index');
    }
}
