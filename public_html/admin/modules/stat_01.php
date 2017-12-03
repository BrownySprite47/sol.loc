<?php

set_time_limit(0);
ini_set("memory_limit", "1024M");

$oDB = cMyDB::oGetDB("db");

$aBackendUsers = array();
$aRecommendations = array();
$aProjects = array();
$aLeaders = array();
$aOptionValues = array();
$aContentsOptionValues = array();

$sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_name
FROM
  " . DB_PREFIX . "backend_users AS bu
ORDER BY
  bu.backend_user_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aBackendUsers[$aRow["backend_user_id"]] = $aRow["backend_user_name"];
  }
  $oResult->close();
}

$sSql = "SELECT
  ov.option_value_id,
  ov.option_value,
  ov.option_id
FROM
  " . DB_PREFIX . "option_values AS ov
ORDER BY
  ov.option_id,
  ov.option_value_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aOptionValues[$aRow["option_id"]][$aRow["option_value_id"]] = $aRow["option_value"];
  }
  $oResult->close();
}

require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

$oExcel = new PHPExcel();
$oExcel->setActiveSheetIndex(0);
$oExcel->getActiveSheet()->setTitle("Лидеры ЛИСС");
$oPage = $oExcel->createSheet($oExcel->getSheetCount() + 1);
$oPage->setTitle("Проекты ЛИСС");
$oPage = $oExcel->createSheet($oExcel->getSheetCount() + 1);
$oPage->setTitle("Рекомендации");

$aFields = array();
$aFields["recommendation_id"] = "Id рекомендации";
$aFields["recommendation_create_datetime"] = "Дата и время создания рекомендации";
$aFields["leader_id_from"] = "Id (кто рекомендует)";
$aFields["leader_name_from"] = "ФИО рекомендателя";
$aFields["leader_id_to"] = "Id (кого рекомендуют)";
$aFields["leader_name_to"] = "ФИО рекомендуемого";
$aFields["leader_surname"] = "Фамилия";
$aFields["leader_name"] = "Имя";
$aFields["leader_patronymic"] = "Отчество";
$aFields["city_name"] = "Город";
$aFields["leader_city_name"] = "Город (другой)";
$aFields["leader_phone"] = "Телефон";
$aFields["leader_email"] = "E-mail";
$aFields["leader_project_name"] = "Проект";
$aFields["recommendation_reason"] = "Причина рекомендации";
$aFields["recommendation_comment"] = "Комментарии";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  r.recommendation_id,
  r.recommendation_create_datetime,
  r.leader_id_from,
  COALESCE(r.leader_id_to, '') AS leader_id_to,
  COALESCE(c.city_name, '') AS city_name,
  COALESCE(r.leader_city_name, '') AS leader_city_name,
  COALESCE(r.leader_surname, '') AS leader_surname,
  COALESCE(r.leader_name, '') AS leader_name,
  COALESCE(r.leader_patronymic, '') AS leader_patronymic,
  COALESCE(r.leader_phone, '') AS leader_phone,
  COALESCE(r.leader_email, '') AS leader_email,
  COALESCE(r.leader_project_name, '') AS leader_project_name,
  r.recommendation_reason,
  r.recommendation_comment,
  COALESCE(CONCAT(l_from.leader_surname, IF(l_from.leader_name = '', '', CONCAT(' ', l_from.leader_name, CONCAT(IF(l_from.leader_patronymic = '', '', CONCAT(' ', l_from.leader_patronymic)))))), '') AS leader_name_from,
  COALESCE(CONCAT(l_to.leader_surname, IF(l_to.leader_name = '', '', CONCAT(' ', l_to.leader_name, CONCAT(IF(l_to.leader_patronymic = '', '', CONCAT(' ', l_to.leader_patronymic)))))), '') AS leader_name_to,
  IF(l_to.leader_interview_date <= r.recommendation_create_datetime, 0, 1) AS recommendation_to_for_interview
FROM
  " . DB_PREFIX . "recommendations AS r
  LEFT JOIN " . DB_PREFIX . "cities AS c ON r.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l_from ON r.leader_id_from = l_from.leader_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l_to ON r.leader_id_to = l_to.leader_id
