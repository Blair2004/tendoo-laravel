<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>{{ \App\Helpers\Page::FilterTitle( config( 'page.title', 'Unamed Page' ) ) }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  @section( 'dashboard.page.head' )
  <!-- page stylesheets -->

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset( 'libs/bootstrap/css/bootstrap.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/line-awesome/css/line-awesome.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/' ) }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/open-sans/styles.css' ) }}">-->

    <link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/montserrat/styles.css' ) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset( 'libs/tether/css/tether.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'libs/jscrollpane/jquery.jscrollpane.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'libs/flag-icon-css/css/flag-icon.min.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset( 'css/common.css' ) }}">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset( 'css/themes/primary.min.css' ) }}">
    <link class="ks-sidebar-dark-style" rel="stylesheet" type="text/css" href="{{ asset( 'css/themes/sidebar-black.min.css' ) }}">
    <!-- END THEME STYLES -->

	<link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/kosmo/styles.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'fonts/weather/css/weather-icons.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'libs/c3js/c3.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'libs/noty/noty.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/widgets/payment.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/widgets/panels.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/dashboard/tabbed-sidebar.min.css' ) }}">
	<!-- end page stylesheets -->
	@show
	<!-- endbuild -->
</head>
<body class="ks-navbar-fixed ks-sidebar-sections ks-sidebar-position-fixed ks-theme-primary ks-content-solid-bg"> <!-- remove ks-page-header-fixed to unfix header -->
    @include( 'dashboard.layout.header' )
		{{--  @include( 'dashboard.layout.sidebar' )  --}}
		@include( 'dashboard.layout.content' )
		@include( 'dashboard.layout.footer' )
</html>