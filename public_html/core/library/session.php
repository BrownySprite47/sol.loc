<?php
if (isset($_SESSION)) {
    if(!empty($_SESSION['id'])) {
        if ($_SESSION['role'] == 'user'){
            $admin = false;
        }else{
            $admin = true;
        }
        $session = true;
    }else{
        $session = false;
    }
}else{
    $session = false;

}

//проверка $_GET
function check_correct_lider($user_id, $id_lid){
    $sql = "SELECT id_lid FROM liders WHERE id_lid='{$id_lid}'";
    $lider = getData(dbQuery($sql));
    if (empty($lider[0])){
        return false;
    }
    $sql = "SELECT id_lid FROM liders WHERE user_id='{$user_id}' AND id_lid='{$id_lid}'";
    $lider = getData(dbQuery($sql));
    if (!empty($lider[0])){
        return true;
    }else{
        return false;
    }
}

//проверка $_GET
function check_correct_project($user_id, $id_proj){
    $sql = "SELECT id_lid FROM liders WHERE user_id='{$user_id}'";
    $lider = getData(dbQuery($sql));

    $sql = "SELECT id_proj FROM lider_project WHERE id_proj='{$id_proj}'";
    $project = getData(dbQuery($sql));
    if (empty($project[0])){
        return false;
    }
    $sql = "SELECT id_proj FROM lider_project WHERE id_lid='{$lider[0]["id_lid"]}' AND id_proj='{$id_proj}'";
    $project = getData(dbQuery($sql));
    if (!empty($project[0])){
        return true;
    }else{
        return false;
    }
}

