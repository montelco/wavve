@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="../css/welcome.css">
<div class="container">
    <div class="row">
        <div class="content centering">
            <h1 class="ch">A Better Way of Marketing</h1>
            <p class="ct">Wavvve is an easy-to-use platform designed to make businesses of any size better at marketing. With simple tools and a useable interface, engage potential customers with online content that inspires real-world, offline interactions. Create campaigns to reach passersby and alert them to what your business has to offer. Think of it like a personal billboard delivered right to a person's phone.</p>
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
