@extends('frontend.layouts.app')
@section('content')
    @include('frontend.layouts.partials.nav')
    <section class="container" style="margin-top: 100px">
        <div class="row mx-auto " style="max-width: 1000px;">
            <div class="col-md-3 col-6 my-1">
                <a href="{{ route('head.and.tail') }}">
                    <img src="{{ asset('assets/images/frontend/images/heads-tails.jpg') }}" class="w-100 rounded"
                        alt="">
                    <h4 class="text-center text-light my-1">Head and Tail</h4>
                </a>
            </div>
        </div>
        <div class="row mx-auto " style="max-width: 1000px;">
            <div class="col-md-3 col-6 my-1">
                <a href="{{ route('dragon.tiger.play') }}">
                    <img src="{{ asset('assets/images/frontend/images/heads-tails.jpg') }}" class="w-100 rounded"
                        alt="">
                    <h4 class="text-center text-light my-1">Dragon Tiger</h4>
                </a>
            </div>
        </div>
    </section>
    @include('frontend.layouts.partials.footer')
@endsection
