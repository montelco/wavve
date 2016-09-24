@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h1 class="page-header">
                Dashboard <small> Your Overview</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-dashboard fa-fw"></i> Quick Links</h3>
                </div>

                <div class="panel-body">
                    <p>Get started below...</p>
                    <hr>
                    <a href="{{ url('/passes/editor') }}" class="cta">Make a new Pass</a>
                    <hr>
                    <a href="{{ url('/passes/scheduler') }}" class="cta">Pass Scheduler</a>
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
    </div>

@endsection
