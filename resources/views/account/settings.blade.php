@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')


@section('dashContent')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Settings
            </h1>
            <ol class="breadcrumb">
                <li>
                	<a href="{{ url('dashboard') }}">
                		<i class="fa fa-dashboard"></i> Dashboard
                	</a>
                </li>
				<li class="active">
                	<a href="{{ url('settings') }}">
                		<i class="fa fa-cog"></i> Settings
                	</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
		<div class="col-md-6 col-md-offset-3">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i>Change Things Up...</h3>
	            </div>
	            <div class="panel-body">
	                <div class="list-group">
                        <label class="control-label">Change E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="New email" value="" />
                        </div>
	                </div>
	                <div class="list-group">
                        <label class="control-label">Facebook URL</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Link to Facebook" value="" />
                        </div>
	                </div>
	                <div class="list-group">
                        <label class="control-label">Foursquare URL</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Link to Foursquare" value="" />
                        </div>
	                </div>
	                <div class="list-group">
                        <label class="control-label">Twitter URL</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Link to Twitter" value="" />
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection