@inject( 'gui', 'App\Services\Gui' )
<script>
tendooApp.factory( 'resource', function( $resource ) {
     return $resource(
          '../api/{{ $gui->config[ 'table' ][ 'resource' ] }}/:id',
          {
               id              :   '@_id',
               order_by        :   '@_order_by',
               order_type      :   '@_order_type',
               limit           :   '@_limit',
               current_page    :   '@_current_page',
               exclude         :   '@_exclude'
          },{
               get : {
                    method : 'GET',
                    transformRequest  :     ( data, headersGetter ) => {
                         return angular.toJson(data);
                    },
                    transformResponse :     ( data, headersGetter, status ) => {
                         return angular.fromJson( data );
                    }
               },
               all  :    {
                    method : 'GET',
                    transformRequest  :     ( data, headersGetter ) => {
                         return angular.toJson(data);
                    },
                    transformResponse :     ( data, headersGetter, status ) => {
                         return angular.fromJson( data );
                    },
                    isArray   :    true
               },
               save : {
                    method : 'POST',
                    transformRequest  :     ( data, headersGetter ) => {
                         return angular.toJson(data);
                    },
                    transformResponse :     ( data, headersGetter, status ) => {
                         return angular.fromJson( data );
                    }
               },
               update : {
                    method : 'PUT',
                    transformRequest  :     ( data, headersGetter ) => {
                         return angular.toJson(data);
                    },
                    transformResponse :     ( data, headersGetter, status ) => {
                         return angular.fromJson( data );
                    }
               },
               delete : {
                    method : 'DELETE',
                    transformRequest  :     ( data, headersGetter ) => {
                         return angular.toJson(data);
                    },
                    transformResponse :     ( data, headersGetter, status ) => {
                         return angular.fromJson( data );
                    }
               }
          }
     );
});
</script>
