<?php

$bExcelEnabled = isset($_GET["excel_enabled"]);

$oDB = cMyDB::oGetDB("db");

$aSearch = array();
$aSearch["date_from"] = "";
$aSearch["date_to"] = "";
$aSearch["stat_type_id"] = "";

$aWhereLeaders = array();
$aWhereLeaders[] = "TRUE";
$aWhereRecommendations = array();
$aWhereRecommendations[] = "TRUE";
$aWhereProjects = array();
$aWhereProjects[] = "TRUE";

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
  $aWhereLeaders[] = "l.leader_create_datetime >= '" . $aSearch["date_from"] . "'";
  $aWhereRecommendations[] = "r.recommendation_create_datetime >= '" . $aSearch["date_from"] . "'";
  $aWhereProjects[] = "p.project_create_datetime >= '" . $aSearch["date_from"] . "'";
}

if($aSearch["date_to"] !== "")
{
  $aWhereLeaders[] = "l.leader_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
  $aWhereRecommendations[] = "r.recommendation_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
  $aWhereProjects[] = "p.project_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
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
$aStatTypes[2] = array("time_prefix" => "YEARWEEK(", "time_postfix" =>", -1)", "period_name_show" => "CONCAT(DATE_FORMAT(STR_TO_DATE(CONCAT(t.period_name, 'Monday'), '%x%v%W'), '%Y-%m-%d'), ' - ', DATE_FORMAT(STR_TO_DATE(CONCAT(t.period_name, 'Sunday'), '%x%v%W'), '%Y-%m-%d'))");
$aStatTypes[3] = array("time_prefix" => "DATE_FORMAT(", "time_postfix" =>", '%Y-%m')", "period_name_show" => "t.period_name");
$aStatTypes[4] = array("time_prefix" => "YEAR(", "time_postfix" =>")", "period_name_show" => "t.period_name");
$aStatTypes[5] = array("time_prefix" => "IF(", "time_postfix" =>" IS NULL, '-', '-')", "period_name_show" => "t.period_name");

if($bExcelEnabled)
{
  require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

  $oExcel = new PHPExcel();
  $oExcel->setActiveSheetIndex(0);
  $oExcel->getActiveSheet()->setTitle("stat_04");
  $oPage = $oExcel->getActiveSheet();

  $aFields = array();
  $aFields["period_name_show"] = "Период создания (лидер ЛИСС, проекта ЛИСС, рекомендация)";
  $aFields["leaders_count_1"] = "Количество лидеров ЛИСС (интервью пройдено + интервью на сегодня)";
  $aFields["leaders_count_2"] = "Количество лидеров ЛИСС (интервью ожидается)";
  $aFields["leaders_count_3"] = "Количество лидеров ЛИСС (интервью не назначено)";
  $aFields["leaders_count_4"] = "Количество лидеров ЛИСС";
  $aFields["leaders_count_4"] = "Количество лидеров ЛИСС (количество входящих рекомендаций не менее 2-ух)";
  $aFields["projects_count_1"] = "Количество проектов ЛИСС";
  $aFields["recommendations_count_1"] = "Количество рекомендаций (лидер создан)";
  $aFields["recommendations_count_2"] = "Количество рекомендаций";

  $iColumn = 0;
  $iRow = 1;

  foreach($aFields as $sKey => $sValue)
  {
    $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $sValue);
    $oPage->getColumnDimensionByColumn($iColumn)->setWidth(25);
    $iColumn++;
  }

  $oPage->freezePane("A2");
}
else
{
  $oSmarty = new cMySmarty();
}

$sCurrentDate = date("Y-m-d");

$sSql = "SELECT
  t.period_name,
  " . $aStatTypes[$aSearch["stat_type_id"]]["period_name_show"] . " AS period_name_show,
  SUM(t.leaders_count_1) AS leaders_count_1,
  SUM(t.leaders_count_2) AS leaders_count_2,
  SUM(t.leaders_count_3) AS leaders_count_3,
  SUM(t.leaders_count_4) AS leaders_count_4,
  SUM(t.leaders_count_5) AS leaders_count_5,
  SUM(t.projects_count_1) AS projects_count_1,
  SUM(t.recommendations_count_1) AS recommendations_count_1,
  SUM(t.recommendations_count_2) AS recommendations_count_2
