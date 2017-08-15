// DEPRECATED
angular.element( document ).ready( function(){
    tendooApp.factory('sharedDataToCsv', function(){
        return {
            export:function( resource, columns ){

                    resource.get( function( data ){

                    var infos = "data:text/csv;charset=latin-1,\ufeff";
                    data.entries = angular.toJson( data.entries );
                    data.entries = JSON.parse ( data.entries );

                    // Setting columns
                    var row = "";
                    var col_array = new Array // For storing namespace columns

                    _.each( columns, function ( value ){
                        row += '"' + value.text + '",';
                        col_array.push( value.namespace);
                    });
                    infos += row + '\r\n';

                    for (var i = 0; i < data.entries.length; i++) {
                        var row = "";
                        _.each( data.entries[i], function ( value, key ){
                            var keyers = "";
                            keyers += key;

                            if ( col_array.indexOf( keyers ) != -1 ){
                                row += '"' + value + '",';
                            }
                        });
                        row.slice(0, row.length - 1);
                        infos += row + '\r\n';
                    }

                    var encodedData = encodeURI( infos );
                    var body = angular.element(document.getElementsByTagName('body'))[0];
                    angular.element(body).append("<a id='ExportToCSV'></a>");
                    var link = angular.element(document.getElementById('ExportToCSV'));
                    link.attr('href',encodedData);
                    var fileName = name || ((new Date()).toLocaleDateString()+".csv");
                    link.attr('download',fileName);
                    link[0].click();
                    link.remove();
                });
            }
        }
    });
});
