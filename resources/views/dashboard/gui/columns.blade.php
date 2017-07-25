<div class="ks-content">
    <div class="ks-body {{ $gui->getTabs() ? 'ks-tabs-page-container' : null }}">
        @if( $gui->getTabs() ) 
        <div class="ks-tabs-container-description">
            <h3>{{ @$gui->config[ 'page' ][ 'title' ] }}</h3>
            <p>{{ @$gui->config[ 'page' ][ 'subTitle' ] }}</p>
        </div>
        <ul class="nav ks-nav-tabs ks-tabs-page-default ks-tabs-full-page">
            @foreach( $gui->getTabs() as $index => $tab )
            <li class="nav-item">
                <a class="nav-link {{ $gui->request->input( 'tab' ) == @$tab[ 'namespace' ] || ( ! $gui->request->input( 'tab' ) && $loop->index == 0 ) ? 'active' : '' }}" href="#" data-toggle="tab" data-target="#{{ @$tab[ 'namespace' ] }}">
                    
                    {{ $tab[ 'title' ] }}
                    <!--<span class="badge badge-info badge-pill">15</span>-->
                </a>
            </li>
            @endforeach 
        </ul>
        <div class="tab-content">
            @foreach( $gui->getTabs() as $index => $tab )
            <div class="tab-pane {{ $gui->request->input( 'tab' ) == $tab[ 'namespace' ] || ( ! $gui->request->input( 'tab' ) && $loop->index == 0 ) ? 'active' : '' }} ks-column-section" id="{{ $tab[ 'namespace' ] }}" role="tabpanel">
                @include( 'dashboard.gui.columns-elements' )
            </div>
        @endforeach
        </div>
        @else 
            <div class="container-fluid">
            @include( 'dashboard.gui.columns-elements' )
            </div>            
        @endif 
    </div>
</div>