<?php
namespace App\Dashboard;

class Page
{
    /**
     * Page Title
     * @param string
     * @return void
    **/

    public static function title( $title, $subTitle = null )
    {
        // if a title is set, then we would probably want to enable it
        config([ 'dashboard.page.show.title' => true ]);
        config([ 'dashboard.page.title' => $title ]);
        config([ 'dashboard.page.subTitle' => $subTitle ]);
    }
}