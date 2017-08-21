@inject( 'gui', 'App\Services\Gui' )

<script>
let resourceCTRL                   =    function( $scope, resource, sharedResourceLoader, sharedFieldEditor, sharedFieldEditor, sharedRawToOptions ) {
     $scope.resourceLoader         =    new sharedResourceLoader;
     $scope.resource               =    resource;
     $scope.columns                =    [];
     $scope.resourceName           =    '{{ $gui->config[ 'table' ][ 'resource' ] }}';
     $scope.definedColumns         =    {!! json_encode( $gui->config[ 'table' ][ 'columns' ] )  !!};
     $scope.route                  =    {!! json_encode( array_get( $gui->config, 'table.routes' ) ) !!};
     $scope.columnsConfig          =    {!! json_encode( $gui->parseColumnRules( 
          $gui->config[ 'table' ][ 'columns-config' ] )  
     ) !!};
     $scope.fields                 =    {!! json_encode( $gui->parseColumnRules( 
          $gui->config[ 'table' ][ 'fields' ] ) ) 
     !!};

     // defined relations
     $scope.relations              =    [];

     _.each( $scope.fields, function( field, field_name ) {
          if( typeof field.relation != 'undefined' ) {
               $scope.resourceLoader.push({
                    resource       :    $scope.resource( field.relation ),
                    success        :    ( data ) => {
                         field.options        =   sharedRawToOptions( data, 'id', 'name' );
                         console.log( field );
                    }
               });
          }
     });

     $scope.resourceLoader.run();

     
     _.each( $scope.definedColumns, ( title, name ) => {
          $scope.columns.push({
               is             :    null,
               namespace      :    name,
               title
          });
     }); 

     // table sujet @?
     $scope.subject                =    {
          plural                   :    '{{ $gui->config[ 'table' ][ 'subject' ][1] }}',
          singular                 :    '{{ $gui->config[ 'table' ][ 'subject' ][0] }}',
     }

     $scope.title                  =    "{{ __( 'Add a new %s' ) }}".replace( '%s', $scope.subject.singular  );
};

/**
 * InJect Dependencies
 * @since 1.0
**/

resourceCTRL.$inject          =    [ '$scope', 'resource', 'sharedResourceLoader', 'sharedFieldEditor', 'sharedFieldEditor', 'sharedRawToOptions' ];

tendooApp.directive( 'tdForm', function(){
     return {
          templateUrl         :    "{{ route( 'dashboard.templates', [ 'file' => 'table.form-template' ]) }}",
          controller          :    resourceCTRL
     }
});
</script>