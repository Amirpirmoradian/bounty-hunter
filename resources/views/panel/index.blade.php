@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card shop-card">
                @if (!count($cart))
                    <div class="card-header">{{ __('خطا') }}</div>

                    <div class="card-body offcode-container">
                        <h2 class="offcode-header">سبد خرید شما تکمیل است.</h2>
                    </div>
                @else
                    <div class="card-header">
                        {{ __('سبد خرید') }}

                        <a href="/shop/{{ $seller->username }}" class="back-to-shop">
                            بازگشت به لیست محصولات
                        </a>
                    
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th scope="col">نام</th>
                                          <th scope="col">تعداد</th>
                                          <th scope="col">قیمت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cart['products'] as $product)
                                        <tr>
                                            <td>{{ $product['data']['name'] }}</td>
                                            <td>x{{ $product['quantity'] }}</td>
                                            <td>
                                                {{ number_format($product['quantity'] * $product['data']['price'], 0,',') }} تومان
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
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

                    <a href="{{ route('checkout') }}" class="cart-checkout btn btn-primary">
                        ثبت سفارش خرید
                    </a>
                
                </div>
            @endif --}}

        </div>
    </div>
</div>
@endsection
