<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$iContentId = 0;

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  ov.option_value_id,
  ov.option_value,
  ov.option_value_small,
  ov.option_value_comment,
  ov.option_value_help,
  ov.option_order,
  o.option_name
FROM
  " . DB_PREFIX . "option_values AS ov
  INNER JOIN " . DB_PREFIX . "options AS o ON ov.option_id = o.option_id
WHERE
  ov.option_value_id = " . $_GET["content_id"] . "
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $aRow["option_name"] = htmlspecialchars($aRow["option_name"]);
      $aRow["option_value"] = htmlspecialchars($aRow["option_value"]);
      $aRow["option_value_small"] = htmlspecialchars($aRow["option_value_small"]);
      $aRow["option_value_comment"] = htmlspecialchars($aRow["option_value_comment"]);
      $aRow["option_value_help"] = htmlspecialchars($aRow["option_value_help"]);

      $oSmarty->assign("aContentData", $aRow);

      $iContentId = $aRow["option_value_id"];
    }
    $oResult->close();
  }
}

if($iContentId === 0)
{
  $sSql = "SELECT
  o.option_id,
  o.option_name
FROM
  " . DB_PREFIX . "options AS o
ORDER BY
  o.option_order,
  o.option_name";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      $aRow["option_name"] = htmlspecialchars($aRow["option_name"]);

      $oSmarty->append("aOptions", $aRow);
    }
    $oResult->close();
  }
}

vSetFormErrors($oSmarty);

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Справочники.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_option_values.js");

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["option_values"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_option_values_view");
$oSmarty->display("backend_main.tpl");

?>