@extends('backend.layouts.main')
<style>
    .alert-div {
        position: fixed;
        right: 38px;
        width: 20%;
        z-index: 10;
    }

    @media only screen and (max-width: 767px) {
        .alert-div {
            position: relative;
            right: 0;
            width: 100%;
            z-index: 10;
        }
    }
</style>
@section('content')
    <x-alert />
    <div class="row g-gs">
        <div class="col-md-4 col-xxl-3">
            <div class="card card-bordered h-100">
                <div class="card-inner mb-n2 text-center">
                    <div class="card-title">
                        <h4 class="title">Total Users</h4>
                    </div>
                    <div class="card-body">
                        <h2><em class="icon ni ni-users"></em> {{ $UserCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
@endpush
