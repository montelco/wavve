@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	        <h2>Your Passes</h2>
	        <p>See below to view, edit and obtain data for each pass created.</p>
	        <hr>
	        @if($passes->count())
	        <div class="table-responsive">
	            <table class="table table-hover table-striped">
	                <thead>
	                    <tr>
	                        <th>Pass Title</th>
	                        {{-- <th>Impressions</th> --}}
	                        <th>Active/Scheduled</th>
	                        <th>Last Changed</th>
	                        <th>Edit</th>
 	                        <th>Delete</th>
 	                        {{-- <th>iOS Count</th>
 	                        <th>iOS Opened</th>
 	                        <th>Android Count</th
	                        <th>Andoid Opened</th> --}}
	                    </tr>
	                </thead>
	                <tbody>
	                	
		                	@foreach ($passes as $pass)
			                    <tr>
			                        <td><a href="/{{$pass->uuid}}">{{ $pass->title }}</a></td>
			                        {{-- <td>{{ $pass->id }}</td> --}}
			                        <td><a href="{{ url('/passes/publish/' . $pass->id) }}">@if($pass->published === 0)False @else True @endif</a></td>
			                        <td>{{ $pass->FriendlyTime }}</td>
			                        <td>
			                        	<a href="{{ url('/passes/edit-existing/' . $pass->id) }}">
			                        		<i class="fa fa-pencil fa-fw"></i>
										</a>
									</td>
									<td>
			                        	<a href="{{ url('/passes/post/delete/' . $pass->id) }}">
			                        		<i class="fa fa-trash fa-fw"></i>
										</a>
									</td>
			                    </tr>
		                    @endforeach
	                </tbody>
	            </table>
	            <div class="text-center">
	            	{{ $passes->links() }}
	            </div>
	        </div>
	        @else
	        <h3>Nothing here yet. Make a pass to get started.</h3>
	        @endif  
        </div>
	</div>
@endsection