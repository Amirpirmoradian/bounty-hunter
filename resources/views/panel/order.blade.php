@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card referrals-card">
                <div class="card-header">
                    {{ __('سفارش') }}
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table" id="branches-table">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title" style="display: table-cell">{{ __('شماره') }}</th>
                                        <th class="column-title" style="display: table-cell">{{ __('تاریخ') }}</th>
                                        <th class="column-title" style="display: table-cell;">{{ __('مشتری') }}</th>
                                        <th class="column-title" style="display: table-cell;">مبلغ کل</th>
                                        <th class="column-title" style="display: table-cell;">تسویه شده</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    <tr class="even pointer">
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                     
                                        <td class="date-time">{{ $order->created_at }}</td>

                                        <td class="phone-number">
                                            {{ substr($order->customer->phone_number, 0, 4) . "****" . substr($order->customer->phone_number, 7, 4); }}
                                        </td>
    
                                        
    
                                        <td>
                                            {{ number_format($order->order_total ,0,',') }} تومان
                                        </td>
    
    
                                        <td>
                                            @if ($order->cleared)
                                                <i class="fa fa-check" style="color:green">بله</i>
                                            @else
                                                <i class="fa fa-times" style="color:red">خیر</i>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                
            </div>
          

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card referrals-card">
                <div class="card-header">
                    {{ __('محصولات') }}
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table" id="branches-table">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title" style="display: table-cell">{{ __('شناسه') }}</th>
                                        <th class="column-title" style="display: table-cell;">{{ __('نام') }}</th>
                                        <th class="column-title" style="display: table-cell;">قیمت واحد</th>
                                        <th class="column-title" style="display: table-cell;">تعداد</th>
                                        <th class="column-title" style="display: table-cell;">قیمت کل</th>
        
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr class="even pointer">
                                            <td>
                                                {{ $product->id }}
                                            </td>
        
                                            <td>
                                                {{ $product->name }}
                                            </td>
        
                                            <td>
                                                {{ number_format($product->pivot->price ,0,',') }}
                                            </td>
        
                                            <td>
                                                {{ $product->pivot->quantity }}
                                            </td>
        
                                            <td>
                                                {{ number_format($product->pivot->quantity * $product->pivot->price ,0,',') }}
                                            </td>
        
                                            
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>جمع کل</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            {{ number_format($order->order_total ,0,',') }}
                                        </td>
                                    </tr>
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
