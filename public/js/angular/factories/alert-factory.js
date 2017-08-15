tendooApp.factory( 'sharedAlert', [ 'SweetAlert', function( SweetAlert ){
    return new function(){

        /**
         *  Alert Text
         *  @param string message
         *  @return void
        **/

        this.alert      =   function( message ) {
            return SweetAlert.swal( message );
        }

        /**
         *  Confirmation
         *  @param string message
         *  @param function callback
         *  @return void
        **/

        this.confirm    =   function( message, callback ) {
            return SweetAlert.swal({
                   title                : "Please confirm your action",
                   text                 : message,
                   type                 : "warning",
                   showCancelButton     : true,
                   confirmButtonColor   : "#DD6B55",
                   confirmButtonText    : "Yes",
                   closeOnConfirm       : typeof callback == 'function'
            }, function( isConfirm ) {
                callback( isConfirm );
            });
        }

        /**
         *  Alert Warning
         *  @param string message
         *  @return void
        **/

        this.warning            =   function( message ) {
            return SweetAlert.swal(
                {
                   title                : "Warning",
                   text                 : message,
                   type                 : "warning",
                   showCancelButton     : false,
                   confirmButtonColor   : "#DD6B55",
                   confirmButtonText    : "Ok",
                   closeOnConfirm       : true
               }
            );
        }
    }
}]);
