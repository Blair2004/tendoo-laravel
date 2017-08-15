tendooApp.factory( 'sharedDocumentTitle', function(){
    return new function(){
        this.set        =   function( title ){
            var signature   =   '<?php echo _s( ' &mdash; NexoPOS', 'nexopos_advanced' );?>';
            angular.element( 'title' ).html( title + signature );
        }
    }
})
