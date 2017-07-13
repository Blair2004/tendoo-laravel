<div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs">
    @include( 'dashboard.layout.sidebar' )
    <div class="ks-column ks-page">
        @if( config( 'page.show.title', false ) )
        
        <div class="ks-header">
            <section class="ks-title-and-subtitle">
                <div class="ks-title-block">
                    <h3 class="ks-main-title">{{ config( 'page.title' ) }}</h3>
                    <div class="ks-sub-title">{{ config( 'page.subTitle' ) }}</div>
                </div>
            </section>
        </div>
        @endif
        @yield( 'dashboard.page.body' )
    </div>
</div>