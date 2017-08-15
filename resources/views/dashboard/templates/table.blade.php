<div class="ks-user-list-view-header-block">
     <h4 class="ks-user-list-view-header-block-name">
          {{ @$gui->config[ 'table' ][ 'name' ] }}
          <span class="ks-user-list-view-header-block-amount">
               <span class="ks-icon la la-users"></span>
               <span>5 candidates</span>
          </span>
     </h4>

     <div class="ks-user-list-view-header-control">
          <div class="btn btn-primary">Add Member</div>
     </div>
</div>

<div class="ks-user-list-view-table">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card panel panel-default panel-table">
                         <div class="card-block table-responsive">
                              <table class="table table-bordered td-crud-table">
                                   <thead>
                                        <tr class="active">
                                             <td ng-click="toggleAllEntries( entries, headCheckbox )" width="40">
                                                  <label class="custom-control custom-checkbox ks-checkbox ks-no-description ks-checkbox-primary">
                                                       <input type="checkbox" class="custom-control-input">
                                                       <span class="custom-control-indicator"></span>
                                                  </label>
                                             </td>
                                             <!-- Expect col to be an object with following keys : text, namespace, order (for reorder) -->
                                             <td ng-repeat="col in columns" width="@{{ columnsConfig[ col.namespace ].width }}" ng-click="order( col.namespace )">
                                                  <strong>@{{ col.title }}</strong>
                                                  <span
                                                       ng-show="order_type == 'desc' && col.namespace == order_by" class="fa fa-long-arrow-up pull-right">
                                                  </span>
                                                  <span
                                                       ng-show="order_type == 'asc' && col.namespace == order_by" class="fa fa-long-arrow-down pull-right">
                                                  </span>
                                             </td>
                                             <td ng-hide="isDisabled( 'entry-actions' )"><strong>Actions</strong></td>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr class="row-checked" ng-repeat="( row_index, row ) in entries" ng-class="{ 'success' : entry.checked }" ng-click="entry.checked = !entry.checked">
                                             <td scope="row" class="checkbox-cell text-center" width="40">
                                                  <label class="custom-control custom-checkbox ks-checkbox ks-no-description ks-checkbox-primary">
                                                       <input type="checkbox" class="custom-control-input">
                                                       <span class="custom-control-indicator"></span>
                                                  </label>
                                             </td>
                                             <td ng-repeat="( col_name, col_title ) in columns" style="line-height: 30px;" title="@{{ entry[ col.namespace ] }}">
                                                  @{{
                                                       filter({ col_name, col_title, row_index, row })
                                                  }}
                                             </td> 
                                             {{--  <td>
                                                  <div class="table-cell-block image">
                                                       <div class="image-block-container">
                                                       <img src="assets/img/avatars/ava-2.png" class="rounded-circle" width="36" height="36">
                                                       </div>
                                                       <div class="text-block-container">
                                                       <div class="text-block-text">John Robinson</div>
                                                       <div class="text-block-sub-text">Design Team</div>
                                                       </div>
                                                  </div>
                                             </td>  --}}
                                             {{--  <td>
                                                  <div class="table-cell-block">
                                                       <div class="text-block-container">
                                                       <div class="text-block-text">$8,557</div>
                                                       <div class="text-block-sub-text">Paid</div>
                                                       </div>
                                                  </div>
                                             </td>  --}}
                                             <td class="table-actions">
                                                  <div class="btn-group">
                                                       <button style="margin:10px" class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                       </button>
                                                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                                            <a class="dropdown-item" href="#">
                                                                 <span class="la la-pencil icon text-primary-on-hover"></span> Edit
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                 <span class="la la-trash icon text-danger-on-hover"></span> Delete
                                                            </a>
                                                       </div>
                                                  </div>
                                                  {{--  <div class="dropdown">
                                                       <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions <span class="caret"></span>
                                                       </button>
                                                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                                            <a class="dropdown-item" href="#">
                                                                 <span class="la la-pencil icon text-primary-on-hover"></span> Edit
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                 <span class="la la-trash icon text-danger-on-hover"></span> Delete
                                                            </a>
                                                       </div>
                                                  </div>  --}}
                                             </td>
                                        </tr>
                                        <tr ng-show="entries.length == 0">
                                             <td class="text-center" colspan="@{{
                                                  columns.length + 2 +
                                                  ( isDisabled( 'entry-actions' ) ? 1 : 0 )
                                             }}">Aucune Entrer a afficher</td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
