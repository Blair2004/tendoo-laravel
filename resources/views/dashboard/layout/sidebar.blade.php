<!-- sidebar panel -->
<div class="sidebar-panel offscreen-left">
    <div class="brand">
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
        <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
        <span></span>
        <span></span>
        <span></span>
        </a>
    </div>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
    <a class="brand-logo">
        <span>{{ config( 'app.name' ) }}</span>
    </a>
    <a href="#" class="small-menu-visible brand-logo">R</a>
    <!-- /logo -->
    </div>
    <!-- main navigation -->
    <nav role="navigation">
    <ul class="nav">
        @foreach( config( 'dashboard.menus' ) as $namespace => $menus )
            @if( count( $menus ) > 1 )
        <li class="menu-accordion">
            <a href="javascript:;">
                <i class="{{ array_get( array_first( array_values( $menus ) ), 'icon' ) }}"></i>
                <span>{{ array_get( array_first( array_values( $menus ) ), 'text' ) }}</span>
            </a>
            <ul class="sub-menu">
                @foreach( $menus as $subNamespace => $menu )
                <li class="sub-menu-{{ $subNamespace }} child-of-{{ $namespace }}">
                    <a href="{{ $menu[ 'href' ] }}" class="sub-menu-{{ $subNamespace }}-link">
                        <span class="sub-menu-{{ $subNamespace }}-text">{{ $menu[ 'text' ] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
            @else
                @foreach( $menus as $subNamespace => $menu )
        <li class="menu-{{ $namespace }}">
            <a href="{{ $menu[ 'href' ] }}" class="menu-{{ $namespace }}-link">
                <i class="{{ $menu[ 'icon' ] }}"></i>
                <span class="menu-{{ $namespace }}-text">{{ $menu[ 'text' ] }}</span>
            </a>
        </li>
                @endforeach
            @endif
        
        @endforeach    
    </ul>
    </nav>
    <!-- /main navigation -->
</div>
<!-- /sidebar panel -->