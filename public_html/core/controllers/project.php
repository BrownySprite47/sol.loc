<?php

function action_index(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/project.php';
    require SITE_DIR . '/core/models/admin.php';

    $data = getDataAdminCheck();

    $data['target'] = 'false';
    if (isset($_GET['id'])){
        if (is_numeric($_GET['id'])){
            $data['project'] = getProject($_GET['id']);
            $data['localizations'] = getLocalizations();
            $data['one_project'] = getOneProjectLiders($_GET['id']);
            $data['project_files'] = getOneProjectLidersFiles($_GET['id']);
            if ($_SESSION['role'] == 'admin' && !empty($_GET)) {
                $data['getUserData'] = getData(getUserDataAdmin($_GET['id']));
            }else{
                $data['getUserData'] = getData(getUserData($_SESSION['id']));
            }
        }else{
            header('Location: /');
            exit();
        }
    }else{
        header('Location: /');
        exit();
    }
    renderView('project', $data);
}

function action_add(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/admin.php';
    if (isset($_SESSION['id'])){
        $data = getDataAdminCheck();
        $data['localizations'] = getLocalizations();
        if ($_SESSION['role'] == 'admin' && !empty($_GET)) {
            $data['getUserData'] = getData(getUserDataAdmin($_GET['id']));
        }else{
            $data['getUserData'] = getData(getUserData($_SESSION['id']));
        }
        renderView('add_project', $data);
    }else{
        header('Location: /user');
        exit();
    }
}

function action_edit(){
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/models/project.php';
    require SITE_DIR . '/core/models/admin.php';

    if (isset($_SESSION['id'])){
        if (isset($_GET['id'])){
            if (is_numeric($_GET['id'])){
                $data = getDataAdminCheck();
                $data['project'] = getProject($_GET['id']);
                $data['localizations'] = getLocalizations();
                $data['one_project'] = getOneProjectLiders($_GET['id']);
                $data['project_files'] = getOneProjectLidersFiles($_GET['id']);
                $data['filters'] = getLidersFio();
                // if ($_SESSION['role'] == 'admin') {
                //     $data['getUserData'] = getOneProjectLiders($_GET['id']);
                // }else{
                    $data['getUserData'] = getOneProjectLiders($_GET['id']);
                // }
                renderView('edit_project', $data);
            }else{
                header('Location: /user');
                exit();
            }
        }else{
            header('Location: /user');
            exit();
        }
    }else{
        header('Location: /user');
        exit();
    }
}
