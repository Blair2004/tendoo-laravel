@foreach( $column[ 'items' ] as $index => $item )

    @if( in_array( $item[ 'type' ], [ 'text', 'password', 'email', 'url' ]) )

        @if( is_array( @$options[ $item[ 'name' ] ] ) )
            @foreach( $options[ $item[ 'name' ] ] as $value )
                @include( 'dashboard.gui.items-text' )
            @endforeach
        @else
            @include( 'dashboard.gui.items-text' )
        @endif

    @endif

    @if( $item[ 'type' ] == 'select' )
    <!-- Select Field -->
    <fieldset class="form-group {{ $errors->first( $item[ 'name' ] ) ? 'has-danger' : '' }}">
        <label class="form-control-label label-{{ $item[ 'name' ] }}" for="{{ $item[ 'name' ] }}">{{ @$item[ 'label' ] }}</label>
        <select 
        name="{{ $item[ 'name' ] }}" 
        id="field-{{ $index . '-' . $item[ 'name' ] }}" 
        class="form-control">
            @foreach( ( array ) @$item[ 'options' ] as $value => $text )
            <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        </select>
        <p class="help-block">{{ $errors->first( $item[ 'name' ] ) ? $errors->first( $item[ 'name' ] ) : @$item[ 'description' ] }}</p>
    </fieldset>
    <!-- end select field -->
    @endif

    @if( $item[ 'type' ] == 'textarea' )
    <!-- Select Field -->
    <fieldset class="form-group {{ $errors->first( $item[ 'name' ] ) ? 'has-danger' : '' }}">
        <label class="form-control-label label-{{ $item[ 'name' ] }}" for="{{ $item[ 'name' ] }}">{{ @$item[ 'label' ] }}</label>
        <textarea 
        name="{{ $item[ 'name' ] }}" 
        id="field-{{ $index . '-' . $item[ 'name' ] }}" 
        class="form-control" style="min-height:130px"></textarea>
        <p class="help-block">{{ $errors->first( $item[ 'name' ] ) ? $errors->first( $item[ 'name' ] ) : @$item[ 'description' ] }}</p>
    </fieldset>
    <!-- end select field -->
    @endif

    @if( @$item[ 'validation' ] )
    {{ $gui->saveValidationRules( $namespace, $item ) }}
    @endif

@endforeach
<input name="form-namespace" type="hidden" value="{{ $gui->formNamespace( $namespace ) }}"/>