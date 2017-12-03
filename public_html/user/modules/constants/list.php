<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$sSql = "SELECT
  ct.constant_type_id,
  ct.constant_type_name,
  COUNT(c.constant_id) AS constants_count
FROM
  " . DB_PREFIX . "constant_types AS ct
  INNER JOIN " . DB_PREFIX . "constants AS c ON ct.constant_type_id = c.constant_type_id
GROUP BY
  ct.constant_type_id
ORDER BY
  ct.constant_type_order,
  ct.constant_type_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_array())
  {
    $aRow["constant_type_name"] = htmlspecialchars($aRow["constant_type_name"]);
    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Настройки.";

$aMenu["constants"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_constants_list");
$oSmarty->display("backend_main.tpl");
?>