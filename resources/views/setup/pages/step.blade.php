@extends( 'setup.layout.main' )

@section( 'setup.layout.content' )
<div class="ks-body">
        <div class="ks-logo">{{ config( 'app.name' ) }}</div>

        @if( $step == 1 )
        <div class="card panel panel-default ks-light ks-panel ks-signup" style="min-height:auto">
            <div class="card-block">
                <form class="form-container" action="{{ route( 'setup.db' ) }}" method="POST">
                    <h4 class="ks-header">{{ __( 'Database Configuration' ) }}</h4>

                    {{--  {{ dd( $errors ) }}  --}}

                    {{ csrf_field() }}

                    @foreach( ( array ) $fields->setup( $step ) as $name => $field )
                        @include( 'shared.fields' )
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">{{ __( 'Install' ) }}</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if( $step == 2 )
        <div class="card panel panel-default ks-light ks-panel ks-signup" style="min-height:auto">
            <div class="card-block">
                <form class="form-container" action="{{ route( 'setup.app' ) }}" method="POST">
                    <h4 class="ks-header">{{ __( 'Application Configuration' ) }}</h4>

                    {{--  {{ dd( $errors ) }}  --}}

                    {{ csrf_field() }}

                    @foreach( ( array ) $fields->setup( $step ) as $name => $field )
                        @include( 'shared.fields' )
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">{{ __( 'Save' ) }}</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
@endsection