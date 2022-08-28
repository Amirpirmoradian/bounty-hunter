@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ورود') }}</div>

                <div class="card-body login-form">
                    @if($saloonName != null)
                        <h2>به مو‌تن‌رو، فروشگاه ارایشی و بهداشتی خوش آمدید.</h2>
                        <p>باعث افتخار ماست که به شما مشتری گرامی سالن آرایش و زیبایی {{$saloonName}}، هدیه‌ای ارزشمند از طرف مو‌تن‌رو تقدیم کنیم.</p>
                    @endif
                    <form method="GET" action="{{ route('verify') }}">
                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('شماره موبایل') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ورود') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
