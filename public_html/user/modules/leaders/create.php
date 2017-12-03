<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $aSql = array();

  $aSql[] = "START TRANSACTION";

  $aSql[] = "INSERT INTO
  " . DB_PREFIX . "leaders (leader_surname, leader_name, leader_patronymic, leader_create_backend_user_id, leader_create_datetime, leader_enabled)
SELECT
  COALESCE(lp.leader_surname, '') AS leader_surname,
  COALESCE(lp.leader_name, '') AS leader_name,
  COALESCE(lp.leader_patronymic, '') AS leader_patronymic,
  " . $aBackendUserInfo["backend_user_id"] . " AS leader_create_backend_user_id,
  NOW() AS leader_create_datetime,
  1 AS leader_enabled
FROM
  " . DB_PREFIX . "leaders_projects AS lp
WHERE
  lp.leader_project_id = " . $_GET["content_id"] . " AND
  lp.leader_id IS NULL
LIMIT
  1";

  $aSql[] = "SET @leader_id := LAST_INSERT_ID()";

  $aSql[] = "UPDATE
  " . DB_PREFIX . "leaders_projects AS lp
SET
  lp.leader_id = @leader_id,
  lp.leader_surname = NULL,
  lp.leader_name = NULL,
  lp.leader_patronymic = NULL
WHERE
  lp.leader_project_id = " . $_GET["content_id"] . " AND
  lp.leader_id IS NULL AND
  @leader_id > 0";

  $aSql[] = "COMMIT";

  foreach($aSql as $sSql)
  {  	if($oResult = $oDB->query($sSql))
    {
    }  }

  $sSql = "SELECT @leader_id AS leader_id";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc() and $aRow["leader_id"] > 0)
    {
      $sUrlPostfix = "view&content_id=" . $aRow["leader_id"];

      vTransactionLeader($aRow["leader_id"], $aBackendUserInfo["backend_user_id"]);
    }
    $oResult->close();
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=" . $sUrlPostfix);

?>