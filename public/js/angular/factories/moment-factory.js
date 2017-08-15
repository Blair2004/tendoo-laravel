tendooApp.factory( 'sharedMoment', function( $interval ){
    return new function(){
        $this                       =   this;
        this.serverTimeZone         =   'Africa/Casablanca';
        this.serverDate             =   moment( '<?php echo date_now();?>' );

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