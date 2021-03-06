<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  c.city_id,
  c.city_name,
  c.city_comment,
  c.city_order,
  c.region_id
FROM
  " . DB_PREFIX . "cities AS c
WHERE
  c.city_id = " . $_GET["content_id"] . "
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $aRow["city_name"] = htmlspecialchars($aRow["city_name"]);
      $aRow["city_comment"] = htmlspecialchars($aRow["city_comment"]);

      $oSmarty->assign("aContentData", $aRow);
    }
    $oResult->close();
  }
}

vSetFormErrors($oSmarty);

$sSql = "SELECT
  r.region_id,
  r.region_name
FROM
  " . DB_PREFIX . "regions AS r
ORDER BY
  r.region_order,
  r.region_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["region_name"] = htmlspecialchars($aRow["region_name"]);

    $oSmarty->append("aRegions", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Города.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_cities.js");

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["cities"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_cities_view");
$oSmarty->display("backend_main.tpl");

?>