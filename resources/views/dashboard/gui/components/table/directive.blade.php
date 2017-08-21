@inject( 'gui', 'App\Services\Gui' )
<script>
let resourceCTRL              =    [ '$scope', 'resource', 'sharedTable', 
     function( 
          $scope, resource, sharedTable
     ){
     
     $scope                        =    _.extend( $scope, new sharedTable );
     $scope.resource               =    resource;
     $scope.resourceName           =    '{{ $gui->config[ 'table' ][ 'resource' ] }}';
     $scope.columns                =    [];
     $scope.definedColumns         =    {!! json_encode( $gui->config[ 'table' ][ 'columns' ] )  !!};
     $scope.route                  =    {!! json_encode( array_get( $gui->config, 'table.routes' ) ) !!};
     $scope.columnsConfig          =    {!! json_encode( $gui->parseColumnRules( 
          $gui->config[ 'table' ][ 'columns-config' ] )  
     ) !!};

     $scope.entries                =    [];
     
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

     $scope.resource( $scope.resourceName ).all(function( entries ){
          $scope.entries                =    entries;
     });

     /**
      * Title Configuration
     **/
     
     $scope.subject                =    {
          plural                   :    '{{ $gui->config[ 'table' ][ 'subject' ][1] }}',
          singular                 :    '{{ $gui->config[ 'table' ][ 'subject' ][0] }}',
     }

     $scope.title                  =    "{{ __( '%s List' ) }}".replace( '%s', $scope.subject.plural  );     
}];

tendooApp.directive( 'tdTable', function(){
     return {
          templateUrl         :    "{{ route( 'dashboard.templates', [ 'file' => 'table.template' ]) }}",
          controller          :    resourceCTRL
     }
});
</script>