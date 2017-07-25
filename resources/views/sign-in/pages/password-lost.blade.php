@extends( 'sign-in.layout.main' )

@section( 'sign-in.layout.content' )

<div class="ks-body">
    <div class="ks-logo">{{ config( 'app.name' ) }}</div>

    <div class="card panel panel-default light ks-panel ks-forgot-password">
        <div class="card-block">
            <form class="form-container" method="POST" action="{{ url()->route( 'sign-in.password-recovery' ) }}">
                {{ csrf_field() }}
                <h4 class="ks-header">
                    {{ _i( 'Password Lost' ) }}
                    <span>{{ _i( 'Don\'t worry, this happens sometimes.' ) }}</span>
                </h4>

                <div class="form-group {{ $errors->has( 'email' ) ? 'has-danger' : '' }}">
                    <div class="input-icon icon-left icon-lg icon-color-primary">
                        <input name="email" type="text" class="form-control" placeholder="Email">
                        <span class="icon-addon">
                            <span class="la la-at"></span>
                        </span>
                    </div>
                    <div class="form-control-feedback">{{ $errors->first( 'email' ) }}</div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ _i( 'Sumit' ) }}</button>
                </div>
                <div class="ks-text-center">
                    <a href="{{ url()->route( 'sign-in.index' ) }}">{{ _i( 'Sign in' ) }}</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection