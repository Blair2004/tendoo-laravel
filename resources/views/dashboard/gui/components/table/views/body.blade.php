@include( 'dashboard.layout.page-title' )
<div class="ks-content">
    <div class="ks-body ks-content-nav ks-user-list-view">
        @if( @$gui->config[ 'table' ][ 'filter' ] == true )
            @include( 'dashboard.gui.components.table.views.filter' )
        @endif
        <div class="ks-nav-body">
            <td-table>
                Something
            </td-table>
        </div>
    </div>
</div>