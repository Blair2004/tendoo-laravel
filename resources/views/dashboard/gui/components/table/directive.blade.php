@inject( 'gui', 'App\Services\Gui' )
<script>
let resourceCTRL              =    [ '$scope', 'resource', 'sharedTable', 
     function( 
          $scope, resource, sharedTable
     ){
     
     $scope                        =    _.extend( $scope, new sharedTable );
     $scope.resource               =    resource;
     $scope.columns                =    [];
     $scope.entries                =    [];
     $scope.definedColumns         =    {!! json_encode( $gui->config[ 'table' ][ 'columns' ] )  !!};

     $scope.columnsConfig          =    {!! json_encode( $gui->parseColumnRules( 
          $gui->config[ 'table' ][ 'columns-config' ] )  
     ) !!};

     _.each( $scope.definedColumns, ( title, name ) => {
          $scope.columns.push({
               is             :    null,
               namespace      :    name,
               title
          });
     }); 

     $scope.entryActions           =    [{
          name           :    'Edit',
          namespace      :    'edit',
          url            :    '{{ url()->current() . '/edit/' }}'
     },{
          name           :    'Delete',
          namespace      :    'delete',
          url            :    '{{ url()->current() . '/delete/' }}'
     }];
     
     $scope.route                  =    {!! json_encode( array_get( $gui->config, 'table.routes' ) ) !!};
     
     $scope.resource.all(function( entries ){
          $scope.entries                =    entries;
     });
}];

tendooApp.directive( 'tdTable', function(){
     return {
          templateUrl         :    "{{ route( 'dashboard.templates', [ 'file' => 'table.template' ]) }}",
          controller          :    resourceCTRL
     }
});
</script>