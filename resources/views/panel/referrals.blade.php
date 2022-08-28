@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card referrals-card">
                <div class="card-header">
                    {{ __('ارجاع داده شده ها') }}
                </div>

                <div class="card-body">
                    @if(count($referrals) > 0)
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">شماره موبایل</th>
                                        <th scope="col">تاریخ ثبت نام در موتن‌رو</th>
                                        <th scope="col">تاریخ اولین خرید</th>
                                        <th scope="col">مبلغ پاداش</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($referrals as $referral)
                                        <tr>
                                            <td class="phone-number">{{ substr($referral->phone_number, 0, 4) . "****" . substr($referral->phone_number, 7, 4); }}</td>
                                            <td class="date-time">{{ $referral->created_at }}</td>
                                            <td>
                                                نامشخص
                                            </td>

                                            <td>
                                                نامشخص
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <h2>هنوز کسی از سمت شما ثبت نام نکرده است</h2>
                    @endif
                    
                    
                </div>
                
            </div>
          

        </div>
    </div>
</div>
@endsection
