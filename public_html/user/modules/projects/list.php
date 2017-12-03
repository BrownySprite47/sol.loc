<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$aSearch = array();
$aSearch["date_from"] = "";
$aSearch["date_to"] = "";
$aSearch["project_area_enabled"] = 0;
$aSearch["search_text"] = "";

$aWhere = array();
$aWhere[] = "TRUE";
$sJoin = "";

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
  $aWhere[] = "p.project_create_datetime >= '" . $aSearch["date_from"] . "'";
}

if($aSearch["date_to"] !== "")
{
  $aWhere[] = "p.project_create_datetime < '" . $aSearch["date_to"] . "' + INTERVAL 1 DAY";
}

if(isset($_GET["search_text"]))
{
  if(get_magic_quotes_gpc())
  {
    $_GET["search_text"] = stripslashes($_GET["search_text"]);
  }
  $_GET["search_text"] = trim($_GET["search_text"]);

  if(bIsInt($_GET["search_text"], 1) or mb_strlen($_GET["search_text"], "utf-8") > 2)
  {
  	$aSearch["search_text"] = htmlspecialchars($_GET["search_text"]);

  	$aTemp = array();

  	if(bIsInt($_GET["search_text"], 1))
  	{
  	  $aTemp[] = "p.project_id = " . $_GET["search_text"];
  	}

  	if(mb_strlen($_GET["search_text"], "utf-8") > 2)
  	{
  	  $aTemp[] = "p.project_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "p.project_name_small LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "p.project_name_code LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "p.project_city_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "c.city_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	}

  	$aWhere[] = "(" . implode(" OR ", $aTemp) . ")";
  }
}

if(isset($_GET["project_enabled_type_id"]) and bIsInt($_GET["project_enabled_type_id"], 1, 3))
{
  $aSearch["project_enabled_type_id"] = $_GET["project_enabled_type_id"];
}
else
{
  $aSearch["project_enabled_type_id"] = "2";
}

switch($aSearch["project_enabled_type_id"])
{
  case "1":
  {
  	break;
  }

  case "2":
  {
  	$aWhere[] = "p.project_enabled = 1";
  	break;
  }

  case "3":
  {
  	$aWhere[] = "p.project_enabled = 0";
  	break;
  }
}

if(isset($_GET["project_area_enabled"]) and $_GET["project_area_enabled"] == "1")
{  $aSearch["project_area_enabled"] = 1;}

$oSmarty->assign("aSearch", $aSearch);

$aOptionIds = array(5, 9, 11, 12);
$aOVChecked = array();
$aOVCheckedSql = array();
$aOVCheckedSql[] = "FALSE";

foreach($aOptionIds as $iOptionId)
{  $aOVChecked[$iOptionId] = array();

  if(isset($_GET["ov_" . $iOptionId]) and is_array($_GET["ov_" . $iOptionId]))
  {  	foreach($_GET["ov_" . $iOptionId] as $iOptionValueId)
  	{  	  if(bIsInt($iOptionValueId, 1))
  	  {  	  	$aOVChecked[$iOptionId][] = $iOptionValueId;  	  }  	}  }

  if(!empty($aOVChecked[$iOptionId]))
  {  	$aOVCheckedSql[] = "(ov.option_value_id IN (" . implode(", ", $aOVChecked[$iOptionId]) . ") AND ov.option_id = " . $iOptionId . ")";

  	switch($iOptionId)
  	{  	  case 5:
  	  {
        $sJoin .= "
LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov_search ON
  p.project_id = cov_search.content_id AND
  cov_search.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
  cov_search.option_value_id IN (" . implode(", ", $aOVChecked[$iOptionId]) . ")";

        if($aSearch["project_area_enabled"] === 1)
        {
          $aWhere[] = "(cov_search.content_id IS NOT NULL OR p.project_area != '')";        }
        else
        {          $aWhere[] = "cov_search.content_id IS NOT NULL";        }

  	  	break;  	  }

  	  case 9:
  	  {
  	  	$aWhere[] = "p.project_question_40 IN (" . implode(", ", $aOVChecked[$iOptionId]) . ")";

  	  	break;
  	  }

  	  case 11:
  	  {
  	  	$aWhere[] = "p.project_question_41 IN (" . implode(", ", $aOVChecked[$iOptionId]) . ")";

  	  	break;
  	  }

  	  case 12:
  	  {
  	  	$aWhere[] = "p.project_question_42 IN (" . implode(", ", $aOVChecked[$iOptionId]) . ")";

  	  	break;
  	  }  	}  }}

if($aSearch["project_area_enabled"] === 1 and empty($aOVChecked[5]))
{  $aWhere[] = "p.project_area != ''";}

$sSql = "SELECT
  ov.option_id,
  ov.option_value_id,
  ov.option_value,
  IF(" . implode(" OR ", $aOVCheckedSql) . ", 1, 0) AS option_value_checked
FROM
  " . DB_PREFIX . "option_values AS ov
WHERE
  ov.option_id IN (" . implode(", ", $aOptionIds ) . ")
ORDER BY
  ov.option_order,
  ov.option_value";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["option_value"] = htmlspecialchars($aRow["option_value"]);

    $oSmarty->append("aOV" . $aRow["option_id"], $aRow);
  }
  $oResult->close();
}


$iContentOnPage = cConstants::sGetConstant("PROJECTS_ON_BACKEND_PAGE");
$iMaxPage = 1;

$sSql = "SELECT
  COUNT(DISTINCT p.project_id) AS content_count
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "cities AS c ON p.city_id = c.city_id" . $sJoin . "
WHERE
  " . implode(" AND
  ", $aWhere);
if($oResult = $oDB->query($sSql))
{
  if($aRow = $oResult->fetch_assoc())
  {
    $iMaxPage = ceil($aRow["content_count"] / $iContentOnPage);
  }
  $oResult->close();
}

if(isset($_GET["page"]) and bIsInt($_GET["page"], 2, $iMaxPage))
{
  $iCurrentPage = $_GET["page"];
}
else
{
  $iCurrentPage = 1;
}

$oSmarty->assign("iMaxPage", $iMaxPage);
$oSmarty->assign("iCurrentPage", $iCurrentPage);

$aOrderTypes = array();

$aOrderTypes[1] = "p.project_create_datetime, p.project_id";
$aOrderTypes[2] = "p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[3] = "project_name_small_show, p.project_create_datetime, p.project_id";
$aOrderTypes[4] = "project_name_small_show DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[5] = "city_name_show, p.project_create_datetime, p.project_id";
$aOrderTypes[6] = "city_name_show DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[7] = "project_interview_backend_user_name, p.project_create_datetime, p.project_id";
$aOrderTypes[8] = "project_interview_backend_user_name DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[9] = "project_option_11, p.project_create_datetime, p.project_id";
$aOrderTypes[10] = "project_option_11 DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[11] = "project_option_12, p.project_create_datetime, p.project_id";
$aOrderTypes[12] = "project_option_12 DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[13] = "leader_names, p.project_create_datetime, p.project_id";
$aOrderTypes[14] = "leader_names DESC, p.project_create_datetime DESC, p.project_id DESC";
$aOrderTypes[15] = "project_option_5, p.project_area, p.project_create_datetime, p.project_id";
$aOrderTypes[16] = "project_option_5 DESC, p.project_area DESC, p.project_create_datetime DESC, p.project_id DESC";

if(isset($_GET["order"], $aOrderTypes[$_GET["order"]]))
{
  $iCurrentOrder = $_GET["order"];
}
else
{
  $iCurrentOrder = 2;
}

$oSmarty->assign("iCurrentOrder", $iCurrentOrder);

