<?php
session_start();

require_once "libs/configs/config.php";
require_once CONFIGS_PATH . "config_backend.php";
require_once LIBS_PATH . "DB/cMyDB.php";
require_once LIBS_PATH . "functions/functions_global.php";
require_once LIBS_PATH . "functions/functions_backend.php";
require_once LIBS_PATH . "cMySmarty.php";
require_once LIBS_PATH . "cBackendUser.php";
require_once LIBS_PATH . "cConstants.php";

cMyDB::vSetDBConnect("db", DB_HOST, DB_USER, DB_PASSWORD);

$oBackendUser = new cBackendUser();

$sModuleName = "login";

if($oBackendUser->bIsAuth())
{
  $aMenu = array();

  $aMenu["leaders"] = array("menu_name" => "Лидеры ЛИСС", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=list", "access_type_internal_name" => "leaders");
  $aMenu["projects"] = array("menu_name" => "Проекты ЛИСС", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=projects&action_name=list", "access_type_internal_name" => "projects");

  $aMenu["stat"] = array("menu_name" => "Статистика", "items" => array());
  $aMenu["stat"]["items"]["stat_04"] = array("menu_name" => "По датам создания", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_04", "access_type_internal_name" => "stat_04");
  $aMenu["stat"]["items"]["stat_05"] = array("menu_name" => "По интервьюерам", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_05", "access_type_internal_name" => "stat_05");
  $aMenu["stat"]["items"]["stat_06"] = array("menu_name" => "По городам", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_06", "access_type_internal_name" => "stat_06");
  $aMenu["stat"]["items"]["stat_07"] = array("menu_name" => "По сферам деятельности", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_07", "access_type_internal_name" => "stat_07");
  $aMenu["stat"]["items"]["stat_01"] = array("menu_name" => "Выгрузка лидеров и проектов ЛИСС", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_01", "access_type_internal_name" => "stat_01");
  $aMenu["stat"]["items"]["stat_02"] = array("menu_name" => "Выгрузка лидеров ЛИСС (история)", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_02", "access_type_internal_name" => "stat_02");
  $aMenu["stat"]["items"]["stat_03"] = array("menu_name" => "Выгрузка проектов ЛИСС (история)", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=stat_03", "access_type_internal_name" => "stat_03");

  $aMenu["libs"] = array("menu_name" => "Справочники", "items" => array());
  $aMenu["libs"]["items"]["option_values"] = array("menu_name" => "Справочники", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=option_values&action_name=list", "access_type_internal_name" => "option_values");
  $aMenu["libs"]["items"]["regions"] = array("menu_name" => "Регионы", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=regions&action_name=list", "access_type_internal_name" => "regions");
  $aMenu["libs"]["items"]["cities"] = array("menu_name" => "Города", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=cities&action_name=list", "access_type_internal_name" => "cities");

  $aMenu["constants"] = array("menu_name" => "Настройки", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=constants&action_name=list", "access_type_internal_name" => "constants");

  $aMenu["backend_users"] = array("menu_name" => "Пользователи", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=backend_users&action_name=list", "access_type_internal_name" => "backend_users");

  $aBackendUserInfo = $oBackendUser->aGetBackendUserInfo();

  foreach($aMenu as $sMenuName => $aMenuTemp)
  {
    if(isset($aMenuTemp["items"]))
    {
      foreach($aMenuTemp["items"] as $sSubMenuName => $aSubMenuTemp)
      {
      	if(empty($aBackendUserInfo["backend_module_names"]) or !in_array($aSubMenuTemp["access_type_internal_name"], $aBackendUserInfo["backend_module_names"]))
        {
      	  unset($aMenu[$sMenuName]["items"][$sSubMenuName]);
        }
      }

      if(empty($aMenu[$sMenuName]["items"]))
      {
      	unset($aMenu[$sMenuName]);
      }
    }
    else
    {
      if(empty($aBackendUserInfo["backend_module_names"]) or !in_array($aMenuTemp["access_type_internal_name"], $aBackendUserInfo["backend_module_names"]))
      {
      	unset($aMenu[$sMenuName]);
      }
    }
  }

  $aMenu["logout"] = array("menu_name" => "Выход", "menu_url" => PROJECT_BACKEND_URL . "index.php?module_name=logout", "access_type_internal_name" => "logout");

  if(isset($_GET["module_name"]))
  {
  	if(get_magic_quotes_gpc())
    {
      $_GET["module_name"] = stripslashes($_GET["module_name"]);
    }
    $_GET["module_name"] = trim($_GET["module_name"]);

    if(!empty($_GET["module_name"]) and in_array($_GET["module_name"], $aBackendUserInfo["backend_module_names"]))
    {
      $sModuleName = $_GET["module_name"];
    }
  }

  if($sModuleName === "login")
  {  	$sModuleName = "index";  }
}

switch($sModuleName)
{
  case "logout":
  {
    $oBackendUser->vLogOut();
    header("Location: " . PROJECT_BACKEND_URL);

    break;
  }

  case "index":
  case "backend_users":
  case "projects":
  case "leaders":
  case "cities":
  case "regions":
  case "stat_01":
  case "stat_02":
  case "stat_03":
  case "stat_04":
  case "stat_05":
  case "stat_06":
  case "stat_07":
  case "search":
  case "constants":
  case "option_values":
  {
    require_once MODULES_PATH . $sModuleName . ".php";
    break;
  }

  default:
  {
    require_once MODULES_PATH . "login.php";
    break;
  }
}
?>