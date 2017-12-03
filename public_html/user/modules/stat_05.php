<?php

$bExcelEnabled = isset($_GET["excel_enabled"]);

$oDB = cMyDB::oGetDB("db");

$aSearch = array();
$aSearch["date_from"] = "";
$aSearch["date_to"] = "";
$aSearch["stat_type_id"] = "";

$aWhereLeaders = array();
$aWhereLeaders[] = "TRUE";

if(isset($_GET["date_from"]) and bIsDate($_GET["date_from"]) and $_GET["date_from"] <= date("Y-m-d"))
{
  $aSearch["date_from"] = $_GET["date_from"];
}

if(isset($_GET["date_to"]) and bIsDate($_GET["date_to"]) and $_GET["date_to"] <= date("Y-m-d"))
{
  if($aSearch["date_from"] !== "" and $aSearch["date_from"] > $_GET["date_to"])
  {
  	$aSearch["date_from"] = "";
  }
  else
  {
  	$aSearch["date_to"] = $_GET["date_to"];
  }
}

if($aSearch["date_from"] !== "")
{
  $aWhereLeaders[] = "l.leader_interview_date >= '" . $aSearch["date_from"] . "'";
}

if($aSearch["date_to"] !== "")
{
  $aWhereLeaders[] = "l.leader_interview_date <= '" . $aSearch["date_to"] . "'";
}

if(isset($_GET["stat_type_id"]) and bIsInt($_GET["stat_type_id"], 1, 5))
{
  $aSearch["stat_type_id"] = $_GET["stat_type_id"];
}
else
{
  $aSearch["stat_type_id"] = 2;
}

$aStatTypes = array();
$aStatTypes[1] = array("time_prefix" => "DATE(", "time_postfix" =>")", "period_name_show" => "t.period_name");
$aStatTypes[2] = array("time_prefix" => "YEARWEEK(", "time_postfix" =>", -1)", "period_name_show" => "COALESCE(CONCAT(DATE_FORMAT(STR_TO_DATE(CONCAT(t.period_name, 'Monday'), '%x%v%W'), '%Y-%m-%d'), ' - ', DATE_FORMAT(STR_TO_DATE(CONCAT(t.period_name, 'Sunday'), '%x%v%W'), '%Y-%m-%d')), '-')");
$aStatTypes[3] = array("time_prefix" => "DATE_FORMAT(", "time_postfix" =>", '%Y-%m')", "period_name_show" => "t.period_name");
$aStatTypes[4] = array("time_prefix" => "YEAR(", "time_postfix" =>")", "period_name_show" => "t.period_name");
$aStatTypes[5] = array("time_prefix" => "IF(", "time_postfix" =>" IS NULL, '-', '-')", "period_name_show" => "t.period_name");

if($bExcelEnabled)
{
  require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

  $oExcel = new PHPExcel();
  $oExcel->setActiveSheetIndex(0);
  $oExcel->getActiveSheet()->setTitle("stat_05");
  $oPage = $oExcel->getActiveSheet();
}
else
{
  $oSmarty = new cMySmarty();
}

$aBackendUsers = array();

$sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_name
FROM
  " . DB_PREFIX . "backend_users AS bu
ORDER BY
  bu.backend_user_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["backend_user_name"] = htmlspecialchars($aRow["backend_user_name"]);
    $aBackendUsers[$aRow["backend_user_id"]] = htmlspecialchars($aRow["backend_user_name"]);
  }
  $oResult->close();
}

$aBackendUsers["-"] = "Без интервьюера";
$aBackendUsers["all"] = "Всего";

$sSql = "SELECT
  t.period_name,
  " . $aStatTypes[$aSearch["stat_type_id"]]["period_name_show"] . " AS period_name_show,
  t.backend_user_id,
  SUM(t.leaders_count) AS leaders_count,
  SUM(t.projects_count) AS projects_count
FROM
  ((SELECT
    COALESCE(" . $aStatTypes[$aSearch["stat_type_id"]]["time_prefix"] . "l.leader_interview_date" . $aStatTypes[$aSearch["stat_type_id"]]["time_postfix"] . ", '-') AS period_name,
    COALESCE(l.leader_interview_backend_user_id, '-') AS backend_user_id,
    COUNT(l.leader_id) AS leaders_count,
    0 AS projects_count
  FROM
    " . DB_PREFIX . "leaders AS l
  WHERE
    " . implode(" AND
    ", $aWhereLeaders) . "
  GROUP BY
    period_name,
    backend_user_id)) AS t