$sSql = "SELECT
  p.project_id,
  IF(p.project_name_small = '', p.project_name, p.project_name_small) AS project_name_small_show,
  p.project_enabled,
  p.project_site,
  IF(c.city_id IS NULL, p.project_city_name, CONCAT(c.city_name, IF(p.project_city_name = '', '', CONCAT(' (', p.project_city_name, ')')))) AS city_name_show,
  COALESCE(bu.backend_user_name, '') AS project_interview_backend_user_name,
  COALESCE(ov_11.option_value, '') AS project_option_11,
  COALESCE(ov_12.option_value, '') AS project_option_12,
  COALESCE(GROUP_CONCAT(DISTINCT CONCAT(COALESCE(CONCAT(l.leader_surname, IF(l.leader_name != '' AND l.leader_name IS NOT NULL, CONCAT(' ', l.leader_name, IF(l.leader_patronymic != '' AND l.leader_patronymic IS NOT NULL, CONCAT(' ', l.leader_patronymic), '')), '')), CONCAT(lp.leader_surname, IF(lp.leader_name != '' AND lp.leader_name IS NOT NULL, CONCAT(' ', lp.leader_name, IF(lp.leader_patronymic != '' AND lp.leader_patronymic IS NOT NULL, CONCAT(' ', lp.leader_patronymic), '')), ''))), '___', COALESCE(l.leader_id, 0)) ORDER BY lp.leader_order, lp.leader_surname, lp.leader_name, lp.leader_patronymic, l.leader_surname, l.leader_name, l.leader_patronymic, l.leader_create_datetime, l.leader_id SEPARATOR '###'), '') AS leader_names,
  p.project_area,
  COALESCE(GROUP_CONCAT(DISTINCT IF(cov.option_value_id IS NULL, NULL, ov_5.option_value) ORDER BY ov_5.option_order, ov_5.option_value SEPARATOR ', '), '') AS project_option_5
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "cities AS c ON p.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu ON p.project_interview_backend_user_id = bu.backend_user_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_11 ON p.project_question_41 = ov_11.option_value_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_12 ON p.project_question_42 = ov_12.option_value_id
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON p.project_id = lp.project_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_5 ON ov_5.option_id = 5
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    p.project_id = cov.content_id AND
    cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
    ov_5.option_value_id = cov.option_value_id" . $sJoin . "
WHERE
  " . implode(" AND
  ", $aWhere) . "
GROUP BY
  p.project_id
ORDER BY
  " . $aOrderTypes[$iCurrentOrder] . "
LIMIT
  " . (($iCurrentPage - 1) * $iContentOnPage) . ", " . $iContentOnPage;
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["project_name_small_show"] = htmlspecialchars($aRow["project_name_small_show"]);
    $aRow["project_site_enabled"] = (int) (strpos($aRow["project_site"], "http://") === 0 or strpos($aRow["project_site"], "https://") === 0);
    $aRow["project_site"] = htmlspecialchars($aRow["project_site"]);
    $aRow["city_name_show"] = htmlspecialchars($aRow["city_name_show"]);
    $aRow["project_option_11"] = htmlspecialchars($aRow["project_option_11"]);
    $aRow["project_option_12"] = htmlspecialchars($aRow["project_option_12"]);
    $aRow["project_interview_backend_user_name"] = htmlspecialchars($aRow["project_interview_backend_user_name"]);

    if($aRow["leader_names"] !== "")
    {
      $aLeaders = array();

      $aTemp = explode("###", $aRow["leader_names"]);
      unset($aRow["leader_names"]);

      foreach($aTemp as $sTemp)
      {
      	$aLeaderTemp = explode("___", $sTemp);

      	if(count($aLeaderTemp) === 2)
      	{
      	  $aLeaders[] = array("leader_name" => htmlspecialchars($aLeaderTemp[0]), "leader_id" => $aLeaderTemp[1]);
      	}
      }

      $aRow["leaders"] = $aLeaders;
    }

    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Проекты ЛИСС.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_projects_list.js");

$aMenu["projects"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_projects_list");
$oSmarty->display("backend_main.tpl");

?>