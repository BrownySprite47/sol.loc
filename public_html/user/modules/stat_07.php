<?php

$bExcelEnabled = isset($_GET["excel_enabled"]);

$oDB = cMyDB::oGetDB("db");

$aSearch = array();
$aSearch["date_from"] = "";
$aSearch["date_to"] = "";

$aWhereLeaders = array();
$aWhereLeaders[] = "TRUE";
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
  $aWhereProjects[] = "p.project_create_datetime >= '" . $aSearch["date_from"] . "'";
}

if($aSearch["date_to"] !== "")
{
  $aWhereLeaders[] = "l.leader_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
  $aWhereProjects[] = "p.project_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
}

if($bExcelEnabled)
{
  require_once LIBS_PATH . "PHPExcel/PHPExcel.php";

  $oExcel = new PHPExcel();
  $oExcel->setActiveSheetIndex(0);
  $oExcel->getActiveSheet()->setTitle("stat_07");
  $oPage = $oExcel->getActiveSheet();

  $aFields = array();
  $aFields["project_option_5"] = "Сфера деятельности";
  $aFields["leaders_count_1"] = "Количество лидеров ЛИСС (интервью пройдено + интервью на сегодня)";
  $aFields["leaders_count_2"] = "Количество лидеров ЛИСС (интервью ожидается)";
  $aFields["leaders_count_3"] = "Количество лидеров ЛИСС (интервью не назначено)";
  $aFields["leaders_count_4"] = "Количество лидеров ЛИСС";
  $aFields["projects_count_1"] = "Количество проектов ЛИСС";

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

$aOptionValues = array();

$sSql = "SELECT
  ov.option_value_id
FROM
  " . DB_PREFIX . "option_values AS ov
WHERE
  ov.option_id = 5
ORDER BY
  ov.option_value_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {  	$aOptionValues[] = $aRow["option_value_id"];  }
  $oResult->close();
}

if(empty($aOptionValues))
{  $aOptionValues[] = 0;}

$sCurrentDate = date("Y-m-d");

$sSql = "SELECT
  COALESCE(ov.option_value, 'сфера не выбрана (или не стандартная)') AS project_option_5,
  SUM(t.leaders_count_1) AS leaders_count_1,
  SUM(t.leaders_count_2) AS leaders_count_2,
  SUM(t.leaders_count_3) AS leaders_count_3,
  SUM(t.leaders_count_4_) AS leaders_count_4,
  SUM(t.projects_count_1) AS projects_count_1
FROM
  ((SELECT
    COALESCE(cov.option_value_id, '') AS project_option_5,
    COUNT(DISTINCT t.leaders_count_1) AS leaders_count_1,
    COUNT(DISTINCT t.leaders_count_2) AS leaders_count_2,
    COUNT(DISTINCT t.leaders_count_3) AS leaders_count_3,
    COUNT(DISTINCT t.leaders_count_4_) AS leaders_count_4_,
    0 AS projects_count_1
  FROM
   (SELECT
     l.leader_id,
     IF(l.leader_interview_date <= '" . $sCurrentDate . "', l.leader_id, NULL) AS leaders_count_1,
     IF(l.leader_interview_date > '" . $sCurrentDate . "', l.leader_id, NULL) AS leaders_count_2,
     IF(l.leader_interview_date IS NULL, l.leader_id, NULL) AS leaders_count_3,
     l.leader_id AS leaders_count_4_,
     COALESCE(GROUP_CONCAT(lp.project_id ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id) + 0, '') AS project_id
   FROM
     " . DB_PREFIX . "leaders AS l
     LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON l.leader_id = lp.leader_id
     LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
   WHERE
     " . implode(" AND
     ", $aWhereLeaders) . "
   GROUP BY
     l.leader_id) AS t
   LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
      t.project_id = cov.content_id AND
      cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
      cov.option_value_id IN (" . implode(", ", $aOptionValues) . ")
  GROUP BY
    project_option_5)
  UNION ALL
  (SELECT
    COALESCE(cov.option_value_id, '') AS project_option_5,
    0 AS leaders_count_1,
    0 AS leaders_count_2,
    0 AS leaders_count_3,
    0 AS leaders_count_4_,
    COUNT(DISTINCT p.project_id) AS projects_count_1
  FROM
    " . DB_PREFIX . "projects AS p
    LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
      p.project_id = cov.content_id AND
      cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
      cov.option_value_id IN (" . implode(", ", $aOptionValues) . ")
  WHERE
    " . implode(" AND
    ", $aWhereProjects) . "
  GROUP BY
    project_option_5)) AS t
  LEFT JOIN " . DB_PREFIX . "option_values AS ov ON
    t.project_option_5 = ov.option_value_id AND
    ov.option_id = 5
GROUP BY
  ov.option_value_id
ORDER BY
  leaders_count_4 DESC,
  ov.option_order,
  ov.option_value";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if($bExcelEnabled)
    {      $iColumn = 0;
      $iRow++;

      foreach($aFields as $sKey => $sValue)
      {
        $oPage->setCellValueByColumnAndRow($iColumn, $iRow, $aRow[$sKey]);
        $iColumn++;
      }    }
    else
    {      $aRow["project_option_5"] = htmlspecialchars($aRow["project_option_5"]);
      $oSmarty->append("aContentList", $aRow);    }
  }
  $oResult->close();
}

if($bExcelEnabled)
{
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="stat_07_' . date("Y_m_d_H_i_s") . '.xlsx"');

  $oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
  $oWriter->save('php://output');
}
else
{
  $oSmarty->assign("aSearch", $aSearch);

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления. Статистика по сферам деятельности.";
  $aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_stat_07.js");

  $aMenu["stat"]["active"] = true;
  $aMenu["stat"]["items"]["stat_07"]["active"] = true;

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->assign("aMenu", $aMenu);
  $oSmarty->assign("sInnerPage", "backend_stat_07");
  $oSmarty->display("backend_main.tpl");
}

?>