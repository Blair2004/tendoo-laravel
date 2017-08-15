tendooApp.factory( 'sharedTableActions', function(){
    return function(){
        return [
            {
                namespace   :   false,
                name        :   '<?php echo _s( 'Faites un choix...', 'nexopos_advanced' );?>'
            },
            {
                namespace   :   'delete',
                name        :   '<?php echo _s( 'Supprimer', 'nexopos_advanced' );?>'
            },
            {
                namespace   :   'export',
                name        :   '<?php echo _s( 'Export', 'nexopos_advanced' );?>'
            }
        ];
    }
});
