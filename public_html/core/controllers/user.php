<?php
function action_index(){
    // require SITE_DIR . '/core/models/main.php';
    // require SITE_DIR . '/core/models/user.php';
    // require SITE_DIR . '/core/models/admin.php';

    // $data['getDataTableUser'] = getDataTableUser($_SESSION['id']);

    renderView('user/interests', $data);
}

function action_settings() {
    if (isset($_SESSION['id'])){
        require SITE_DIR . '/core/models/main.php';
        require SITE_DIR . '/core/models/user.php';
        require SITE_DIR . '/core/models/project.php';
        $data['getProjectsFromUser'] = getProjectsFromUser($_SESSION['id']);
        $data['project_files'] = getOneProjectLidersFiles_toUser($_SESSION['id']);
        //view($data['getProjectsFromUser']);
        $data['user'] = getData(getUserData($_SESSION['id']));
        $data['user_social'] = getData(getUser($_SESSION['id']));
        renderView('user/index', $data);
    }else{
        header('Location: /');
        exit();
    }
}



function action_edit() {
    if ($_SESSION['role'] == 'user'){
        require SITE_DIR . '/core/models/main.php';
        require SITE_DIR . '/core/models/user.php';
        require SITE_DIR . '/core/models/project.php';
        $data['user'] = getData(getUserData($_SESSION['id']));
        $data['project_files'] = getOneProjectLidersFiles_toUser($_SESSION['id']);
        renderView('user/edit_user', $data);
    }
    else{
        header('Location: /');
        exit();
    }
}

function action_add() {
    if ($_SESSION['role'] == 'user'){
        require SITE_DIR . '/core/models/main.php';
        require SITE_DIR . '/core/models/user.php';
        $data['user'] = getData(getUserData($_SESSION['id']));
        renderView('user/edit_user', $data);
    }
    else{
        header('Location: /');
        exit();
    }
}
function action_recommend(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/lider.php';
    $data['recommend'] = getRecommendLider();
    renderView('user/recommend_liders', $data);
}

function action_inter(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/admin.php';

    $data['getDataTableUser'] = getDataTableUser($_SESSION['id']);

    renderView('user/settings', $data);
}

