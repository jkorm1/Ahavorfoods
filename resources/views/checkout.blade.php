@extends('layouts.main')

@section('title', 'Checkout - Ahavor Foods')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <h1 class="section-title">Checkout</h1>
    
    @if(session('error'))
        <div class="alert-danger" style="padding: 15px; margin-bottom: 20px; border-radius: 10px;">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="checkout-container">
        <div class="checkout-form">
            <form action="{{ route('checkout.place-order') }}" method="POST">
                @csrf
                <div class="form-section">
                    <h3>Personal Information</h3>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Shipping Information</h3>
                    <div class="form-group">
                        <label for="address">Delivery Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                        @error('city')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <select id="region" name="region" required>
                            <option value="">Select Region</option>
                            <option value="Greater Accra" {{ old('region') == 'Greater Accra' ? 'selected' : '' }}>Greater Accra</option>
                            <option value="Ashanti" {{ old('region') == 'Ashanti' ? 'selected' : '' }}>Ashanti</option>
                            <option value="Western" {{ old('region') == 'Western' ? 'selected' : '' }}>Western</option>
                            <option value="Eastern" {{ old('region') == 'Eastern' ? 'selected' : '' }}>Eastern</option>
                            <option value="Central" {{ old('region') == 'Central' ? 'selected' : '' }}>Central</option>
                            <option value="Volta" {{ old('region') == 'Volta' ? 'selected' : '' }}>Volta</option>
                            <option value="Northern" {{ old('region') == 'Northern' ? 'selected' : '' }}>Northern</option>
                            <option value="Upper East" {{ old('region') == 'Upper East' ? 'selected' : '' }}>Upper East</option>
                            <option value="Upper West" {{ old('region') == 'Upper West' ? 'selected' : '' }}>Upper West</option>
                            <option value="Bono" {{ old('region') == 'Bono' ? 'selected' : '' }}>Bono</option>
                            <option value="Bono East" {{ old('region') == 'Bono East' ? 'selected' : '' }}>Bono East</option>
                            <option value="Ahafo" {{ old('region') == 'Ahafo' ? 'selected' : '' }}>Ahafo</option>
                            <option value="Savannah" {{ old('region') == 'Savannah' ? 'selected' : '' }}>Savannah</option>
                            <option value="North East" {{ old('region') == 'North East' ? 'selected' : '' }}>North East</option>
                            <option value="Oti" {{ old('region') == 'Oti' ? 'selected' : '' }}>Oti</option>
                            <option value="Western North" {{ old('region') == 'Western North' ? 'selected' : '' }}>Western North</option>
                        </select>
                        @error('region')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Additional Information</h3>
                    <div class="form-group">
                        <label for="notes">Order Notes (Optional)</label>
                        <textarea id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Order Summary</h3>
                    <div class="order-summary-items">
                        @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="order-item-image">
                                <img src="{{ asset($item['product']->image_path) }}" alt="{{ $item['product']->name }}">
                                <span class="order-item-quantity">{{ $item['quantity'] }}</span>
                            </div>
                            <div class="order-item-details">
                                <h4>{{ $item['product']->name }}</h4>
                                <p>₵{{ number_format($item['product']->sale_price ?? $item['product']->regular_price, 2) }} x {{ $item['quantity'] }}</p>
                            </div>
                            <div class="order-item-price">
                                ₵{{ number_format($item['subtotal'], 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="order-totals">
                        <div class="total-row">
                            <span>Subtotal:</span>
                            <span>₵{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="total-row">
                            <span>Shipping:</span>
                            <span>₵20.00</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Total:</span>
                            <span>₵{{ number_format($total + 20, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="checkout-actions">
                    <button type="submit" class="place-order-btn">Place Order</button>
                    <a href="{{ route('cart.index') }}" class="back-to-cart"><i class="fas fa-arrow-left"></i> Back to Cart</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection