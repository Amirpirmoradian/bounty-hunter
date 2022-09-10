@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card referrals-card">
                <div class="card-header">
                    {{ __('موجودی') }}
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table" id="branches-table">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title" style="display: table-cell;width: 10%;">عکس</th>
                                        <th class="column-title" style="display: table-cell;width: 15%;">{{ __('نام') }}</th>
                                        <th class="column-title" style="display: table-cell;width: 10%;">موجودی</th>
                                        <th class="column-title" style="display: table-cell;width: 10%;">قیمت</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="even pointer">
                                           
        
                                            <td>
                                                <img width="50" src="{{ $product->media_url }}" alt="{{ $product->danger }}">
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
        
                                            <td>
                                                {{ $product->pivot->quantity }}
                                            </td>
        
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                           
        
                                        </tr>
                                    @endforeach
        
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