ORDER BY
  r.leader_id_from,
  r.leader_id_to,
  r.leader_surname,
  r.leader_name,
  r.leader_patronymic,
  r.recommendation_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if(mb_strlen($aRow["leader_phone"], "utf-8") === 10)
    {      $aRow["leader_phone"] = "+7" . $aRow["leader_phone"];    }

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      if($sKey === "leader_phone")
      {
      	$oPage->setCellValueExplicit(PHPExcel_Cell::stringFromColumnIndex($iColumn) . $iRow, $aRow[$sKey], PHPExcel_Cell_DataType::TYPE_STRING);
      }
      else
      {
      	$oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
      }

      $iColumn++;
    }

    if(!isset($aRecommendations[$aRow["leader_id_from"]]))
    {      $aRecommendations[$aRow["leader_id_from"]] = array("recommendations_from_count" => 0, "recommendations_to_count" => 0, "recommendations_to_count_for_interview" => 0, "leader_ids" => array(), "leader_names" => array(), "leader_ids_from" => array(), "leaders_names_from" => array());    }

    $aRecommendations[$aRow["leader_id_from"]]["recommendations_from_count"]++;
    $aRecommendations[$aRow["leader_id_from"]]["leader_ids"][] = $aRow["leader_id_to"];

    if($aRow["leader_id_to"] !== "")
    {      if(!isset($aRecommendations[$aRow["leader_id_to"]]))
      {      	$aRecommendations[$aRow["leader_id_to"]] = array("recommendations_from_count" => 0, "recommendations_to_count" => 0, "recommendations_to_count_for_interview" => 0, "leader_ids" => array(), "leader_names" => array(), "leader_ids_from" => array(), "leaders_names_from" => array());      }

      $aRecommendations[$aRow["leader_id_to"]]["recommendations_to_count"]++;
      $aRecommendations[$aRow["leader_id_to"]]["recommendations_to_count_for_interview"] += $aRow["recommendation_to_for_interview"];
      $aRecommendations[$aRow["leader_id_to"]]["leader_ids_from"][] = $aRow["leader_id_from"];
      $aRecommendations[$aRow["leader_id_to"]]["leader_names_from"][] = $aRow["leader_name_from"];
      $aRecommendations[$aRow["leader_id_from"]]["leader_names"][] = $aRow["leader_name_to"];    }
    else
    {      $sLeaderNameTo = $aRow["leader_surname"];

      if($aRow["leader_name"] !== "")
      {      	$sLeaderNameTo .= " " . $aRow["leader_name"];

      	if($aRow["leader_patronymic"] !== "")
        {
      	  $sLeaderNameTo .= " " . $aRow["leader_patronymic"];
        }      }

      $aRecommendations[$aRow["leader_id_from"]]["leader_names"][] = $sLeaderNameTo;    }
  }

  $oResult->close();
}

$oPage = $oExcel->createSheet($oExcel->getSheetCount() + 1);
$oPage->setTitle("Лидер-проект");

$aFields = array();
$aFields["leader_project_id"] = "Id";
$aFields["leader_id"] = "Id лидера ЛИСС";
$aFields["leader_full_name"] = "ФИО лидера";
$aFields["project_number"] = "Порядок проекта у лидера";
$aFields["project_id"] = "Id проекта ЛИСС";
$aFields["project_full_name"] = "Название проекта";
$aFields["leader_date_from"] = "Период участия (с)";
$aFields["leader_date_to"] = "Период участия (по)";
$aFields["project_name"] = "Проект";
$aFields["leader_role"] = "Роль лидера";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  lp.leader_project_id,
  l.leader_id,
  CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, CONCAT(IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic)))))) AS leader_full_name,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(lp.project_name, '') AS project_name,
  lp.leader_role,
  COALESCE(p.project_id, '') AS project_id,
  COALESCE(p.project_name, '') AS project_full_name
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  INNER JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
ORDER BY
  l.leader_id,
  lp.project_order,
  lp.project_name,
  p.project_name,
  p.project_create_datetime,
  p.project_id";
if($oResult = $oDB->query($sSql))
{
  $iLiderId = 0;

  while($aRow = $oResult->fetch_assoc())
  {
    if($iLiderId != $aRow["leader_id"])
    {      $iProjectNumber = 0;
      $iLiderId = $aRow["leader_id"];    }
    $iProjectNumber++;

    $aRow["project_number"] = $iProjectNumber;

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
      $iColumn++;
    }

    if(!isset($aProjects[$aRow["leader_id"]]))
    {      $aProjects[$aRow["leader_id"]] = array("project_ids" => array(), "project_names" => array(), "leader_roles" => array());    }

    $aProjects[$aRow["leader_id"]]["project_ids"][] = $iProjectNumber . ". " . $aRow["project_id"];
    $aProjects[$aRow["leader_id"]]["leader_roles"][] = $iProjectNumber . ". " . $aRow["leader_role"];

    if($aRow["project_id"] === "")
    {      $aProjects[$aRow["leader_id"]]["project_names"][] = $iProjectNumber . ". " . $aRow["project_name"];    }
    else
    {      $aProjects[$aRow["leader_id"]]["project_names"][] = $iProjectNumber . ". " . $aRow["project_full_name"];    }
  }

  $oResult->close();
}

$oPage = $oExcel->createSheet($oExcel->getSheetCount() + 1);
$oPage->setTitle("Проект-лидер");

