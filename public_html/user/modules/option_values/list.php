<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$sSql = "SELECT
  o.option_id,
  o.option_name,
  o.option_comment,
  ot.option_type_name,
  o.option_multi_enabled
FROM
  " . DB_PREFIX . "options AS o
  INNER JOIN " . DB_PREFIX . "option_types AS ot ON o.option_type_id = ot.option_type_id
ORDER BY
  o.option_order,
  o.option_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["option_name"] = htmlspecialchars($aRow["option_name"]);
    $aRow["option_type_name"] = htmlspecialchars($aRow["option_type_name"]);
    $aRow["option_comment"] = htmlspecialchars($aRow["option_comment"]);

    $oSmarty->append("aOptions", $aRow);
  }
  $oResult->close();
}

$aOptionValues = array();

$sSql = "SELECT
  ov.option_value_id,
  ov.option_value,
  ov.option_id,
  COUNT(DISTINCT IF(cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . ", cov.content_id, NULL)) + COUNT(DISTINCT l.leader_id) AS leaders_count,
  COUNT(DISTINCT IF(cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . ", cov.content_id, NULL)) + COUNT(DISTINCT p.project_id) AS projects_count
FROM
  " . DB_PREFIX . "option_values AS ov
  INNER JOIN " . DB_PREFIX . "options AS o ON ov.option_id = o.option_id
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    ov.option_value_id = cov.option_value_id AND
    o.option_multi_enabled = 1
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON
    ov.option_value_id IN (l.leader_interview_type, l.leader_question_08, l.leader_question_09) AND
    o.option_multi_enabled = 0
  LEFT JOIN " . DB_PREFIX . "projects AS p ON
    ov.option_value_id IN (p.project_question_12, p.project_question_13, p.project_question_14, p.project_question_15, p.project_question_16, p.project_question_17, p.project_question_40, p.project_question_41, p.project_question_42) AND
    o.option_multi_enabled = 0
GROUP BY
  ov.option_value_id
ORDER BY
  ov.option_order,
  ov.option_value,
  o.option_order,
  o.option_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    if(!isset($aOptionValues[$aRow["option_id"]]))
    {      $aOptionValues[$aRow["option_id"]] = array();    }

    $aRow["option_value"] = htmlspecialchars($aRow["option_value"]);

    $aOptionValues[$aRow["option_id"]][] = $aRow;
  }
  $oResult->close();
}

$oSmarty->assign("aOptionValues", $aOptionValues);

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Справочники.";

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["option_values"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_option_values_list");
$oSmarty->display("backend_main.tpl");
?>