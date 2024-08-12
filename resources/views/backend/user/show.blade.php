@extends('backend.layouts.main')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title float-left mt-2">User Details</h4>
        </div>
        <div class="nk-block-des text-right">
            <a href="{{ route('user.index') }}"><button class="btn btn-secondary"><em
                        class="icon ni ni-arrow-left"></em>Back</button></a>
        </div>
    </div>
    <div class="card card-bordered">
        <div class="card-inner">
            <div class="nk-block">
                <div class="nk-data data-list">
                    <div class="data-head">
                        <h6 class="overline-title">Basics</h6>
                    </div>
                    @if (isset($user))
                        @foreach ($user->getAttributes() as $key => $value)
                            @if ($key !== 'id')
                                <div class="data-item">
                                    <div class="data-col"><span class="data-label">{{ $key }}</span><span
                                            class="data-value">{{ $value }}</span></div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="nk-data data-list">
                    <div class="data-head">
                        <h6 class="overline-title">Preferences</h6>
                    </div>
                    <div class="data-item">
                        <div class="data-col"><span class="data-label">Language</span><span class="data-value">English
                                (United State)</span></div>
                        <div class="data-col data-col-end"><a data-bs-toggle="modal" href="#modalLanguage"
                                class="link link-primary">Change Language</a></div>
                    </div>
                    <div class="data-item">
                        <div class="data-col"><span class="data-label">Date Format</span><span class="data-value">M, D,
                                YYYY</span></div>
                        <div class="data-col data-col-end"><a data-bs-toggle="modal" href="#modalDate"
                                class="link link-primary">Change</a></div>
                    </div>
                    <div class="data-item">
                        <div class="data-col"><span class="data-label">Timezone</span><span class="data-value">Bangladesh
                                (GMT +6:00)</span></div>
                        <div class="data-col data-col-end"><a data-bs-toggle="modal" href="#modalTimezone"
                                class="link link-primary">Change</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
@endpush
