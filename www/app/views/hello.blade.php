<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Falcon Player</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:300);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
			background:#363C47;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 24px;
			margin: 16px 0 0 0;
			color: white;
			letter-spacing: 1px;

		}
	</style>
</head>
<body>
	<div class="welcome">
		<a href="http://falconchristmas.com" title="Falcon Player">
		<img src="{{ asset('assets/images/logo.png') }}">
			</a>
		<h1>Falcon Player</h1>
	</div>
</body>
</html>
