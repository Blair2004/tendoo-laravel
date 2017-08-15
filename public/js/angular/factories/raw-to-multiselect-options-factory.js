// Deprecated
tendooApp.factory( 'rawToMultiselectOptions', function(){

    /**
     *  Turn Raw Options to dropdown multiselect option
     *  @param object
     *  @param string key
     *  @param string value
     *  @return object
    **/

    return function( raw, value, label ) {
        var DropdownOptions         =   [];

        _.each( raw, function( data ) {
            DropdownOptions.push({
                id          :   data[value],
                label       :   data[label]
            })
        });

        return DropdownOptions;
    }
});
