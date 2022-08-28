@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('فروشندگان') }}
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
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('نام') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">موبایل</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">نام کاربری</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">نام سالن</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sellers as $seller)
                                <tr class="even pointer">
                                    <td>
                                        {{ $seller->id }}
                                    </td>

                                    <td>
                                        {{ $seller->mootanroo_id }}
                                    </td>

                                    <td>
                                        {{ $seller->FullName }}
                                    </td>

                                    <td>
                                        {{ $seller->phone_number }}
                                    </td>

                                    <td>
                                        {{ $seller->username }}
                                    </td>

                                    <td>
                                        {{ $seller->saloon_name }}
                                    </td>


                                    <td class=" last">
                                        <a href="{{ route('admin-sellers-show', $seller->id) }}" class="btn btn-default">
                                            {{ __('نمایش') }}
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $sellers->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
