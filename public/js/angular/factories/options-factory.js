tendooApp.factory( 'sharedOptions', function(){
    return {
        yesOrNo         :   [
            {
                value       :   'yes',
                label       :   '<?php echo _s( 'Oui', 'nexopos_advanced' );?>'
            },{
                value       :   'no',
                label       :   '<?php echo _s( 'Non', 'nexopos_advanced' );?>'
            }
        ],
        percentOrFlat       :   [
            {
                value       :   'percent',
                label       :   '<?php echo _s( 'Pourcentage', 'nexopos_advanced' );?>'
            },{
                value       :   'flat',
                label       :   '<?php echo _s( 'Fixe', 'nexopos_advanced' );?>'
            }
        ],
        maleOrFemale       :   [
            {
                value       :   'male',
                label       :   '<?php echo _s( 'Masculin', 'nexopos_advanced' );?>'
            },{
                value       :   'female',
                label       :   '<?php echo _s( 'Féminin', 'nexopos_advanced' );?>'
            }
        ],
        status       :   [
            {
                value       :   'active',
                label       :   '<?php echo _s( 'Actif', 'nexopos_advanced' );?>'
            },{
                value       :   'inactive',
                label       :   '<?php echo _s( 'Inactif', 'nexopos_advanced' );?>'
            },{
                value       :   'unavailabe',
                label       :   '<?php echo _s( 'Indisponible', 'nexopos_advanced' );?>'
            }
        ]
    }
});
