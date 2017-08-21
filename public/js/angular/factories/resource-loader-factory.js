tendooApp.factory( 'sharedResourceLoader', function(){
    return function(){
        this.resourcesArray     =   [];

        /**
        * Push resource + callback
        * @param object resource + callback
        * @return object this
        **/

        this.push               =   ( object ) => {
            this.resourcesArray.push( object );
            return this;
        }

        /**
        * Run Resource Loader
        * @param int index 
        * @return void
        **/
        
        this.run                =   ( resourceIndex = 0, callback ) => {

            if( typeof this.resourcesArray[ resourceIndex ] != 'undefined' ) {
                let currentResource     =   this.resourcesArray[ resourceIndex ];

                if( typeof currentResource.params != 'undefined' ) {
                    currentResource.resource.all( currentResource.params, ( data ) => {                         
                        currentResource.success( data );                            
                        this.run( resourceIndex + 1, callback );                            
                    }, ( data ) => {
                        typeof currentResource.error != 'undefined' ? currentResource.error( data ) : null
                    });
                } else {
                    currentResource.resource.all( {}, ( data ) => {
                        currentResource.success( data );                            
                        this.run( resourceIndex + 1, callback );                            
                    }, ( data ) => {
                        typeof currentResource.error != 'undefined' ? currentResource.error( data ) : null
                    });
                }    
            } else {
                // let run the callback
                if( typeof callback == 'function' ) {
                    callback();
                }
            }
        }
    }
})