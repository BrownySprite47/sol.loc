<?php

set_time_limit(0);
ini_set("memory_limit", "1024M");

$oDB = cMyDB::oGetDB("db");

$aBackendUsers = array();
$aOptionValues = array();
$aCities = array();
$aSex = array();

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
  ov.option_value_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if(!isset($aOptionValues[$aRow["option_id"]]))
    {      $aOptionValues[$aRow["option_id"]] = array();    }

    $aOptionValues[$aRow["option_id"]][$aRow["option_value_id"]] = $aRow["option_value"];
  }
  $oResult->close();
}

$sSql = "SELECT
  c.city_id,
  c.city_name
FROM
  " . DB_PREFIX . "cities AS c
ORDER BY
  c.city_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aCities[$aRow["city_id"]] = $aRow["city_name"];
  }
  $oResult->close();
}

$sSql = "SELECT
  s.sex_id,
  s.sex_name
FROM
  " . DB_PREFIX . "sex AS s
ORDER BY
  s.sex_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aSex[$aRow["sex_id"]] = $aRow["sex_name"];
  }
  $oResult->close();
}

require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

$oExcel = new PHPExcel();
$oExcel->setActiveSheetIndex(0);
$oExcel->getActiveSheet()->setTitle("Лидеры ЛИСС");
$oPage = $oExcel->getActiveSheet();

$aFields = array();
$aFields["transaction_id"] = "Id транзакции";
$aFields["transaction_create_datetime"] = "Дата и время транзакции";
$aFields["transaction_create_backend_user_name"] = "Автор изменений";
$aFields["leader_id"] = "Id";
$aFields["leader_interview_date"] = "Дата интервью";
$aFields["leader_interview_backend_user_name"] = "Интервьюер";
$aFields["leader_write_backend_user_name"] = "Оператор";
$aFields["leader_option_01"] = "Способ проведения интервью";
$aFields["leader_contact_from"] = "Источник контакта";
$aFields["leader_interview_result"] = "Договоренности";
$aFields["leader_question_21"] = "Комментарии";
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
$aFields["leader_create_backend_user_name"] = "Инициатор";
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
  t.transaction_id,
  t.transaction_create_datetime,
  t.content_id,
  t.backend_user_id,
  t.transaction_data
FROM
  " . DB_PREFIX . "transactions AS t
WHERE
  t.content_type_id = " . LEADER_CONTENT_TYPE_ID . "
ORDER BY
  t.content_id,
  t.transaction_create_datetime,
  t.transaction_id";
