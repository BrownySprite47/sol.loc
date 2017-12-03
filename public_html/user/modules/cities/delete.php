<?php

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "DELETE
  c
FROM
  " . DB_PREFIX . "cities AS c
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON c.city_id = l.city_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON c.city_id = p.city_id
  LEFT JOIN " . DB_PREFIX . "recommendations AS r ON c.city_id = r.city_id
WHERE
  c.city_id = " . $_GET["content_id"] . " AND
  l.leader_id IS NULL AND
  p.project_id IS NULL AND
  r.recommendation_id IS NULL";
  if($oResult = $oDB->query($sSql))
  {
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=cities&action_name=list");
?>