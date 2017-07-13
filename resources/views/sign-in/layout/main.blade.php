<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>{{ config( 'page.title', 'Unamed Page' ) }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  @section( 'sign-in.page.head' )
  <!-- page stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ asset( 'libs/bootstrap/css/bootstrap.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/line-awesome/css/line-awesome.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/open-sans/styles.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'libs/tether/css/tether.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/common.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/pages/auth.min.css' ) }}">
	<!-- end page stylesheets -->
	@show
	<!-- endbuild -->
</head>

<body>
	<div class="ks-page">

		@yield( 'sign-in.layout.content' )

		@include( 'sign-in.layout.footer' )
    
	</div>
</html>