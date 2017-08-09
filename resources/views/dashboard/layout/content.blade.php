<div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs">
    @include( 'dashboard.layout.sidebar' )
    <div class="ks-column ks-page">
        @include( 'dashboard.layout.page-title' )
        @yield( 'dashboard.page.body' )
    </div>
</div>