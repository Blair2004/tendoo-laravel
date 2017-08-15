tendooApp.factory( 'sharedRawToOptions', function(){

    /**
     *  Turn Raw Options to dropdown option
     *  @param object
     *  @param string key
     *  @param string value
     *  @return object
    **/

    return function( raw, value, label ) {
        var DropdownOptions         =   [];

        _.each( raw, function( data ) {
            DropdownOptions.push({
                value       :   data[value],
                label       :   data[label]
            })
        });

        return DropdownOptions;
    }
});
