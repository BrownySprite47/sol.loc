<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$iContentId = 0;

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  p.project_id,
  p.project_create_datetime,
  p.project_name,
  p.project_name_small,
  p.project_create_backend_user_id,
  p.project_name_code,
  COALESCE(p.project_interview_backend_user_id, '') AS project_interview_backend_user_id,
  COALESCE(p.project_write_backend_user_id, '') AS project_write_backend_user_id,
  COALESCE(p.project_interview_date, '') AS project_interview_date,
  COALESCE(t.transaction_id, '') AS transaction_id,
  COALESCE(t.transaction_create_datetime, '') AS transaction_create_datetime,
  COALESCE(t.backend_user_id, '') AS transaction_backend_user_id,
  p.project_enabled,
  p.project_text,
  p.project_site,
  COALESCE(l.leader_id, '') AS leader_id,
  COALESCE(l.leader_surname, '') AS leader_surname,
  COALESCE(l.leader_name, p.leader_name) AS leader_name,
  COALESCE(l.leader_patronymic, '') AS leader_patronymic,
  p.project_area,
  p.project_question_01,
  p.project_question_02,
  COALESCE(p.project_question_03, '') AS project_question_03,
  p.project_question_04,
  p.project_question_05,
  p.project_question_06,
  p.project_question_07,
  p.project_question_08,
  p.project_question_09,
  p.project_question_10,
  p.project_question_11,
  COALESCE(p.project_question_12, '') AS project_question_12,
  COALESCE(p.project_question_13, '') AS project_question_13,
  COALESCE(p.project_question_14, '') AS project_question_14,
  COALESCE(p.project_question_15, '') AS project_question_15,
  COALESCE(p.project_question_16, '') AS project_question_16,
  COALESCE(p.project_question_17, '') AS project_question_17,
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
  COALESCE(p.project_question_34, '') AS project_question_34,
  COALESCE(p.project_question_35, '') AS project_question_35,
  COALESCE(p.project_question_36, '') AS project_question_36,
  COALESCE(p.project_question_37, '') AS project_question_37,
  COALESCE(p.project_question_38, '') AS project_question_38,
  COALESCE(p.project_question_39, '') AS project_question_39,
  COALESCE(p.project_question_40, '') AS project_question_40,
  p.project_question_32,
  p.project_question_33,
  COALESCE(p.city_id, '') AS city_id,
  p.project_city_name,
  COALESCE(p.project_start_date, '') AS project_start_date,
  COALESCE(p.project_question_41, '') AS project_question_41,
  COALESCE(p.project_question_42, '') AS project_question_42,
  p.project_question_43,
  p.project_question_44,
  p.project_question_45,
  p.project_question_46,
  p.project_question_47
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON p.transaction_id = t.transaction_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON p.leader_id = l.leader_id
WHERE
  p.project_id = " . $_GET["content_id"] . "
GROUP BY
  p.project_id
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $iContentId = $aRow["project_id"];

      $aRow["project_name"] = htmlspecialchars($aRow["project_name"]);
      $aRow["project_name_small"] = htmlspecialchars($aRow["project_name_small"]);
      $aRow["project_name_code"] = htmlspecialchars($aRow["project_name_code"]);
      $aRow["project_text"] = htmlspecialchars($aRow["project_text"]);
      $aRow["project_site"] = htmlspecialchars($aRow["project_site"]);
      $aRow["project_city_name"] = htmlspecialchars($aRow["project_city_name"]);
      $aRow["leader_surname"] = htmlspecialchars($aRow["leader_surname"]);
      $aRow["leader_name"] = htmlspecialchars($aRow["leader_name"]);
      $aRow["leader_patronymic"] = htmlspecialchars($aRow["leader_patronymic"]);
      $aRow["project_area"] = htmlspecialchars($aRow["project_area"]);
      $aRow["project_question_01"] = htmlspecialchars($aRow["project_question_01"]);
      $aRow["project_question_02"] = htmlspecialchars($aRow["project_question_02"]);
      $aRow["project_question_04"] = htmlspecialchars($aRow["project_question_04"]);
      $aRow["project_question_05"] = htmlspecialchars($aRow["project_question_05"]);
      $aRow["project_question_06"] = htmlspecialchars($aRow["project_question_06"]);
      $aRow["project_question_07"] = htmlspecialchars($aRow["project_question_07"]);
      $aRow["project_question_08"] = htmlspecialchars($aRow["project_question_08"]);
      $aRow["project_question_09"] = htmlspecialchars($aRow["project_question_09"]);
      $aRow["project_question_10"] = htmlspecialchars($aRow["project_question_10"]);
      $aRow["project_question_11"] = htmlspecialchars($aRow["project_question_11"]);
      $aRow["project_question_32"] = htmlspecialchars($aRow["project_question_32"]);
      $aRow["project_question_33"] = htmlspecialchars($aRow["project_question_33"]);
      $aRow["project_question_43"] = htmlspecialchars($aRow["project_question_43"]);
      $aRow["project_question_44"] = htmlspecialchars($aRow["project_question_44"]);
      $aRow["project_question_45"] = htmlspecialchars($aRow["project_question_45"]);
      $aRow["project_question_46"] = htmlspecialchars($aRow["project_question_46"]);
      $aRow["project_question_47"] = htmlspecialchars($aRow["project_question_47"]);
      $aRow["project_question_18"] = htmlspecialchars($aRow["project_question_18"]);
      $aRow["project_question_19"] = htmlspecialchars($aRow["project_question_19"]);
      $aRow["project_question_20"] = htmlspecialchars($aRow["project_question_20"]);
      $aRow["project_question_21"] = htmlspecialchars($aRow["project_question_21"]);
      $aRow["project_question_22"] = htmlspecialchars($aRow["project_question_22"]);
      $aRow["project_question_23"] = htmlspecialchars($aRow["project_question_23"]);
      $aRow["project_question_24"] = htmlspecialchars($aRow["project_question_24"]);
      $aRow["project_question_25"] = htmlspecialchars($aRow["project_question_25"]);
      $aRow["project_question_26"] = htmlspecialchars($aRow["project_question_26"]);
      $aRow["project_question_27"] = htmlspecialchars($aRow["project_question_27"]);
      $aRow["project_question_28"] = htmlspecialchars($aRow["project_question_28"]);
      $aRow["project_question_29"] = htmlspecialchars($aRow["project_question_29"]);
      $aRow["project_question_30"] = htmlspecialchars($aRow["project_question_30"]);
      $aRow["project_question_31"] = htmlspecialchars($aRow["project_question_31"]);

      $oSmarty->assign("aContentData", $aRow);

      $sSql = "SELECT
  lp.leader_project_id,
  lp.leader_role,
  lp.leader_order,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(l.leader_id, '') AS leader_id,
  COALESCE(l.leader_surname, lp.leader_surname, '') AS leader_surname,
  COALESCE(l.leader_name, lp.leader_name, '') AS leader_name,
  COALESCE(l.leader_patronymic, lp.leader_patronymic, '') AS leader_patronymic
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
WHERE
  lp.project_id = " . $iContentId . "
