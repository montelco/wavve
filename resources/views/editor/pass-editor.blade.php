@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
    <style>
        .pass-theme-select{
            width: 100%;
            height: 65vh;
            background: #6B5078 !important; /* Alternate colour: #774A78 */
            border: solid 1px #909494 !important;
            transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
        }
        .pass-theme-select{
            transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            color: white !important;
        }

        .pass-theme-select:hover,
        .pass-theme-select:active {
            color: #909494 !important;
            text-decoration: none !important;
            transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            background: #503C59 !important;
        }
        @media(max-width: 767px){
            .pass-theme-select{
                margin-bottom: 4vh;
            }
        }
    </style>
	<div class="row">
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/1') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Member Pass
                </button>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/2') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Special Deal Pass
                </button>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ URL::to('/passes/editor/3') }}">
                <button type="button" class="btn btn-default btn-lg pass-theme-select">
                    Custom Pass
                </button>
            </a>
        </div>
    </div>
@endsection
