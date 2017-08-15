tendooApp.factory( 'sharedFieldEditor', function(){
    return function( modelName, fields ) {
        var field          =       false;
        _.each( fields, function( value ) {
            if( value.type != 'group' && value.model == modelName ) {
                field       =   value;
            } else if( value.type == 'group' ) {
                _.each( value.subFields, function( _value ) {
                    if( _value.model == modelName ) {
                        field   =   _value;
                    }
                });
            }
        });

        return field;
    }
})