ORDER BY
  lp.leader_order,
  lp.leader_surname,
  lp.leader_name,
  lp.leader_patronymic,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_create_datetime,
  l.leader_id";
      if($oLeadersResult = $oDB->query($sSql))
      {
        while($aLeadersRow = $oLeadersResult->fetch_assoc())
        {
          $aLeadersRow["leader_role"] = htmlspecialchars($aLeadersRow["leader_role"]);
          $aLeadersRow["leader_surname"] = htmlspecialchars($aLeadersRow["leader_surname"]);
          $aLeadersRow["leader_name"] = htmlspecialchars($aLeadersRow["leader_name"]);
          $aLeadersRow["leader_patronymic"] = htmlspecialchars($aLeadersRow["leader_patronymic"]);

          $oSmarty->append("aLeaders", $aLeadersRow);
        }
        $oLeadersResult->close();
      }
    }
    $oResult->close();
  }
}

vSetFormErrors($oSmarty);

$sSql = "SELECT
  c.city_id,
  c.city_name
FROM
  " . DB_PREFIX . "cities AS c
ORDER BY
  c.city_order,
  c.city_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["city_name"] = htmlspecialchars($aRow["city_name"]);

    $oSmarty->append("aCities", $aRow);
  }
  $oResult->close();
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

    $aBackendUsers[$aRow["backend_user_id"]] = $aRow;
  }
  $oResult->close();
}

if(!empty($aBackendUsers))
{
  $oSmarty->assign("aBackendUsers", $aBackendUsers);
}

$aOptions = array();

$sSql = "SELECT
  o.option_id,
  o.option_type_id,
  o.option_multi_enabled,
  GROUP_CONCAT(ov.option_value_id ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_value_id,
  GROUP_CONCAT(ov.option_value ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_value,
  GROUP_CONCAT(IF(cov.option_value_id IS NULL, 0, 1) ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_selected
FROM
  " . DB_PREFIX . "options AS o
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON o.option_id = ov.option_id
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    cov.content_id = " . $iContentId . " AND
    cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
    ov.option_value_id = cov.option_value_id AND
    o.option_multi_enabled = 1
WHERE
  o.option_id IN (2, 5, 6, 7, 8, 9, 10, 11, 12)
GROUP BY
  o.option_id
ORDER BY
  o.option_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aOptionValueId = explode("###", $aRow["option_value_id"]);
    $aOptionValue = explode("###", $aRow["option_value"]);
    $aOptionSelected = explode("###", $aRow["option_selected"]);

    unset($aRow["option_value_id"]);
    unset($aRow["option_value"]);
    unset($aRow["option_selected"]);

    foreach($aOptionValueId as $iTemp => $iOptionValueId)
    {      $aRow["option_value"][$iOptionValueId] = array("option_value_id" => $iOptionValueId, "option_value" => $aOptionValue[$iTemp], "option_selected" => $aOptionSelected[$iTemp]);    }

    $aOptions[$aRow["option_id"]] = $aRow;
  }
  $oResult->close();
}

if(!empty($aOptions))
{
  $oSmarty->assign("aOptions", $aOptions);
}

if(isset($_GET["leader_id"]) and bIsInt($_GET["leader_id"], 1) and $iContentId === 0)
{  $sSql = "SELECT
  l.leader_id,
  l.leader_interview_date AS project_interview_date,
  l.leader_interview_backend_user_id AS project_interview_backend_user_id
FROM
  " . DB_PREFIX . "leaders AS l
WHERE
  l.leader_id = " . $_GET["leader_id"] . "
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $oSmarty->assign("aContentDataDefault", $aRow);
    }
    $oResult->close();
  }}

$oSmarty->assign("iBackendUserId", $aBackendUserInfo["backend_user_id"]);
$oSmarty->assign("bLeaderProjectDeleteEnabled", isset($aBackendUserInfo["backend_access_types"]["leader_project_delete_enabled"]));

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Проекты ЛИСС.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_projects.js");

$aMenu["projects"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_projects_view");
$oSmarty->display("backend_main.tpl");

?>