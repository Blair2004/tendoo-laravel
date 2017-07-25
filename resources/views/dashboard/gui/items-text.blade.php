<fieldset class="form-group {{ $errors->first( $item[ 'name' ] ) ? 'has-danger' : '' }}">
    <label class="form-control-label label-{{ $item[ 'name' ] }}" for="{{ $item[ 'name' ] }}">{{ @$item[ 'label' ] }}</label>
    <input 
    type="{{ $item[ 'type' ] }}" 
    name="{{ $item[ 'name' ] }}" 
    class="form-control field-{{ $item[ 'name' ] }}" 
    id="field-{{ $index . '-' . $item[ 'name' ] }}"
    value="{{ @$value ? $value : @$options[ $item[ 'name' ] ] }}"
    placeholder="{{ @$item[ 'placeholder' ] == null ? @$item[ 'label' ] : $item[ 'placeholder' ] }}"> 
    <p class="help-block">{{ $errors->first( $item[ 'name' ] ) ? $errors->first( $item[ 'name' ] ) : @$item[ 'description' ] }}</p>
</fieldset>