<div
    ng-repeat="field in fields"
    class="{{ field.class !== undefined ? field.class : 'col-lg-12 col-sm-12 col-xs-12' }}"
    >

    <div 
        class="form-group" 
        ng-if="field.type == 'text'"
        ng-hide="field.hide( item )">
        <div class="input-group">
          <span class="input-group-addon">{{ field.label }}</span>
          <input
            type="text"
            class="form-control"
            ng-blur="validate.blur( field, item )"
            ng-focus="validate.focus( field, item )"
            ng-model="item[ field.model ]"
            placeholder="{{ field.placeholder }}"
            ng-disabled="field.disabled">
        </div>
        <p class="help-block {{ field.model }}-helper" style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

    <div 
        class="form-group" 
        ng-if="field.type == 'textarea'"
        ng-hide="field.hide( item )">
        <label>{{ field.label }}</label>
        <textarea
            ng-model="item[ field.model ]"
            ng-blur="validate.blur( field, item )"
            ng-focus="validate.focus( field, item )"
            ng-disabled="field.disabled"
            placeholder="{{ field.placeholder }}" class="form-control"></textarea>
        <p class="help-block {{ field.model }}-helper" style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

    <div 
        class="form-group" 
        ng-if="field.type == 'select'"
        ng-hide="field.hide( item )">
        <div class="input-group">
            <span class="input-group-addon">{{ field.label }}</span>
            <select
                id = "{{ field.model }}-input-id"
                class="form-control"
                ng-model="item[ field.model ]"
                ng-blur="validate.blur( field, item )"
                ng-focus="validate.focus( field, item )"
                ng-disabled="field.disabled"
                >
                <option ng-repeat="option in field.options track by $index" value="{{ option.value }}">{{ option.label }}</option>
            </select>
            <span class="input-group-btn" ng-if="field.buttons.length > 0">
                <a class="btn btn-{{ button.class }}" ng-repeat="button in field.buttons" ng-click="button.click( item )"><i class="{{ button.icon }}"></i> {{ button.label }}</a>
            </span>
        </div>
        <p class="help-block {{ field.model }}-helper" style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

    <div 
        class="form-group" 
        ng-if="field.type == 'datepick'"
        ng-hide="field.hide( item )">
        <div class="input-group">
            <span class="input-group-addon">{{ field.label }}</span>
            <input
                class="form-control"
                ng-blur="validate.blur( field, item )"
                ng-focus="validate.focus( field, item )"
                ng-disabled="field.disabled"
                placeholder="{{ field.placeholder }}"
                datetimepicker ng-model="item[ field.model ]"
                options="field.options"
                />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <p class="help-block {{ field.model }}-helper" style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

    <!-- For multiselect -->

    <div 
        class="form-group" 
        ng-if="field.type == 'dropdown_multiselect'"
        ng-hide="field.hide( item )">
        <label>{{ field.label }}</label><br>
        <amo-multiselect
            ng-blur="validate.blur( field, item )"
            ng-focus="validate.focus( field, item )"
            ng-disabled="field.disabled"
            ng-model="item[ field.model ]"
            options="option.label for option in field.options"> <!-- $scope.fields[1].options -->
        </amo-multiselect>
        <p class="help-block {{ field.model }}-helper" style="font-size:12px;">{{ field.desc }}</p>
    </div>

    <div 
        class="form-group" 
        ng-if="field.type == 'datetime-popup'"
        ng-hide="field.hide( item )">
        <p class="input-group">
          <input
            type="text"
            class="form-control"
            uib-datepicker-popup
            ng-model="item[ field.model ]"
            ng-disabled="field.disabled"
            is-open="popup2.opened"
            ng-required="true"
            close-text="Close" />
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
          </span>
        </p>
        <p class="help-block {{ field.model }}-helper" style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

    <div
        class="row"
        ng-if="field.type == 'group'"
        ng-init="item[ field.model ] = resetGroup( item[ field.model ] )"
        ng-hide="field.hide( item )"
    >

        <div
            class="col-lg-6 col-sm-6 col-xs-12"
            ng-repeat="(group_index,group_value) in item[ field.model ]"
        >

            <div 
                class="box box-primary" 
                style="background:#F1F1F1;"
                ng-hide="field.hide( item )">
                <div class="box-header with-border">
                    <!-- .groups" -->
                    <div class="box-title">
                        {{ field.label }}
                    </div>
                    <div class="box-tools pull-right">
                        <button ng-show="item[ field.model ].length <= groupLengthLimit" type="button" name="button" class="btn btn-sm btn-primary" ng-click="addGroup( item[ field.model ] )"><i class="fa fa-plus" ></i></button>
                        <button ng-show="item[ field.model ].length > 1" type="button" ng-click="removeGroup( group_index, item[ field.model ] )" name="button" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div
                        ng-repeat="subField in field.subFields"
                        ng-show="subField.show( variation, item, field.subFields )"
                    >

                        <div 
                            class="form-group" 
                            ng-if="subField.type == 'text'"
                            ng-hide="field.hide( item, item[ field.model ][ group_index ] )">

                            <div class="input-group">

                              <span class="input-group-addon">{{ subField.label }}</span>

                              <input
                                type="text"
                                ng-disabled="subField.disabled"
                                class="form-control"
                                ng-model="item[ field.model ][ group_index ][ subField.model ]"
                                placeholder="{{ subField.placeholder }}"
                                >

                            </div>
                            <p class="help-block" style="min-height:15px;font-size:12px;">{{ subField.desc }}</p>
                        </div>

                        <div 
                            class="form-group" 
                            ng-if="subField.type == 'select'"
                            ng-hide="field.hide( item, item[ field.model ][ group_index ] )">
                            <div class="input-group">
                                <span class="input-group-addon">{{ subField.label }}</span>
                                <select 
                                    class="form-control" 
                                    ng-disabled="subField.disabled"
                                    ng-model="item[ field.model ][ group_index ][ subField.model ]">
                                    <option ng-repeat="option in subField.options" value="{{ option.value }}">{{ option.label }}</option>
                                </select>
                                <span class="input-group-btn" ng-if="subField.buttons.length > 0">
                                    <a class="btn btn-{{ button.class }}" ng-repeat="button in subField.buttons" ng-click="button.click( item )"><i class="{{ button.icon }}"></i> {{ button.label }}</a>
                                </span>
                            </div>
                            <p class="help-block" style="min-height:15px;font-size:12px;">{{ subField.desc }}</p>
                        </div>

                        <!--  Image Select -->

                        <div 
                            class="input-group" 
                            ng-if="subField.type == 'image_select'"
                            ng-hide="field.hide( item, item[ field.model ][ group_index ] )">
                          <span class="input-group-addon">{{ subField.label }}</span>
                          <input 
                            ng-model="item[ field.model ][ group_index ][ subField.model ]" 
                            ng-disabled="subField.disabled"
                            type="text" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
    
    <div 
        class="form-group" 
        ng-if="field.type == 'image_select'"
        ng-hide="field.hide( item, item[ field.model ][ group_index ] )">
        <div class="input-group">
          <span class="input-group-addon">{{ field.label }}</span>
          <input
            ng-blur="validate.focus( field, item )"
            ng-blur="validate.blur( field, item )"
            ng-model="item[ field.model ]"
            ng-disabled="subField.disabled"
            type="text"
            class="form-control"
            placeholder="">
            <button media-modal model="field.model" selected-size="field.size"></button>
        </div>
        <p
          class="help-block {{ field.model }}-helper"
          style="min-height:15px;font-size:12px;">{{ field.desc }}</p>
    </div>

</div>
