@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($offcode == null)
                    <div class="card-header">{{ __('خطا') }}</div>

                    <div class="card-body offcode-container">
                        <h2 class="offcode-header">شما تنها می‌توانید یک کد تخفیف دریافت کنید.</h2>
                        <p class="offcode-description">
                            برای ورود به سایت مو‌تن‌رو و استفاده از تخفیف قبلی خود، روی لینک زیر کلیک کنید:
                        </p>
                        <a href="https://mootanroo.com/" class="btn btn-primary offcode-link">
                            ورود به مو‌تن‌رو
                        </a>
                    </div>
                @else
                    <div class="card-header">{{ __('تبریک') }}</div>

                    <div class="card-body offcode-container">
                        <h2 class="offcode-header">شما برنده کد تخفیف اختصاصی شدید.</h2>
                        <p class="offcode-description">برای خرید لوازم آرایشی و بهداشتی خود با تخفیف ویژه، از کد زیر استفاده کنید:</p>
                        <span class="offcode">{{ $offcode->code }}</span>
                        <p class="offcode-description">
                            برای ورود به سایت مو‌تن‌رو و استفاده از این تخفیف شگفت انگیز، روی لینک زیر کلیک کنید:
                        </p>
                        <a href="https://mootanroo.com/" class="btn btn-primary offcode-link">
                            ورود به مو‌تن‌رو
                        </a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