if($oResult = $oDB->query($sSql))
{
  $iContentId = 0;
  $aDataPrev = array();
  $aData = array();

  while($aRow = $oResult->fetch_assoc())
  {
    $aData = unserialize($aRow["transaction_data"]);

    $aData["content"]["transaction_id"] = $aRow["transaction_id"];
    $aData["content"]["transaction_create_datetime"] = $aRow["transaction_create_datetime"];
    $aData["content"]["leader_id"] = $aRow["content_id"];

    if(isset($aBackendUsers[$aRow["backend_user_id"]]))
    {      $aData["content"]["transaction_create_backend_user_name"] = $aBackendUsers[$aRow["backend_user_id"]];    }

    if(isset($aData["content"]["leader_create_backend_user_id"], $aBackendUsers[$aData["content"]["leader_create_backend_user_id"]]))
    {
      $aData["content"]["leader_create_backend_user_name"] = $aBackendUsers[$aData["content"]["leader_create_backend_user_id"]];
    }

    if(isset($aData["content"]["leader_interview_backend_user_id"], $aBackendUsers[$aData["content"]["leader_interview_backend_user_id"]]))
    {
      $aData["content"]["leader_interview_backend_user_name"] = $aBackendUsers[$aData["content"]["leader_interview_backend_user_id"]];
    }

    if(isset($aData["content"]["leader_write_backend_user_id"], $aBackendUsers[$aData["content"]["leader_write_backend_user_id"]]))
    {
      $aData["content"]["leader_write_backend_user_name"] = $aBackendUsers[$aData["content"]["leader_write_backend_user_id"]];
    }

    if(isset($aData["content"]["leader_phone"]) and !is_null($aData["content"]["leader_phone"]) and mb_strlen($aData["content"]["leader_phone"], "utf-8") === 10)
    {
      $aData["content"]["leader_phone"] = "+7" . $aData["content"]["leader_phone"];
    }

    if(isset($aData["content"]["city_id"]) and !is_null($aData["content"]["city_id"]) and isset($aCities[$aData["content"]["city_id"]]))
    {      $aData["content"]["city_name"] = $aCities[$aData["content"]["city_id"]];    }

    if(isset($aData["content"]["sex_id"]) and !is_null($aData["content"]["sex_id"]) and isset($aSex[$aData["content"]["sex_id"]]))
    {
      $aData["content"]["sex_name"] = $aSex[$aData["content"]["sex_id"]];
    }

    if(isset($aData["content"]["leader_interview_type"]) and !is_null($aData["content"]["leader_interview_type"]) and isset($aOptionValues[1][$aData["content"]["leader_interview_type"]]))
    {
      $aData["content"]["leader_option_01"] = $aOptionValues[1][$aData["content"]["leader_interview_type"]];
    }

    if(isset($aData["content"]["leader_question_08"]) and !is_null($aData["content"]["leader_question_08"]) and isset($aOptionValues[2][$aData["content"]["leader_question_08"]]))
    {
      $aData["content"]["leader_question_08"] = $aOptionValues[2][$aData["content"]["leader_question_08"]];
    }

    if(isset($aData["content"]["leader_question_09"]) and !is_null($aData["content"]["leader_question_09"]) and isset($aOptionValues[3][$aData["content"]["leader_question_09"]]))
    {
      $aData["content"]["leader_question_09"] = $aOptionValues[3][$aData["content"]["leader_question_09"]];
    }

    if(isset($aOptionValues[4]))
    {      foreach($aOptionValues[4] as $iOptionValueId => $sOptionValue)
      {      	if(isset($aData["content_options"]) and in_array($iOptionValueId, $aData["content_options"]))
      	{      	  if(!isset($aData["content"]["leader_option_04"]))
      	  {      	  	$aData["content"]["leader_option_04"] = "";      	  }

      	  if($aData["content"]["leader_option_04"] !== "")
      	  {      	  	$aData["content"]["leader_option_04"] .= ", ";      	  }

      	  $aData["content"]["leader_option_04"] .= $sOptionValue;      	}      }    }

    $aData["content"]["recommendation_leader_ids"] = "";
    $aData["content"]["recommendation_leader_names"] = "";

    if(isset($aData["recommendations"]) and !empty($aData["recommendations"]))
    {
      foreach($aData["recommendations"] as $iTemp => $aRecommendation)
      {
      	if(isset($aRecommendation["leader_id_to"]) and !is_null($aRecommendation["leader_id_to"]))
      	{
      	  $iLeaderId = $aRecommendation["leader_id_to"];
      	}
      	else
      	{
      	  $iLeaderId = "";
      	}

      	if(isset($aRecommendation["leader_surname"]) and !is_null($aRecommendation["leader_surname"]) and $aRecommendation["leader_surname"] !== "")
      	{
      	  $sLeaderName = $aRecommendation["leader_surname"];

      	  if(isset($aRecommendation["leader_name"]) and !is_null($aRecommendation["leader_name"]) and $aRecommendation["leader_name"] !== "")
      	  {
      	    $sLeaderName .= " " . $aRecommendation["leader_name"];

      	    if(isset($aRecommendation["leader_patronymic"]) and !is_null($aRecommendation["leader_patronymic"]) and $aRecommendation["leader_patronymic"] !== "")
      	    {
      	      $sLeaderName .= " " . $aRecommendation["leader_patronymic"];
      	    }
      	  }
      	}
      	else
      	{
      	  $sLeaderName = "";
      	}

      	$aData["content"]["recommendation_leader_ids"] .= ($iTemp + 1) . ". " . $iLeaderId . "
";
        $aData["content"]["recommendation_leader_names"] .= ($iTemp + 1) . ". " . $sLeaderName . "
";
      }
    }

    $aData["content"]["recommendation_leader_ids"] = trim($aData["content"]["recommendation_leader_ids"]);
    $aData["content"]["recommendation_leader_names"] = trim($aData["content"]["recommendation_leader_names"]);

    $aData["content"]["project_ids"] = "";
    $aData["content"]["project_names"] = "";
    $aData["content"]["leader_roles"] = "";

    if(isset($aData["leaders_projects"]) and !empty($aData["leaders_projects"]))
    {      foreach($aData["leaders_projects"] as $iTemp => $aProject)
      {      	if(isset($aProject["project_id"]) and !is_null($aProject["project_id"]))
      	{      	  $iProjectId = $aProject["project_id"];      	}
      	else
      	{      	  $iProjectId = "";      	}

      	if(isset($aProject["project_name"]) and !is_null($aProject["project_name"]))
      	{
      	  $sProjectName = $aProject["project_name"];
      	}
      	else
      	{
      	  $sProjectName = "";
      	}

      	if(isset($aProject["leader_role"]) and !is_null($aProject["leader_role"]))
      	{
      	  $sLeaderRole = $aProject["leader_role"];
      	}
      	else
      	{
      	  $sLeaderRole = "";
      	}

      	$aData["content"]["project_ids"] .= ($iTemp + 1) . ". " . $iProjectId . "
";
        $aData["content"]["project_names"] .= ($iTemp + 1) . ". " . $sProjectName . "
";
        $aData["content"]["leader_roles"] .= ($iTemp + 1) . ". " . $sLeaderRole . "
";      }    }

    $aData["content"]["project_ids"] = trim($aData["content"]["project_ids"]);
    $aData["content"]["project_names"] = trim($aData["content"]["project_names"]);
    $aData["content"]["leader_roles"] = trim($aData["content"]["leader_roles"]);

    $iColumn = 0;
    $iRow++;

    foreach($aFields as $sKey => $sValue)
    {
      if(isset($aData["content"][$sKey]) and !is_null($aData["content"][$sKey]))
      {      	$sData = $aData["content"][$sKey];      }
      else
      {      	$sData = "";      }

      if(isset($aDataPrev[$sKey]) and !is_null($aDataPrev[$sKey]))
      {      	$sDataPrev = $aDataPrev[$sKey];      }
      else
      {      	$sDataPrev = "";      }

      $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sData);

      if($iContentId == $aRow["content_id"] and $sData != $sDataPrev and !in_array($sKey, array("transaction_id", "transaction_create_datetime", "transaction_create_backend_user_name")))
      {      	$oPage->getStyle(PHPExcel_Cell::stringFromColumnIndex($iColumn) . $iRow)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB(mb_strtoupper("00CC00"));
      }

      $iColumn++;
    }

    if($iContentId != $aRow["content_id"])
    {
      $iContentId = $aRow["content_id"];
    }
    $aDataPrev = $aData["content"];
  }

  $oResult->close();
  unset($aData);
  unset($aDataPrev);
}

unset($aOptionValues);
unset($aBackendUsers);
unset($aCities);
unset($aSex);
unset($oPage);

$oExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="leaders_history_' . date("Y_m_d_H_i_s") . '.xlsx"');

$oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
$oWriter->save('php://output');

unset($oExcel);
unset($oWriter);

?>