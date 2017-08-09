<?php
namespace App\Services\Interfaces;

use App\Services\Gui;

class DashboardSettings
{
    public function __construct() {
    
        // Run Service Container
        $this->gui                  =   app()->make( Gui::class );

        $this->gui->config([
            'page.title'         =>  __( 'Tendoo Settings' ),
            'page.subTitle'      =>  __( 'All application settings.' )
        ]);

        $this->gui->tabs([
            
            // General Setting Tab

            'general.title'             =>  __( 'General' ),
            'general.namespace'         =>  'general',

            // Registration Setting Tab

            'registration.title'        =>  __( 'Registration' ),
            'registration.namespace'    =>  'registration',
            
            // Advanced Settings Tab

            'bar.title'                 =>  __( 'Advanced' ),
            'bar.namespace'             =>  'advanced',
        ]);

        $this->gui->tabsColumns( 'general', [
            'details.width'     =>  6,
            'details.title'     =>  __( 'Informations' ),
            'timezone.width'    =>  6,
            'timezone.title'    =>  __( 'Timezone' )
        ]);

        /** 
         *  --------------------------------------------------------------------------
         *  Details Column
         *  -------------------------------------------------------------------------- 
        **/

        $this->gui->tabColumnItems( 'general', 'details', [
            'type'          =>  'text',
            'name'          =>  'app_name',
            'label'         =>  __( 'Application Name' ),
            'validation'    =>  'required',
            'description'   =>  __( 'Provide a name for your installation.' )
        ]);

        $this->gui->tabColumnItems( 'general', 'details', [
            'type'          =>  'select',
            'options'       =>  config( 'tendoo.system.language' ),
            'name'          =>  'app_language',
            'label'         =>  __( 'System Language' ),
            'description'   =>  __( 'Change the default system language.' )
        ]);

        /** 
         *  --------------------------------------------------------------------------
         *  TimeZone Column
         *  -------------------------------------------------------------------------- 
        **/

        $this->gui->tabColumnItems( 'general', 'timezone', [
            'type'          =>  'select',
            'options'       =>  config( 'tendoo.system.timezone-list', [] ),
            'name'          =>  'app_timezone',
            'validation'    =>  'nullable',
            'label'         =>  __( 'System Timezone' ),
            'description'   =>  __( 'Select the timezone to use in the system.' )
        ]);

        /** 
         |  ---------------------------------------------------------------------------
         |  Register Tab Column
         |  ---------------------------------------------------------------------------
        **/

        $this->gui->tabsColumns( 'registration', [
            'basic.width'     =>  6,
            'basic.title'     =>  __( 'Basic Settings' ),
        ]);

        $this->gui->tabColumnItems( 'registration', 'basic', [
            'type'          =>  'select',
            'options'       =>  'true/false',
            'name'          =>  'app_registration',
            'label'         =>  __( 'Allow Registration' ),
            'description'   =>  __( 'Evevryone can sign up.' )
        ]);
    }
}