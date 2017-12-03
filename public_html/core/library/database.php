<?php

function dbConnect() {
    $db = require SITE_DIR . '/core/configs/database.php';
    $link = @mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);

    if (!$link) {
        if (DEBUG) {
            die(mysqli_error($link));
        } else {
            die(renderView('error'));
        }
    }

    return $link;
}

function dbQuery($sql) {
    $link = dbConnect();
    $result = mysqli_query($link, $sql);

    if (!$result){
        if (DEBUG) {
            die(mysqli_error($link));
        } else {
            die(renderView('error'));
        }
    }
   return $result;
}

function getData($data){
    while($result[] = mysqli_fetch_assoc($data));

    return $result;
}

function dbSaveData($str) {
    $link = dbConnect();
    return mysqli_real_escape_string($link, $str);
}

function db_count($table, $where = '') {

    if ($where == '') {
        $where = " WHERE checked = '1'";
    }else{
        $where = $where." AND checked = '1'";
    }
    $result = dbQuery('SELECT COUNT(1) FROM '.$table.$where);

    $count = mysqli_fetch_array($result);

    return $count[0];
}
