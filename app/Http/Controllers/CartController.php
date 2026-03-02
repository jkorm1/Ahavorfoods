<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $product->sale_price ? $product->sale_price * $details['quantity'] : $product->regular_price * $details['quantity']
                ];
                
                $total += $cartItems[count($cartItems) - 1]['subtotal'];
            }
        }
        
        return view('cart', compact('cartItems', 'total'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);
        
        // If product already in cart, update quantity
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] = [
                'quantity' => $request->quantity
            ];
        }
        
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
        }
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
    
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}