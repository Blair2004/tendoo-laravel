@extends( 'sign-in.layout.main' )

@section( 'sign-in.layout.content' )
<div class="session-wrapper">
    <div class="page-height-o row-equal align-middle">
    <div class="column">
        <div class="card bg-white no-border">
        <div class="card-block">
            <form role="form" class="form-layout" method="POST" action="{{ url( 'sign-in/check' ) }}">
            <div class="text-center m-b">
                <h4 class="text-uppercase">{{ config( 'app.name' ) }}</h4>
                <p>{{ _i( 'Please sign-in with your account' ) }}</p>
            </div>
            <div class="form-inputs">
                <label class="text-uppercase">{{ _i( 'Email or Username' ) }}</label>
                <input type="email" class="form-control input-lg" placeholder="Email Address" required>
                <label class="text-uppercase">{{ _i( 'Password' ) }}</label>
                <input type="password" class="form-control input-lg" placeholder="Password" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg m-b" type="submit">{{ _i( 'sign-in' ) }}</button>
            
            @if( config( 'sign-in.allow-registration' ) )

            <div class="divider">
                <span>{{ _i( 'Or' ) }}</span>
            </div>
            <a class="btn btn-block no-bg btn-lg m-b" href="{{ url( 'register' ) }}">{{ _i( 'Register' ) }}</a>
            <p class="text-center">
                <small>
                <em>{{ _i( 'By clicking here you agree to our terms and conditions.' ) }}</em>
                </small>
            </p>

            @endif

            </form>
        </div>
        <a href="{{ url( 'sign-in/password-lost' ) }}" class="bottom-link">{{ _i( 'Forgotten Password ?' ) }}</a>
        </div>
    </div>
    </div>
</div>
@endsection