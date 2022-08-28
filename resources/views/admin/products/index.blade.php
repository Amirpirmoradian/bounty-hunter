@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('Add game') }}
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form action="{{ isset($currentGame) ? route('admin-games-update', $currentGame->id)  : route('admin-games-list') }}" enctype="multipart/form-data""
                    method="POST" class="form-horizontal form-label-left">
                    @csrf
                    @if (isset($currentGame))
                        @method('PUT')
                        <input type="text" hidden value="{{ $currentGame->id }}" name="game_id">
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('Game title') }}</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="text" class="form-control" name="title" placeholder="{{ __('Game title') }}"
                                value="{{ isset($currentGame) ? $currentGame->title : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __("Game icon") }}</label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            @if (isset($currentGame->media_path))
                                <img src="{{ $currentGame->media_path }}" alt="" width="200">
                            @endif
                            <input type="file" name="photo">
                            @if (isset($currentGame->MediaUrl))
                                <p>{{ __('Upload new photo to change') }}</p>
                            @endif
                            <p>{{ __('Photo should be square') }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">تیمی یا تکی</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="select2 form-select full-width" name="game_type" aria-label="Default select example">
                                    <option value="solo" {{ isset($currentGame) && $currentGame->game_type == 'solo' ? 'selected' : '' }}>تکی</option>   
                                    <option value="team" {{ isset($currentGame) && $currentGame->game_type == 'team' ? 'selected' : '' }}>تیمی</option>   
                              </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">تعداد اعضا تیم</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input required type="number" class="form-control" name="team_member_count" placeholder="{{ __('تعداد اعضا تیم') }}"
                                value="{{ isset($currentGame) ? $currentGame->team_member_count : '' }}">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">
                                {{ isset($currentGame) ? __('Edit') : __('Add') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>
                    {{ __('Games') }}
                </h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table" id="branches-table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title" style="display: table-cell;width: 15%;">{{ __('Photo') }}</th>
                                <th class="column-title" style="display: table-cell;width: 50%;">{{ __('Title') }}</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">تکی یا تیمی</th>
                                <th class="column-title" style="display: table-cell;width: 10%;">تعداد اعضا تیم</th>
                                <th class="column-title no-link last" style="display: table-cell;width: 15%;">
                                    <span class="nobr">
                                        {{ __('Actions') }}
                                    </span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($games as $game)
                                <tr class="even pointer">
                                    <td>
                                        <img src="{{ $game->media_path }}" alt="{{ $game->title }}">
                                    </td>
                                    <td>
                                        {{ $game->title }}
                                    </td>

                                    <td>
                                        {{ $game->game_type == 'solo' ? 'تکی' : 'تیمی' }}
                                    </td>

                                    <td>
                                        {{ $game->team_member_count }}
                                    </td>

                                    <td class=" last">
                                        <a href="{{ route('admin-games-edit', $game->id) }}" class="btn btn-default">
                                            {{ __('Edit') }}
                                        </a>
                                        <form style="display: inline;" method="POST"
                                            action="{{ route('admin-games-delete', $game->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger delete-btn">
                                                {{ __('Delete') }}
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $games->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
