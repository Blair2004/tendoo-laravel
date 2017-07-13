<div class="ks-navbar-actions">
    <!-- BEGIN NAVBAR NOTIFICATIONS -->
    {{--  <div class="nav-item dropdown ks-notifications">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="la la-bell ks-icon" aria-hidden="true">
                <span class="badge badge-pill badge-info">7</span>
            </span>
            <span class="ks-text">Notifications</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
            <ul class="nav nav-tabs ks-nav-tabs ks-info" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-toggle="tab" data-target="#navbar-notifications-all" role="tab">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#navbar-notifications-activity" role="tab">Activity</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tab" data-target="#navbar-notifications-comments" role="tab">Comments</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane ks-notifications-tab active" id="navbar-notifications-all" role="tabpanel">
                    <div class="ks-wrapper ks-scrollable">
                        <a href="#" class="ks-notification">
                            <div class="ks-avatar">
                                <img src="assets/img/avatars/avatar-3.jpg" width="36" height="36">
                            </div>
                            <div class="ks-info">
                                <div class="ks-user-name">Emily Carter <span class="ks-description">has uploaded 1 file</span></div>
                                <div class="ks-text"><span class="la la-file-text-o ks-icon"></span> logo vector doc</div>
                                <div class="ks-datetime">1 minute ago</div>
                            </div>
                        </a>
                        <a href="#" class="ks-notification">
                            <div class="ks-action">
                                <span class="ks-default">
                                    <span class="la la-briefcase ks-icon"></span>
                                </span>
                            </div>
                            <div class="ks-info">
                                <div class="ks-user-name">New project created</div>
                                <div class="ks-text">Dashboard UI</div>
                                <div class="ks-datetime">1 minute ago</div>
                            </div>
                        </a>
                        <a href="#" class="ks-notification">
                            <div class="ks-action">
                                <span class="ks-error">
                                    <span class="la la-times-circle ks-icon"></span>
                                </span>
                            </div>
                            <div class="ks-info">
                                <div class="ks-user-name">File upload error</div>
                                <div class="ks-text"><span class="la la-file-text-o ks-icon"></span> logo vector doc</div>
                                <div class="ks-datetime">10 minutes ago</div>
                            </div>
                        </a>
                    </div>

                    <div class="ks-view-all">
                        <a href="#">Show more</a>
                    </div>
                </div>
                <div class="tab-pane ks-empty" id="navbar-notifications-activity" role="tabpanel">
                    There are no activities.
                </div>
                <div class="tab-pane ks-empty" id="navbar-notifications-comments" role="tabpanel">
                    There are no comments.
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- END NAVBAR NOTIFICATIONS -->

    <!-- BEGIN NAVBAR USER -->
    <div class="nav-item dropdown ks-user">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-avatar">
                <img src="assets/img/avatars/avatar-13.jpg" width="36" height="36">
            </span>
            <span class="ks-info">
                <span class="ks-name">Robert Dean</span>
                <span class="ks-description">Premium User</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
            @foreach( config( 'dashboard.user-menus' ) as $menu )
            <a class="dropdown-item" href="{{ $menu[ 'href' ] }}">
                <span class="{{ @$menu[ 'icon' ] }} ks-icon"></span>
                <span> {{ @$menu[ 'text' ] }} </span>
            </a>
            @endforeach
        </div>
    </div>
    <!-- END NAVBAR USER -->
</div>