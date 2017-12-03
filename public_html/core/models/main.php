<?php

function clean($array, $el1 = NULL, $el2 = NULL, $el3 = NULL, $el4 = NULL, $el5 = NULL) {
    foreach ($array as $key => $value) {
        if ($value === $el1 || $value === $el2 || $value === $el3 || $value === $el4 || $value === $el5) {
            unset($array[$key]);
        }
    }

    return $array;
}

function getFilters() {
    if (isset($_POST['city']) && $_POST['city'] != 'all') {
        $where = 'WHERE author_location = "'.$_POST['city'].'" AND checked = "1"';
    }else{
        $where = 'WHERE checked = "1"';
    }
    $filters['titles'] = clean(getData(dbQuery('SELECT DISTINCT project_title FROM projects '.$where.' ORDER BY project_title')));
    $filters['cities'] = clean(getData(dbQuery('SELECT DISTINCT author_location FROM projects WHERE checked = "1" ORDER BY author_location')));
    $filters['fio'] = clean(getData(dbQuery('SELECT fio FROM liders WHERE checked = "1" ORDER BY fio')));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects '.$where)));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects '.$where)));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq, proforient, it_prof, personal FROM projects '.$where)));
    foreach ($ages as $key => $value) {
        $filters['ages'][$key] = clean($ages[$key], '', '0', 0, NULL, 'NULL');
    }
    foreach ($predmets as $key => $value) {
        $filters['predmets'][$key] = clean($predmets[$key], '', '0', 0, NULL, 'NULL');
    }
    foreach ($metapredmets as $key => $value) {
        $filters['metapredmets'][$key] = clean($metapredmets[$key], '', '0', 0, NULL, 'NULL');
    }
    return $filters;
}

function getLidersFio() {
    $filters['fio'] = clean(getData(dbQuery('SELECT fio FROM liders WHERE checked != "2" AND fio !="0" ORDER BY fio')));
    return $filters;
}
//функция для перевода названия колонок в таблице(так как в БД локализации нет)
function getLocalizations() {

    $localizations['ages'] = array(
        'r_00_07' => 'Дети 0-7',
        'r_12_15' => 'Средние классы 12-15',
        'r_16_18' => 'Старшие классы 16-18',
        'r_19_25' => 'Студенчество 19-25',
        'r_08_11' => 'Начальные классы 8-11',
        'r_all_life' => 'Образование через всю жизнь 26+',
        'r_others' => 'Прочее',
        'r_parents' => 'Родители',
        'r_teachers' => 'Педагоги',
    );

    $localizations['metapredmets'] = array(
        'business' => 'Предпринимательство и бизнес-навыки',
        'engineer' => 'Инженерное мышление',
        'eq' => 'EQ+',
        'it_prof' => 'Современные ИТ-профессии',
        'personal' => 'Личностное развитие, когнитивные навыки',
        'proforient' => 'Профориентация, самоопределение',

    );

    $localizations['predmets'] = array(
        'arts' => 'Arts',
        'lingvistic' => 'Лингвистика',
        'pedagogy' => 'Педагогика2.0 и родительство',
        'sport' => 'Спорт и здоровье',
        'social' => 'Обществ.-научн. блок',
        'techno' => 'Технология',
        'naturall' => 'Естеств.-научн. блок и математика',
    );

    $localizations['methods'] = array(
        'only_online' => 'только онлайн',
        'general_online' => 'в основном онлайн',
        'general_offline' => 'в основном оффлайн',
        'totally_offline' => 'только оффлайн',
    );

    $localizations['levels'] = array(
        'first_level' => '1 уровень',
        'second_level' => '2 уровень',
        'third_level' => '3 уровень',
    );

    $localizations['geographys'] = array(
        'international' => 'Международный',
        'interregional' => 'Межрегиональный',
        'local' => 'Локальный',
    );

    $localizations['stage_of_project'] = array(
        'Стартап' => 'Стартап',
        'Развитие' => 'Развитие',
        'Прототип' => 'Прототип',
        'Закрыт' => 'Закрыт',
        'Идея' => 'Идея',
    );

    return $localizations;
}

