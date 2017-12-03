<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_login,
  bu.backend_user_name,
  bu.backend_user_comment,
  bu.backend_user_enabled,
  COALESCE(GROUP_CONCAT(DISTINCT bubat.backend_access_type_id), '') AS backend_access_types
FROM
  " . DB_PREFIX . "backend_users AS bu
 LEFT JOIN " . DB_PREFIX . "backend_users_backend_access_types AS bubat ON bubat.backend_user_id = " . $_GET["content_id"] . "
WHERE
  bu.backend_user_id = " . $_GET["content_id"] . "
GROUP BY
  bu.backend_user_id
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_array())
    {
      $aRow["backend_user_name"] = htmlspecialchars($aRow["backend_user_name"]);
      $aRow["backend_user_login"] = htmlspecialchars($aRow["backend_user_login"]);
      $aRow["backend_user_comment"] = htmlspecialchars($aRow["backend_user_comment"]);

      if(!empty($aRow["backend_access_types"]))
      {      	$aRow["backend_access_types"] = explode(",", $aRow["backend_access_types"]);
      	$aRow["backend_access_types"] = array_count_values($aRow["backend_access_types"]);      }

      $oSmarty->assign("aContentData", $aRow);
    }
    $oResult->close();
  }
}

$sSql = "SELECT
  bat.backend_access_type_id,
  bat.backend_access_type_name
FROM
  " . DB_PREFIX . "backend_access_types AS bat
ORDER BY
  bat.backend_access_type_order,
  bat.backend_access_type_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_array())
  {
    $aRow["backend_access_type_name"] = htmlspecialchars($aRow["backend_access_type_name"]);

    $oSmarty->append("aBackendAccessTypes", $aRow);
  }
  $oResult->close();
}

vSetFormErrors($oSmarty);

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Пользователи.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_backend_users.js");

$aMenu["backend_users"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_backend_users_view");
$oSmarty->display("backend_main.tpl");
?>