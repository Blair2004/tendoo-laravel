@inject( 'Enqueue', 'App\Services\Enqueue' )
@inject( 'Hook', 'App\Services\Hook' )
@section( 'dashboard.page.footer' )
     @bower_js( 'angular/angular.min' )
     @bower_js( 'angular-resource/angular-resource.min' )
     @bower_js( 'babel/browser.min' )
     @bower_js( 'jquery/dist/jquery.min' )
     @bower_js( 'jquery/dist/jquery-migrate.3.0.0' )
     @bower_js( 'responsejs/response.min' )
     @bower_js( 'loading-overlay/loadingoverlay.min' )
     @bower_js( 'tether/js/tether.min' )
     @bower_js( 'bootstrap/js/bootstrap.min' )
     @bower_js( 'jscrollpane/jquery.jscrollpane.min' )
     @bower_js( 'jscrollpane/jquery.mousewheel' )
     @bower_js( 'flexibility/flexibility' )
     @bower_js( 'noty/noty.min' )
     @bower_js( 'd3/d3.min' )
     @bower_js( 'noty/noty' )
     @bower_js( 'maplace/maplace.min' )
     @bower_js( 'underscore/underscore' )
     @bower_js( 'momentjs/moment.min' )
     
     @foreach( $Enqueue::getBowerScripts( 'onFooter' ) as $file )
          @bower_js( $file[ 'url' ] )
     @endforeach

     @js( 'common' )

     <script>
     var tendooApp       =   angular.module( 'tendooApp', {!! json_encode( $Hook->apply_filters( 'angular_dependencies', [ 'ngResource' ] ) ) !!} );
     </script>

     @foreach( $Enqueue::getScripts( 'onFooter' ) as $file )
          @js( $file[ 'url' ] )
     @endforeach

     {!! $Hook->do_action( 'dashboard_footer', false ) !!}
@show
