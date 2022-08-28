@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('سفارشات') }}
                </h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table" id="branches-table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('مشتری') }}</th>
                                <th class="column-title" style="display: table-cell;width: 50%;">{{ __('فروشنده') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">مبلغ کل</th>
                                <th class="column-title no-link last" style="display: table-cell;width: 15%;">
                                    <span class="nobr">
                                        {{ __('عملیات') }}
                                    </span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="even pointer">
                                    <td>
                                        {{ $order->customer->FullName }}
                                    </td>

                                    <td>
                                        {{ $order->seller->FullName }}
                                    </td>

                                    <td>
                                        {{ number_format($order->order_total ,0,',') }}
                                    </td>

                                    <td class=" last">
                                        <a href="{{ route('admin-orders-show', $order->id) }}" class="btn btn-default">
                                            {{ __('مشاهده') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
