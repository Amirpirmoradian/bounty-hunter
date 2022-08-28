@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card referrals-card">
                <div class="card-header">
                    {{ __('قفسه') }}
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">کالاهای موجود</th>
                                    <th scope="col">فروخته شده</th>
                                    <th scope="col">مبلغ کل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $totalInStock }}
                                        </td>
                                        <td>
                                            {{ $totalSold }}
                                        </td>
                                        <td>
                                            {{ number_format($totalAmount ,0,',') }} 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <a href="{{ route('shelfInStock') }}">
                                                مشاهده همه
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('shelfSold') }}">
                                                مشاهده همه
                                            </a>
                                        </td>
                                        <td>
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
