@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	        <h2>Your Passes</h2>
	        <hr>
	        @if($passes->count())
	        <div class="table-responsive">
	            <table class="table table-hover table-striped">
	                <thead>
	                    <tr>
	                        <th>Pass Title</th>
	                        <th>Impressions</th>
	                        <th>Percent Follow-Through</th>
	                        <th>Last Changed</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	
		                	@foreach ($passes as $pass)
			                    <tr>
			                        <td><a href="/{{$pass->uuid}}">{{ $pass->title }}</a></td>
			                        <td>{{ $pass->id }}</td>
			                        <td>32.3%</td>
			                        <td>{{ $pass->FriendlyTime }}</td>
			                        <td>
			                        	<a href="{{ url('/passes/edit-existing/' . $pass->id) }}">
			                        		Edit
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
	        </div>
	        @else
	        <h3>Nothing here yet. Make a pass to get started.</h3>
	        @endif  
        </div>
	</div>
@endsection