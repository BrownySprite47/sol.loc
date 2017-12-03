<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$sSql = "SELECT
  c.city_id,
  c.city_name,
  COUNT(DISTINCT l.leader_id) AS leaders_count,
  COUNT(DISTINCT p.project_id) AS projects_count,
  COUNT(DISTINCT r.recommendation_id) AS recommendations_count
FROM
  " . DB_PREFIX . "cities AS c
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON c.city_id = l.city_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON c.city_id = p.city_id
  LEFT JOIN " . DB_PREFIX . "recommendations AS r ON c.city_id = r.city_id
GROUP BY
  c.city_id
ORDER BY
  c.city_order,
  c.city_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["city_name"] = htmlspecialchars($aRow["city_name"]);

    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Города.";

$aMenu["libs"]["active"] = true;
$aMenu["libs"]["items"]["cities"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_cities_list");
$oSmarty->display("backend_main.tpl");
?>