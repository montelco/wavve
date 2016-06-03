@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')


@section('dashContent')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Account Settings
            </h1>
            <!-- <ol class="breadcrumb">
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
            </ol> -->
        </div>
    </div>
    <div class="row">
		<div class="col-md-6">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i>Stay Social</h3>
	            </div>
	            <div class="panel-body">
	                <label for="basic-url">Facebook Page Name</label>
					<div class="input-group">
						<span class="input-group-addon">https://facebook.com/</span>
						<input type="text" class="form-control" id="fbPN" v-model="bizFB">
					</div>
	                <label for="basic-url">Instagram Username</label>
					<div class="input-group">
						<span class="input-group-addon">@</span>
						<input type="text" class="form-control" id="igUN" v-model="bizIG">
					</div>
	                <label for="basic-url">Twitter Username</label>
					<div class="input-group">
						<span class="input-group-addon">@</span>
						<input type="text" class="form-control" id="twUN" v-model="bizTW" >
					</div>
					<label for="basic-url">Website</label>                        
					<div class="input-group">
						<span class="input-group-addon">http://</span>
						<input type="text" class="form-control" id="web" v-model="bizWS">
					</div>
	            </div>
	        </div>
	    </div>
	    @include('account.extras.updateInfo')
	    <div class="col-md-6">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i>Tell The World About You</h3>
	            </div>
	            <div class="panel-body">
	                <label for="basic-url">Bio</label>
					<div class="input-group">
						<textarea placeholder="Tell people about your business; Who you are; What you do." v-model="bizBio" class="form-control" id="bio"></textarea>
					</div>
	                <label for="basic-url">Business Name</label>
					<div class="input-group">
						<input placeholder="" type="text" class="form-control" id="igUN">
					</div>
	            </div>
	        </div>
	    </div>
    </div>
@endsection