<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$aSearch = array();
$aSearch["date_from"] = "";
$aSearch["date_to"] = "";
$aSearch["search_text"] = "";
$aSearch["leader_enabled_type_id"] = "";
$aSearch["leader_high_priority_type_id"] = "";
$aSearch["leader_interview_date_type_id"] = "";
$aSearch["leader_interview_backend_user_id"] = "";

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
  $aWhere[] = "l.leader_create_date >= '" . $aSearch["date_from"] . "'";
}

if($aSearch["date_to"] !== "")
{
  $aWhere[] = "l.leader_create_date <= '" . $aSearch["date_to"] . "'";
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
  	  $aTemp[] = "l.leader_id = " . $_GET["search_text"];
  	  $aTemp[] = "p_search.project_id = " . $_GET["search_text"];
  	}

  	if(mb_strlen($_GET["search_text"], "utf-8") > 2)
  	{
  	  $aTemp[] = "l.leader_surname LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "l.leader_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "l.leader_patronymic LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "l.leader_email LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "l.leader_phone LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "lp_search.project_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "p_search.project_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "l.leader_city_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "c.city_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	  $aTemp[] = "bu.backend_user_name LIKE '%" . $oDB->escape_string($_GET["search_text"]) . "%'";
  	}

  	$aWhere[] = "(" . implode(" OR ", $aTemp) . ")";
  	$sJoin .= "
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp_search ON l.leader_id = lp_search.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p_search ON lp_search.project_id = p_search.project_id";
  }
}

if(isset($_GET["leader_enabled_type_id"]) and bIsInt($_GET["leader_enabled_type_id"], 1, 3))
{
  $aSearch["leader_enabled_type_id"] = $_GET["leader_enabled_type_id"];
}
else
{
  $aSearch["leader_enabled_type_id"] = "2";
}

switch($aSearch["leader_enabled_type_id"])
{
  case "1":
  {
  	break;
  }

  case "2":
  {
  	$aWhere[] = "l.leader_enabled = 1";
  	break;
  }

  case "3":
  {
  	$aWhere[] = "l.leader_enabled = 0";
  	break;
  }
}

if(isset($_GET["leader_done_type_id"]) and bIsInt($_GET["leader_done_type_id"], 1, 3))
{
  $aSearch["leader_done_type_id"] = $_GET["leader_done_type_id"];
}
else
{
  $aSearch["leader_done_type_id"] = "1";
}

switch($aSearch["leader_done_type_id"])
{
  case "1":
  {
  	break;
  }

  case "2":
  {
  	$aWhere[] = "l.leader_done = 1";
  	break;
  }

  case "3":
  {
  	$aWhere[] = "l.leader_done = 0";
  	break;
  }
}

if(isset($_GET["leader_high_priority_type_id"]) and bIsInt($_GET["leader_high_priority_type_id"], 1, 3))
{
  $aSearch["leader_high_priority_type_id"] = $_GET["leader_high_priority_type_id"];

  if($aSearch["leader_high_priority_type_id"] == "2")
  {
  	$aWhere[] = "l.leader_high_priority = 1";
  }
  else
  {
  	if($aSearch["leader_high_priority_type_id"] == "3")
    {
  	  $aWhere[] = "l.leader_high_priority = 0";
    }
  }
}
else
{
  $aSearch["leader_high_priority_type_id"] = "1";
}

