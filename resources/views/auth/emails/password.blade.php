<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background: #eaeaea;
		}
		#resetContainer{
			display: flex;
			flex-wrap: wrap;
			background: white;
			-webkit-box-shadow: 0px 5px 13px 1px rgba(161,161,161,1);
			-moz-box-shadow: 0px 5px 13px 1px rgba(161,161,161,1);
			box-shadow: 0px 5px 13px 1px rgba(161,161,161,1);
		}
		#resetContent{
			order: 1;
			font-family: sans-serif;
			font-weight: 300;
			color: #626262;
		}
		#resetContent a{
			color: #75b8f3;
			text-decoration: none;
		}
		#disclaimer{
			font-size: 0.5em;
			font-family: sans-serif;
			font-weight: 300;
			color: #d0d0d0;
			order: 2;
		}
	</style>
</head>
<body>
	<div id="resetContainer">
		<div id="resetContent">
			<h2>Forgetting your password stinks...</h2>
			<p>Click here to reset it: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
		</div>
		<div id="disclaimer">
			Copyright 2016. Wavvve. If you believe you have received this email in error, please delete it.
		</div>
	</div>
</body>
</html>
