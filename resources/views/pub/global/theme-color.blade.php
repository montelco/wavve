@section('theme-color')
	@if(isset($pass->theme))
		@if($pass->theme == 1)
			"#528089"
		@elseif($pass->theme == 2)
			"#903749"
		@elseif($pass->theme == 3)
			"#539E8B"
		@else
			"#528089"
		@endif
	@else
		"#528089"
	@endif
@endsection

@section('bg-defaults')
	@if(isset($pass->theme))
		@if($pass->theme == 1)
			#1a2128
		@elseif($pass->theme == 2)
			#2B2E4A
		@elseif($pass->theme == 3)
			#539E8B
		@else
			#1a2128
		@endif
	@else
		#1a2128
	@endif
@endsection

@section('header-colour')
	@if(isset($pass->theme))
		@if($pass->theme == 1)
			#fff
		@elseif($pass->theme == 2)
			#e84545
		@elseif($pass->theme == 3)
			#ede4ca
		@else
			#fff
		@endif
	@else
		#fff
	@endif
@endsection

@section('accent-colour')
	@if(isset($pass->theme))
		@if($pass->theme == 1)
			#528089
		@elseif($pass->theme == 2)
			#903749
		@elseif($pass->theme == 3)
			#6674b6
		@else
			white
		@endif
	@else
		#528089
	@endif
@endsection