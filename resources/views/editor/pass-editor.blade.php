@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
    <style>
        .pass-theme-select {
            background: #6B5078 !important;
            border: solid 1px #909494 !important;
            height: 26vh;
            margin-bottom: 4vh; /* Alternate colour: #774A78 */
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            width: 100%;
        }

        .pass-theme-select {
            color: white !important;
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
        }

        .pass-theme-select:hover,
        .pass-theme-select:active {
            background: #503C59 !important;
            color: #909494 !important;
            text-decoration: none !important;
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
        }

        @media only screen and (min-width: 768px) {
            .pass-theme-select {
                height: 65vh;
                margin-bottom: 0;
            }
        }
    </style>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/1') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Full Page Background Pass
                </button>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/2') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Center Strip Image Pass
                </button>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/3') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Custom Image Pass
                </button>
            </a>
        </div>
    </div>
@endsection
