<?php

set_time_limit(0);
ini_set("memory_limit", "1024M");

$oDB = cMyDB::oGetDB("db");

$aBackendUsers = array();
$aOptionValues = array();
$aCities = array();

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

require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

$oExcel = new PHPExcel();
$oExcel->setActiveSheetIndex(0);
$oExcel->getActiveSheet()->setTitle("Проекты ЛИСС");
$oPage = $oExcel->getActiveSheet();

$aFields = array();
$aFields["transaction_id"] = "Id транзакции";
$aFields["transaction_create_datetime"] = "Дата и время транзакции";
$aFields["transaction_create_backend_user_name"] = "Автор изменений";
$aFields["project_id"] = "Id проекта ЛИСС";
$aFields["project_interview_date"] = "Дата интервью";
$aFields["project_interview_backend_user_name"] = "Интервьюер";
$aFields["project_write_backend_user_name"] = "Оператор";
$aFields["leader_id"] = "Интервьюируемый (Id)";
$aFields["leader_name"] = "Интервьюируемый (ФИО)";
$aFields["project_enabled"] = "Актуальность";
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
$aFields["project_create_backend_user_name"] = "Инициатор";
$aFields["leader_ids"] = "Лидеры ЛИСС (Id)";
$aFields["leader_names"] = "Лидеры ЛИСС (ФИО)";
$aFields["leader_roles"] = "Лидеры ЛИСС (роли)";

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
  t.content_type_id = " . PROJECT_CONTENT_TYPE_ID . "
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
    $aData["content"]["project_id"] = $aRow["content_id"];

    if(isset($aBackendUsers[$aRow["backend_user_id"]]))
    {      $aData["content"]["transaction_create_backend_user_name"] = $aBackendUsers[$aRow["backend_user_id"]];    }

    if(isset($aData["content"]["project_create_backend_user_id"], $aBackendUsers[$aData["content"]["project_create_backend_user_id"]]))
    {
      $aData["content"]["project_create_backend_user_name"] = $aBackendUsers[$aData["content"]["project_create_backend_user_id"]];
    }

    if(isset($aData["content"]["project_interview_backend_user_id"], $aBackendUsers[$aData["content"]["project_interview_backend_user_id"]]))
    {
      $aData["content"]["project_interview_backend_user_name"] = $aBackendUsers[$aData["content"]["project_interview_backend_user_id"]];
    }

    if(isset($aData["content"]["project_write_backend_user_id"], $aBackendUsers[$aData["content"]["project_write_backend_user_id"]]))
    {
      $aData["content"]["project_write_backend_user_name"] = $aBackendUsers[$aData["content"]["project_write_backend_user_id"]];
    }

    if(isset($aData["content"]["city_id"]) and !is_null($aData["content"]["city_id"]) and isset($aCities[$aData["content"]["city_id"]]))
    {      $aData["content"]["city_name"] = $aCities[$aData["content"]["city_id"]];    }

    if(isset($aData["content"]["project_question_12"]) and !is_null($aData["content"]["project_question_12"]) and isset($aOptionValues[2][$aData["content"]["project_question_12"]]))
    {
      $aData["content"]["project_option_02"] = $aOptionValues[2][$aData["content"]["project_question_12"]];
    }

    if(isset($aData["content"]["project_question_03"]) and !is_null($aData["content"]["project_question_03"]) and isset($aOptionValues[7][$aData["content"]["project_question_03"]]))
    {
      $aData["content"]["project_option_07"] = $aOptionValues[7][$aData["content"]["project_question_03"]];
    }

    if(isset($aData["content"]["project_question_40"]) and !is_null($aData["content"]["project_question_40"]) and isset($aOptionValues[9][$aData["content"]["project_question_40"]]))
    {
      $aData["content"]["project_option_09"] = $aOptionValues[9][$aData["content"]["project_question_40"]];
    }

    if(isset($aData["content"]["project_question_41"]) and !is_null($aData["content"]["project_question_41"]) and isset($aOptionValues[11][$aData["content"]["project_question_41"]]))
    {
      $aData["content"]["project_option_11"] = $aOptionValues[11][$aData["content"]["project_question_41"]];
    }

    if(isset($aData["content"]["project_question_42"]) and !is_null($aData["content"]["project_question_42"]) and isset($aOptionValues[12][$aData["content"]["project_question_42"]]))
    {
      $aData["content"]["project_option_12"] = $aOptionValues[12][$aData["content"]["project_question_42"]];
    }

    for($iTemp = 13; $iTemp <= 17; $iTemp++)
    {      if(isset($aData["content"]["project_question_" . $iTemp]) and !is_null($aData["content"]["project_question_" . $iTemp]) and isset($aOptionValues[8][$aData["content"]["project_question_" . $iTemp]]))
      {
        $aData["content"]["project_option_" . $iTemp] = $aOptionValues[8][$aData["content"]["project_question_" . $iTemp]];
      }
      else
      {
        $aData["content"]["project_option_" . $iTemp] = "";
      }    }

    foreach(array(5, 6, 10) as $iOptionId)
    {      if(isset($aOptionValues[$iOptionId]))
      {
        foreach($aOptionValues[$iOptionId] as $iOptionValueId => $sOptionValue)
        {
      	  $sOptionId = str_pad($iOptionId, 2, "0", STR_PAD_LEFT);

      	  if(isset($aData["content_options"]) and in_array($iOptionValueId, $aData["content_options"]))
      	  {
      	    if(!isset($aData["content"]["project_option_" . $sOptionId]))
      	    {
      	  	  $aData["content"]["project_option_" . $sOptionId] = "";
      	    }

      	    if($aData["content"]["project_option_" . $sOptionId] !== "")
      	    {
      	  	  $aData["content"]["project_option_" . $sOptionId] .= ", ";
      	    }

      	    $aData["content"]["project_option_" . $sOptionId] .= $sOptionValue;
      	  }
        }
      }    }

    $aData["content"]["leader_ids"] = "";
    $aData["content"]["leader_names"] = "";
    $aData["content"]["leader_roles"] = "";

    if(isset($aData["leaders_projects"]) and !empty($aData["leaders_projects"]))
    {      foreach($aData["leaders_projects"] as $iTemp => $aProject)
      {      	if(isset($aProject["leader_id"]) and !is_null($aProject["leader_id"]))
      	{      	  $iLeaderId = $aProject["leader_id"];      	}
      	else
      	{      	  $iLeaderId  = "";      	}

      	if(isset($aProject["leader_surname"]) and !is_null($aProject["leader_surname"]) and $aProject["leader_surname"] !== "")
      	{
      	  $sLeaderName = $aProject["leader_surname"];

      	  if(isset($aProject["leader_name"]) and !is_null($aProject["leader_name"]) and $aProject["leader_name"] !== "")
      	  {
      	    $sLeaderName .= " " . $aProject["leader_name"];

      	    if(isset($aProject["leader_patronymic"]) and !is_null($aProject["leader_patronymic"]) and $aProject["leader_patronymic"] !== "")
      	    {
      	      $sLeaderName .= " " . $aProject["leader_patronymic"];
      	    }
      	  }
      	}
      	else
      	{
      	  $sLeaderName = "";
      	}

      	if(isset($aProject["leader_role"]) and !is_null($aProject["leader_role"]))
      	{
      	  $sLeaderRole = $aProject["leader_role"];
      	}
      	else
      	{
      	  $sLeaderRole = "";
      	}

      	$aData["content"]["leader_ids"] .= ($iTemp + 1) . ". " . $iLeaderId . "
";
        $aData["content"]["leader_names"] .= ($iTemp + 1) . ". " . $sLeaderName . "
";
        $aData["content"]["leader_roles"] .= ($iTemp + 1) . ". " . $sLeaderRole . "
";      }    }

    $aData["content"]["leader_ids"] = trim($aData["content"]["leader_ids"]);
    $aData["content"]["leader_names"] = trim($aData["content"]["leader_names"]);
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
unset($oPage);

$oExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="projects_history_' . date("Y_m_d_H_i_s") . '.xlsx"');

$oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
$oWriter->save('php://output');

unset($oExcel);
unset($oWriter);

?>