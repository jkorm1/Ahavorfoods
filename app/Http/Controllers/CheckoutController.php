<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty!');
        }
        
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
        
        return view('checkout', compact('cartItems', 'total'));
    }
    
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'notes' => 'nullable|string'
        ]);
        
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        $orderItems = [];
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $price = $product->sale_price ?? $product->regular_price;
                $subtotal = $price * $details['quantity'];
                $total += $subtotal;
                
                $orderItems[] = [
                    'product_id' => $id,
                    'product_name' => $product->name,
                    'price' => $price,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }
        
        // Create order
        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(Str::random(8));
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->region = $request->region;
        $order->notes = $request->notes;
        $order->total = $total;
        $order->status = 'pending';
        $order->save();
        
        // Create order items
        foreach ($orderItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->product_name = $item['product_name'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();
        }
        
        // Send email notification to admin
        $this->sendOrderNotification($order, $orderItems);
        
        // Clear cart
        Session::forget('cart');
        
        return redirect()->route('order.confirmation', $order->order_number);
    }
    
    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $orderItems = OrderItem::where('order_id', $order->id)
            ->with('product')
            ->get();
            
        return view('order-confirmation', compact('order', 'orderItems'));
    }
    
    private function sendOrderNotification($order, $orderItems)
    {
        // This is a placeholder for email functionality
        // You would implement actual email sending here
        // For example, using Laravel's Mail facade
        
        // Mail::to('your-email@example.com')->send(new OrderNotification($order, $orderItems));
        
        // For now, we'll just log the order
        \Log::info('New order received: ' . $order->order_number);
    }
}