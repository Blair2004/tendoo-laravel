<!-- BEGIN HEADER -->
<nav class="navbar ks-navbar">
    <!-- BEGIN HEADER INNER -->
    <!-- BEGIN LOGO -->
    <div href="{{ url()->route( 'dashboard.index' ) }}" class="navbar-brand">
        <!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
        <a href="#" class="ks-sidebar-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
        <a href="#" class="ks-sidebar-mobile-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
        <!-- END RESPONSIVE SIDEBAR TOGGLER -->

        <div class="ks-navbar-logo text-center">
            <a href="{{ url()->route( 'dashboard.index' ) }}" class="ks-logo">{{ config( 'app.name' ) }}</a>
        </div>

    </div>
    <!-- END LOGO -->

    <!-- BEGIN MENUS -->
    <div class="ks-wrapper">
        <nav class="nav navbar-nav">
            <!-- BEGIN NAVBAR MENU -->            
            <div class="ks-navbar-menu">  
                <div class="nav-item toggle-sidebar hidden-sm hidden-xs">
                    <a class="nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-navicon"></i>
                    </a>
                </div>              
                @foreach( config( 'dashboard.tools-menus', [] ) as $menu )
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ @$menu[0][ 'text' ] }}
                    </a>
                    <div class="dropdown-menu ks-info" aria-labelledby="Preview">
                        @foreach( $menu as $subMenu )
                        <!-- ks-active -->
                        <a class="dropdown-item" href="{{ @$subMenu[ 'href' ] }}">{{ @$subMenu[ 'text' ] }}</a> 
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <!-- END NAVBAR MENU -->

            <!-- BEGIN NAVBAR ACTIONS -->
            @include( 'dashboard.layout.header-notifications' )
            <!-- END NAVBAR ACTIONS -->
        </nav>

        <!-- BEGIN NAVBAR ACTIONS TOGGLER -->
        <nav class="nav navbar-nav ks-navbar-actions-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-ellipsis-h ks-icon ks-open"></span>
                <span class="la la-close ks-icon ks-close"></span>
            </a>
        </nav>
        <!-- END NAVBAR ACTIONS TOGGLER -->

        <!-- BEGIN NAVBAR MENU TOGGLER -->
        <nav class="nav navbar-nav ks-navbar-menu-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-th ks-icon ks-open"></span>
                <span class="la la-close ks-icon ks-close"></span>
            </a>
        </nav>
        <!-- END NAVBAR MENU TOGGLER -->
    </div>
    <!-- END MENUS -->
    <!-- END HEADER INNER -->
</nav>
<!-- END HEADER -->