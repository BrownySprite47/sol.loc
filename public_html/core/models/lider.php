<?php
// добавление нового лидера
function addNewLider($data) {
    $email = $data['email'];

    $sql = "SELECT id FROM users WHERE email = '{$email}'";
    $res = getData(dbQuery($sql));
    $sql = "INSERT INTO `liders`(`user_id`, `checked`) VALUES ('{$res[0]['id']}', '0')";
    return dbQuery($sql);
}
// получение полной информации по выбранному лидеру из таблицы лидеров
function getOneLider($id_lid, $search_id) {
    $id_lid = checkChars($id_lid);
    $search_id = checkChars($search_id);

    $liders = clean(getData(dbQuery("SELECT id_lid, fio, familya, name, male_female, telephone, email, i_can, i_need, otchestvo, city, region, social, contact_info, birthday, checked, image_name FROM liders WHERE {$search_id} = '{$id_lid}'")));
    return $liders;
}
// получение всех проектов у выбранного лидера
function getProjectsFromLider($id_lid, $search_id) {
    $id_lid = checkChars($id_lid);
    $search_id = checkChars($search_id);
    $project = clean(getData(dbQuery("SELECT id_proj FROM lider_project WHERE {$search_id} = '{$id_lid}'  AND checked != '2'")));
    //view($project );
    $result=[];
    foreach ($project as $key => $value) {
        $projects = clean(getData(dbQuery("SELECT id_proj, project_title, project_description FROM projects WHERE id_proj = '{$value['id_proj']}'")));
        $result[$key]['project_title'] = $projects[0]['project_title'];
        $result[$key]['id_proj'] = $value['id_proj'];
        $result[$key]['project_description'] = $projects[0]['project_description'];
    }
    return $result;
}
 
// получение рекомендованных лидеров
function getRecommendLider() {
    $user = getData(dbQuery("SELECT id_lid FROM liders WHERE user_id = '".$_SESSION['id']."'"));
    $lider = getData(dbQuery("SELECT * FROM recommend_liders WHERE user_id = '".$user[0]['id_lid']."'"));
    $result = array_pop($lider);
    foreach ($lider as $key => $value) {
        $res = getData(dbQuery("SELECT fio, telephone, email, image_name FROM liders WHERE id_lid = '".$lider[$key]['id_lid']."'"));
        $lider[$key]['fio'] = $res[0]['fio'];
        $lider[$key]['image_name'] = $res[0]['image_name'];
        $lider[$key]['telephone'] = $res[0]['telephone'];
        $lider[$key]['email'] = $res[0]['email'];
        $lider[$key]['reason'] = $lider[$key]['reason'];
    }
    //view($lider);
    return $lider;
}
 