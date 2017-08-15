<?php if( true == false ):?>
<script>
<?php endif;?>
tendooApp.factory( 'sharedFormManager', [ 
    'sharedValidate', 
    'sharedAlert', 
    'sharedHooks',
    '$rootScope', 
    
    function( 
        sharedValidate, 
        sharedAlert, 
        sharedHooks,
        $rootScope 
    ){
    return function() {

        this.item           =   {};
        this.validate       =   new sharedValidate(); // not yet used
        this.hooks          =   new sharedHooks();// Don't forget this is part of a controller. 

        /**
        *  Add Group. Duplicate group fields
        *  @param  object
        *  @return void
        **/

        this.addGroup         =   function( group ) {

            // can also be used like an action
            let object          =   this.hooks.applyFilters( 'addGroup', {});

            group.push(object);
        }

        /**
        *  Add Variation
        *  @param void
        *  @return void
        **/

        this.addVariation         =   function(){
            if( this.item.variations.length == 10 ) {
                NexoAPI.Notify().info( '<?php echo _s( 'Attention', 'nexopos_advanced' );?>', '<?php echo _s( 'Vous ne pouvez pas créer plus de 10 variations d\'un même produit.', 'nexopos_advanced' );?>')
                return;
            }

            var singleVariation         =   {
                tabs        :   this.item.getTabs()
            };

            _.each( singleVariation, function( variation, $tab_id ) {
                _.each( variation.tabs, function( tab, $tab_key ) {
                    tab.models      =   {};
                });
            });

            this.item.variations.push( this.hooks.applyFilters( 'addVariation', singleVariation ) );
        }

        /**
        *  Active Tab
        *  @param
        *  @return
        **/

        this.activeTab        =   function( $event, variationIndex, tabIndex ) {
            angular.element( $event.currentTarget )
            .parent( 'li' )
            .siblings()
            .removeClass( 'active' );

            angular.element( $event.currentTarget )
            .parent( 'li' )
            .addClass( 'active' );

            _.each( this.item.variations[variationIndex].tabs, function( value ) {
                value.active    =   false;
            });

            this.item.variations[variationIndex].tabs[ tabIndex ].active     =   true;
        }

        /**
        *  Count all errors
        *  @param object variation object
        *  @return int
        **/

        this.countAllErrors       =   function( tab ) {

            var error_count      =   0;
            error_count         +=  _.keys( tab.errors ).length;

            if( angular.isDefined( tab.groups_errors ) ) {
                _.each( tab.groups_errors, function( group ) {
                    _.each( group, function( errors ){
                        error_count  +=  _.keys( errors ).length;
                    });
                });
            }

            return error_count;
        }

        /**
         * Duplicated a given variation
         * @param object variation
         * @param int variation index
         * @return void
        **/
        
        this.duplicate 	=	function( variation, $index ) {
            let copied_variation;
            copied_variation    =   {
                models      :   angular.copy( variation.models ),
                tabs        :   this.item.getTabs()
            };

            // copy only models from original 
            copied_variation.tabs.forEach( ( value, key ) => {
                value.models    =   angular.copy( variation.tabs[ key ].models );
            });

            this.hooks.applyFilters( 'duplicateVariation', copied_variation );

            this.item.variations.splice( $index + 1, 0, copied_variation );

            setTimeout( () => {
                angular.element( '.variation-' + ( $index + 1 ) ).hide().fadeIn( 500 );
            }, 50 );

            
        }

        /**
        *  Get Icon using URL
        *  @param string icon
        *  @return string
        **/

        this.getIcon          =   function( string ){
            return '<?php echo module_url( 'nexopos_advanced' ) . 'images/items/'; ?>' + string;
        }

        /**
        *  Get Class
        *  Access ids object and return all ui classe for selecting variation, variation header, variation vontent
        *  @param  object ids object
        *  @return object
        **/

        this.getClass         =   function( ids ) {

            // if ids is not default, just return a non defined value.
            if( typeof ids == 'undefined' ) {
                return {};
            }

            var classes_object          =   {
                variation               :   '.variation-' + ids.variation_id,
                variation_header        :   '.variation-header-' + ids.variation_id,
                variation_body          :   '.variation-body-' +   ids.variation_id,
                // variation_tab           :   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id,
                variation_tab_header    :   '.variation-' + ids.variation_id + '-tab-header-' + ids.variation_tab_id,
                variation_tab_body      :   '.variation-' + ids.variation_id + '-tab-body-' + ids.variation_tab_id,
            }

            if( angular.isDefined( ids.variation_group_id ) ) {
                // classes_object.variation_group              =   '.variation-' + ids.variation_id + '-tab-' +  ids.variation_tab_id + '-group-' + ids.variation_group_id;
                classes_object.variation_group_header       =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-header-' + ids.variation_group_id;
                classes_object.variation_group_body         =   '.variation-' + ids.variation_id + '-tab-' + ids.variation_tab_id + '-group-body-' + ids.variation_group_id;
            }

            return classes_object;
        }

        /**
        *  Render Attrs
        *  @param
        *  @return
        **/

        this.renderAttributes         =   function( object ) {
            if( angular.isDefined( object ) ) {
                var attrs   =   '';
                _.each( object, function( value, key ) {
                    attrs   +=  key + '="' + value + '" ';
                });

                return attrs;
            }
        }

        /**
        *  Reset Group if not defined
        *  @param object group object
        *  @return void
        **/

        this.resetGroup               =   function( group ) {
            if( angular.isUndefined( group ) ) {
                return [{}];
            }
            return group
        }

        /**
        *  Remove Group
        *  @param int group index
        *  @return void
        **/

        this.removeGroup      =   function( $index, $groups, ids ) {
            sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer ce groupe ?', 'nexopos_advanced' );?>', ( action ) => {
                if( action ) {

                    if( typeof this.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors != 'undefined' ) {
                        // delete all error related to the deleted group
                        this.item.variations[ ids.variation_id ].tabs[ ids.variation_tab_id ].groups_errors[ ids.variation_tab.namespace ].splice( $index, 1 );
                    }                    

                    $groups.splice( this.hooks.applyFilters( 'removeGroup', $index ), 1 );
                }
            });
        }

        /**
        *  Remove Variation
        *  @param int variation index
        *  @return void
        **/

        this.removeVariation  =   function( $index ){
            sharedAlert.confirm( '<?php echo _s( 'Souhaitez-vous supprimer cette variation ?', 'nexopos_advanced' );?>', ( action ) => {
                if( action ) {
                    this.item.variations.splice( this.hooks.applyFilters( 'removeVariation', $index ), 1 );
                }
            });
        }

        /**
        *  Select Tab
        *  @param object tabs
        *  @param string tab naemspace
        *  @return object
        **/

        this.selectTab        =   function( tabs, namespace ) {
            var tabToReturn;
            _.each( tabs, function( tab, key ) {
                if( tab.namespace == namespace ) {
                    tabToReturn =   key;
                }
            });
            return tabs[ tabToReturn ];
        }

        /**
        *  tabContent is active, check whether a tab is already active
        *  @param
        *  @return
        **/

        this.tabContentIsActive   =   function( tabActive, index ) {
            if( angular.isDefined( tabActive ) ) {
                return tabActive;
            }

            if( index == 0 ) {
                return true;
            }
            return false;
        }

        /**
        *  Toggle Tip
        *  @param object field
        *  @return boolean
        **/

        this.toggleFieldTip           =   function( field ) {
            if( angular.isUndefined( field.tip ) ) {
                field.tip   =   false;
            }
            return field.tip  = ! field.tip;
        }

        /**
         * Disable Fields
         * 
         * @param fields
         * @return void
        **/

        this.disable                =   function( action, fields ) {
            if( action == 'all' ) {
                _.each( fields, ( field ) => {
                    field.disabled      =   true;
                });
            }
        }

        /**
         * Enable fields
         * 
         * @param string action
         * @param array fields
         * @return void
        **/

        this.enable                 =   function( action, fields ) {
            if( action == 'all' ) {
                _.each( fields, ( field ) => {
                    field.disabled      =   false;
                });
            }
        }
    }
}])