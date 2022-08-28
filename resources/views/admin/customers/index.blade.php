@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('مشتریان') }}
                </h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table" id="branches-table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('شناسه') }}</th>
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('شناسه مو‌تن‌رو') }}</th>
                                <th class="column-title" style="display: table-cell;width: 50%;">{{ __('نام') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">موبایل</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customers as $customer)
                                <tr class="even pointer">
                                    <td>
                                        {{ $customer->id }}
                                    </td>

                                    <td>
                                        {{ $customer->mootanroo_id }}
                                    </td>

                                    <td>
                                        {{ $customer->FullName }}
                                    </td>

                                    <td>
                                        {{ $customer->phone_number }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $customers->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
