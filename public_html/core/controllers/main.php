<?php

function action_index() {
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();

    // $data = getDataAdminCheck();
    // view($data);
    $data['filters'] = getFilters();
    $data['localizations'] = getLocalizations();
    $data['dynamicFilter'] = getDynamicFilter($data['filters'], $data['localizations']);
    $settings['projects_on_page'] = (isset($_POST['projects_on_page'])) ? $_POST['projects_on_page'] : '10';
    // $settings['projects_on_page'] = 10;
    if (empty($_POST)) {
        $data['countpages'] = intval((db_count('projects') - 1) / $settings['projects_on_page']) + 1;
    }else{
        $where = getWhereForFilter($_POST);
        $data['countpages'] = intval((db_count('projects', $where) - 1) / $settings['projects_on_page']) + 1;
    }

    $data['numpage'] = intval((!isset($_POST['numpage']) ? 1 : $_POST['numpage']));

    if ($data['numpage'] < 1)                    $data['numpage'] = 1;
    if ($data['numpage'] > $data['countpages'])  $data['numpage'] = $data['countpages'];

    $startproject = $data['numpage'] * $settings['projects_on_page'] - $settings['projects_on_page'];
    $limit = getLimitForPageNavigation($startproject, $settings['projects_on_page']);

    if (empty($_POST)) {
        $data['projects'] = getProjects('', $limit);
        renderView('main', $data);
    }else{
        $where = getWhereForFilter($_POST);
        $data['projects'] = getProjects($where, $limit);
        $data['all_projects'] = getProjects($where, '');
        renderView('layouts/content', $data);
    }
}
