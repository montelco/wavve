@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')


@section('dashContent')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Your Analytics
        </h1>
        <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="{{ url('passes/analytics') }}">
                        <i class="fa fa-line-chart"></i> Analytics
                    </a>
                </li>
            </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Total Visitors</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    {{-- <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
                <div class="text-right">
                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Recent Activity on Passes</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @if(isset($recent))
                        @foreach($recent as $visit)
                            <a href="#" class="list-group-item">
                                <span class="badge">{{$visit->friendlyTime}}</span>
                                <i class="fa fa-fw fa-eye"></i> Someone viewed {{$visit->passes->title}}
                            </a>
                        @endforeach
                    @else
                        <h2>No recent activity on your content.</h2>
                    @endif
                </div>
                <div class="text-right">
                    {{-- <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tag fa-fw"></i> Passes Overview</h3>
            </div>
            <div class="panel-body">
            @if(isset($totals))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Pass Title</th>
                                <th>Post Date</th>
                                <th>Total Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totals as $passTotal)
                                <tr>
                                    <td>{{$passTotal->title}}</td>
                                    <td>{{$passTotal->updated_at->toFormattedDateString()}}</td>
                                    <td>{{$passTotal->visitors_count}}</td>
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {{-- <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            @else
                <h2>No passes viewable.</h2>
            @endif
            </div>
        </div>
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
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-mobile fa-fw"></i> Apple Wallet Registrations</h3>
            </div>
            <div class="panel-body">
                @if(isset($registrations))
                    <p class="huge-centered">{{ $registrations }}</p>
                @else
                    <p class="huge-centered">0</p>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Offer Redemptions</h3>
            </div>
            <div class="panel-body">
                @if(isset($redemptions))
                    <p class="huge-centered">{{ $redemptions }}</p>
                @else
                    <p class="huge-centered">0</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- Morris Charts JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="{{ URL::to('/js/plugins/morris/raphael.min.js') }}"></script>
<script src="{{ URL::to('/js/plugins/morris/morris.min.js') }}"></script>
<script>
    $(function() {

        // Area Chart
        Morris.Area({
            element: 'morris-area-chart',
            data: [
            @foreach($morrisData as $day)
                {
                    period: '{{ $day['period'] }}',
                    views: {{ $day['views'] }}
                }, 
            @endforeach
            ],
            xkey: 'period',
            ykeys: ['views',],
            labels: ['views',],
            pointSize: 1,
            hideHover: 'auto',
            resize: true
        });
    });
</script>
@endsection