if(isset($_GET["leader_interview_date_type_id"]) and bIsInt($_GET["leader_interview_date_type_id"], 1, 5))
{
  $aSearch["leader_interview_date_type_id"] = $_GET["leader_interview_date_type_id"];

  switch($aSearch["leader_interview_date_type_id"])
  {
  	case "1":
  	{
  	  break;
  	}

  	case "2":
  	{
  	  $aWhere[] = "l.leader_interview_date < '" . date("Y-m-d") . "'";
  	  $aWhere[] = "l.leader_interview_date IS NOT NULL";
  	  break;
  	}

  	case "3":
  	{
  	  $aWhere[] = "l.leader_interview_date = '" . date("Y-m-d") . "'";
  	  break;
  	}

  	case "4":
  	{
  	  $aWhere[] = "l.leader_interview_date > '" . date("Y-m-d") . "'";
  	  $aWhere[] = "l.leader_interview_date IS NOT NULL";
  	  break;
  	}

  	case "5":
  	{
  	  $aWhere[] = "l.leader_interview_date IS NULL";
  	  break;
  	}
  }
}
else
{
  $aSearch["leader_interview_date_type_id"] = "1";
}

if(isset($_GET["leader_interview_backend_user_id"]) and bIsInt($_GET["leader_interview_backend_user_id"], 0))
{
  if($_GET["leader_interview_backend_user_id"] === "0")
  {
  	$aWhere[] = "l.leader_interview_backend_user_id IS NULL";
  }
  else
  {
  	$aWhere[] = "l.leader_interview_backend_user_id = " . $_GET["leader_interview_backend_user_id"];
  }

  $aSearch["leader_interview_backend_user_id"] = $_GET["leader_interview_backend_user_id"];
}



if(isset($_GET["leader_done_1"]) && $_GET["leader_done_1"] === "on")
  {
    $leader_done_1 = '1';
    $aWhere[] = "l.leader_done_1 = 1";
  }
  else
  {
    $leader_done_1 = '0';
    //$aWhere[] = "l.leader_done_1 = 0";
  }

  if(isset($_GET["leader_done_2"]) && $_GET["leader_done_2"] === "on")
  {
    $leader_done_2 = '1';
    $aWhere[] = "l.leader_done_2 = 1";
  }
  else
  {
    $leader_done_2 = '0';
    //$aWhere[] = "l.leader_done_2 = 0";
  }

  if(isset($_GET["leader_done_3"]) && $_GET["leader_done_3"] === "on")
  {
    $leader_done_3 = '1';
    $aWhere[] = "l.leader_done_3 = 1";
  }
  else
  {
    $leader_done_3 = '0';
    //$aWhere[] = "l.leader_done_3 = 0";
  }

  if(isset($_GET["leader_done_4"]) && $_GET["leader_done_4"] === "on")
  {
    $leader_done_4 = '1';
    $aWhere[] = "l.leader_done_4 = 1";
  }
  else
  {
    $leader_done_4 = '0';
    //$aWhere[] = "l.leader_done_4 = 0";
  }

  $aSearch["leader_done_1"] = $leader_done_1;
  $aSearch["leader_done_2"] = $leader_done_2;
  $aSearch["leader_done_3"] = $leader_done_3;
  $aSearch["leader_done_4"] = $leader_done_4;










$oSmarty->assign("aSearch", $aSearch);

$aOV4Enabled = array();

if(isset($_GET["ov_4"]) and is_array($_GET["ov_4"]))
{
  foreach($_GET["ov_4"] as $iOptionValueId)
  {
  	if(bIsInt($iOptionValueId, 1))
  	{
  	  $aOV4Enabled[] = $iOptionValueId;
  	}
  }
}

if(empty($aOV4Enabled))
{
  $sOV4Checked = "0";
}
else
{
  $sOV4Checked = "IF(ov.option_value_id IN (" . implode(", ", $aOV4Enabled) . "), 1, 0)";
}

$aOV4All = array();
$aOV4Checked = array();

$sSql = "SELECT
  ov.option_value_id,
  ov.option_value,
  " . $sOV4Checked . " AS option_value_checked
FROM
  " . DB_PREFIX . "option_values AS ov
WHERE
  ov.option_id = 4
ORDER BY
  ov.option_order,
  ov.option_value";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["option_value"] = htmlspecialchars($aRow["option_value"]);

    $aOV4All[] = $aRow["option_value_id"];

    if($aRow["option_value_checked"] == 1)
    {
      $aOV4Checked[] = $aRow["option_value_id"];
    }

    $oSmarty->append("aOV4", $aRow);
  }
  $oResult->close();
}

