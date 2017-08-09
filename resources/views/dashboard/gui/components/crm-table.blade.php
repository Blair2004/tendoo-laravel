@include( 'dashboard.layout.page-title' )
<div class="ks-content">
    <div class="ks-body ks-content-nav ks-user-list-view">
        @if( @$gui->config[ 'table' ][ 'filter' ] == true )
            @include( 'dashboard.gui.components.crm-table-filter' )
        @endif
        <div class="ks-nav-body">
            <div class="ks-user-list-view-header-block">
                <h4 class="ks-user-list-view-header-block-name">
                    {{ @$gui->config[ 'table' ][ 'name' ] }}
                    <span class="ks-user-list-view-header-block-amount">
                        <span class="ks-icon la la-users"></span>
                        <span>5 candidates</span>
                    </span>
                </h4>

                <div class="ks-user-list-view-header-control">
                    <div class="btn btn-success">Add Member</div>
                </div>
            </div>

            <div class="ks-user-list-view-table">
                <div class="ks-full-table">
                    <table id="ks-datatable" class="table ks-table-info dt-responsive nowrap" width="100%" data-pagination="true">
                        <thead>
                        @if( @$gui->config[ 'table' ][ 'columns' ] )
                        <tr>
                            @foreach( $gui->config[ 'table' ][ 'columns' ] as $column )
                            <th>{{ $column }}</th>
                            @endforeach
                        </tr>
                        @endif
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="assets/img/avatars/avatar-1.jpg" class="ks-avatar" alt="" width="36" height="36">
                                    Scarlett Johansson
                                </td>
                                <td>
                                    <span class="badge badge-default">In discussion</span>
                                </td>
                                <td>
                                    <span class="la la-github ks-icon"></span>
                                    Github
                                </td>
                                <td>
                                    Scarlett Johansson
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>