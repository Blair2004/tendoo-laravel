<?php
namespace App\Services\Assets;

use App\Services\Enqueue;

class DashboardGuiTable
{
     public function __construct()
     {
          Enqueue::footerJS( 'table-factory', 'angular/factories/table-factory' );
          Enqueue::footerJS( 'table-alert', 'angular/factories/alert-factory' );
          Enqueue::footerJS( 'table-moment', 'angular/factories/moment-factory' );
          Enqueue::footerJS( 'table-currency', 'angular/factories/currency-factory' );
          Enqueue::bowerCSS( 'sweet-alert', 'sweetalert/sweetalert' );
          Enqueue::bowerJS( 'sweet-alert', 'sweetalert/sweetalert' );
          Enqueue::bowerJS( 'ng-sweet-alert', 'ngSweetAlert/SweetAlert.min' );
     }
}