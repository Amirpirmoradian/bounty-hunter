@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('فروشنده') }}
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('افزودن محصول') }}
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form action="{{ route('admin-sellers-add-product', $seller->id) }}" enctype="multipart/form-data""
                    method="POST" class="form-horizontal form-label-left">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">محصول</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="select2 form-select full-width" name="product_id" aria-label="Default select example">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">موجودی</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="number" class="form-control" name="quantity" placeholder="{{ __('موجودی') }}">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                {{ __('اضافه کردن') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('محصولات') }}
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
                                <th class="column-title" style="display: table-cell;width: 10%;">u;s</th>
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('نام') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">موجودی</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">قیمت</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($seller->products as $product)
                                <tr class="even pointer">
                                    <td>
                                        {{ $product->id }}
                                    </td>

                                    <td>
                                        {{ $product->mootanroo_id }}
                                    </td>

                                    <td>
                                        <img width="200" src="{{ $product->media_url }}" alt="{{ $product->danger }}">
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


                                    <td class=" last">
                                        <a href="{{ route('admin-sellers-remove-product',[ $seller->id, $product->id]) }}" class="btn btn-default">
                                            {{ __('حذف') }}
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
