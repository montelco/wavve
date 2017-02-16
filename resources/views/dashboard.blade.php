@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')

    @if (session('status'))
        <div class="row">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h1 class="page-header">
                Dashboard
                <small> Your Overview</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-dashboard fa-fw"></i> Quick Links</h3>
                </div>

                <div class="panel-body quickLinks">
                    <a href="{{ url('/passes/editor') }}">
                        <div class="quickLinks__link"><i class="fa fa-plus" aria-hidden="true"></i> Make a new Pass
                        </div>
                    </a>
                    <hr>
                    <a href="{{ url('/passes/scheduler') }}">
                        <div class="quickLinks__link"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Pass
                            Scheduler
                        </div>
                    </a>
                </div>

                <div class="panel-body quickLinksButtons">
                    <button class="btn btn-block quickLinksButtons__button">
                        <a href="{{ url('/passes/editor') }}">
                            <div class="quickLinks__link"><i class="fa fa-plus" aria-hidden="true"></i> Make a new Pass
                            </div>
                        </a>
                    </button>
                    <hr>
                    <button class="btn btn-block quickLinksButtons__button">
                        <a href="{{ url('/passes/scheduler') }}" class="cta">
                            <div class="quickLinks__link"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Pass
                                Scheduler
                            </div>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bell fa-fw"></i> Recent Activity</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @if($newsFeed->count())
                            @foreach ($newsFeed as $item)
                                <a href="/{{$item->uuid}}" class="list-group-item">
                                    <span class="badge">{{ $item->FriendlyTime }}</span>
                                    <i class="fa fa-fw fa-tags"></i> <strong>Pass:</strong>{{ $item->title }}
                                </a>
                            @endforeach
                        @else
                            Nothing to show yet. Make a pass to get started.
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> 24 Hr. Visitor Preview</h3>
                </div>
                <div class="panel-body">
                    @if(isset($visitors))
                        <p class="huge-centered">{{ $visitors }}</p>
                    @else
                        <p class="huge-centered">0</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
