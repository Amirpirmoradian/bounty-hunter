@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('اضافه کردن محصول') }}
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form action="{{ isset($currentProduct) ? route('admin-products-update', $currentProduct->id)  : route('admin-products-list') }}" enctype="multipart/form-data""
                    method="POST" class="form-horizontal form-label-left">
                    @csrf
                    @if (isset($currentProduct))
                        @method('PUT')
                        <input type="text" hidden value="{{ $currentProduct->id }}" name="game_id">
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('شناسه موتن‌رو') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="text" class="form-control" name="mootanroo_id" placeholder="{{ __('شناسه موتن‌رو') }}"
                                value="{{ isset($currentProduct) ? $currentProduct->mootanroo_id : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('نام محصول') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="text" class="form-control" name="name" placeholder="{{ __('نام محصول') }}"
                                value="{{ isset($currentProduct) ? $currentProduct->name : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('لینک تصویر محصول') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="text" class="form-control" name="media_url" placeholder="{{ __('لینک تصویر محصول') }}"
                                value="{{ isset($currentProduct) ? $currentProduct->media_url : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('قیمت') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="text" class="form-control" name="price" placeholder="{{ __('قیمت') }}"
                                value="{{ isset($currentProduct) ? $currentProduct->price : '' }}">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($currentProduct) ? __('ویرایش') : __('اضافه') }}
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
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('شناسه مو تن رو') }}</th>
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('عکس') }}</th>
                                <th class="column-title" style="display: table-cell;width: 50%;">{{ __('نام') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">قیمت</th>
                                <th class="column-title no-link last" style="display: table-cell;width: 20%;">
                                    <span class="nobr">
                                        {{ __('عملیات') }}
                                    </span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr class="even pointer">

                                    <td>
                                        {{ $product->id }}
                                    </td>

                                    <td>
                                        {{ $product->mootanroo_id }}
                                    </td>

                                    <td>
                                        <img width="200" src="{{ $product->media_url }}" alt="{{ $product->name }}">
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        {{ number_format($product->price ,0,',') }} 
                                    </td>

                                    <td class=" last">
                                        <a href="{{ route('admin-products-edit', $product->id) }}" class="btn btn-default">
                                            {{ __('ویرایش') }}
                                        </a>
                                        <form style="display: inline;" method="POST"
                                            action="{{ route('admin-products-delete', $product->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger delete-btn">
                                                {{ __('حذف') }}
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
