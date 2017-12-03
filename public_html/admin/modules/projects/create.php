<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $aSql = array();

  $aSql[] = "START TRANSACTION";

  $aSql[] = "INSERT INTO
  " . DB_PREFIX . "projects (project_name, project_create_backend_user_id, project_create_datetime, project_enabled, project_create_date, project_interview_date, leader_id, project_write_backend_user_id, project_interview_backend_user_id)
SELECT
  lp.project_name,
  " . $aBackendUserInfo["backend_user_id"] . " AS project_create_backend_user_id,
  NOW() AS project_create_datetime,
  1 AS project_enabled,
  COALESCE(l.leader_create_date, DATE(NOW())) AS project_create_date,
  l.leader_interview_date AS project_interview_date,
  l.leader_id,
  l.leader_write_backend_user_id AS project_write_backend_user_id,
  l.leader_interview_backend_user_id AS project_interview_backend_user_id
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  INNER JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
WHERE
  lp.leader_project_id = " . $_GET["content_id"] . " AND
  lp.project_id IS NULL
LIMIT
  1";

  $aSql[] = "SET @project_id := LAST_INSERT_ID()";

  $aSql[] = "UPDATE
  " . DB_PREFIX . "leaders_projects AS lp
SET
  lp.project_id = @project_id,
  lp.project_name = NULL
WHERE
  lp.leader_project_id = " . $_GET["content_id"] . " AND
  lp.project_id IS NULL AND
  @project_id > 0";

  $aSql[] = "COMMIT";

  foreach($aSql as $sSql)
  {  	if($oResult = $oDB->query($sSql))
    {
    }  }

  $sSql = "SELECT @project_id AS project_id";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc() and $aRow["project_id"] > 0)
    {
      $sUrlPostfix = "view&content_id=" . $aRow["project_id"];
      vTransactionProject($aRow["project_id"], $aBackendUserInfo["backend_user_id"]);
    }
    $oResult->close();
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=projects&action_name=" . $sUrlPostfix);
?>