angular.element( document ).ready( function(){
    tendooApp.factory( 'sharedMoment', function( $interval ){
        return new function(){
            $this                       =   this;
            this.serverTimeZone         =   tendoo.site_timezone == null ? 'Africa/Casablanca' : tendoo.site_timezone;
            this.serverDate             =   moment( tendoo.now() );

            /**
             *  Time From Now
             *  @param string date
             *  @return string
            **/

            this.timeFromNow            =   function( datetime ) {
                return moment( datetime ).from( this.serverDate );
            }

            setInterval( () =>{
                this.serverDate.add( 1, 's' );
            }, 1000 );

            /**
             *  Return Now Date
             *  @param void
             *  @return void
            **/

            this.now                    =   function(){
                return this.serverDate.format();
            }
        }
    });
});
