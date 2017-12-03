<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_name,
  bu.backend_user_enabled,
  COALESCE(GROUP_CONCAT(DISTINCT bat.backend_access_type_name ORDER BY bat.backend_access_type_order, bat.backend_access_type_name SEPARATOR '; '), '') AS backend_access_types,
  IF(bu.backend_user_id != " . $oBackendUser->iGetBackendUserId() . " AND l.leader_id IS NULL AND p.project_id IS NULL, 1, 0) AS backend_user_delete_enabled
FROM
  " . DB_PREFIX . "backend_users AS bu
  LEFT JOIN " . DB_PREFIX . "backend_users_backend_access_types AS bubat ON bu.backend_user_id = bubat.backend_user_id
  LEFT JOIN " . DB_PREFIX . "backend_access_types AS bat ON bubat.backend_access_type_id = bat.backend_access_type_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON bu.backend_user_id IN (l.leader_create_backend_user_id, l.leader_interview_backend_user_id, l.leader_write_backend_user_id)
  LEFT JOIN " . DB_PREFIX . "projects AS p ON bu.backend_user_id IN (p.project_create_backend_user_id, p.project_interview_backend_user_id, p.project_write_backend_user_id)
GROUP BY
  bu.backend_user_id
ORDER BY
  bu.backend_user_name,
  bu.backend_user_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_array())
  {
    $aRow["backend_user_name"] = htmlspecialchars($aRow["backend_user_name"]);
    $aRow["backend_access_types"] = htmlspecialchars($aRow["backend_access_types"]);

    $oSmarty->append("aContentList", $aRow);
  }
  $oResult->close();
}

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Пользователи.";

$aMenu["backend_users"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);
$oSmarty->assign("sInnerPage", "backend_backend_users_list");
$oSmarty->display("backend_main.tpl");
?>