tendooApp.factory( 'sharedCurrency', function(){
    return new function(){

        this.currencyPosition   =   'before'; // NexoPOS.currencyPosition == null ? 'before' : NexoPOS.currencyPosition;
        this.currencyFormat     =   '0,0.00';
        this.currencySymbol     =   '$'
        this.currencyISO        =   'USD';
        this.defaultFormat      =   '0,0.0';

        /**
         *  Currency Position on Format
         *  @return string
        **/

        this.format     =   function() {
            let value;
            if( this.currencyPosition == 'before' ) {
                    value  =   '$' + ' ' + this.currencyFormat;
            } else if( this.currencyPosition == 'before_close' ) {
                value   =   '$' + this.currencyFormat;
            } else if( this.currencyPosition == 'after' ) {
                value   =   this.currencyFormat + ' ' + '$';
            } else if( this.currencyPosition == 'after_close' ) {
                value   =   this.currencyFormat + '$';
            }

            return typeof value != undefined ? value : this.defaultFormat;
        }

        /**
         * Turn a String into a money
         * @param string current amount
         * @return string formated amount
        **/
        
        this.toAmount 	=	function( money ) {
            if( parseInt( money ) >= 0 ) {
                value   =   numeral( parseFloat( money ), this.currencyISO ).format( this.format() );
                value   =   value.replace( '$', this.currencySymbol );
                return value;
            }

            return money;
        }

    }
});