<?php

//функция для получения данных по проектам из БД с заданными условиями по фильтру и лимитом по количеству проектов на странице
function getProjectsAdmin($status) {
    $status = checkChars($status);
    $projects = clean(getData(dbQuery('SELECT id_proj, user_id, project_title, project_description, author_location FROM projects WHERE checked = "'.$status.'"')));

    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects WHERE checked = "'.$status.'"')));

    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq , proforient, it_prof, personal FROM projects WHERE checked = "'.$status.'"')));

    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects WHERE checked = "'.$status.'"')));

    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = clean($predmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['metapredmets'] = clean($metapredmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['ages'] = clean($ages[$key], '', '0', 0, NULL, 'NULL');
        if ($project['user_id'] != '0') {
            $res = getData(dbQuery("SELECT id_lid, user_id FROM liders WHERE user_id = '{$project['user_id']}'"));
            $projects[$key]['id_lid'] = $res[0]['id_lid'];
            $projects[$key]['user_id'] = $res[0]['user_id'];
            $res = getData(dbQuery("SELECT fio FROM liders WHERE id_lid = '".$res[0]['id_lid']."'"));
            $projects[$key]['fio'] = $res[0]['fio'];
        }

    }
    //$projects['viewed'] = clean(getData(dbQuery('SELECT id_proj FROM projects WHERE viewed = "0"')));
    return $projects;
}


//функция для получения данных по лидерам из БД с заданными условиями по фильтру и лимитом по количеству лидеров на странице
function getLidersAdmin($status) {
    $status = checkChars($status);

    $liders = clean(getData(dbQuery('SELECT user_id, id_lid, fio, region, image_name FROM liders WHERE checked = "'.$status.'" AND fio != "0"')));
    
    foreach ($liders as $key => $value) {
        $lider_project = clean(getData(dbQuery('SELECT id_proj FROM lider_project WHERE id_lid='.$value['id_lid'])));

        foreach ($lider_project as $key1 => $value1) {
            $projects = clean(getData(dbQuery('SELECT id_proj, project_title FROM projects WHERE id_proj='.$value1['id_proj'])));
            $liders[$key]['projects'][] = $projects[0];
            // $liders[$key]['projects']['id_proj'] = $projects[0]['id_proj'];
        }
    }
    //$liders['viewed'] = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE viewed = "0"')));
    return $liders;
}

function recommendLider(){
    // $liders = getData(dbQuery("SELECT id_lid, fio, recommend, image_name FROM liders WHERE checked = '4'"));
    $liders = getData(dbQuery("SELECT * FROM recommend_liders WHERE checked = '0'"));

    $res = array_pop($liders);
    foreach ($liders as $key => $value) {
        $res = getData(dbQuery("SELECT id_lid, fio FROM liders WHERE id_lid = '{$value['user_id']}'"));
        $liders[$key]['user_id'] = $res[0]['id_lid'];
        $liders[$key]['fio_user'] = $res[0]['fio'];
        $res = getData(dbQuery("SELECT id_lid, fio, image_name FROM liders WHERE id_lid = '{$value['id_lid']}'"));
        $liders[$key]['id_lid'] = $res[0]['id_lid'];
        $liders[$key]['fio_lid'] = $res[0]['fio'];
        $liders[$key]['image_name'] = $res[0]['image_name'];
    }
  // view($liders);
    // foreach ($liders as $key => $value) {
    //     if ($value['user_id'] == 'admin') {
    //         $liders[$key]['fio_recom'] = 'admin';
    //     }else{
    //         $res = getData(dbQuery("SELECT fio, image_name FROM liders WHERE id_lid = '{$value['user_id']}'"));
    //         $liders[$key]['fio_recom'] = $res[0]['fio'];
    //         $liders[$key]['image_name'] = $res[0]['image_name'];
    //     }
    // }
//view($liders);
    //$liders['viewed'] = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE viewed = "0"')));
    return $liders;

}
//получаем данные
function getUserDataAdmin($id)
{
    $id = checkChars($id);
    
    $liders = dbQuery("SELECT id_lid, user_id, fio, familya, name, otchestvo, telephone, email, city, region, social, contact_info, birthday, checked, image_name FROM liders WHERE id_lid = '{$id}'");
    //echo "string";
    //$liders['viewed'] = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE viewed = "0"')));
    return $liders;
}

function getAddedLidersAdmin(){
    $sql = "SELECT id_lid, fio, image_name, user_id FROM liders WHERE user_id = 'admin' AND checked != '2'";
    $result = getData(dbQuery($sql));
    $liders = array_pop($result);
    //$result['viewed'] = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE user_id = "admin" AND checked = "1" AND viewed = "0"')));
    return $result;
}

function getAddedProjectsAdmin(){
    $sql = "SELECT id_proj, project_title, project_description FROM projects WHERE user_id = 'admin' AND checked != '2'";
    $result = getData(dbQuery($sql));
    $projects = array_pop($result);
    //$result['viewed'] = clean(getData(dbQuery('SELECT id_proj FROM projects WHERE user_id = "admin" AND checked = "1" AND viewed = "0"')));
    return $result;
}

function getDataAdminCheck(){
    $data['getProjectsAdmin_add'] = getProjectsAdmin('0');
    $data['getProjectsAdmin_del'] = getProjectsAdmin('2');
    $data['getProjectsAdmin_edit'] = getProjectsAdmin('3');

    $data['getLidersAdmin_add'] = getLidersAdmin('0');
    $data['getLidersAdmin_del'] = getLidersAdmin('2');
    $data['getLidersAdmin_edit'] = getLidersAdmin('3');

    $data['added_projects'] = getAddedProjectsAdmin();
    $data['added_liders'] = getAddedLidersAdmin();

    $data['getDataTableUser'] = getDataTableUser($_SESSION['id']);
    $data['recommendLider'] = recommendLider();
    return $data;
}