GROUP BY
  t.period_name,
  t.backend_user_id
ORDER BY
  t.period_name,
  t.backend_user_id";
if($oResult = $oDB->query($sSql))
{
  $aContentTotal = array();
  $aContentTotal["all"] = array("leaders_count" => 0, "projects_count" => 0);
  $aContentData = array();
  $aBUIds = array();

  while($aRow = $oResult->fetch_assoc())
  {
    $aBUIds[$aRow["backend_user_id"]] = true;

    if(!isset($aContentData[$aRow["period_name_show"]]))
    {      $aContentData[$aRow["period_name_show"]] = array();
      $aContentData[$aRow["period_name_show"]]["all"] = array("leaders_count" => 0, "projects_count" => 0);    }
    $aContentData[$aRow["period_name_show"]][$aRow["backend_user_id"]] = $aRow;
    $aContentData[$aRow["period_name_show"]]["all"] = array("leaders_count" => $aContentData[$aRow["period_name_show"]]["all"]["leaders_count"] + $aRow["leaders_count"], "projects_count" => $aContentData[$aRow["period_name_show"]]["all"]["projects_count"] + $aRow["projects_count"]);

    if(!isset($aContentTotal[$aRow["backend_user_id"]]))
    {      $aContentTotal[$aRow["backend_user_id"]] = array("leaders_count" => 0, "projects_count" => 0);    }
    $aContentTotal[$aRow["backend_user_id"]] = array("leaders_count" =>  $aContentTotal[$aRow["backend_user_id"]]["leaders_count"] + $aRow["leaders_count"], "projects_count" =>  $aContentTotal[$aRow["backend_user_id"]]["projects_count"] + $aRow["projects_count"]);
    $aContentTotal["all"] = array("leaders_count" =>  $aContentTotal["all"]["leaders_count"] + $aRow["leaders_count"], "projects_count" =>  $aContentTotal["all"]["projects_count"] + $aRow["projects_count"]);
  }
  $oResult->close();

  if(!empty($aContentTotal) and $aSearch["stat_type_id"] != 5)
  {
    $aContentData["all"] = $aContentTotal;  }

  if(!empty($aContentData))
  {  	$aBUIds["all"] = true;

  	foreach($aBackendUsers as $iBackenUserId => $sBackenUserName)
    {
      if(!isset($aBUIds[$iBackenUserId]))
      {
      	unset($aBackendUsers[$iBackenUserId]);
      }
    }

  	if($bExcelEnabled)
    {
      $aFields = array();
      $aFields["period_name"] = "Период интервью";

      foreach($aBackendUsers as $iBackenUserId => $sBackenUserName)
      {      	$aFields[$iBackenUserId . "_leaders"] = $sBackenUserName;      }

      $iColumn = 0;
      $iRow = 1;

      foreach($aFields as $sKey => $sValue)
      {
        $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
        $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
        $iColumn++;
      }

      $oPage->freezePane("A2");

      foreach($aContentData as $sPeriodName => $aData)
      {      	$iColumn = 0;
        $iRow++;

        if($sPeriodName === "all")
        {          $oPage->setCellValueByColumnAndRow($iColumn, $iRow, "Всего");        }
        else
        {          if($sPeriodName === "-")
          {
            $oPage->setCellValueByColumnAndRow($iColumn, $iRow, "интервью не назначено");
          }
          else
          {
            $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sPeriodName);
          }        }

        foreach($aBackendUsers as $iBackenUserId => $sBackenUserName)
        {
          $iColumn++;

          if(isset($aData[$iBackenUserId]))
          {          	$oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aData[$iBackenUserId]["leaders_count"]);          }
          else
          {          	$oPage->setCellValueByColumnAndRow($iColumn, $iRow, 0);          }
        }      }
    }
    else
    {
      $oSmarty->assign("aContentData", $aContentData);
      $oSmarty->assign("aBackendUsers", $aBackendUsers);
    }  }
}

if($bExcelEnabled)
{
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="stat_05_' . date("Y_m_d_H_i_s") . '.xlsx"');

  $oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
  $oWriter->save('php://output');
}
else
{
  $oSmarty->assign("aSearch", $aSearch);

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления. Статистика по интервьюерам.";
  $aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_stat_05.js");

  $aMenu["stat"]["active"] = true;
  $aMenu["stat"]["items"]["stat_05"]["active"] = true;

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->assign("aMenu", $aMenu);
  $oSmarty->assign("sInnerPage", "backend_stat_05");
  $oSmarty->display("backend_main.tpl");
}

?>