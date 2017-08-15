<?php
global $Options;
$this->load->config( 'rest' );
?>
tendooApp.factory( 'sharedUserResource', function( $resource ) {
    return $resource(
        '<?php echo site_url( [ 'rest', 'nexopos_advanced', 'users/:id?order_by=:order_by&order_type=:order_type&limit=:limit' ]);?>',
        {
            id              :   '@_id',
            order_by        :   '@_order_by',
            order_type      :   '@_order_type',
            limit           :   '@_limit',
            current_page    :   '@_current_page'
        },{
            get  : {
                method : 'GET',
                headers         :   {
                    '<?php echo $this->config->item('rest_key_name');?>'    :   '<?php echo @$Options[ 'rest_key' ];?>'
                }
            }
        }
    );
});
