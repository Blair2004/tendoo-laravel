<!-- Select Field -->
<fieldset class="form-group {{ $errors->first( $item[ 'name' ] ) ? 'has-danger' : '' }}">
    <label class="form-control-label label-{{ $item[ 'name' ] }}" for="{{ $item[ 'name' ] }}">{{ @$item[ 'label' ] }}</label>
    <select 
    {{ is_array( @$options[ $item[ 'name' ] ] ) ? 'multiple' : '' }}
    name="{{ $item[ 'name' ] }}" 
    id="field-{{ $index . '-' . $item[ 'name' ] }}" 
    class="form-control">
        @if( in_array( $item[ 'options' ], [ 'true/false', 'yes/no' ] ) )
            <?php $item[ 'options' ]    =   [
                'true'      =>  __( 'Yes' ),
                'false'     =>  __( 'No')
            ]?>
        @endif
        @foreach( ( array ) @$item[ 'options' ] as $value => $text )
            {{-- If item return an array, we assume the select has type "multiple"  --}}
            @if( is_array( @$options[ $item[ 'name' ] ] ) )
            <option 
                {{ in_array( $value, @$options[ $item[ 'name' ] ], true ) ? 'selected' : '' }} 
                value="{{ $value }}">
                {{ $text }}
            </option>            
            @else <option {{ $value === @$options[ $item[ 'name' ] ] ? 'selected' : '' }} value="{{ $value }}">
                {{ $text }}
            </option>@endif
        @endforeach
    </select>
    <p class="help-block">{{ $errors->first( $item[ 'name' ] ) ? $errors->first( $item[ 'name' ] ) : @$item[ 'description' ] }}</p>
</fieldset>
<!-- end select field -->