$aFields = array();
$aFields["leader_project_id"] = "Id";
$aFields["project_id"] = "Id проекта ЛИСС";
$aFields["project_full_name"] = "Название проекта";
$aFields["leader_number"] = "Порядок лидера у проекта";
$aFields["leader_id"] = "Id лидера ЛИСС";
$aFields["leader_full_name"] = "ФИО лидера";
$aFields["leader_surname"] = "Фамилия";
$aFields["leader_name"] = "Имя";
$aFields["leader_patronymic"] = "Отчество";
$aFields["leader_date_from"] = "Период участия (с)";
$aFields["leader_date_to"] = "Период участия (по)";
$aFields["leader_role"] = "Роль лидера";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  lp.leader_project_id,
  p.project_id,
  p.project_name AS project_full_name,
  COALESCE(CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, CONCAT(IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic)))))), '') AS leader_full_name,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(lp.leader_surname, '') AS leader_surname,
  COALESCE(lp.leader_patronymic, '') AS leader_patronymic,
  COALESCE(lp.leader_name, '') AS leader_name,
  lp.leader_role,
  COALESCE(l.leader_id, '') AS leader_id
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  INNER JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
ORDER BY
  p.project_id,
  lp.leader_order,
  lp.leader_surname,
  lp.leader_name,
  lp.leader_patronymic,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_create_datetime,
  l.leader_id";
if($oResult = $oDB->query($sSql))
{
  $iProjectId = 0;

  while($aRow = $oResult->fetch_assoc())
  {
    if($iProjectId != $aRow["project_id"])
    {
      $iLeaderNumber = 0;
      $iProjectId = $aRow["project_id"];
    }
    $iLeaderNumber++;

    $aRow["leader_number"] = $iLeaderNumber;

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
      $iColumn++;
    }

    if(!isset($aLeaders[$aRow["project_id"]]))
    {
      $aLeaders[$aRow["project_id"]] = array("leader_ids" => array(), "leader_names" => array(), "leader_roles" => array());
    }

    $aLeaders[$aRow["project_id"]]["leader_ids"][] = $iLeaderNumber . ". " . $aRow["leader_id"];
    $aLeaders[$aRow["project_id"]]["leader_roles"][] = $iLeaderNumber . ". " . $aRow["leader_role"];

    if($aRow["leader_id"] === "")
    {
      $sLeaderName = $aRow["leader_surname"];

      if($aRow["leader_name"] !== "")
      {
      	$sLeaderName .= " " . $aRow["leader_name"];

      	if($aRow["leader_patronymic"] !== "")
        {
      	  $sLeaderName .= " " . $aRow["leader_patronymic"];
        }
      }

      $aLeaders[$aRow["project_id"]]["leader_names"][] = $iLeaderNumber . ". " . $sLeaderName;
    }
    else
    {
      $aLeaders[$aRow["project_id"]]["leader_names"][] = $iLeaderNumber . ". " . $aRow["leader_full_name"];
    }
  }

  $oResult->close();
}

$aFilials = array();

$oPage = $oExcel->createSheet($oExcel->getSheetCount() + 1);
$oPage->setTitle("Филиалы");

$aFields = array();
$aFields["filial_id"] = "Id филиала";
$aFields["project_id"] = "Id проекта ЛИСС";
$aFields["project_name"] = "Проект ЛИСС";
$aFields["city_name"] = "Город";
$aFields["filial_city_name"] = "Город (другой)";
$aFields["filial_address"] = "Адрес";
$aFields["filial_comment"] = "Комментарий";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  f.filial_id,
  p.project_id,
  p.project_name,
  COALESCE(c.city_name, '') AS city_name,
  f.filial_city_name,
  f.filial_address,
  f.filial_comment
FROM
  " . DB_PREFIX . "filials AS f
  INNER JOIN " . DB_PREFIX . "projects AS p ON f.project_id = p.project_id
  LEFT JOIN " . DB_PREFIX . "cities AS c ON f.city_id = c.city_id
ORDER BY
  p.project_id,
  f.filial_order,
  c.city_order,
  c.city_name,
  f.filial_city_name,
  f.filial_id";
if($oResult = $oDB->query($sSql))
{
  $iProjectId = 0;

  while($aRow = $oResult->fetch_assoc())
  {
    if($iProjectId != $aRow["project_id"])
    {
      $iFilialNumber = 0;
      $iProjectId = $aRow["project_id"];
    }
    $iFilialNumber++;

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
      $iColumn++;
    }

    if(!isset($aFilials[$aRow["project_id"]]))
    {
      $aFilials[$aRow["project_id"]] = array("filial_ids" => array(), "city_names" => array());
    }

    if($aRow["filial_city_name"] !== "")
    {
      if($aRow["city_name"] === "")
      {
      	$aRow["city_name"] = $aRow["filial_city_name"];
      }
      else
      {
      	$aRow["city_name"] .= " (" . $aRow["filial_city_name"] . ")";
      }
    }

    $aFilials[$aRow["project_id"]]["filial_ids"][] = $iFilialNumber . ". " . $aRow["filial_id"];
    $aFilials[$aRow["project_id"]]["city_names"][] = $iFilialNumber . ". " . $aRow["city_name"];
  }

  $oResult->close();
}

$oExcel->setActiveSheetIndex(0);
$oPage = $oExcel->getActiveSheet();

