<div class="ks-user-list-view-header-block">
     <h4 class="ks-user-list-view-header-block-name">
     {{ @$gui->config[ 'table' ][ 'name' ] }}
     <span class="ks-user-list-view-header-block-amount">
          <span class="ks-icon la la-users"></span>
          <span>5 candidates</span>
     </span>
     </h4>

     <div class="ks-user-list-view-header-control">
        <a href="@{{ route.create }}">
            <div class="btn btn-primary">Add Member</div>
        </a>        
     </div>
</div>
<div class="ks-user-list-view-table">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="input-group" ng-hide="hideSearch">
                    <input ng-model="searchModel" placeholder="Search" type="text" class="form-control" placeholder="">
                    <button ng-click="table.search()" type="button" class="btn btn-primary"><i class="la la-search"></i></button>
                    <button ng-click="table.clear()" type="button" class="btn btn-secondary">2</button>
                </div>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <div class="input-group" ng-hide="hideHeaderButtons">
                    <span class="input-group-addon">Export</span>
                    <select ng-model="selectedExportOption" type="text" class="form-control">
                        <option value="">Select</option>
                        <option ng-show="
                        ( button.show.singleSelect && getChecked().length == 1 ) ||
                        ( button.show.multiSelect && getChecked().length > 1 ) ||
                        ( button.show.noSelect && getChecked().length == 0 )"
                        ng-repeat="( index, button ) in headerButtons" value="@{{ index }}"><i class="@{{ button.icon }}"></i> @{{ button.text }}</option>
                    </select>
                    <span class="input-group-btn">
                        <button ng-click="triggerExport()" type="button" name="button" class="btn btn-default"><i class="la la-download"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card panel panel-default panel-table">
                    <div class="card-block">
                        <table class="table text-light">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1" ng-click="toggleAllEntries( entries, headCheckbox )">
                                        <label style="margin-right:0px" class="custom-control custom-checkbox">
                                            <input ng-model="headCheckbox" type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </th>
                                    <th ng-repeat="col in columns" width="@{{ col.width }}" ng-click="order( col.namespace )">

                                        <strong>@{{ col.title }}</strong>

                                        <span
                                            ng-show="order_type == 'desc' && col.namespace == order_by" class="la la-long-arrow-up pull-right">
                                        </span>

                                        <span
                                            ng-show="order_type == 'asc' && col.namespace == order_by" class="la la-long-arrow-down pull-right">
                                        </span>

                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="entry in entries" ng-class="{ 'success' : entry.checked }" ng-click="entry.checked = !entry.checked">
                                    <td scope="row">
                                        <label style="margin-right:0px" class="custom-control custom-checkbox">
                                            <input ng-model="entry.checked" ng-checked="entry.checked"  value="@{{ entry.id }}" type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td ng-repeat="col in columns">@{{ filter( entry[ col.namespace ], col, entry )}}</td>
                                    <td width="1">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a ng-repeat="action in entryActions"
                                                    ng-if="action.namespace != false"
                                                    ng-click="submitSingleAction( entry, action )" 
                                                    class="dropdown-item" href="#">
                                                    @{{ action.name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr ng-show="entries.length == 0">
                                    <td colspan="@{{ columns.length + 2 }}" class="text-center">
                                        Nothing to display
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group">
                    <select ng-init="selectedAction = actions[0]" ng-options="action as action.name for action in actions track by action.namespace" ng-model="selectedAction" class="form-control" aria-label="...">
                    </select>
                    <div class="input-group-btn">
                        <button ng-click="submitBulkActions()" class="btn btn-primary">
                            Run
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon">Item Per Pages</span>
                    <select ng-change="order()" type="text" ng-model="limit" class="form-control" placeholder="">
                        <option ng-repeat="nbr in [ 10, 20, 40, 60, 100 ]" value="@{{ nbr }}">@{{ nbr }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation example" class="pull-right">
                    <ul class="pagination">
                        <li class="page-item" ng-class="{disabled:currentPage === 1}">
                            <a class="page-link" ng-click="getPage( 1 )">First</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link"  ng-click="get( currentPage - 1)">Previous</a>
                        </li>
                        <li ng-repeat="( page, v ) in __getNumber( pages ) track by $index" ng-class="{active:currentPage === page}" class="page-item">
                            <a class="page-link" ng-click="getPage( page )" href="javascript:void(0)">@{{ page + 1 }} </a>
                        </li>
                        <li class="page-item" ng-class="{disabled: currentPage === pages }">
                            <a class="page-link" click="get( currentPage + 1)">Next</a>
                        </li>
                        <li class="page-item" ng-class="{disabled: currentPage === pages }">
                            <a class="page-link" click="vm.setPage(vm.pager.totalPages)">Last</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div> 
{{--  <div class="col-md-12">
    <h3 style="margin-top:0px;">@{{ textDomain.listTitle }}<a ng-href="@{{ textDomain.addNewLink }}" class="btn btn-primary btn-sm pull-right">@{{ textDomain.addNew }}</a></h3>
    <div class="box">
        <div class="box-header with-border">
            
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom:-1px;">
                    <thead>
                        <tr class="active">
                            <td ng-click="toggleAllEntries( entries, headCheckbox )">
                                <input type="checkbox" class="minimal" ng-model="headCheckbox">
                            </td>
                            <!-- Expect col to be an object with following keys : text, namespace, order (for reorder) -->
                            <td ng-repeat="col in columns" width="@{{ col.width }}" ng-click="order( col.namespace )">

                                <strong>@{{ col.text }}</strong>

                                <span
                                    ng-show="order_type == 'desc' && col.namespace == order_by" class="la la-long-arrow-up pull-right">
                                </span>

                                <span
                                    ng-show="order_type == 'asc' && col.namespace == order_by" class="la la-long-arrow-down pull-right">
                                </span>

                            </td>

                            <td ng-hide="isDisabled( 'entry-actions' )"><strong>Actions</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr >
                            <td width="20" ng-click="toggleThis( entry )">
                                <input type="checkbox" ng-model="entry.checked" ng-checked="entry.checked"  value="@{{ entry.id }}">
                            </td>
                            <td ng-repeat="col in columns" style="line-height: 30px;" title="@{{ entry[ col.namespace ] }}">
                                @{{
                                    filter( entry[ col.namespace ], col.is, col, entry )
                                }}
                            </td>
                            <td width="50" ng-hide="isDisabled( 'entry-actions' )">
                                <!-- Single button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu right-align">
                                    <li ng-repeat="action in entryActions">
                                        <a
                                            ng-if="action.namespace != false"
                                            href="javascript:void(0);"
                                            ng-click="submitSingleAction( entry, action )"
                                        >@{{ action.name }} </a>
                                    </li>
                                  </ul>
                                </div>
                            </td>
                        </tr>

                        <tr ng-show="entries.length == 0">
                            <td class="text-center" colspan="@{{
                                columns.length + 2 +
                                ( isDisabled( 'entry-actions' ) ? 1 : 0 )
                            }}">No Entries</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                      <select ng-init="selectedAction = actions[0]" ng-options="action as action.name for action in actions track by action.namespace" ng-model="selectedAction" class="form-control" aria-label="...">
                      </select>
                      <div class="input-group-btn">
                          <button ng-click="submitBulkActions()" class="btn btn-primary">
                              Run
                          </button>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">Item Per Pages</span>
                      <select ng-change="order()" type="text" ng-model="limit" class="form-control" placeholder="">
                          <option ng-repeat="nbr in [ 10, 20, 40, 60, 100 ]" value="@{{ nbr }}">@{{ nbr }}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- ng-class="{disabled: currentPage === pages }" -->
                    <ul class="pagination pull-right" style="margin:0px;">
                        <li ng-class="{disabled:currentPage === 1}">
                            <a ng-click="getPage( 1 )">First</a>
                        </li>
                        <li ng-class="{disabled: currentPage === 1}">
                            <a ng-click="get( currentPage - 1)">Previous</a>
                        </li>

                        <li ng-repeat="( page, v ) in __getNumber( pages ) track by $index" ng-class="{active:currentPage === page}">
                            <a href="javascript:void(0)" ng-click="getPage( page )">@{{ page + 1 }} </a>
                        </li>

                        <li ng-class="{disabled: currentPage === pages }">
                            <a click="get( currentPage + 1)">Next</a>
                        </li>
                        <li ng-class="{disabled: currentPage === pages }">
                            <a click="vm.setPage(vm.pager.totalPages)">Last</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>  --}}
