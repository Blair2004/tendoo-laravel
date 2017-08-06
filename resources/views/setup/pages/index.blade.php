@extends( 'setup.layout.main' )

@section( 'setup.layout.content' )
<div class="ks-body">
        <div class="ks-logo">{{ config( 'app.name' ) }}</div>

        <div class="card panel panel-default ks-light ks-panel ks-signup" style="min-height:200px">
            <div class="card-block">
                <form class="form-container">
                    <h4 class="ks-header">{{ __( 'Setup' ) }}</h4>
                    
                    <div class="ks-text-center">
                        {{ __( 'Thank you for having choosed Tendoo CMS. You\'ll be ready to go in few second. Before let\'s install everyting.' ) }}
                    </div>                   

                    <br>

                    <div class="form-group">
                        <a href="{{ route( 'setup.step', [ 'step' => 1 ] ) }}" class="btn btn-primary btn-block">Sign Up</a>
                    </div>

                    <div class="ks-social">

                    <div class="ks-text-center">{{ __( 'Coding\'s Art' ) }}</div>
                        
                        {{--  <div class="pull-lg-left">{{ __( 'Follow us on social Network' ) }}</div>
                        <div class="pull-lg-right">
                            <a href="#" class="facebook la la-facebook"></a>
                            <a href="#" class="twitter la la-twitter"></a>
                            <a href="#" class="google la la-google"></a>
                        </div>  --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection