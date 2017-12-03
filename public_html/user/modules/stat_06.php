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
  $oExcel->getActiveSheet()->setTitle("stat_06");
  $oPage = $oExcel->getActiveSheet();

  $aFields = array();
  $aFields["city_name"] = "Город";
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

$sCurrentDate = date("Y-m-d");

$sSql = "SELECT
  COALESCE(c.city_name, 'город не установлен') AS city_name,
  SUM(t.leaders_count_1) AS leaders_count_1,
  SUM(t.leaders_count_2) AS leaders_count_2,
  SUM(t.leaders_count_3) AS leaders_count_3,
  SUM(t.leaders_count_4_) AS leaders_count_4,
  SUM(t.projects_count_1) AS projects_count_1
FROM
  ((SELECT
    COALESCE(l.city_id, '') AS city_id,
    SUM(IF(l.leader_interview_date <= '" . $sCurrentDate . "', 1, 0)) AS leaders_count_1,
    SUM(IF(l.leader_interview_date > '" . $sCurrentDate . "', 1, 0)) AS leaders_count_2,
    SUM(IF(l.leader_interview_date IS NULL, 1, 0)) AS leaders_count_3,
    COUNT(l.leader_id) AS leaders_count_4_,
    0 AS projects_count_1
  FROM
    " . DB_PREFIX . "leaders AS l
  WHERE
    " . implode(" AND
    ", $aWhereLeaders) . "
  GROUP BY
    l.city_id)
  UNION ALL
  (SELECT
    COALESCE(p.city_id, '') AS city_id,
    0 AS leaders_count_1,
    0 AS leaders_count_2,
    0 AS leaders_count_3,
    0 AS leaders_count_4_,
    COUNT(p.project_id) AS projects_count_1
  FROM
    " . DB_PREFIX . "projects AS p
  WHERE
    " . implode(" AND
    ", $aWhereProjects) . "
  GROUP BY
    p.city_id)) AS t
  LEFT JOIN " . DB_PREFIX . "cities AS c ON t.city_id = c.city_id
GROUP BY
  c.city_id
ORDER BY
  leaders_count_4 DESC,
  c.city_name";
if($oResult = $oDB->query($sSql))
{
  $aContentTotal = array();

  while($aRow = $oResult->fetch_assoc())
  {
    foreach($aRow as $sKey => $iValue)
    {      if($sKey !== "city_name")
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
    {      $aRow["city_name"] = htmlspecialchars($aRow["city_name"]);
      $oSmarty->append("aContentList", $aRow);    }
  }
  $oResult->close();

  if(!empty($aContentTotal))
  {  	$aContentTotal["city_name"] = "Всего";

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
  header('Content-Disposition: attachment;filename="stat_06_' . date("Y_m_d_H_i_s") . '.xlsx"');

  $oWriter = PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
  $oWriter->save('php://output');
}
else
{
  $oSmarty->assign("aSearch", $aSearch);

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления. Статистика по городам.";
  $aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_stat_06.js");

  $aMenu["stat"]["active"] = true;
  $aMenu["stat"]["items"]["stat_06"]["active"] = true;

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->assign("aMenu", $aMenu);
  $oSmarty->assign("sInnerPage", "backend_stat_06");
  $oSmarty->display("backend_main.tpl");
}

?>