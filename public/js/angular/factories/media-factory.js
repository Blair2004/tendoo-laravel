angular.element( document ).ready( () => {
    tendooApp.factory('sharedMedia', ['$http', function( $http ){
        return function(){

            this.modalOneShown = function(){
                console.log('model one shown');
            }
    
        }
    }]);
});