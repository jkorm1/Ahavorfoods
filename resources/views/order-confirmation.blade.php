@extends('layouts.main')

@section('title', 'Order Confirmation - Ahavor Foods')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <div class="order-confirmation">
        <div class="confirmation-header">
            <i class="fas fa-check-circle"></i>
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been placed successfully.</p>
        </div>
        
        <div class="order-details">
            <h2>Order Details</h2>
            <div class="order-info">
                <div class="info-item">
                    <span class="info-label">Order Number:</span>
                    <span class="info-value">{{ $order->order_number }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date:</span>
                    <span class="info-value">{{ $order->created_at->format('F d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total:</span>
                    <span class="info-value">₵{{ number_format($order->total, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="info-value">{{ ucfirst($order->status) }}</span>
                </div>
            </div>
        </div>
        
        <div class="order-items-section">
            <h2>Order Items</h2>
            <div class="order-items-table">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>₵{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₵{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="shipping-info-section">
            <h2>Shipping Information</h2>
            <div class="shipping-info-grid">
                <div class="info-item">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $order->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $order->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $order->phone }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Address:</span>
                    <span class="info-value">{{ $order->address }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">City:</span>
                    <span class="info-value">{{ $order->city }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Region:</span>
                    <span class="info-value">{{ $order->region }}</span>
                </div>
            </div>
        </div>
        
        <div class="next-steps">
            <h2>What's Next?</h2>
            <ul>
                <li><i class="fas fa-check"></i> Your order has been received and is being processed.</li>
                <li><i class="fas fa-phone"></i> Our team will contact you shortly to confirm your order.</li>
                <li><i class="fas fa-truck"></i> Your order will be delivered to your address.</li>
                <li><i class="fas fa-money-bill"></i> Payment will be collected upon delivery.</li>
            </ul>
        </div>
        
          Payment will be collected upon delivery.</li>
            </ul>
        </div>
        
        <div class="confirmation-actions">
            <a href="{{ route('products') }}" class="cta-button">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection