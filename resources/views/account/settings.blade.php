@extends('layouts.dashbase')

@include('global.settings')
@section('token')
	"{{ csrf_token() }}"
@endsection

@section('dashContent')

	<form id="settings" v-on:submit="updateInfo">
		<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">
	                Account Settings
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
			<div class="col-md-6">
		        <div class="panel panel-default">
		            <div class="panel-heading">
		                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i>Stay Social</h3>
		            </div>
		            <div class="panel-body">
		                <label for="basic-url">Facebook Page Name</label>
						<div class="input-group">
							<span class="input-group-addon">https://facebook.com/</span>
							<input type="text" maxlength="16" class="form-control" id="fbPN" v-model="bizFB" value="{{ Auth::user()->facebook }}">
						</div>
		                <label for="basic-url">Instagram Username</label>
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" maxlength="16" class="form-control" id="igUN" v-model="bizIG" value="{{ Auth::user()->instagram }}">
						</div>
		                <label for="basic-url">Twitter Username</label>
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" maxlength="16" class="form-control" id="twUN" v-model="bizTW" value="{{ Auth::user()->twitter }}">
						</div>
						<label for="basic-url">Website</label>                        
						<div class="input-group">
							<span class="input-group-addon">http://</span>
							<input type="text" maxlength="64" class="form-control" id="web" v-model="bizWS" value="{{ Auth::user()->website }}">
						</div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="panel panel-default">
		            <div class="panel-heading">
		                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i>Tell The World About You</h3>
		            </div>
		            <div class="panel-body">
		            	<label for="basic-url">Bio</label>
						<div class="input-group">
							<textarea v-model="bizDescription" class="form-control" id="bio">{{ Auth::user()->description }}</textarea>
						</div>
		                <label for="basic-url">Business Name</label>
						<div class="input-group">
							<input placeholder="ABC, LLC" type="text" maxlength="64" class="form-control" id="bizName" v-model="bizName" value="{{ Auth::user()->name }}">
						</div>
						<label for="basic-url">Business Username</label>
						<div class="input-group">
							<input placeholder="abcllc" type="text" maxlength="16" class="form-control" id="bizUsername" v-model="bizUsername" value="{{ Auth::user()->username }}">
						</div>
						{{-- <input class="clearable pd" id="file-uploader" name="profile_pic" type="hidden" data-clearable role="uploadcare-uploader" data-crop v-model="profile_pic"> --}}
		            </div>
		        </div>
		    </div>
	    </div>
	    <input type="submit" class="edit-submit" value="Save Settings">
    </form>
    <div id="results"></div>
    @include('account.updateInfo')
@endsection