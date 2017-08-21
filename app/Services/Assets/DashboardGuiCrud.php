<?php
namespace App\Services\Assets;

use App\Services\Enqueue;

class DashboardGuiCrud
{
     public function __construct()
     {
          Enqueue::footerJS( 'table-factory', 'angular/factories/table-factory' );
          Enqueue::footerJS( 'table-alert', 'angular/factories/alert-factory' );
          Enqueue::footerJS( 'table-moment', 'angular/factories/moment-factory' );
          Enqueue::footerJS( 'table-currency', 'angular/factories/currency-factory' );
          Enqueue::footerJS( 'field-editor', 'angular/factories/field-editor-factory' );
          Enqueue::footerJS( 'raw-to-options', 'angular/factories/raw-to-options-factory' );
          Enqueue::footerJS( 'raw-to-mutiselect', 'angular/factories/raw-to-multiselect-options-factory' );
          Enqueue::footerJS( 'resource-loader', 'angular/factories/resource-loader-factory' );
          Enqueue::bowerCSS( 'sweet-alert', 'sweetalert/sweetalert' );
          Enqueue::bowerJS( 'sweet-alert', 'sweetalert/sweetalert' );
          Enqueue::bowerJS( 'ng-sweet-alert', 'ngSweetAlert/SweetAlert.min' );
     }
}