tendooApp.factory( 'sharedTable', [
    '$location',
    '$http',
    'sharedAlert',
    'sharedCurrency',
    'sharedMoment',
    function(
        $location,
        $http,
        sharedAlert,
        sharedCurrency,
        sharedMoment
    ){
    return function( name = 'Unammed' ){

        this.columns            =   [];
        this.disabledFeatures   =   [];
        this.params             =   new Object;

        // let the use hide a search input
        this.hideSearch         =   false;

        // Hide Header buttons
        this.hideHeaderButtons  =   false;

        // table name
        this.name               =   name;
        this.limit              =   20;
        this.order_type         =   'asc';

        /**
         *  Array of Object To String
         *  @param
         *  @return
        **/

        this.arrayOfObjectToString      =   function( array ) {
            var stringToReturn      =   '';
            var arrayJson           =   angular.fromJson( array );
            _.each( arrayJson, function( entry, index ) {
                if( index + 1 == arrayJson.length ) {
                    stringToReturn  +=  entry.label;
                } else {
                    stringToReturn  +=  entry.label + ', ';
                }
            });
            return stringToReturn;
        }

        /**
         * Options value to human readable
        **/

        this.objectToString = function ( data, options ){
            var stringToReturn = '';
            if ( typeof data == "undefined" ){
                return "Non défini";
            } else {
                _.each( options, function( entry ){
                    if (entry.value == data){
                        stringToReturn = entry.label
                    }
                });
            }
            return stringToReturn;
        }

        /**
         *  Cancel Search
         *  @param void
         *  @return void
        **/

        this.clear             =   function(){
            if( this.resource ) {
                this.resource.get( this.params, ( data ) => {
                    this.entries           =   data.entries;
                    this.pages             =   Math.ceil( data.num_rows / this.limit );
                    this.searchModel       =   '';
                });
            }
        }

        /**
         *  Delete Entries
         *  @param string entry
         *  @return string
        **/
        
        this.delete             =   function( params ) {
            this.resource.delete( _.extend( this.params, params ), ( data ) => {
                this.get();
            },function(){
                sharedAlert.warning( 'An error occured' );
            });
        }

        /**
         *  disable feature
         *  @param string feature to disable
         *  @return void
        **/

        this.disable            =   function( feature ) {
            this.disabledFeatures.push( feature );
        }

        /**
         *  Filter Col Entry
         *  @param string entry
         *  @return string
        **/

        this.filter             =   function( value, col, entry ) {
            if( col.is == 'array_of_object' ) {
                return this.arrayOfObjectToString( value )
            } else if( col.is == 'money' ) {
                return sharedCurrency.toAmount( value );
            } else if( col.is == 'date_span' ) {
                return sharedMoment.timeFromNow( value );
            } else if( col.is == 'object'){
                return this.objectToString( value, col.object );
            } else if( col.is == 'filter' ) {
                return col.filter( value, col, entry );
            }
            return value;
        }

        /**
         *  Is Disable. checks whether an feature is enabeld or not
         *  @param string feature
         *  @return boolean
        **/

        this.isDisabled         =   function( feature ) {
            return _.indexOf( this.disabledFeatures, feature ) > -1 ? true : false;
        }

        // For select action for bulk operation
        this.selectedAction     =   void(0);

        /**
         *  Order Columns
         *  @param object column
         *  @return void
        **/

        this.order      =   function( column ) {

            // Set table order
            if( angular.isUndefined( this.order_type ) ) {
                this.order_type   =   'desc';
            } else if( this.order_type == 'desc' ) {
                this.order_type   =   'asc';
            } else  if( this.order_type == 'asc' ) {
                this.order_type   =   'desc';
            }

            if( angular.isDefined( column ) ) {
                this.order_by           =   column;
            }

            if( typeof this.get == 'function' ) {
                // Trigger callback
                this.get( _.extend( this.params, {
                    order_type      :   this.order_type,
                    order_by        :   this.order_by,
                    limit           :   this.limit,
                    current_page    :   this.currentPage
                } ) );
            }
        }

        /**
        *  Table Get
        *  @param object query object
        *  @return void
        **/

        this.get            =   function( params ) {
            this.resource.get( _.extend( this.params, params ), ( data ) => {
                this.entries        =   data.entries;
                this.pages          =   Math.ceil( data.num_rows / this.limit );
            });
        }

        /**
         *  Get Checked entries
         *  @param void
         *  @return array of object
        **/

        this.getChecked             =   function(){
            var selectedEntries     =   [];

            _.each( this.entries, function( entry ) {
                if( entry.checked == true ) {
                    selectedEntries.push( entry );
                }
            })

            return selectedEntries;
        }

        /**
         *  Get Page
         *  @param int page id
         *  @return void
        **/

        this.getPage                =   function( id ) {
            this.currentPage        =   id;
            this.order(void(0), ( data ) => {
                this.entries       =   data.entries;
                this.pages         =   Math.ceil( data.num_rows / this.limit );
            });
        }

        /**
         *  Get Number
         *  @param int
         *  @return array
        **/

        this.__getNumber        =   function( number ) {
            if( angular.isDefined( number ) ) {
                return new Array( number );
            }
        }

        /**
         *  Search
         *  @param void
         *  @return void
        **/

        this.search                     =   function(){
            if( this.resource ) {
                this.resource.get( _.extend( this.params, {
                    search  :   this.searchModel
                }), ( data ) => {
                    this.entries        =   data.entries;
                    this.pages          =   Math.ceil( data.num_rows / this.limit );
                });
            }
        }

        /**
         *  Submit bulk Actions
         *  @param void
         *  @return void
        **/

        this.submitBulkActions          =   function() {

            if( this.selectedAction != false ) {

                var selectedEntries     =   [];

                _.each( this.entries, function( entry ) {
                    if( entry.checked == true ) {
                        selectedEntries.push( entry.id );
                    }
                })

                if( selectedEntries.length == 0 ) {
                    return sharedAlert.warning( 'You should at least choose one element' );
                }

                if( this.selectedAction.namespace == 'delete' ) {
                    // Here perform actions
                    if( angular.isUndefined( this.delete ) ) {
                        console.log( '"delete" method is not defined' );
                        return;
                    }

                    sharedAlert.confirm( 'Delete these elements', ( action ) => {
                        if( action ) {
                            this.delete({
                                'ids[]'  :   selectedEntries
                            });
                        }
                    });
                }
            }
        }

        /**
         *  Submit Single Action
         *  @param object entry
         *  @param object action
         *  @return void
        **/

        this.submitSingleAction          =   function( entry, action ) {
            if( action.namespace == 'delete' ) {
                // Here perform actions
                if( angular.isUndefined( this.delete ) ) {
                    console.log( '"delete" method is not defined' );
                    return;
                }

                sharedAlert.confirm( 'Delete these elements', ( action ) => {
                    if( action ) {
                        this.resource.delete({
                            'id'  :   entry.id
                        });
                    }
                });
            } else {
                return document.location = action.url + entry.id
            }
        }

        /**
         *  Toggle All Entry.
         *  @param object entries
         *  @return void
        **/

        this.toggleAllEntries         =   function( entries, headCheckbox ) {
            _.each( entries, function( entry ) {
                entry.checked  =   headCheckbox;
            });
        }

        /**
         *  Trigger Button Export
         *  @return void
        **/

        this.triggerExport              =   ()  =>  {
            if( typeof this.selectedExportOption != 'undefined' ) {
                this.headerButtons[ this.selectedExportOption ].callback( this );
            }
        }

    }
}])
