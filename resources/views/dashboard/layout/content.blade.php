<!-- content panel -->
<div class="main-panel">
    @include( 'dashboard.layout.header' )
    <!-- main area -->
    <div class="main-content {{ config( 'dashboard.page.body.padding', true ) == true ? '' : 'no-padding' }}">
        @if( config( 'dashboard.page.show.title', false ) )
        <div class="page-title">
          <div class="title">{{ config( 'dashboard.page.title' ) }}</div>
          <div class="sub-title">{{ config( 'dashboard.page.subTitle' ) }}</div>
        </div>
        @endif
        @yield( 'dashboard.page.body' )
    </div>
    <!-- /main area -->
</div>
<!-- /content panel -->