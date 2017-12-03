<?php

function action_index() {
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/admin.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/lider.php';
    require SITE_DIR . '/core/models/project.php';

    $data['target'] = 'false';

    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $data = getDataAdminCheck();
            $data['lider'] = getOneLider($_GET['id'], 'id_lid');
            $data['projects'] = getProjectsFromLider($_GET['id'], 'id_lid');
            $data['project_files'] = getOneProjectLidersFiles_toLid($_GET['id']);
        }else{
            header('Location: /');
            exit();
        }
    }else{
        header('Location: /');
        exit();
    }
    renderView('lider', $data);
}

function action_add(){
    if (isset($_SESSION['id'])){
        require SITE_DIR . '/core/models/main.php';
        require SITE_DIR . '/core/models/admin.php';
        require SITE_DIR . '/core/models/user.php';
        require SITE_DIR . '/core/models/lider.php';
        $data = getDataAdminCheck();
        $data['user'] = getOneLider($_SESSION['id'], 'user_id');
        renderView('add_lider', $data);
    }else{
        header('Location: /');
        exit();
    }
}

function action_edit(){
    if (isset($_SESSION['id'])){
        require SITE_DIR . '/core/models/main.php';
        require SITE_DIR . '/core/models/admin.php';
        require SITE_DIR . '/core/models/user.php';
        require SITE_DIR . '/core/models/lider.php';
        require SITE_DIR . '/core/models/project.php';
        $data = getDataAdminCheck();
        $data['user'] = getOneLider($_GET['id'], 'id_lid');
        $data['project_files'] = getOneProjectLidersFiles_toLid($_GET['id']);
        renderView('edit_lider', $data);
    }else{
        header('Location: /');
        exit();
    }
}

