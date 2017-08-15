angular.element( document ).ready( () => {
    tendooApp.factory( 'sharedValidate', function(){
        return function(){
            var expression  =   {
                required: /^\s*$/,
                url: /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/,
                email: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
                number: /^\d+$/,
                alpha_char  :    /^[a-zA-Z]+$/,
                alpha_num   :   /^[a-zA-Z0-9]+$/,
                ip          :   /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,
                digit       :   /^[0-9]+$/,
                decimal       :   /^[+-]?\d+(\.\d+)?$/
            };

            var $this       =   this;

            /**
            *  Individual Validation
            *  @param object field
            *  @param object item
            *  @return object error
            **/

            this.__run          =   function( field, item ) {
                var errors      =   {};

                // validation must run only for visible field
                if( typeof field.hide == 'function' ) {
                    if( field.hide( item ) ) {
                        return errors;
                    }
                }

                if( angular.isDefined( field.validation ) ) {
                    _.each( field.validation, function( value, rule ) {

                        // If a field has a specific formating, let's apply this before validating
                        if( typeof field.beforeValidation != 'undefined' ) {
                            item[ field.model ]     =   field.beforeValidation( item[ field.model ] );
                        }

                        if( rule == 'required' && value == true ) {
                            if( ! angular.isDefined( item[ field.model ] ) || item[ field.model ] == null ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   NexoPOS.textDomain.requiredField;
                                errors[ field.model ].label     =   field.label;
                            } else if( item[ field.model ].match( expression.required ) ) {
                                errors[ field.model ]           =   {};
                                errors[ field.model ].msg       =   NexoPOS.textDomain.requiredField;
                                errors[ field.model ].label     =   field.label;
                            }
                        }

                        if(
                            rule == 'email' &&
                            value == true &&
                            typeof item[ field.model ] != 'undefined' &&
                            angular.equals({}, errors )
                        ) {
                            if( item[ field.model ] != null ) {
                                if( ! item[ field.model ].match( expression.email ) ) {
                                    errors[ field.model ]           =   {};
                                    errors[ field.model ].msg       =   NexoPOS.textDomain.invalidEmail;
                                    errors[ field.model ].label     =   field.label;
                                }
                            }
                        }

                        if(
                            rule == 'min_value' &&
                            typeof item[ field.model ] != 'undefined' &&
                            angular.equals({}, errors )
                        ) {
                            if( item[ field.model ] != null ) {
                                if( item[ field.model ].length < value ) {
                                    errors[ field.model ]           =   {};
                                    errors[ field.model ].msg       =   NexoPOS.textDomain.invalidLengthMin.format( value );
                                    errors[ field.model ].label     =   field.label;
                                }
                            }
                        }

                        if(
                            rule == 'max_value' &&
                            typeof item[ field.model ] != 'undefined' &&
                            angular.equals({}, errors )
                        ) {
                            if( item[ field.model ] != null ) {
                                if( item[ field.model ].length > value ) {
                                    errors[ field.model ]           =   {};
                                    errors[ field.model ].msg       =   NexoPOS.textDomain.invalidLengthMax.format( value );
                                    errors[ field.model ].label     =   field.label;
                                }
                            }
                        }

                        if(
                            rule == 'numeric' &&
                            value == true &&
                            typeof item[ field.model ] != 'undefined' &&
                            angular.equals({}, errors )
                        ) {
                            if( item[ field.model ] != null ) {
                                if( ! item[ field.model ].match( expression.number ) ) {
                                    errors[ field.model ]           =   {};
                                    errors[ field.model ].msg       =   NexoPOS.textDomain.numericRequired;
                                    errors[ field.model ].label     =   field.label;
                                }
                            }
                        }

                        if(
                            rule == 'decimal' &&
                            value == true &&
                            typeof item[ field.model ] != 'undefined' &&
                            angular.equals({}, errors )
                        ) {
                            if( item[ field.model ] != null ) {
                                if( ! item[ field.model ].match( expression.decimal ) ) {
                                    errors[ field.model ]           =   {};
                                    errors[ field.model ].msg       =   NexoPOS.textDomain.decimalRequired;
                                    errors[ field.model ].label     =   field.label;
                                }
                            }
                        }

                        /**
                        * Callback Rules
                        * Define a callback on a field, which can make an http request.
                        **/

                        if( rule == "callback" ) { 
                            errors[ field.model ]           =   {};
                            errors[ field.model ].callback  =   value;
                            errors[ field.model ].label     =   field.label;   
                            errors[ field.model ].msg       =   ''; 
                        }
                        
                    });

                }
                
                item[ field.model ]     =   angular.isUndefined( item[ field.model ]  ) ? '' : item[ field.model ];

                return errors;
            }

            this.run        =   function( fields, item ) {

                var errors          =   {};

                _.each( fields, function( field ){
                    // extends current field errors
                    let singleRunResult     =   $this.__run( field, item ) ;

                    errors          =   _.extend( errors, singleRunResult );
                });

                // replace template on error if exists
                errors              =   this.__replaceTemplate( errors );

                return this.__response( errors );
            };

            /**
            *  Turn into response
            *  @param object error
            *  @return object
            **/

            this.__response     =   function( errors ) {
                return {
                    isValid     :   angular.equals({}, errors ) ? true : false,
                    errors      :   errors
                }
            }

            this.focus      =   function( field, item, $event ) {
                var fieldClass      =   '.' + field.model + '-helper';
                if( angular.isDefined( $event ) ) {
                    angular.element( $event.target ).closest( '.form-group' ).removeClass( 'has-error' );
                    angular.element( $event.target ).closest( '.form-group' ).find( 'p.help-block' ).text( field.desc );
                } else {
                    angular.element( fieldClass ).closest( '.form-group' ).removeClass( 'has-error' );
                    angular.element( fieldClass ).text( field.desc );
                }
            }

            /**
            *  unique validation
            *  @param object fields
            *  @param object item
            *  @return void
            **/

            this.blur       =   function( field, item, $event ) {
                var validation      =   this.__run( field, item );
                var response        =   this.__response( validation );
                var errors          =   this.__replaceTemplate( response.errors );
                var fieldClass      =   '.' + field.model + '-helper';

                if( ! response.isValid ) {
                    if( angular.isDefined( $event ) ) {
                        angular.element( $event.target ).closest( '.form-group' ).removeClass( 'has-success' );
                        angular.element( $event.target ).closest( '.form-group' ).find( 'p.help-block' ).text( errors[ field.model ].msg );
                        angular.element( $event.target ).closest( '.form-group' ).addClass( 'has-error' );
                    } else {
                        angular.element( fieldClass ).closest( '.form-group' ).removeClass( 'has-success' );
                        angular.element( fieldClass ).text( errors[ field.model ].msg );
                        angular.element( fieldClass ).closest( '.form-group' ).addClass( 'has-error' );
                    }
                }
            }

            /**
            *  Blur all fields to display errors
            *  @param object fields
            *  @return void
            **/

            this.blurAll            =   function( fields, item ) {
                _.each( fields, function( field ) {
                    $this.blur( field, item );
                });
            }

            /**
            *  Replace template
            *  @param  object validation object
            *  @return object
            **/

            this.__replaceTemplate    =   function( errors ) {
                _.each( errors, function( value, key ) {
                    // We'll skip array since it may comes from group and has already been parsed.
                    if( ! Array.isArray( value ) ) {
                        errors[ key ].msg   =   value.msg.replace( '%%', value.label );
                    }                     
                });

                return errors;
            }

            this.walker                 =   function( { 
                fields, 
                models,
                item            =   null, 
                variation       =   null,
                tab             =   null, 
                index           =   0, 
                mainResolve, 
                errors          =   {} 
            }) {

                // if no item is defined
                item    =   item == null ? models : item;

                return new Promise( ( resolve, reject ) => {

                    let length              =   fields.length;
                    let field               =   fields[ index ];

                    // to avoid mainResolve overwrithing
                    if( index == 0 ) {
                        mainResolve     =   resolve;
                    }

                    // probably when the walker reach the end
                    if( typeof field == 'undefined' ) {

                        // when the walker has done
                        errors              =   this.__replaceTemplate( errors );
                        let response        =   this.__response( errors ); 

                        _.each( fields, ( field ) => {
                            if( typeof response.errors[ field.model ] != 'undefined' ) {
                                let fieldClass      =   '.' + field.model + '-helper';
                                if( ! response.isValid ) {
                                    angular.element( fieldClass ).closest( '.form-group' ).removeClass( 'has-success' );
                                    angular.element( fieldClass ).text( errors[ field.model ].msg );
                                    angular.element( fieldClass ).closest( '.form-group' ).addClass( 'has-error' );
                                }
                            }                            
                        });

                        return mainResolve( errors );
                    }

                    let promise         =   new Promise( ( _resolve, _reject ) => {

                        if( field.type == 'group' ) {

                            _.each( models[ field.model ], ( group ) => {
                                _.each( field.subFields, ( subField ) => {
                                    if( typeof group.models == 'undefined' ) {          
                                        group.models    =   {};
                                    }
                                    
                                    if( typeof group.models[ subField.model ] == 'undefined' ) {
                                        group.models[ subField.model ] = '';
                                    }
                                });
                            });

                            return this.groups_walker({
                                subFields       :   field.subFields,
                                item,
                                groups          :   models[ field.model ]  
                            }).then( ( groups_errors ) => {

                                if( typeof tab.groups_errors == 'undefined' ){
                                    tab.groups_errors       =   new Object;
                                }

                                tab.groups_errors[ field.model ]    =   groups_errors;

                                return _resolve({
                                    index   :   index+1,
                                    errors
                                });
                            });
                        }

                        // put before to make sure any undefined field has an empty string.
                        let run         =   this.__run( field, models );

                        // if the field doesn't have a validation rules, just skip that.
                        if ( typeof field.validation == 'undefined' ) {
                            return _resolve({
                                index   :   index+1,
                                errors
                            });
                        }

                        // don't run over hidden fields
                        if( typeof field.show != 'undefined' ) {
                            if( field.show( models, item ) == false ) {
                                
                                return _resolve({
                                    index   :   index+1,
                                    errors
                                });
                            }
                        }

                        if( _.keys( run ).length > 0 ) {

                            // before rejecting, let make sure it's not a callback
                            if( typeof run[ field.model ].callback != 'undefined' ) {                                
                                // Test Callback Promise
                                let callbackPromise     =   run[ field.model ].callback( field, models, errors );
                                callbackPromise.then( ( errors )=>{
                                    return _resolve({
                                        index   :   index+1,
                                        errors
                                    });
                                }, ( callback_errors ) => {
                                    errors          =   _.extend( errors, callback_errors ); 
                                    return _reject({
                                        index   :   index+1,
                                        errors
                                    });
                                });
                            } else {
                                errors          =   _.extend( errors, run ); 
                                // index + 1 to move to the next fields
                                return _reject({
                                    index   :   index+1,
                                    errors
                                }); 
                            }                        
                        } else {

                            return _resolve({
                                index       :   index+1,
                                errors
                            });
                        }                          
                    });

                    // Run Template Remplacement
                    promise.then( ({ index, errors }) => {
                        // if there is no error, just validate next fields
                        this.walker({ fields, models, item, variation, tab, index, mainResolve, errors });
                    }, ({ index, errors }) => {
                        this.walker({ fields, models, item, variation, tab, index, mainResolve, errors });
                    });
                });
            }

            this.variations_walker       =   function({
                fields,
                item, 
                index   =   0,
                mainResolve
            }) {

                return new Promise( ( resolve, reject ) => {

                    let variation       =   item.variations[ index ];

                    if( index == 0 ) {
                        mainResolve     =   resolve;
                    }

                    if( typeof variation == 'undefined' ) {
                        return mainResolve();
                    }

                    let promise         =   new Promise( ( _resolve, _reject ) => {

                        this.tabs_walker({
                            fields,
                            item, 
                            variation
                        }).then( () => {
                            // When all variation tab has been walked over
                            // let put all errors and groups_errors on this variations
                            variation.errors               =   new Object;
                            variation.groups_errors        =   new Object;
                            _.each( variation.tabs, ( tab ) => {
                                if( typeof tab.errors != 'undefined' ){
                                    variation.errors           =   _.extend( variation.errors, tab.errors );
                                }

                                if( typeof tab.groups_errors != 'undefined' ) {
                                    variation.groups_errors    =   _.extend( 
                                        variation.groups_errors,
                                        tab.groups_errors 
                                    );
                                }                                
                            });

                            _resolve({
                                index   :   index+1,
                                mainResolve
                            });
                        }); 

                    });

                    promise.then( ({ index, mainResolve }) => {
                        this.variations_walker({
                            fields,
                            item, 
                            index,
                            mainResolve
                        });
                    })
                })
            }

            this.tabs_walker             =   function({
                fields,
                item,
                variation,
                mainResolve,
                index           =   0,
                errors          =   {},
                groups_errors   =   {}
            }) {

                return new Promise( ( resolve, reject ) => {
                    if( index == 0 ) {
                        mainResolve     =   resolve;
                    }

                    if( typeof variation.tabs[ index ] == 'undefined' ) {
                        return mainResolve();
                    }

                    let promise         =   new Promise( ( _resolve, _reject ) => { 
                        
                        let tab         =   variation.tabs[ index ];

                        // Don't run over hidden tabs
                        if( typeof tab.hide != 'undefined' ) {
                            if( tab.hide( item ) == true ) {
                                return _resolve({ index : index + 1, mainResolve });
                            }
                        }

                        // if models is not set
                        if( typeof tab.models == 'undefined' ) {
                            tab.models    =   new Object;
                        }                        

                        _.each( fields[ tab.namespace ], ( field ) => {
                            if( typeof tab.models[ field.model ] == 'undefined' ) {
                                tab.models[ field.model ]     =   '';    
                            }
                        });

                        // Skip each tab, if fields doesn't belong to it
                        if( typeof fields[ tab.namespace ] == 'undefined' ) {
                            _resolve({ index : index + 1, mainResolve });
                        } else {
                            // fields, item, index = 0, mainResolve, errors = {}
                            this.walker({
                                fields  :   fields[ tab.namespace ],
                                models  :   tab.models, 
                                item,
                                variation,
                                tab                               
                            }).then( function( errors ){
                                // when all tabs fields has been checked
                                tab.errors    =   errors;
                                _resolve({ index : index + 1, mainResolve });
                            });
                        }                                       
                    });

                    promise.then( ({ index, mainResolve }) => {
                        this.tabs_walker({ fields, item, variation, index, mainResolve });
                    });
                })
            }

            this.groups_walker          =   function({
                subFields, 
                item, 
                groups,
                index                   =   0,
                mainResolve             =   null,
                errors                  =   []
            }) {
                return new Promise( ( resolve, reject ) => {
                    
                    if( mainResolve == null ) {
                        mainResolve     =   resolve;
                    }

                    // has finish
                    if( typeof groups[ index ] == 'undefined' ) {
                        return mainResolve( errors );
                    }

                    let promise         =   new Promise( ( _resolve, _reject ) => {
                        return this.walker({
                            fields      :   subFields, 
                            models      :   groups[ index ].models,
                            item
                        }).then( ( walker_errors ) => {
                            
                            groups[ index ].errors  =   walker_errors;
                            errors[ index ]         =   walker_errors;
                            
                            return _resolve({
                                index       :   index + 1,
                                errors
                            });
                        }); 
                    });

                    promise.then( ({ index, errors }) => { 
                        return this.groups_walker({
                            subFields,
                            item, 
                            groups,
                            index,
                            mainResolve, 
                            errors
                        });
                    });
                });
            }
        }
    });
});