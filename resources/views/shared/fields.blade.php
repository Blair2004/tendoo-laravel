@if( in_array( @$field[ 'type'], [ 'text', 'password', 'email' ] ) )
<div class="form-group {{ $errors->first( $name ) ? 'has-danger' : '' }}">
    <div class="input-icon icon-left icon-lg icon-color-primary">
        <input value="{{ @$field[ 'value' ] }}" name="{{ $name }}" type="{{ @$field[ 'type' ] == null ? 'text' : $field[ 'type' ] }}" class="form-control" placeholder="{{ @$field[ 'text' ] }}">
        <span class="icon-addon">
            <span class="{{ @$field[ 'icon' ] }}"></span>
        </span>
    </div>
    <div class="form-control-feedback">{{ $errors->first( $name ) }}</div>
</div>
@elseif( @$field[ 'type' ] == 'checkbox' ) 
<label class="custom-control custom-checkbox">
    <input name="{{ $name }}" type="checkbox"  class="custom-control-input" value="{{ @$field[ 'value' ] }}">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">{{ $field[ 'text' ] }}</span>
</label>
@endif