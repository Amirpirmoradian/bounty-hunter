@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shop-card">
                <div class="card-header">
                    {{ __('سفارش') }}

                    <a href="/shop/{{ $seller->username }}" class="back-to-shop">
                        بازگشت به لیست محصولات
                    </a>
                
                </div>

                <div class="card-body">
                    <h2>سفارش شما با موفقیت ثبت شد.</h2>
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
                                {{-- @foreach ($cart['products'] as $product)
                                    <tr>
                                        <td>{{ $product['data']['name'] }}</td>
                                        <td>x{{ $product['quantity'] }}</td>
                                        <td>
                                            {{ number_format($product['quantity'] * $product['data']['price'], 0,',') }} تومان
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
           

        </div>
    </div>
</div>
@endsection
