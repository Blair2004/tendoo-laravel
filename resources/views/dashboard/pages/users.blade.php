@extends( 'dashboard.layout.main' )

@section( 'dashboard.page.head' )
    @parent
    @css( 'apps/crm/users-list' )
@endsection

@section( 'dashboard.page.body' )
{!! $gui->render( 'table' ) !!}
@endsection