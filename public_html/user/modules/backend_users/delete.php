<?php

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1) and $_GET["content_id"] != $oBackendUser->iGetBackendUserId())
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "DELETE
  bu,
  bubat
FROM
  " . DB_PREFIX . "backend_users AS bu
  LEFT JOIN " . DB_PREFIX . "backend_users_backend_access_types AS bubat ON bubat.backend_user_id = " . $_GET["content_id"] . "
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON bu.backend_user_id IN (l.leader_create_backend_user_id, l.leader_interview_backend_user_id, l.leader_write_backend_user_id)
  LEFT JOIN " . DB_PREFIX . "projects AS p ON bu.backend_user_id IN (p.project_create_backend_user_id, p.project_interview_backend_user_id, p.project_write_backend_user_id)
WHERE
  bu.backend_user_id = " . $_GET["content_id"] . " AND
  l.leader_id IS NULL AND
  p.project_id IS NULL";
  if($oResult = $oDB->query($sSql))
  {
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=backend_users&action_name=list");
?>