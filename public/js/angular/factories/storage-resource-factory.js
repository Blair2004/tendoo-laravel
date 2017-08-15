<?php
global $Options;
$this->load->config( 'rest' );
?>
tendooApp.factory( 'sharedStorageResource', function( $resource ) {
    return $resource(
        '<?php echo site_url( [ 'rest', 'nexopos_advanced', 'storage/:keys' ]);?>',
        {
            keys             :   '@_keys'
        },{
            get  : {
                method          : 'GET',
                headers			:	{
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            },
            post            :   {
                method      :   'POST',
                headers     :   {
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            },
            delete : {
                method : 'DELETE',
                headers : {
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            }
        }
    );
});
