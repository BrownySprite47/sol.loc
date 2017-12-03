<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$sSql = "SELECT
  r.region_id,
  r.region_name,
  COUNT(c.city_id) AS cities_count
FROM
  " . DB_PREFIX . "regions AS r
  LEFT JOIN " . DB_PREFIX . "cities AS c ON r.region_id = c.region_id
GROUP BY
  r.region_id
ORDER BY
  r.region_order,
  r.region_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["region_name"] = htmlspecialchars($aRow["region_name"]);

    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Регионы.";

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["regions"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_regions_list");
$oSmarty->display("backend_main.tpl");

?>