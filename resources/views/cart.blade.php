@extends('layouts.main')

@section('title', 'Shopping Cart - Ahavor Foods')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <h1 class="section-title">Shopping Cart</h1>
    
    @if(session('success'))
        <div class="alert-success" style="padding: 15px; margin-bottom: 20px; border-radius: 10px;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(count($cartItems) > 0)
        <div class="cart-container">
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td class="cart-product">
                                <img src="{{ asset($item['product']->image_path) }}" alt="{{ $item['product']->name }}">
                                <div>
                                    <h4>{{ $item['product']->name }}</h4>
                                    <p>{{ $item['product']->category->name }}</p>
                                </div>
                            </td>
                            <td>₵{{ number_format($item['product']->sale_price ?? $item['product']->regular_price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" class="quantity-update-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn minus-btn">-</button>
                                        <input type="number" name="quantity" class="quantity-input" value="{{ $item['quantity'] }}" min="1">
                                        <button type="button" class="quantity-btn plus-btn">+</button>
                                    </div>
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                            </td>
                            <td>₵{{ number_format($item['subtotal'], 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $item['id']) }}" class="remove-btn">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="cart-summary">
                <h3>Cart Summary</h3>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>₵{{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>₵{{ number_format($total, 2) }}</span>
                </div>
                <div class="cart-actions">
                    <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout</a>
                    <a href="{{ route('cart.clear') }}" class="clear-cart-btn">Clear Cart</a>
                </div>
                <div class="continue-shopping">
                    <a href="{{ route('products') }}"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <i class="fas fa-shopping-cart fa-4x"></i>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('products') }}" class="cta-button">Start Shopping</a>
        </div>
    @endif
</div>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtns = document.querySelectorAll('.minus-btn');
        const plusBtns = document.querySelectorAll('.plus-btn');
        
        minusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            });
        });
        
        plusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value);
                input.value = value + 1;
            });
        });
    });
</script>
@endsection