@if( count( $gui->getColumns( @$tab[ 'namespace' ] ) ) > 0 )
    <div class="row">
        @foreach( $gui->getColumns( @$tab[ 'namespace' ] ) as $namespace => $column )
        <div class="col-md-{{ $column[ 'width' ] }} column-{{ $namespace }}">
            <div class="card">
                <div class="card-block">
                    @if( @$column[ 'action' ] != false )
                    <form action="{{ $column[ 'action' ] }}" method="POST">
                    {{ csrf_field() }}
                    <?php
                    $options            =   [];
                    if( @$column[ 'action' ] != false ) {
                        $options        =   $gui->getOptions();
                    }
                    ?>
                    @endif

                    @include( 'dashboard.gui.items' )

                    @if( @$column[ 'action' ] != false )
                    <button class="btn btn-primary">{{ @$column[ 'submitLabel' ] == null ? __( 'Submit' ) : $column[ 'submitLabel' ] }}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
