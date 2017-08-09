@inject( 'page', 'App\Services\Page' )
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{ $page::FilterTitle( config( 'page.title', 'Unamed Page' ) ) }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    @section( 'dashboard.page.head' )
        @bower_css( 'bootstrap/css/bootstrap.min' )
        @bower_css( 'tether/css/tether.min' )
        @bower_css( 'jscrollpane/jquery.jscrollpane' )
        @bower_css( 'flag-icon-css/css/flag-icon.min' )
        @bower_css( 'c3js/c3.min' )
        @bower_css( 'noty/noty' )
        @css( 'common' )
        @css( 'themes/primary.min' )
        @css( 'themes/sidebar-black.min' )      
        @css( 'widgets/payment.min' )
        @css( 'widgets/panels.min' )
        @css( 'dashboard/tabbed-sidebar.min' )
        @fonts( 'line-awesome/css/line-awesome.min' )
        @fonts( 'montserrat/styles' )
        @fonts( 'kosmo/styles' )
        @fonts( 'open-sans/styles' )
        @fonts( 'weather/css/weather-icons.min' )
    <!-- end page stylesheets -->
    @show
    <!-- endbuild -->
</head>
<body ng-app="tendooApp" class="ks-navbar-fixed ks-sidebar-sections ks-sidebar-position-fixed ks-theme-primary ks-content-solid-bg"> <!-- remove ks-page-header-fixed to unfix header -->
    @include( 'dashboard.layout.header' )
    {{--  @include( 'dashboard.layout.sidebar' )  --}}
    @include( 'dashboard.layout.content' )
    @include( 'dashboard.layout.footer' )
</html>