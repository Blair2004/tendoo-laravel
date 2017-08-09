@extends( 'dashboard.layout.main' )

@section( 'dashboard.page.head' )
    @parent
    @css( 'apps/crm/users-list.min' )
@endsection

@section( 'dashboard.page.body' )
{!! $gui->render( 'crm-table' ) !!}
@endsection