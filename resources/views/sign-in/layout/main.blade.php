<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>{{ config( 'page.title', 'Unamed Page' ) }}</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	@section( 'sign-in.page.head' )
		<!-- page stylesheets -->
		@bower_css( 'bootstrap/css/bootstrap.min' )
		@fonts( 'line-awesome/css/line-awesome.min' )
		@fonts( 'open-sans/styles' )
		@bower_css( 'tether/css/tether.min' )
		@css( 'common.min' )
		@css( 'pages/auth.min' )
	@show
	<!-- endbuild -->
</head>

<body>
	<div class="ks-page">

		@yield( 'sign-in.layout.content' )

		@include( 'sign-in.layout.footer' )
    
	</div>
</html>