FROM
  ((SELECT
    " . $aStatTypes[$aSearch["stat_type_id"]]["time_prefix"] . "l.leader_create_datetime" . $aStatTypes[$aSearch["stat_type_id"]]["time_postfix"] . " AS period_name,
    SUM(IF(l.leader_interview_date <= '" . $sCurrentDate . "', 1, 0)) AS leaders_count_1,
    SUM(IF(l.leader_interview_date > '" . $sCurrentDate . "', 1, 0)) AS leaders_count_2,
    SUM(IF(l.leader_interview_date IS NULL, 1, 0)) AS leaders_count_3,
    COUNT(l.leader_id) AS leaders_count_4,
    0 AS leaders_count_5,
    0 AS projects_count_1,
    0 AS recommendations_count_1,
    0 AS recommendations_count_2
  FROM
    " . DB_PREFIX . "leaders AS l
  WHERE
    " . implode(" AND
    ", $aWhereLeaders) . "
  GROUP BY
    period_name)
  UNION ALL
  (SELECT
    " . $aStatTypes[$aSearch["stat_type_id"]]["time_prefix"] . "p.project_create_datetime" . $aStatTypes[$aSearch["stat_type_id"]]["time_postfix"] . " AS period_name,
    0 AS leaders_count_1,
    0 AS leaders_count_2,
    0 AS leaders_count_3,
    0 AS leaders_count_4,
    0 AS leaders_count_5,
    COUNT(p.project_id) AS projects_count_1,
    0 AS recommendations_count_1,
    0 AS recommendations_count_2
  FROM
    " . DB_PREFIX . "projects AS p
  WHERE
    " . implode(" AND
    ", $aWhereProjects) . "
  GROUP BY
    period_name)
  UNION ALL
  (SELECT
    " . $aStatTypes[$aSearch["stat_type_id"]]["time_prefix"] . "r.recommendation_create_datetime" . $aStatTypes[$aSearch["stat_type_id"]]["time_postfix"] . " AS period_name,
    0 AS leaders_count_1,
    0 AS leaders_count_2,
    0 AS leaders_count_3,
    0 AS leaders_count_4,
    0 AS leaders_count_5,
    0 AS projects_count_1,
    SUM(IF(r.leader_id_to IS NULL, 0, 1)) AS recommendations_count_1,
    COUNT(r.recommendation_id) AS recommendations_count_2
  FROM
    " . DB_PREFIX . "recommendations AS r
  WHERE
    " . implode(" AND
    ", $aWhereRecommendations) . "
  GROUP BY
    period_name)
  UNION ALL
  (SELECT
    " . $aStatTypes[$aSearch["stat_type_id"]]["time_prefix"] . "l.leader_create_datetime" . $aStatTypes[$aSearch["stat_type_id"]]["time_postfix"] . " AS period_name,
    0 AS leaders_count_1,
    0 AS leaders_count_2,
    0 AS leaders_count_3,
    0 AS leaders_count_4,
    1 AS leaders_count_5,
    0 AS projects_count_1,
    0 AS recommendations_count_1,
    0 AS recommendations_count_2
  FROM
    " . DB_PREFIX . "recommendations AS r
    INNER JOIN " . DB_PREFIX . "leaders AS l ON r.leader_id_to = l.leader_id
  WHERE
    " . implode(" AND
    ", $aWhereLeaders) . "
  GROUP BY
    r.leader_id_to
  HAVING
    COUNT(r.recommendation_id) >= 2)) AS t
GROUP BY
  t.period_name
ORDER BY
  t.period_name";
if($oResult = $oDB->query($sSql))
{
  $aContentTotal = array();

  while($aRow = $oResult->fetch_assoc())
  {
    foreach($aRow as $sKey => $iValue)
    {      if($sKey !== "period_name" and $sKey !== "period_name_show")
      {
        if(!isset($aContentTotal[$sKey]))
        {      	  $aContentTotal[$sKey] = 0;        }
        $aContentTotal[$sKey] += $iValue;
      }    }

    if($bExcelEnabled)
    {      $iColumn = 0;
      $iRow++;

      foreach($aFields as $sKey => $sValue)
      {
        $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
        $iColumn++;
      }    }
    else
    {      $aRow["period_name"] = htmlspecialchars($aRow["period_name"]);
      $aRow["period_name_show"] = htmlspecialchars($aRow["period_name_show"]);
      $oSmarty->append("aContentList", $aRow);    }
  }
  $oResult->close();

  if(!empty($aContentTotal) and $aSearch["stat_type_id"] != 5)
  {  	$aContentTotal["period_name_show"] = "Всего";

  	if($bExcelEnabled)
    {
      $iColumn = 0;
      $iRow++;

      foreach($aFields as $sKey => $sValue)
      {
        $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aContentTotal[$sKey]);
        $iColumn++;
      }
    }
    else
    {
      $oSmarty->append("aContentList", $aContentTotal);
    }  }
}

if($bExcelEnabled)
{
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="stat_04_' . date("Y_m_d_H_i_s") . '.xlsx"');

  $oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
  $oWriter->save('php://output');
}
else
{
  $oSmarty->assign("aSearch", $aSearch);

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления. Статистика по датам создания.";
  $aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_stat_04.js");

  $aMenu["stat"]["active"] = true;
  $aMenu["stat"]["items"]["stat_04"]["active"] = true;

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->assign("aMenu", $aMenu);
  $oSmarty->assign("sInnerPage", "backend_stat_04");
  $oSmarty->display("backend_main.tpl");
}

?>