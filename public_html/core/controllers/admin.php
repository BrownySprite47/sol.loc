<?php

function action_index(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/index', $data);
}

function action_new_liders(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/new_liders', $data);
}

function action_recommend_liders(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/recommend_liders', $data);
}

function action_edit_liders(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/edit_liders', $data);
}

function action_edit_projects(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/edit_projects', $data);
}

function action_added_liders(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';
    $data = getDataAdminCheck();
    renderView('admin/added_liders', $data);
}

function action_added_projects(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/added_projects', $data);
}

function action_deleted_projects(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/deleted_projects', $data);
}

function action_deleted_liders(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/deleted_liders', $data);
}

function action_settings(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';

    $data = getDataAdminCheck();
    renderView('admin/settings', $data);
}

