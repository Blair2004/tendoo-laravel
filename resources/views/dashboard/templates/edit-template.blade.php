<div class="col-md-12">
    <h3 style="margin-top:0px;">{{ textDomain.title }}<a ng-href="{{ textDomain.returnLink }}" class="btn btn-primary btn-sm pull-right">{{ textDomain.return }}</a></h3>
</div>
<div class="col-md-9">
    <div class="input-group input-group-lg">
        <span class="ng-hide input-group-btn ">
            <span class="ng-hide"></span>
        </span>
        <input
            placeholder="{{ textDomain.itemTitle }}"
            ng-blur="validate.blur( fields[0], item )"
            ng-focus="validate.focus( fields[0], item )"
            type="text" class="form-control"
            style="line-height:40px;font-size:25px;" ng-model="item.name">
        <span class="input-group-btn ">
            <button class="btn btn-primary" ng-disabled="submitDisabled" ng-click="submit()" type="button">{{ textDomain.saveBtnText }}</button>
            <span class="ng-hide"></span>
        </span>
    </div>
    <p class="help-block {{ fields[0].model }}" style="font-size:12px;">{{ fields[0].desc }}</p>
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">
                {{ textDomain.fieldsTitle }}
            </div>
        </div>
        <div class="box-body">
            <div class="row">

                <?php include_once( dirname( __FILE__ ) . '/fields-template.php' );?>
                
            </div>
        </div>
    </div>
</div>
