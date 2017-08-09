<?php
/**
 * Will hold all configuration option which require 
 * the software to boot to be registered
**/

namespace App\Services;

class Boot
{
    public function __construct()
    {
        config([ 'tendoo.system.timezone-list' => generate_timezone_list() ]);


        /**
         * Save System Errors Messages
        **/

        config([ 'tendoo.errors' =>  array_merge( config( 'tendoo.errors', [] ), [
            'setup-locked'  =>  [
                'title'     =>  __( 'Setup Locked' ),
                'message'   =>  __( 'You can\'t access to that page, the setup is locked.' )
            ],
            'token-error'   =>  [
                'title'     =>  __( 'Token Error' ),
                'message'   =>  __( 'Your request can\'t be treated. Your token has expired or is missing' )
            ],
            '404'           =>  [
                'title'     =>  __( 'Error : 404' ),
                'message'   =>  __( 'That page can\'t be found' )
            ],
            'access-denied'     =>  [
                'title'     =>  __( 'Access Denied' ),
                'message'   =>  __( 'You don\'t have access to that page.' )
            ]
        ])]);        
    }
}