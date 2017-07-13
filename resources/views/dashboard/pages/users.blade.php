@extends( 'dashboard.layout.main' )

@section( 'dashboard.page.body' )
<div class="card bg-white m-b">
    <div class="card-header">Basic Table</div>
    <div class="card-block p-a-0">
    <div class="table-responsive">
        <table class="table m-b-0">
        <thead>
            <tr>
            <th class="col-md-5">
                <span></span>Entity</th>
            <th class="col-md-2">Volume</th>
            <th class="col-md-2">Value</th>
            <th class="col-md-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>
                <span></span>Facebook</td>
            <td>23,532</td>
            <td>573</td>
            <td class="align-middle">
                <div class="progress progress-sm m-a-0">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <span></span>Google</td>
            <td>78</td>
            <td>1,138</td>
            <td class="align-middle">
                <div class="progress progress-sm m-a-0">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%">
                    <span class="sr-only">23% Complete (success)</span>
                </div>
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <span></span>Yahoo</td>
            <td>895</td>
            <td>488</td>
            <td class="align-middle">
                <div class="progress progress-sm m-a-0">
                <div class="progress-bar" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                    <span class="sr-only">78% Complete (success)</span>
                </div>
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <span></span>Themeforest</td>
            <td>7653</td>
            <td>1,290</td>
            <td class="align-middle">
                <div class="progress progress-sm progress-striped active m-a-0">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%">
                    <span class="sr-only">56% Complete (success)</span>
                </div>
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <span></span>Evanto</td>
            <td>894</td>
            <td>478</td>
            <td class="align-middle">
                <div class="progress progress-sm progress-striped m-a-0">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
                    <span class="sr-only">49% Complete (success)</span>
                </div>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection