<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $aSql = array();

  $aSql[] = "START TRANSACTION";

  $aSql[] = "INSERT INTO
  " . DB_PREFIX . "projects (project_name, project_create_backend_user_id, project_create_datetime, project_enabled)
SELECT
  lp.project_name,
  " . $aBackendUserInfo["backend_user_id"] . " AS project_create_backend_user_id,
  NOW() AS project_create_datetime,
  1 AS project_enabled
FROM
  " . DB_PREFIX . "leaders_projects AS lp
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