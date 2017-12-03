<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  r.region_id,
  r.region_name,
  r.region_comment,
  r.region_order
FROM
  " . DB_PREFIX . "regions AS r
WHERE
  r.region_id = " . $_GET["content_id"] . "
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $aRow["region_name"] = htmlspecialchars($aRow["region_name"]);
      $aRow["region_comment"] = htmlspecialchars($aRow["region_comment"]);

      $oSmarty->assign("aContentData", $aRow);
    }
    $oResult->close();
  }
}

vSetFormErrors($oSmarty);

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Регионы.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_regions.js");

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["regions"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_regions_view");
$oSmarty->display("backend_main.tpl");

?>