$aFields = array();
$aFields["leader_id"] = "Id";
$aFields["leader_create_date"] = "Дата появления в БД";
$aFields["leader_interview_date"] = "Дата интервью";
$aFields["leader_interview_backend_user_name"] = "Интервьюер";
$aFields["leader_write_backend_user_name"] = "Оператор";
$aFields["leader_option_01"] = "Способ проведения интервью";
$aFields["leader_contact_from"] = "Источник контакта";
$aFields["leader_interview_result"] = "Договоренности";
$aFields["leader_question_21"] = "Комментарии по интервью";
$aFields["leader_high_priority"] = "Высокий приоритет";
$aFields["leader_enabled"] = "Актуальность";
$aFields["leader_done"] = "Анкета заполнена";
$aFields["leader_surname"] = "Фамилия";
$aFields["leader_name"] = "Имя";
$aFields["leader_patronymic"] = "Отчество";
$aFields["sex_name"] = "Пол";
$aFields["city_name"] = "Город";
$aFields["leader_city_name"] = "Город (другой)";
$aFields["leader_birth_date"] = "Дата рождения";
$aFields["leader_birth_date_correct"] = "Дата рождения точная";
$aFields["leader_company"] = "Основное место работы";
$aFields["leader_position"] = "Должность";
$aFields["leader_phone"] = "Телефон";
$aFields["leader_email"] = "E-mail";
$aFields["leader_skype"] = "Skype";
$aFields["leader_social_network"] = "Социальные сети";
$aFields["leader_contacts"] = "Дополнительные контакты";
$aFields["leader_question_01"] = "Почему Вас рекомендовали, как ЛИСС?";
$aFields["leader_question_02"] = "Сколько лет реализуете проекты в социальной сфере?";
$aFields["leader_question_03"] = "Что привело в социальную сферу?";
$aFields["leader_question_04"] = "Зачем Вы занимаетесь проектом?";
$aFields["leader_question_05"] = "Какие успешные проекты Вы реализовали?";
$aFields["leader_question_06"] = "В каких экспертных группах Вы состоите?";
$aFields["leader_question_07"] = "Комментарий";
$aFields["leader_question_08"] = "Уровень мышления";
$aFields["leader_question_09"] = "Тип лидера (в классификации Ашока)";
$aFields["leader_option_04"] = "Категория лидера";
$aFields["leader_question_10"] = "Личность (вызовы)";
$aFields["leader_question_11"] = "Личность (препятствия)";
$aFields["leader_question_12"] = "Личность (потребности)";
$aFields["leader_question_13"] = "Проект (вызовы)";
$aFields["leader_question_14"] = "Проект (препятствия)";
$aFields["leader_question_15"] = "Проект (потребности)";
$aFields["leader_question_16"] = "Система (вызовы)";
$aFields["leader_question_17"] = "Система (препятствия)";
$aFields["leader_question_18"] = "Система (потребности)";
$aFields["leader_question_19"] = "Потребности в законодательстве";
$aFields["leader_question_20"] = "Отношение к социальной деятельности";
$aFields["leader_create_datetime"] = "Дата и время создания";
$aFields["transaction_create_datetime"] = "Дата и время последнего изменения";
$aFields["leader_create_backend_user_name"] = "Инициатор";
$aFields["transaction_create_backend_user_name"] = "Автор последних изменений данных";
$aFields["recommendations_to_count"] = "Рекомендации (<-)";
$aFields["recommendations_to_count_for_interview"] = "Рекомендации (<-, до интервью)";
$aFields["recommendations_from_count"] = "Рекомендации (->)";
$aFields["recommendation_leader_ids_from"] = "Рекомендатели (Id)";
$aFields["recommendation_leader_names_from"] = "Рекомендатели (ФИО)";
$aFields["recommendation_leader_ids"] = "Рекомендуемые (Id)";
$aFields["recommendation_leader_names"] = "Рекомендуемые (ФИО)";
$aFields["project_ids"] = "Проекты (Id)";
$aFields["project_names"] = "Проекты (наименования)";
$aFields["leader_roles"] = "Проекты (роли лидера)";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  l.leader_id,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  COALESCE(c.city_name, '') AS city_name,
  l.leader_city_name,
  COALESCE(s.sex_name, '') AS sex_name,
  COALESCE(l.leader_birth_date, '') AS leader_birth_date,
  l.leader_birth_date_correct,
  l.leader_company,
  l.leader_position,
  COALESCE(l.leader_phone, '') AS leader_phone,
  l.leader_email,
  l.leader_skype,
  l.leader_social_network,
  l.leader_contacts,
  l.leader_question_01,
  COALESCE(l.leader_question_02, '') AS leader_question_02,
  l.leader_question_03,
  l.leader_question_04,
  l.leader_question_05,
  l.leader_question_06,
  l.leader_question_07,
  COALESCE(ov_2.option_value, '') AS leader_question_08,
  COALESCE(ov_3.option_value, '') AS leader_question_09,
  COALESCE(GROUP_CONCAT(DISTINCT IF(cov.option_value_id IS NULL, NULL, ov_4.option_value) ORDER BY ov_4.option_order, ov_4.option_value SEPARATOR ', ') , '') AS leader_option_04,
  l.leader_question_10,
  l.leader_question_11,
  l.leader_question_12,
  l.leader_question_13,
  l.leader_question_14,
  l.leader_question_15,
  l.leader_question_16,
  l.leader_question_17,
  l.leader_question_18,
  l.leader_question_19,
  l.leader_question_20,
  l.leader_create_datetime,
  COALESCE(t.transaction_create_datetime, '') AS transaction_create_datetime,
  COALESCE(l.leader_create_backend_user_id, '') AS leader_create_backend_user_id,
  COALESCE(t.backend_user_id, '') AS transaction_create_backend_user_id,
  COALESCE(l.leader_interview_date, '') AS leader_interview_date,
  COALESCE(l.leader_create_date, '') AS leader_create_date,
  COALESCE(l.leader_interview_backend_user_id, '') AS leader_interview_backend_user_id,
  COALESCE(l.leader_write_backend_user_id, '') AS leader_write_backend_user_id,
  COALESCE(ov_1.option_value, '') AS leader_option_01,
  l.leader_contact_from,
  l.leader_interview_result,
  l.leader_question_21,
  l.leader_enabled,
  l.leader_done,
  l.leader_high_priority
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "cities AS c ON l.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "sex AS s ON l.sex_id = s.sex_id
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON l.transaction_id = t.transaction_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_1 ON
    l.leader_interview_type = ov_1.option_value_id AND
    ov_1.option_id = 1
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_2 ON
    l.leader_question_08 = ov_2.option_value_id AND
    ov_2.option_id = 2
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_3 ON
    l.leader_question_09 = ov_3.option_value_id AND
    ov_3.option_id = 3
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_4 ON ov_4.option_id = 4
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    l.leader_id = cov.content_id AND
    cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . " AND
    ov_4.option_value_id = cov.option_value_id
