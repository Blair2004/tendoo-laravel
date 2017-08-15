<?php
global $Options;
$this->load->config( 'rest' );
?>
tendooApp.factory( 'sharedTableHeaderButtons',[ '$http', function( $http ){
    return function() {
        return [{
            text        :   '<?php echo _s( 'XLS', 'nexopos_advanced' );?>',
            show        :   {
                singleSelect    :   true, // if the table has a single select , the button will appear
                multiSelect     :   true, // if the table has more that one select, the button will appear
                noSelect        :   true // if the table has 0 entry selected, the button will appear
            },
            icon        :   'fa fa-file-o',
            callback        :   function( table ) {

                var dataObject      =   {
                    headers         :   table.columns,
                    data            :   table.entries,
                    name            :   table.name,
                    author          :   '<?php echo User::pseudo();?>'
                };

                $http.post( '<?php echo site_url([ 'rest', 'nexopos_advanced', 'export_to_xls' ]);?>' , dataObject,{
                    headers			:	{
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                }).then( ( returned ) => {
                    angular.element( 'body' )
                    .append( '<iframe class="download_xls" style="display:none"></iframe>' );

                    angular.element( 'iframe.download_xls' ).attr({
                        src    :   returned.data.file
                    });

                    angular.element( document ).ready( () => {
                        setTimeout( () => {
                            angular.element( 'iframe.download_xls' ).remove();
                        }, 200 );
                    });
                });
            }
        },{
            text        :   '<?php echo _s( 'CSV', 'nexopos_advanced' );?>',
            show        :   {
                singleSelect    :   true, // if the table has a single select , the button will appear
                multiSelect     :   true, // if the table has more that one select, the button will appear
                noSelect        :   true // if the table has 0 entry selected, the button will appear
            },
            icon        :   'fa fa-file-o',
            callback        :   function( table ) {

                var dataObject      =   {
                    headers         :   table.columns,
                    data            :   table.entries,
                    name            :   table.name,
                    author          :   '<?php echo User::pseudo();?>'
                };

                $http.post( '<?php echo site_url([ 'rest', 'nexopos_advanced', 'export_to_csv' ]);?>' , dataObject,{
                    headers         :   {
                        '<?php echo $this->config->item('rest_key_name');?>'    :   '<?php echo @$Options[ 'rest_key' ];?>'
                    }
                }).then( ( returned ) => {
                    angular.element( 'body' )
                    .append( '<iframe class="download_csv" style="display:none"></iframe>' );

                    angular.element( 'iframe.download_csv' ).attr({
                        src    :   returned.data.file
                    });

                    angular.element( document ).ready( () => {
                        setTimeout( () => {
                            angular.element( 'iframe.download_csv' ).remove();
                        }, 200 );
                    });
                });
            }
        },{
            text        :   '<?php echo _s( 'PDF', 'nexopos_advanced' );?>',
            show        :   {
                singleSelect    :   true, // if the table has a single select , the button will appear
                multiSelect     :   true, // if the table has more that one select, the button will appear
                noSelect        :   true // if the table has 0 entry selected, the button will appear
            },
            icon        :   'fa fa-file-text',
            callback        :   function( table ) {
                var dataObject      =   {
                    headers         :   table.columns,
                    data            :   table.entries,
                    name            :   table.name,
                    author          :   '<?php echo User::pseudo();?>'
                };

                $http.post( '<?php echo site_url([ 'rest', 'nexopos_advanced', 'export_to_pdf' ]);?>' , dataObject,{
                    headers			:	{
                        '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                    }
                }).then( ( returned ) => {
                    window.open( returned.data.file );
                });
            }
        }]
    }
}]);
