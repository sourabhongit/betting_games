@extends('frontend.layouts.app')
@section('content')
    @include('frontend.layouts.partials.nav')
    <section id="profile">
        <div class="container py-4 py-md-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4 my-2 text-center">
                    <img src="{{ asset('assets/images/frontend/images/user.png') }}" class="profile-img rounded-circle shadow"
                        alt="Profile Picture">
                </div>
                <div class="col-md-5 text-center text-md-start user-info mx-auto">
                    <h1 class="text-light mb-3">{{ auth()->user()->name }}</h1>
                    <p class="text-light mb-2"><span class="highlight">Email:</span> {{ auth()->user()->email }}</p>
                    <p class="text-light mb-2"><span class="highlight">Phone Number:</span>
                        {{ auth()->user()->phone_number }}</p>
                    @if ($userBank !== null)
                        <p class="text-light mb-2"><span class="highlight">Bank Account:</span>
                            {{ $userBank->account_number }}</p>
                    @endif
                    @if ($userUpi !== null)
                        <p class="text-light mb-2"><span class="highlight">UPI:</span> {{ $userUpi->upi_id }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary w-100" id="bank-detail">Update Bank Details</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100" id="upi-detail">Update UPI</button>
                </div>
            </div>
        </div>
    </section>
    <section class='mx-3 mt-3 d-none' id='bank-form-section'>
        <form method='POST' action={{ route('add.player.bank.details') }}>
            @csrf
            <div class="row">
                <div class="mb-3 d-none">
                    <input type="text" class="form-control" name="user_id" id="user_id"
                        value={{ auth()->user()->id }} />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Bank<span class="text-danger">*</span></label>
                    <select class="form-select" id="bank" name='bank_name'>
                        <option selected disabled>Select Bank</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank }}">{{ $bank }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Account Number<span class="text-danger">*</span></label>
                    <input class="form-control" id="account_number" name="account_number" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">IFSC Code<span class="text-danger">*</span></label>
                    <input class="form-control" id="ifsc_code" name="ifsc_code" />
                </div>
                <div class="mb-3 col-md-12">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </section>
    <section class='mx-3 mt-3 d-none' id='upi-form-section'>
        <form method="POST" action={{ route('add.player.upi.details') }}>
            @csrf
            <div class="row">
                <div class="mb-3 d-none">
                    <input type="text" class="form-control" name="user_id" value={{ auth()->user()->id }}
                        id="user_id" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">UPI ID<span class="text-danger">*</span></label>
                    <input class="form-control" name="upi_id" id="bank" />
                </div>
                <div class="mb-3 col-md-12">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </section>
    @include('frontend.layouts.partials.footer')
    <style>
    .user-info {
            padding: 20px;
            border-radius: 10px;
        }
        .highlight {
            font-weight: 900;
        }
        p {
            font-size: 20px;
            line-height: 1.5;
        }
    </style>
    <script id='different-forms'>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('bank-detail').addEventListener('click', function() {
                document.getElementById('upi-form-section').classList.add('d-none');
                document.getElementById('bank-form-section').classList.remove('d-none');
            });
            document.getElementById('upi-detail').addEventListener('click', function() {
                document.getElementById('bank-form-section').classList.add('d-none');
                document.getElementById('upi-form-section').classList.remove('d-none');
            });
        });
    </script>
@endsection