GROUP BY
  l.leader_id
ORDER BY
  l.leader_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if($aRow["leader_create_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["leader_create_backend_user_id"]]))
    {
      $aRow["leader_create_backend_user_name"] = $aBackendUsers[$aRow["leader_create_backend_user_id"]];
    }
    else
    {
      $aRow["leader_create_backend_user_name"] = "";
    }

    if($aRow["transaction_create_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["transaction_create_backend_user_id"]]))
    {
      $aRow["transaction_create_backend_user_name"] = $aBackendUsers[$aRow["transaction_create_backend_user_id"]];
    }
    else
    {
      $aRow["transaction_create_backend_user_name"] = "";
    }

    if($aRow["leader_interview_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["leader_interview_backend_user_id"]]))
    {
      $aRow["leader_interview_backend_user_name"] = $aBackendUsers[$aRow["leader_interview_backend_user_id"]];
    }
    else
    {
      $aRow["leader_interview_backend_user_name"] = "";
    }

    if($aRow["leader_write_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["leader_write_backend_user_id"]]))
    {
      $aRow["leader_write_backend_user_name"] = $aBackendUsers[$aRow["leader_write_backend_user_id"]];
    }
    else
    {
      $aRow["leader_write_backend_user_name"] = "";
    }

    if(mb_strlen($aRow["leader_phone"], "utf-8") === 10)
    {
      $aRow["leader_phone"] = "+7" . $aRow["leader_phone"];
    }

    if(isset($aRecommendations[$aRow["leader_id"]]))
    {      $aRow["recommendations_from_count"] = $aRecommendations[$aRow["leader_id"]]["recommendations_from_count"];
      $aRow["recommendations_to_count"] = $aRecommendations[$aRow["leader_id"]]["recommendations_to_count"];
      $aRow["recommendations_to_count_for_interview"] = $aRecommendations[$aRow["leader_id"]]["recommendations_to_count_for_interview"];
      $aRow["recommendation_leader_ids"] = "";
      $aRow["recommendation_leader_names"] = "";
      $aRow["recommendation_leader_ids_from"] = "";
      $aRow["recommendation_leader_names_from"] = "";

      if(!empty($aRecommendations[$aRow["leader_id"]]["leader_ids_from"]))
      {
      	foreach($aRecommendations[$aRow["leader_id"]]["leader_ids_from"] as $iKey => $sValue)
      	{
      	  $aRecommendations[$aRow["leader_id"]]["leader_ids_from"][$iKey] = ($iKey + 1) . ". " . $sValue;
      	  $aRecommendations[$aRow["leader_id"]]["leader_names_from"][$iKey] = ($iKey + 1) . ". " . $aRecommendations[$aRow["leader_id"]]["leader_names_from"][$iKey];
      	}

      	$aRow["recommendation_leader_ids_from"] = implode("
", $aRecommendations[$aRow["leader_id"]]["leader_ids_from"]);
       $aRow["recommendation_leader_names_from"] = implode("
", $aRecommendations[$aRow["leader_id"]]["leader_names_from"]);
      }

      if(!empty($aRecommendations[$aRow["leader_id"]]["leader_ids"]))
      {      	foreach($aRecommendations[$aRow["leader_id"]]["leader_ids"] as $iKey => $sValue)
      	{      	  $aRecommendations[$aRow["leader_id"]]["leader_ids"][$iKey] = ($iKey + 1) . ". " . $sValue;
      	  $aRecommendations[$aRow["leader_id"]]["leader_names"][$iKey] = ($iKey + 1) . ". " . $aRecommendations[$aRow["leader_id"]]["leader_names"][$iKey];      	}

      	$aRow["recommendation_leader_ids"] = implode("
", $aRecommendations[$aRow["leader_id"]]["leader_ids"]);
       $aRow["recommendation_leader_names"] = implode("
", $aRecommendations[$aRow["leader_id"]]["leader_names"]);      }    }
    else
    {      $aRow["recommendations_from_count"] = 0;
      $aRow["recommendations_to_count"] = 0;
      $aRow["recommendations_to_count_for_interview"] = 0;
      $aRow["recommendation_leader_ids"] = "";
      $aRow["recommendation_leader_names"] = "";
      $aRow["recommendation_leader_ids_from"] = "";
      $aRow["recommendation_leader_names_from"] = "";    }

    if(!empty($aProjects[$aRow["leader_id"]]["project_ids"]))
    {      $aRow["project_ids"] = implode("
", $aProjects[$aRow["leader_id"]]["project_ids"]);
      $aRow["project_names"] = implode("
", $aProjects[$aRow["leader_id"]]["project_names"]);
      $aRow["leader_roles"] = implode("
", $aProjects[$aRow["leader_id"]]["leader_roles"]);    }
    else
    {      $aRow["project_ids"] = "";
      $aRow["project_names"] = "";
      $aRow["leader_roles"] = "";    }

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      if($sKey === "leader_phone")
      {      	$oPage->setCellValueExplicit(PHPExcel_Cell::stringFromColumnIndex($iColumn) . $iRow, $aRow[$sKey], PHPExcel_Cell_DataType::TYPE_STRING);      }
      else
      {      	$oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);      }

      $iColumn++;
    }
  }

  $oResult->close();
}

unset($aRecommendations);
unset($aProjects);

$sSql = "SELECT
  cov.content_type_id,
  cov.content_id,
  GROUP_CONCAT(ov.option_value ORDER BY ov.option_order, ov.option_value SEPARATOR ', ') AS option_values,
  ov.option_id
FROM
  " . DB_PREFIX . "contents_option_values AS cov
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON cov.option_value_id = ov.option_value_id
WHERE
  cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . "
GROUP BY
  cov.content_type_id,
  ov.option_id,
  cov.content_id
ORDER BY
  cov.content_type_id,
  ov.option_id,
  cov.content_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aContentsOptionValues[$aRow["content_type_id"]][$aRow["option_id"]][$aRow["content_id"]] = $aRow["option_values"];
  }
  $oResult->close();
}

$oExcel->setActiveSheetIndex(1);
$oPage = $oExcel->getActiveSheet();

$aFields = array();
$aFields["project_id"] = "Id проекта ЛИСС";
$aFields["project_create_date"] = "Дата появления в БД";
$aFields["project_interview_date"] = "Дата интервью";
$aFields["project_interview_backend_user_name"] = "Интервьюер";
$aFields["project_write_backend_user_name"] = "Оператор";
$aFields["leader_id"] = "Интервьюируемый (Id)";
$aFields["leader_name"] = "Интервьюируемый (ФИО)";
$aFields["project_enabled"] = "Актуальность";
$aFields["project_done"] = "Анкета заполнена";
$aFields["project_name"] = "Название";
$aFields["project_name_small"] = "Короткое название";
$aFields["project_name_code"] = "Название для карты";
$aFields["project_text"] = "Суть проекта";
$aFields["project_site"] = "Сайт";
$aFields["project_question_01"] = "Какую проблему решает проект";
$aFields["project_question_02"] = "Для кого Ваш проект?";
$aFields["project_option_05"] = "Сфера";
$aFields["project_area"] = "Сфера (прочее)";
$aFields["project_option_06"] = "Тип проекта";
$aFields["project_option_07"] = "Среда реализации";
$aFields["project_question_04"] = "На основании чего Вы сделали вывод, что проблема существует?";
$aFields["project_question_05"] = "Деятельность проекта";
$aFields["project_question_06"] = "Прямой эффект";
$aFields["project_question_07"] = "Косвенный эффект";
$aFields["project_question_45"] = "Как Вы оцениваете свою эффективность?";
$aFields["project_question_08"] = "Как проблема решается сегодня?";
$aFields["project_question_10"] = "Какие ресурсы Вы используете?";
$aFields["project_question_09"] = "Какую ценность Вы создаёте для тех, кто вам помогает?";
$aFields["project_question_46"] = "Кто в вашей команде? Как Вы их мотивируете?";
$aFields["project_question_11"] = "Комментарий по проекту";
$aFields["project_option_02"] = "Уровень воздействия";
$aFields["project_question_13"] = "Инновационность";
$aFields["project_question_14"] = "Новое содержание";
$aFields["project_question_15"] = "Новая форма представления";
$aFields["project_question_16"] = "Новые процессы/роли/форматы";
$aFields["project_question_17"] = "Новая инфраструктура";
$aFields["project_question_43"] = "Оператор проекта";
$aFields["city_name"] = "Город";
$aFields["project_city_name"] = "Город (другой)";
$aFields["project_start_date"] = "Дата начала деятельности";
$aFields["project_option_10"] = "Организационно-правовая форма оператора проекта";
$aFields["project_option_11"] = "Стадия проекта";
$aFields["project_option_12"] = "Бизнес-модель";
$aFields["project_question_44"] = "Комментарий к бизнес-модели";
$aFields["project_question_18"] = "Затраты - благотворительная деятельность";
$aFields["project_question_19"] = "Затраты - коммерческая деятельность";
$aFields["project_question_20"] = "Затраты - комментарий";
$aFields["project_question_21"] = "Инвестиции - физлица";
$aFields["project_question_22"] = "Инвестиции - юрлица";
$aFields["project_question_23"] = "Инвестиции - фонды/НКО";
$aFields["project_question_24"] = "Инвестиции - государство (бюджет)";
$aFields["project_question_25"] = "Выручка - физлица";
$aFields["project_question_26"] = "Выручка - юрлица";
$aFields["project_question_27"] = "Выручка - фонды/НКО";
$aFields["project_question_28"] = "Выручка - государство (бюджет)";
$aFields["project_question_29"] = "Гранты/спонсорство - физлица";
$aFields["project_question_30"] = "Гранты/спонсорство - юрлица";
$aFields["project_question_31"] = "Гранты/спонсорство - фонды/НКО";
$aFields["project_question_32"] = "Гранты/спонсорство - государство (бюджет)";
$aFields["project_question_33"] = "Комментарий к структуре доходов";
$aFields["project_question_34"] = "Среднемесячное количество посещений сайта/страницы";
$aFields["project_question_35"] = "Среднемесячное количество посещений из РФ";
$aFields["project_question_36"] = "Размер команды";
$aFields["project_question_37"] = "Членов команды в штате";
$aFields["project_question_38"] = "Общее количество пользователей/потребителей в год";
$aFields["project_question_39"] = "Общее количество пользователей/потребителей в год в России";
$aFields["project_option_09"] = "География деятельности";
$aFields["project_question_47"] = "Комментарий масштаб";
$aFields["project_create_datetime"] = "Дата и время создания";
$aFields["transaction_create_datetime"] = "Дата и время последнего изменения";
$aFields["project_create_backend_user_name"] = "Инициатор";
$aFields["transaction_create_backend_user_name"] = "Автор последних изменений данных";
$aFields["leader_ids"] = "Лидеры ЛИСС (Id)";
$aFields["leader_names"] = "Лидеры ЛИСС (ФИО)";
$aFields["leader_roles"] = "Лидеры ЛИСС (роли)";
$aFields["filial_ids"] = "Филиалы (Id)";
$aFields["filial_city_names"] = "Филиалы (города)";

$iColumn = 0;
$iRow = 1;

foreach($aFields as $sKey => $sValue)
{
  $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
  $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
  $iColumn++;
}

$oPage->freezePane("A2");

$sSql = "SELECT
  p.project_id,
  p.project_name,
  p.project_name_small,
  p.project_name_code,
  COALESCE(c.city_name, '') AS city_name,
  p.project_city_name,
  p.project_site,
  p.project_text,
  p.project_create_datetime,
  COALESCE(p.project_interview_date, '') AS project_interview_date,
  COALESCE(p.project_create_date, '') AS project_create_date,
  COALESCE(t.transaction_create_datetime, '') AS transaction_create_datetime,
  COALESCE(p.project_create_backend_user_id, '') AS project_create_backend_user_id,
  COALESCE(t.backend_user_id, '') AS transaction_create_backend_user_id,
  COALESCE(p.project_interview_backend_user_id, '') AS project_interview_backend_user_id,
  COALESCE(p.project_write_backend_user_id, '') AS project_write_backend_user_id,
  p.project_enabled,
  p.project_done,
  COALESCE(l.leader_id, '') AS leader_id,
  IF(l.leader_id IS NULL, p.leader_name, CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, CONCAT(IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic))))))) AS leader_name,
  p.project_area,
  p.project_question_01,
  p.project_question_02,
  COALESCE(ov_7.option_value, '') AS project_option_07,
  COALESCE(ov_2.option_value, '') AS project_option_02,
  p.project_question_04,
  p.project_question_05,
  p.project_question_06,
  p.project_question_07,
  p.project_question_08,
  p.project_question_09,
  p.project_question_10,
  p.project_question_11,
  p.project_question_45,
  p.project_question_46,
  p.project_question_43,
  COALESCE(p.project_start_date, '') AS project_start_date,
  p.project_question_44,
  p.project_question_18,
  p.project_question_19,
  p.project_question_20,
  p.project_question_21,
  p.project_question_22,
  p.project_question_23,
  p.project_question_24,
  p.project_question_25,
  p.project_question_26,
  p.project_question_27,
  p.project_question_28,
  p.project_question_29,
  p.project_question_30,
  p.project_question_31,
  p.project_question_32,
  p.project_question_33,
  COALESCE(p.project_question_34, '') AS project_question_34,
  COALESCE(p.project_question_34, '') AS project_question_35,
  COALESCE(p.project_question_34, '') AS project_question_36,
  COALESCE(p.project_question_34, '') AS project_question_37,
  COALESCE(p.project_question_34, '') AS project_question_38,
  COALESCE(p.project_question_34, '') AS project_question_39,
  COALESCE(ov_9.option_value, '') AS project_option_09,
  COALESCE(ov_11.option_value, '') AS project_option_11,
  COALESCE(ov_12.option_value, '') AS project_option_12,
  p.project_question_47,
  COALESCE(p.project_question_13, '') AS project_question_13,
  COALESCE(p.project_question_14, '') AS project_question_14,
  COALESCE(p.project_question_15, '') AS project_question_15,
  COALESCE(p.project_question_16, '') AS project_question_16,
  COALESCE(p.project_question_17, '') AS project_question_17
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "cities AS c ON p.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON p.transaction_id = t.transaction_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON p.leader_id = l.leader_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_7 ON
    p.project_question_03 = ov_7.option_value_id AND
    ov_7.option_id = 7
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_2 ON
    p.project_question_12 = ov_2.option_value_id AND
    ov_2.option_id = 2
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_9 ON
    p.project_question_40 = ov_9.option_value_id AND
    ov_9.option_id = 9
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_11 ON
    p.project_question_41 = ov_11.option_value_id AND
    ov_11.option_id = 11
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_12 ON
    p.project_question_42 = ov_12.option_value_id AND
    ov_12.option_id = 12
GROUP BY
  p.project_id
ORDER BY
  p.project_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if($aRow["project_create_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["project_create_backend_user_id"]]))
    {
      $aRow["project_create_backend_user_name"] = $aBackendUsers[$aRow["project_create_backend_user_id"]];
    }
    else
    {
      $aRow["project_create_backend_user_name"] = "";
    }

    if($aRow["transaction_create_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["transaction_create_backend_user_id"]]))
    {
      $aRow["transaction_create_backend_user_name"] = $aBackendUsers[$aRow["transaction_create_backend_user_id"]];
    }
    else
    {
      $aRow["transaction_create_backend_user_name"] = "";
    }

    if($aRow["project_interview_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["project_interview_backend_user_id"]]))
    {
      $aRow["project_interview_backend_user_name"] = $aBackendUsers[$aRow["project_interview_backend_user_id"]];
    }
    else
    {
      $aRow["project_interview_backend_user_name"] = "";
    }

    if($aRow["project_write_backend_user_id"] !== "" and isset($aBackendUsers[$aRow["project_write_backend_user_id"]]))
    {
      $aRow["project_write_backend_user_name"] = $aBackendUsers[$aRow["project_write_backend_user_id"]];
    }
    else
    {
      $aRow["project_write_backend_user_name"] = "";
    }

    if(!empty($aLeaders[$aRow["project_id"]]["leader_ids"]))
    {
      $aRow["leader_ids"] = implode("
", $aLeaders[$aRow["project_id"]]["leader_ids"]);
      $aRow["leader_names"] = implode("
", $aLeaders[$aRow["project_id"]]["leader_names"]);
      $aRow["leader_roles"] = implode("
", $aLeaders[$aRow["project_id"]]["leader_roles"]);
    }
    else
    {
      $aRow["leader_ids"] = "";
      $aRow["leader_names"] = "";
      $aRow["leader_roles"] = "";
    }

    if(!empty($aFilials[$aRow["project_id"]]["filial_ids"]))
    {
      $aRow["filial_ids"] = implode("
", $aFilials[$aRow["project_id"]]["filial_ids"]);
      $aRow["filial_city_names"] = implode("
", $aFilials[$aRow["project_id"]]["city_names"]);
    }
    else
    {
      $aRow["filial_ids"] = "";
      $aRow["filial_city_names"] = "";
    }

    for($iTemp = 13; $iTemp <= 17; $iTemp++)
    {      if(isset($aOptionValues[8][$aRow["project_question_" . $iTemp]]))
      {      	$aRow["project_question_" . $iTemp] = $aOptionValues[8][$aRow["project_question_" . $iTemp]];      }
      else
      {      	$aRow["project_question_" . $iTemp] = "";      }    }

    if(isset($aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][5][$aRow["project_id"]]))
    {      $aRow["project_option_05"] = $aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][5][$aRow["project_id"]];    }
    else
    {
      $aRow["project_option_05"] = "";
    }

    if(isset($aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][6][$aRow["project_id"]]))
    {
      $aRow["project_option_06"] = $aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][6][$aRow["project_id"]];
    }
    else
    {
      $aRow["project_option_06"] = "";
    }

    if(isset($aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][10][$aRow["project_id"]]))
    {
      $aRow["project_option_10"] = $aContentsOptionValues[PROJECT_CONTENT_TYPE_ID][10][$aRow["project_id"]];
    }
    else
    {      $aRow["project_option_10"] = "";    }

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
      $iColumn++;
    }
  }

  $oResult->close();
}

unset($aContentsOptionValues);
unset($aLeaders);
unset($aOptionValues);
unset($aFilials);
unset($aBackendUsers);
unset($oPage);

$oExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="leaders_projects_' . date("Y_m_d_H_i_s") . '.xlsx"');

$oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
$oWriter->save('php://output');

unset($oExcel);
unset($oWriter);

?>