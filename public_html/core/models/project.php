<?php

//функция для получения всех данных по выбранному проекту из таблицы проектов
function getProject($id_proj){
    $id_proj = checkChars($id_proj);

    $projects = clean(getData(dbQuery('SELECT id_proj, stage_of_project, project_title, short_title, project_description, site, author, author_location, start_year, checked, image_name FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $method = clean(getData(dbQuery('SELECT only_online, general_online, general_offline, totally_offline FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $level = clean(getData(dbQuery('SELECT first_level, second_level, third_level FROM projects WHERE id_proj = "'.$id_proj.'"')));
    $geography = clean(getData(dbQuery('SELECT offline_geography FROM projects WHERE id_proj = "'.$id_proj.'"')));
    //чистим данные и удаляем связку ключ-значение из массива, если в значении присутствует '', '0', 0
    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = clean($predmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['metapredmets'] = clean($metapredmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['ages'] = clean($ages[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['method'] = clean($method[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['level'] = clean($level[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['geography'] = $geography[$key];

//        $projects[$key]['predmets_all'] = $predmets[$key];
//        $projects[$key]['metapredmets_all'] = $metapredmets[$key];
//        $projects[$key]['ages_all'] = $ages[$key];
//        $projects[$key]['method_all'] = $method[$key];
//        $projects[$key]['level_all'] = $level[$key];
        // $projects[$key]['geography_all'] = $geography[$key];
    }
    return $projects;
}

//функция для получения ФИО и роли лидеров по выбранному проекту
function getOneProjectLiders($id_proj){
    // if ($_SESSION['role'] == 'admin') {
    $id_proj = checkChars($id_proj);

    $sql = 'SELECT id_lid, role FROM lider_project WHERE id_proj = "'.$id_proj.'" AND checked != "2"';
    $lider = clean(getData(dbQuery($sql)));
        //view($lider);
    // }else{
    //     $lider = clean(getData(dbQuery('SELECT id_lid, role FROM lider_project WHERE id_proj = "'.$id_proj.'" AND checked = "1"')));
    // }

    if (!empty($lider)){
        foreach ($lider as $key => $value){
            $liders = clean(getData(dbQuery('SELECT fio FROM liders WHERE id_lid = "'.$value['id_lid'].'" AND fio != "0"')));
            $result[$key]['id_lid'] = $liders[0]['fio'];
            $result[$key]['fio'] = $liders[0]['fio'];
            $result[$key]['role'] = $value['role'];
            $result[$key]['id'] = $value['id_lid'];
        }
        return $result;
    }
}

//функция для получения ФИО и роли лидеров по выбранному проекту
function getOneProjectLidersFiles($id_proj){
    $id_proj = checkChars($id_proj);

    $sql = 'SELECT filename, description FROM projects_uploads WHERE id_proj = "'.$id_proj.'"';
    $lider = clean(getData(dbQuery($sql)));
    return $lider;
}

function getOneProjectLidersFiles_toLid($id_lid){
    $id_lid = checkChars($id_lid);

    $sql = 'SELECT filename, description FROM liders_uploads WHERE id_lid = "'.$id_lid.'"';
    $lider = clean(getData(dbQuery($sql)));
    return $lider;
}

function getOneProjectLidersFiles_toUser($user_id){
    $user_id = checkChars($user_id);

    $sql = 'SELECT id_lid FROM liders WHERE user_id = "'.$user_id.'"';
    //echo "$sql";
    $id = clean(getData(dbQuery($sql)));

    $sql = 'SELECT filename, description FROM liders_uploads WHERE id_lid = "'.$id[0]['id_lid'].'"';
    //echo "$sql";
    $lider = clean(getData(dbQuery($sql)));
    return $lider;
}

// function getProjectsFromLider($id) {
//     $lider = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE user_id = "'.$id.'"')));
//     if ($_SESSION['role'] == 'admin') {
//         $project = clean(getData(dbQuery('SELECT id_proj FROM lider_project WHERE id_lid = "'.$lider[0]['id_lid'].'" AND checked != "2"')));
//     }else{
//         $project = clean(getData(dbQuery('SELECT id_proj FROM lider_project WHERE id_lid = "'.$lider[0]['id_lid'].'" AND checked != "2"')));
//     }


//     $result=[];
//     foreach ($project as $key => $value) {
//         $projects = clean(getData(dbQuery('SELECT id_proj, project_title, project_description, checked FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));
//         $result[$key]['project_title'] = $projects[0]['project_title'];
//         $result[$key]['id_proj'] = $value['id_proj'];
//         $result[$key]['project_description'] = $projects[0]['project_description'];
//         $result[$key]['checked'] = $projects[0]['checked'];
//     }
//     return $result;
// }

function getProjectsFromUser($user_id) {
    $user_id = checkChars($user_id);
    

    $lider = clean(getData(dbQuery('SELECT id_lid FROM liders WHERE user_id = "'.$user_id.'"')));
    $projects = clean(getData(dbQuery('SELECT id_proj FROM lider_project WHERE id_lid = "'.$lider[0]['id_lid'].'"')));
    $result=[];
    foreach ($projects as $key => $value) {
        $projects = clean(getData(dbQuery('SELECT id_proj, project_title, project_description, checked FROM projects WHERE id_proj = "'.$value['id_proj'].'"')));
        $result[$key]['project_title'] = $projects[0]['project_title'];
        $result[$key]['id_proj'] = $value['id_proj'];
        $result[$key]['project_description'] = $projects[0]['project_description'];
        $result[$key]['checked'] = $projects[0]['checked'];
    }
    return $result;
}

