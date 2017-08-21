
<div class="ks-user-list-view-header-block">
     <h4 class="ks-user-list-view-header-block-name">
     @{{ title }}
     </h4>

     <div class="ks-user-list-view-header-control">
        <a href="@{{ route.list }}">
            <div class="btn btn-primary">{{ __( 'Return' ) }}</div>
        </a>        
     </div>
</div>
<div class="ks-user-list-view-table">
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" ng-repeat="( name, field ) in fields track by $index">

               <div class="form-group" ng-if="( field.type == 'text' || field.type == null ) && field.relation == null">
                    <label class="form-control-label" for="formGroupExampleInput">@{{ field.label }}</label>
                    <input 
                    type="@{{ field.type }}" 
                    class="form-control" 
                    id="formGroupExampleInput" 
                    placeholder="@{{ field.placeholder == null ? field.label : field.placeholder }}">
                    <small class="form-text text-muted">@{{ field.description }}</small>
               </div>

               <div class="form-group" ng-if="field.type == 'password'">
                    <label class="form-control-label" for="formGroupExampleInput">@{{ field.label }}</label>
                    <input 
                    type="@{{ field.type }}" 
                    class="form-control" 
                    id="formGroupExampleInput" 
                    placeholder="@{{ definedColumns[ name ] }}">
                    <small class="form-text text-muted">@{{ field.description }}</small>
               </div>

               <div class="form-group" ng-if="field.relation != null">
                    <label class="form-control-label" for="formGroupExampleInput">@{{ field.label }}</label>
                    <select
                        id = "@{{ field.model }}-input-id"
                        class="form-control"
                        ng-model="item[ field.model ]"
                        ng-blur="validate.blur( field, item )"
                        ng-focus="validate.focus( field, item )"
                        ng-disabled="field.disabled"
                        >
                        <option ng-repeat="option in field.options track by $index" value="@{{ option.value }}">@{{ option.label }}</option>
                    </select>
                    <small class="form-text text-muted">@{{ field.description }}</small>
               </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary">{{ __( 'Save' ) }}</button>
            </div>
		</div>
	</div>
</div>