<?php

function action_index()
{
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/liders_filter.php';
    $data = getDataAdminCheck();
    $data['filter'] = getFilters();
    $settings['projects_on_page'] = 10;

    if (!empty($_POST['filter_liders'])) {
        $data['$countpages'] = intval((db_count('liders') - 1) / $settings['projects_on_page']) + 1;
    }else{
        $data['$countpages'] = intval((db_count('projects') - 1) / $settings['projects_on_page']) + 1;
    }
    
    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1) $data['numpage'] = 1;
    if ($data['numpage'] > $data['$countpages']) $data['numpage'] = $data['$countpages'];

    $data['startproject'] = $data['numpage'] * $settings['projects_on_page'] - $settings['projects_on_page'];

    $limit = getLimitForPageNavigation($data['startproject'], $settings['projects_on_page']);

    if (!empty($_POST['filter_liders'])) {
        if ($_POST['filter_liders'] == 'all') {
            $data['lider'] = getLiders("", $limit);
            renderView('layouts/content_liders', $data);
        }else{
            $data['lider'] = getLiders(" WHERE fio='".checkChars($_POST['filter_liders'])."' AND checked = '1'", "");
            $data['$countpages'] = intval((db_count('liders', " WHERE fio='".checkChars($_POST['filter_liders'])."'") - 1) / $settings['projects_on_page']) + 1;
            renderView('layouts/content_liders', $data);
            //view($data['$countpages']);
        }
    }else{
        $data['lider'] = getLiders('', $limit);
        renderView('liders_filter', $data);
        //view($data['$countpages']);
    }
}
