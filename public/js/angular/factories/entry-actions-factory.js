tendooApp.factory( 'sharedEntryActions', function(){
    return function(){
        return [
            {
                namespace   :   'edit',
                name        :   '<?php echo _s( 'Modifier', 'nexopos_advanced' );?>'
            },{
                namespace   :   'delete',
                name        :   '<?php echo _s( 'Supprimer', 'nexopos_advanced' );?>'
            }
        ];
    }
});
