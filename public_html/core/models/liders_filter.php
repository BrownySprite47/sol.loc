<?php

//функция для получения данных по лидерам из БД с заданными условиями по фильтру и лимитом по количеству лидеров на странице
function getLiders($where, $limit) {
    if ($where == '') {
        $where = ' WHERE checked = "1" AND recommend != "admin" ';
    }

    $liders = clean(getData(dbQuery('SELECT id_lid, fio, region, social, i_can, i_need, image_name FROM liders'.$where.' ORDER BY `id_lid` ASC'.$limit)));

    foreach ($liders as $key => $value) {
        $lider_project = clean(getData(dbQuery('SELECT id_proj FROM lider_project WHERE id_lid='.$value['id_lid'])));
//view($lider_project);
        foreach ($lider_project as $key1 => $value1) {
            $projects = clean(getData(dbQuery('SELECT id_proj, project_title FROM projects WHERE checked="1" AND id_proj='.$value1['id_proj'])));
            $liders[$key]['projects'][] = $projects[0];
        }
    }
    //view($liders);
    return $liders;
}
