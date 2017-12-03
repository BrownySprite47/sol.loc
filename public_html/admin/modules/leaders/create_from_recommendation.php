<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $aSql = array();

  $aSql[] = "START TRANSACTION";

  $aSql[] = "INSERT INTO
  " . DB_PREFIX . "leaders (leader_surname, leader_name, leader_patronymic, leader_email, leader_phone, city_id, leader_city_name, leader_create_backend_user_id, leader_create_datetime, leader_enabled, leader_create_date)
SELECT
  r.leader_surname,
  r.leader_name,
  r.leader_patronymic AS leader_patronymic,
  r.leader_email,
  r.leader_phone,
  r.city_id,
  r.leader_city_name,
  " . $aBackendUserInfo["backend_user_id"] . " AS leader_create_backend_user_id,
  NOW() AS leader_create_datetime,
  1 AS leader_enabled,
  COALESCE(l.leader_interview_date, DATE(NOW())) AS leader_create_date
FROM
  " . DB_PREFIX . "recommendations AS r
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON r.leader_id_from = l.leader_id
WHERE
  r.recommendation_id = " . $_GET["content_id"] . " AND
  r.leader_id_to IS NULL
LIMIT
  1";

  $aSql[] = "SET @leader_id := LAST_INSERT_ID()";

  $aSql[] = "INSERT INTO
  " . DB_PREFIX . "leaders_projects (leader_id, project_name)
SELECT
  @leader_id AS leader_id,
  r.leader_project_name AS project_name
FROM
  " . DB_PREFIX . "recommendations AS r
WHERE
  r.recommendation_id = " . $_GET["content_id"] . " AND
  @leader_id > 0 AND
  r.leader_project_name != ''
LIMIT
  1";

  $aSql[] = "UPDATE
  " . DB_PREFIX . "recommendations AS r
SET
  r.leader_id_to = @leader_id,
  r.leader_surname = '',
  r.leader_name = '',
  r.leader_patronymic = '',
  r.leader_email = '',
  r.leader_phone = NULL,
  r.city_id = NULL,
  r.leader_city_name = '',
  r.leader_project_name = ''
WHERE
  r.recommendation_id = " . $_GET["content_id"] . " AND
  r.leader_id_to IS NULL AND
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