<!-- BEGIN DEFAULT SIDEBAR -->
<div class="ks-column ks-sidebar ks-info">
    <div class="ks-wrapper">
        <section>
            <ul class="nav nav-pills nav-stacked">
            @foreach( config( 'dashboard.menus' ) as $namespace => $menus )
                @if( count( $menus ) > 1 )  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="ks-icon {{ array_get( array_first( array_values( $menus ) ), 'icon' ) }}"></i>
                        <span>{{ array_get( array_first( array_values( $menus ) ), 'text' ) }}</span>
                    </a>
                    <div class="dropdown-menu">
                        @foreach( $menus as $subNamespace => $menu )
                            @if( @$menu[ 'disable' ] != true )
                        <a 
                            class="dropdown-item sub-menu-{{ $subNamespace }} child-of-{{ $namespace }}" 
                            href="{{ @$menu[ 'href' ] }}">
                            <span class="sub-menu-{{ $subNamespace }}-text">{{ $menu[ 'text' ] }}</span>
                        </a>
                            @endif
                        @endforeach
                    </div>
                </li>
                @else
                    @foreach( $menus as $subNamespace => $menu )
                <li class="nav-item">
                    <a class="nav-link"  href="{{ @$menu[ 'href' ] }}" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="ks-icon {{ @$menu[ 'icon' ] }}"></i>
                        <span>{{ @$menu[ 'text' ] }}</span>
                    </a>
                </li>
                    @endforeach
                @endif
            @endforeach
            </ul>
        </section>
    </div>
</div>
<!-- END DEFAULT SIDEBAR -->