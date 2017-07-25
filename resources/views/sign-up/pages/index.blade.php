@extends( 'sign-up.layout.main' )

@section( 'sign-up.layout.content' )
<div class="ks-body">
    <div class="ks-logo">{{ config( 'app.name' ) }}</div>

    <div class="card panel panel-default ks-light ks-panel ks-signup">
        <div class="card-block">
            <form class="form-container" method="POST" action="{{ route( 'sign-up.submit' ) }}">
                {{ csrf_field() }}
                <h4 class="ks-header">{{ __( 'Registration' ) }}</h4>
                @foreach( ( array ) $fields->signup() as $name => $field )
                <div class="form-group {{ $errors->first( $name ) ? 'has-danger' : '' }}">
                    <div class="input-icon icon-left icon-lg icon-color-primary">
                        <input name="{{ $name }}" type="{{ @$field[ 'type' ] == null ? 'text' : $field[ 'type' ] }}" class="form-control" placeholder="{{ @$field[ 'text' ] }}">
                        <span class="icon-addon">
                            <span class="{{ @$field[ 'icon' ] }}"></span>
                        </span>
                    </div>
                    <div class="form-control-feedback">{{ $errors->first( $name ) }}</div>
                </div>
                @endforeach
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ __( 'Sign Up' ) }}</button>
                </div>
                {{--  <div class="ks-text-center">
                    <span class="text-muted">By clicking "Sign Up" I agree the </span> <a href="pages-signup.html">Terms Of Service</a>
                </div>  --}}
                <div class="ks-text-center">
                    {!! __( 'Already have an account ? <a href=":link">Login</a>', [ 'link' => route( 'sign-in.index' ) ] ) !!}
                </div>

            </form>
        </div>
    </div>
</div>
@endsection