// локализация фильтров для корректного визуального отображения
function getDynamicFilter ($filters, $localizations) {
    if (isset($filters['ages'])) {
        foreach ($filters['ages'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $ages[$key1] = $value1;
            }
        }
    }

    if (isset($ages)) {
        foreach ($ages as $key => $value) {
            $result['ages'][$key] = $localizations['ages'][$key];
        }
        ksort($result['ages']);
    }
    if (isset($filters['predmets'])) {
        foreach ($filters['predmets'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $predmets[$key1] = $value1;
            }
        }
    }

    if (isset($predmets)) {
        foreach ($predmets as $key => $value) {
            $result['predmets'][$key] = $localizations['predmets'][$key];
        }
        asort($result['predmets']);
    }
    if (isset($filters['metapredmets'])) {
        foreach ($filters['metapredmets'] as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $metapredmets[$key1] = $value1;
            }
        }
    }

    if (isset($metapredmets)) {
        foreach ($metapredmets as $key => $value) {
            $result['metapredmets'][$key] = $localizations['metapredmets'][$key];
        }
        asort($result['metapredmets']);
    }

    return $result;
}

//функция для получения корректного WHERE для SQL-запроса, когда выбрано  1 или несколько фильтров
function getWhereForFilter($post = NULL) {
    $where = '';
    if (!is_null($post)) {
        $where .= ($post['title'] == 'all'       ? '' : ($where == '' ? ' WHERE ' : ' AND ').'project_title = "'.$post['title'].'" AND checked = "1" ');
        $where .= ($post['city'] == 'all'        ? '' : ($where == '' ? ' WHERE ' : ' AND ').'author_location = "'.$post['city'].'" AND checked = "1" ');
        $where .= ($post['predmet'] == 'all'     ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['predmet'].' = 1 AND checked = "1" ');
        $where .= ($post['metapredmet'] == 'all' ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['metapredmet'].' = 1 AND checked = "1" ');
        $where .= ($post['age'] == 'all'         ? '' : ($where == '' ? ' WHERE ' : ' AND ').$post['age'].' = "1" AND checked = "1" ');
    }
    return $where;
}
//функция для получения корректного LIMIT при SQL запросе
function getLimitForPageNavigation($start, $count) {
    return $limit = ' LIMIT '.$start.', '.$count;
}
//функция для получения данных по проектам из БД с заданными условиями по фильтру и лимитом по количеству проектов на странице
function getProjects($where, $limit) {
    if ($where == '') {
        $where = ' WHERE checked = "1" ';
    }
    $projects = clean(getData(dbQuery('SELECT id_proj, project_title, author_location, image_name FROM projects'.$where.' ORDER BY `id_proj` ASC'.$limit )));
    $predmets = clean(getData(dbQuery('SELECT naturall, techno, social, arts, lingvistic, sport, pedagogy FROM projects'.$where.$limit)));
    $metapredmets = clean(getData(dbQuery('SELECT business, engineer, eq , proforient, it_prof, personal FROM projects'.$where.$limit)));
    $ages = clean(getData(dbQuery('SELECT r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others FROM projects'.$where.$limit)));


    foreach ($projects as $key => $project) {
        $projects[$key]['predmets'] = clean($predmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['metapredmets'] = clean($metapredmets[$key], '', '0', 0, NULL, 'NULL');
        $projects[$key]['ages'] = clean($ages[$key], '', '0', 0, NULL, 'NULL');
    }

    return $projects;
}
// ищем в бд ID лидеров и проектов и добавляем в таблицу проект-лидер их id и роль в проекте
function pushToDB($liderNum, $project_title, $status){
    if (!empty($liderNum)) {
        $pushToDBLidID = dbQuery("SELECT id_lid FROM liders WHERE fio = '".$liderNum['fio']."'");
        while($lider[] = mysqli_fetch_assoc($pushToDBLidID));

        $pushToDBProjID = dbQuery ("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'");
        while($project[] = mysqli_fetch_assoc($pushToDBProjID));

        $pushToDB = dbQuery ("INSERT INTO lider_project (id_lid, id_proj, role, checked) VALUES ('".$lider[0]['id_lid']."', '".$project[0]['id_proj']."', '".$liderNum['role']."', '".$status."')");
    }
}

function pushToDBUser($user_id, $project_title, $status){
    $pushToDBLidID = dbQuery ("SELECT id_lid FROM liders WHERE user_id = '".$user_id."'");
    while($lider[] = mysqli_fetch_assoc($pushToDBLidID));


    $pushToDBProjID = dbQuery ("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'");
    while($project[] = mysqli_fetch_assoc($pushToDBProjID));

    $queryToDB = "INSERT INTO lider_project (id_lid, id_proj, role, checked) VALUES ('".$lider[0]['id_lid']."', '".$project[0]['id_proj']."', '', '".$status."')";
    $pushToDB = dbQuery($queryToDB);
}

//превращаем все введенное пользователями в строку, защита от скриптов
function checkChars($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}

