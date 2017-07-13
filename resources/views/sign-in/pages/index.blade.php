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

                        @endif
                    @endif

                    <div class="form-group {{ $errors->first( 'email' ) ? 'has-danger' : '' }}">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">@</div>
                            <input name="email" type="text" class="form-control {{ $errors->first( 'email' ) ? 'form-control-danger' : '' }}" placeholder="{{ _i( 'Email' ) }}">
                        </div>
                        <div class="form-control-feedback">{{ $errors->first( 'email' ) }}</div>
                    </div>

                    <div class="form-group {{ $errors->first( 'password' ) ? 'has-danger' : '' }}">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">
                                <span class="icon-addon">
                                    <span class="la la-key"></span>
                                </span>
                            </div>
                            <input name="password" type="password" class="form-control {{ $errors->first( 'password' ) ? 'form-control-danger' : '' }}" placeholder="{{ _i( 'Password' ) }}">
                        </div>
                        <div class="form-control-feedback">{{ $errors->first( 'password' ) }}</div>
                    </div> 

                    <div class="form-group">
                        <button type="submit" type="button"class="btn btn-primary btn-block">{{_i( 'Login' ) }}</button>
                    </div>

                    @if( config( 'sign-in.allow-registration' ) )
                    <div class="ks-text-center">
                        {{ _i( 'Don\'t have an account ? <a href="%s">Sign Up here</a>.' )}}
                    </div>
                    @endif

                    <div class="ks-text-center">
                        <a href="{{ url( 'sign-in/password-lost' ) }}">{{ _i( 'Forgot your password' ) }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection