@extends('frontend.layouts.app')
@section('content')
    <section class="register">
        <div class="container">
            <form method="POST" action="{{ route('user.register.store') }}">
                @csrf
                <div class="card card-body glass-container">
                    <input type="text" class="form-control my-2" placeholder="Enter Your Full Name" name="name"
                        value="{{ old('name') }}" autocomplete="new-password">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif

                    <input type="email" class="form-control my-2" placeholder="Enter Your Email" name="email"
                        value="{{ old('email') }}" autocomplete="new-password">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif

                    <input type="text" class="form-control my-2" placeholder="Enter Your 10 Digit Phone Number"
                        name="number" value="{{ old('number') }}" autocomplete="new-password">
                    @if ($errors->has('number'))
                        <span class="text-danger">{{ $errors->first('number') }}</span>
                    @endif

                    <input type="password" class="form-control my-2" placeholder="Enter Password" name="password"
                        autocomplete="new-password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                    <button type="submit" class="btn btn-info my-2">Register</button>
                    <p class="text-center text-light mb-0 my-1"><a href="{{ route('user.login') }}"
                            class="text-light">Login</a></p>
                </div>
            </form>
        </div>
    </section>
@endsection
