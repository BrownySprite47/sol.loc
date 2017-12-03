<?php
// добавление нового пользователя
function addNewUser($data){
    $login = $data['login'];
    $password = $data['password'];
    $email = $data['email'];

    $sql = "INSERT INTO `users`(`login`, `password`, `email`) VALUES ('{$login}', '{$password}', '{$email}')";
    return dbQuery($sql);
}
// получение данных о выбранном пользователе
function getUser($data){
    $sql = "SELECT * FROM users WHERE id = '{$data}'";
    return dbQuery($sql);
}

// получение данных о выбранном пользователе
function getUserLogin($data){
    $email = $data['email'];
    $password = $data['password'];

    $sql = "SELECT id, role, login, password, email FROM `users` WHERE email = '{$email}' AND password = '{$password}'";
    return dbQuery($sql);
}

//получаем данные
function getUserData($id){
    $sql = "SELECT id_lid, user_id, fio, familya, name, otchestvo, male_female, i_can, i_need, telephone, email, city, region, social, contact_info, birthday, checked, image_name FROM liders WHERE user_id = '{$id}'";
    return dbQuery($sql);
}

function getDataTableUser($id){
    return getData(dbQuery("SELECT * FROM users WHERE id = '".$id."'"));
}
