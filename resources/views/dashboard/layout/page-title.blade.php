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