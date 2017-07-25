@extends( 'sign-in.layout.main' )

@section( 'sign-in.layout.content' )
    <div class="ks-body">
        <div class="ks-logo">{{ config( 'app.name' ) }}</div>

        <div class="card panel panel-default ks-light ks-panel ks-login">
            <div class="card-block">
                <form class="form-container" method="POST" action="{{ url( 'sign-in/login' ) }}">
                    {{ csrf_field() }}
                    
                    <h4 class="ks-header">{{ _i( 'Login' ) }}</h4>
                    
                    @if( is_array( session( 'response' ) ) )
                        @if( session( 'response.status' ) == 'failed' )
                    
                    <div class="alert alert-danger ks-solid" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                        {{ session( 'response.message')}}
                    </div>

                        @elseif( session( 'response.status' ) == 'success' ) 

                    <div class="alert alert-success ks-solid" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                        {{ session( 'response.message')}}
                    </div>

                        @endif
                    @endif

                    @foreach( ( array ) $fields->signin() as $name => $field )
                        @if( in_array( @$field[ 'type'], [ 'text', 'password', 'email' ] ) )
                        <div class="form-group {{ $errors->first( $name ) ? 'has-danger' : '' }}">
                            <div class="input-icon icon-left icon-lg icon-color-primary">
                                <input name="{{ $name }}" type="{{ @$field[ 'type' ] == null ? 'text' : $field[ 'type' ] }}" class="form-control" placeholder="{{ @$field[ 'text' ] }}">
                                <span class="icon-addon">
                                    <span class="{{ @$field[ 'icon' ] }}"></span>
                                </span>
                            </div>
                            <div class="form-control-feedback">{{ $errors->first( $name ) }}</div>
                        </div>
                        @elseif( @$field[ 'type' ] == 'checkbox' ) 
                        <label class="custom-control custom-checkbox">
                            <input name="{{ $name }}" type="checkbox"  class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">{{ $field[ 'text' ] }}</span>
                        </label>
                        @endif
                    @endforeach

                    <div class="form-group">
                        <button type="submit" type="button"class="btn btn-primary btn-block">{{_i( 'Login' ) }}</button>
                    </div>

                    @if( config( 'sign-in.allow-registration' ) )
                    <div class="ks-text-center">
                        {{ _i( 'Don\'t have an account ? <a href="%s">Sign Up here</a>.' )}}
                    </div>
                    @endif

                    <div class="ks-text-center">
                        <a href="{{ url( 'sign-in/password-lost' ) }}">{{ _i( 'Forgot your password' ) }}</a> <hr> <a href="{{ route( 'sign-up.index' ) }}">{{ _i( 'Register a new account' ) }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection