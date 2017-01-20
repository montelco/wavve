@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="welcome">
                <h1 class="welcome__header">A Better Way of Business</h1>
                <p class="welcome__text">Wavvve is an easy-to-use platform designed to make businesses of any size
                    better at marketing. With simple tools and a useable interface, engage potential customers with
                    online content that inspires real-world, offline interactions. Create campaigns to reach passersby
                    and alert them to what your business has to offer. Think of it like a personal billboard delivered
                    right to a person's phone.</p>
            @if (Auth::guest())
                <!-- <a href="{{ url('/register') }}" class="cta">Sign Up</a> -->
                    <a href="{{ url('/login') }}" class="welcome__button btn">Login</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="welcome__button btn">Dashboard</a>
                @endif
            </div>
        </div>
    </div>
@endsection
