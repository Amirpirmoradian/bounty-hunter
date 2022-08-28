@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shop-card">
                @if (!count($products))
                    <div class="card-header">{{ __('خطا') }}</div>

                    <div class="card-body offcode-container">
                        <h2 class="offcode-header">این فروشنده کالای موجود ندارد.</h2>
                    </div>
                @else
                    <div class="card-header">{{ __('فروشگاه') }}</div>

                    <div class="card-body">
                        <div class="row product-container">
                            @foreach ($products as $product)
                                <div class="product-item">
                                    <div class="product-picture">
                                        <img src="{{ $product->media_url }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="product-meta">
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-link">
                                            <a target="_blank" href="https://mootanroo.com/p-{{ $product->mootanroo_id }}">
                                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M14.851 11.923c-.179-.641-.521-1.246-1.025-1.749-1.562-1.562-4.095-1.563-5.657 0l-4.998 4.998c-1.562 1.563-1.563 4.095 0 5.657 1.562 1.563 4.096 1.561 5.656 0l3.842-3.841.333.009c.404 0 .802-.04 1.189-.117l-4.657 4.656c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-1.952-1.951-1.952-5.12 0-7.071l4.998-4.998c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464.493.493.861 1.063 1.105 1.672l-.787.784zm-5.703.147c.178.643.521 1.25 1.026 1.756 1.562 1.563 4.096 1.561 5.656 0l4.999-4.998c1.563-1.562 1.563-4.095 0-5.657-1.562-1.562-4.095-1.563-5.657 0l-3.841 3.841-.333-.009c-.404 0-.802.04-1.189.117l4.656-4.656c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464 1.951 1.951 1.951 5.119 0 7.071l-4.999 4.998c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-.494-.495-.863-1.067-1.107-1.678l.788-.785z"/></svg>
                                            </a>
                                        </div>
                                        <div class="product-price">{{ number_format($product->price,0,',') }} تومان</div>
                                        <div class="product-add-to-cart">
                                            @if (isset(session('cart')['products'][$product->id]) && session('cart')['products'][$product->id]['quantity'] > 0)
                                                <a class="btn btn-primary" href="{{route('removeFromCart', array($product->id, $sellerId))}}">-</a>

                                                <span class="product-count-in-cart">
                                                    {{ session('cart')['products'][$product->id]['quantity'] }} عدد
                                                </span>
                                            @endif
                                            <a class="btn btn-primary" href="{{route('addToCart', array($product->id, $sellerId))}}">+</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            @endforeach
                            
                        </div>
                        
                    </div>
                @endif
                
            </div>
            @if (isset(session('cart')['products']) && session('cart')['total'] > 0)
                <div class="cart-container">
                    <div class="cart-items">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.53 7l-.564 2h-15.127l-.839-2h16.53zm-14.013 6h12.319l.564-2h-13.722l.839 2zm5.983 5c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm11.305-15l-3.432 12h-13.017l.839 2h13.659l3.474-12h1.929l.743-2h-4.195zm-6.305 15c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5z"/></svg>
                        <span class="cart-count">
                            {{ session('cart')['totalquantity'] }} مورد در سبد خرید
                        </span>
                    </div>
                    <div class="cart-total">
                        {{ number_format(session('cart')['total'],0,',') }} تومان
                    </div>
                    <div class="clearfix"></div>

                    <div class="cart-checkout btn btn-primary">
                        ثبت سفارش خرید
                    </div>
                
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