if(count($aOV4Checked) > 0 and count($aOV4All) !== count($aOV4Checked))
{
  $sJoin .= "
  INNER JOIN " . DB_PREFIX . "contents_option_values AS cov_search ON
    l.leader_id = cov_search.content_id AND
    cov_search.content_type_id = " . LEADER_CONTENT_TYPE_ID . " AND
    cov_search.option_value_id IN (" . implode(", ", $aOV4Checked) . ")";
}

if(empty($aOV4All))
{
  $aOV4All[] = 0;
}

$iContentOnPage = cConstants::sGetConstant("LEADERS_ON_BACKEND_PAGE");
$iMaxPage = 1;

$sSql = "SELECT
  COUNT(DISTINCT l.leader_id) AS content_count
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu ON l.leader_interview_backend_user_id = bu.backend_user_id
  LEFT JOIN " . DB_PREFIX . "cities AS c ON l.city_id = c.city_id" . $sJoin . "
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

$aOrderTypes[1] = "l.leader_create_datetime, l.leader_id";
$aOrderTypes[2] = "l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[3] = "l.leader_surname, l.leader_name, l.leader_patronymic, l.leader_create_datetime, l.leader_id";
$aOrderTypes[4] = "l.leader_surname DESC, l.leader_name DESC, l.leader_patronymic DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[5] = "c.city_name, city_name_show, l.leader_create_datetime, l.leader_id";
$aOrderTypes[6] = "c.city_name DESC, city_name_show DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[7] = "l.leader_interview_date, l.leader_create_datetime, l.leader_id";
$aOrderTypes[8] = "l.leader_interview_date DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[9] = "project_names, l.leader_create_datetime, l.leader_id";
$aOrderTypes[10] = "project_names DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[11] = "leader_option_4, l.leader_create_datetime, l.leader_id";
$aOrderTypes[12] = "leader_option_4 DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[13] = "recommendations_to_count, l.leader_create_datetime, l.leader_id";
$aOrderTypes[14] = "recommendations_to_count DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[15] = "recommendations_from_count, l.leader_create_datetime, l.leader_id";
$aOrderTypes[16] = "recommendations_from_count DESC, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[17] = "l.leader_high_priority DESC, l.leader_create_datetime, l.leader_id";
$aOrderTypes[18] = "l.leader_high_priority, l.leader_create_datetime DESC, l.leader_id DESC";
$aOrderTypes[19] = "leader_interview_backend_user_name, l.leader_create_datetime, l.leader_id";
$aOrderTypes[20] = "leader_interview_backend_user_name DESC, l.leader_create_datetime DESC, l.leader_id DESC";

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
  l.leader_id,
  l.leader_create_datetime,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  IF(c.city_id IS NULL, l.leader_city_name, CONCAT(c.city_name, IF(l.leader_city_name = '', '', CONCAT(' (', l.leader_city_name, ')')))) AS city_name_show,
  COALESCE(l.leader_interview_date, '') AS leader_interview_date,
  l.leader_done,
  l.leader_enabled,
  COUNT(DISTINCT IF(r.leader_id_from = l.leader_id, r.recommendation_id, NULL)) AS recommendations_from_count,
  COUNT(DISTINCT IF(r.leader_id_to = l.leader_id, r.recommendation_id, NULL)) AS recommendations_to_count,
  COALESCE(GROUP_CONCAT(DISTINCT IF(cov.option_value_id IS NULL, NULL, IF(ov_4.option_value_small = '', ov_4.option_value, ov_4.option_value_small)) ORDER BY ov_4.option_order, ov_4.option_value SEPARATOR ', '), '') AS leader_option_4,
  COALESCE(IF(ov_1.option_value_small = '', ov_1.option_value, ov_1.option_value_small), '') AS leader_option_1,
  COALESCE(bu.backend_user_name, '') AS leader_interview_backend_user_name,
  COALESCE(GROUP_CONCAT(DISTINCT CONCAT(COALESCE(p.project_name, lp.project_name), '___', COALESCE(p.project_id, 0)) ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id SEPARATOR '###'), '') AS project_names,
  l.leader_question_21,
  SUBSTRING(l.leader_question_21, 1, " . cConstants::sGetConstant("MAX_SYMBOLS_COUNT_IN_COMMENT") . ") AS leader_question_21_small,
  l.leader_high_priority,
  l.leader_email
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "cities AS c ON l.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu ON l.leader_interview_backend_user_id = bu.backend_user_id
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_1 ON
    l.leader_interview_type = ov_1.option_value_id AND
    ov_1.option_id = 1
  LEFT JOIN " . DB_PREFIX . "recommendations AS r ON l.leader_id IN (r.leader_id_from, r.leader_id_to)
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    l.leader_id = cov.content_id AND
    cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . " AND
    cov.option_value_id IN (" . implode(", ", $aOV4All) . ")
  LEFT JOIN " . DB_PREFIX . "option_values AS ov_4 ON cov.option_value_id = ov_4.option_value_id
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON l.leader_id = lp.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id" . $sJoin . "
WHERE
  " . implode(" AND
  ", $aWhere) . "
