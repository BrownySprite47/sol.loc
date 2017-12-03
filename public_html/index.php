<?php
session_start();

require_once 'core/configs/main.php';
require_once SITE_DIR . '/core/library/main.php';
require_once SITE_DIR . '/core/library/database.php';
require_once SITE_DIR . '/core/library/validation.php';
require_once SITE_DIR . '/vendor/autoload.php';
require_once SITE_DIR . '/core/controllers/mailchimper.php';


// // добавление в лист нового адреса
// $data = array(
// 	'list_id' => '83320450bb', // номер листа вытащить в настройки или в БД
// 	'email'   => 'ffatte@mail.ru',
// 	'status'  => 'subscribed',
// );
// $result = mailchimp('add_to_list', $data);

// // удаление адреса из листа
// $result = mailchimp('del_from_list', array('list_id' => '83320450bb', 'email' => 'ffatte@mail.ru'));

// view($result);die();




$segments = getUrnSegments();

$controller = (empty($segments[0])) ? 'main' : $segments[0];
$action = (empty($segments[1])) ? 'action_index' : 'action_' . $segments[1];

if (file_exists(SITE_DIR . '/core/controllers/' . $controller . '.php')) {
    require_once SITE_DIR . '/core/controllers/' . $controller . '.php';

    if (function_exists($action)) {
        $action();
    } else {
        show404page();
    }
} else {
    show404page();
}
