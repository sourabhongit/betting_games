@extends('frontend.layouts.app')
@section('content')
    <section class="login">
        <div class="container">
            <form method="POST" action="{{ route('user.login.store') }}">
                @csrf
                <div class="card card-body glass-container">
                    <input type="email" class="form-control my-2" placeholder="Email" name="email"
                        value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif

                    <input type="password" class="form-control my-2" placeholder="Password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                    <button type="submit" class="btn btn-info my-2">Login</button>

                    <p class="text-center text-light mb-0 my-1">
                        <a href="{{ route('user.register') }}" class="text-light">Register User</a> |
                        <a href="{{ route('password.request') }}" class="text-light">Forgot Password</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
@endsection
