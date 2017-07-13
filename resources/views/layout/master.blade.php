<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>{{ config( 'dashboard.page.title', 'Unamed Page' ) }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- page stylesheets -->
  <!-- end page stylesheets -->
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  @yield( 'dashboard.header' )
  <!-- endbuild -->
</head>
<body class="page-loading">
	<!-- page loading spinner -->
	<div class="pageload">
		<div class="pageload-inner">
			<div class="sk-rotating-plane"></div>
			</div>
		</div>
	</body>
	<div class="app layout-fixed-header">
		@include( 'dashboard.sidebar' )
		@include( 'dashboard.content' )
		@include( 'dashboard.footer' )
		
	</div>
</html>