GROUP BY
  l.leader_id
ORDER BY
  " . $aOrderTypes[$iCurrentOrder] . "
LIMIT
  " . (($iCurrentPage - 1) * $iContentOnPage) . ", " . $iContentOnPage;
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["leader_surname"] = htmlspecialchars($aRow["leader_surname"]);
    $aRow["leader_name"] = htmlspecialchars($aRow["leader_name"]);
    $aRow["leader_patronymic"] = htmlspecialchars($aRow["leader_patronymic"]);
    $aRow["city_name_show"] = htmlspecialchars($aRow["city_name_show"]);
    $aRow["leader_option_1"] = htmlspecialchars($aRow["leader_option_1"]);
    $aRow["leader_option_4"] = htmlspecialchars($aRow["leader_option_4"]);
    $aRow["leader_interview_backend_user_name"] = htmlspecialchars($aRow["leader_interview_backend_user_name"]);
    $aRow["leader_question_21"] = htmlspecialchars($aRow["leader_question_21"]);
    $aRow["leader_question_21_small"] = htmlspecialchars($aRow["leader_question_21_small"]);

    if($aRow["project_names"] !== "")
    {
      $aProjects = array();

      $aTemp = explode("###", $aRow["project_names"]);
      unset($aRow["project_names"]);

      foreach($aTemp as $sTemp)
      {
      	$aProjectTemp = explode("___", $sTemp);

      	if(count($aProjectTemp) === 2)
      	{
      	  $aProjects[] = array("project_name" => htmlspecialchars($aProjectTemp[0]), "project_id" => $aProjectTemp[1]);
      	}
      }

      $aRow["projects"] = $aProjects;
    }

    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_name
FROM
  " . DB_PREFIX . "backend_users AS bu
  INNER JOIN " . DB_PREFIX . "leaders AS l ON bu.backend_user_id = l.leader_interview_backend_user_id
GROUP BY
  bu.backend_user_id
ORDER BY
  bu.backend_user_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["backend_user_name"] = htmlspecialchars($aRow["backend_user_name"]);

    $oSmarty->append("aLeaderInterviewBackendUsers", $aRow);
  }
  $oResult->close();
}

$oSmarty->assign("bLeadersEdit", isset($aBackendUserInfo["backend_access_types"]["leaders_edit"]));

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Лидеры ЛИСС.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_leaders_list.js", PROJECT_BACKEND_URL . "js/clipboard.min.js");

$aMenu["leaders"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_leaders_list");
$oSmarty->display("backend_main.tpl");

?>