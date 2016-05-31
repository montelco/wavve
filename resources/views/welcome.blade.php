@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="../css/welcome.css">
<div class="container">
    <div class="row">
        <div class="content centering">
            <h1 class="ch">The Future of Marketing is Here</h1>
            <p class="ct">Whether you have two employees or two hundred, have the insight and analytics that can help make your business grow and adapt with the ever changing landscape of technology. You'll look like you have a team of marketing experts on staff thanks to Wavvve's powerful analytics engine that helps you turn passersby into customers.</p>
            @if (Auth::guest())
                <!-- <a href="{{ url('/register') }}" class="cta">Sign Up</a> -->
                <a href="{{ url('/login') }}" class="cta">Login</a>
            @else
                <a href="{{ url('/dashboard') }}" class="cta">Dashboard</a>
            @endif
        </div>
    </div>
</div>
@endsection
