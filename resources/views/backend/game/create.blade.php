@extends('backend.layouts.main')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title float-left mt-2">Add Game Details</h4>
        </div>
        <div class="nk-block-des text-right">
            <a href="{{ route('game.index') }}"><button class="btn btn-secondary"><em
                        class="icon ni ni-arrow-left"></em>Back</button></a>
        </div>
    </div>
    <div id="passwordError"></div>
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ route('game.store') }}" id="form" method="post">
                @csrf
                <div class="row gy-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" data-msg="This field is required" class="form-control required"
                                    name="name" placeholder="Enter Name" value="{{ old('name', $game->name ?? '') }}"
                                    required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <textarea data-msg="This field is required" class="form-control required" name="description"
                                    placeholder="Enter Description" required>{{ old('description', $game->description ?? '') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button id="submitBtn" type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-js')
@endpush
