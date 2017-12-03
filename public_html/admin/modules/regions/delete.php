<?php

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "DELETE
  r
FROM
  " . DB_PREFIX . "regions AS r
  LEFT JOIN " . DB_PREFIX . "cities AS c ON c.region_id = " . $_GET["content_id"] . "
WHERE
  r.region_id = " . $_GET["content_id"] . " AND
  c.city_id IS NULL";
  if($oResult = $oDB->query($sSql))
  {
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=regions&action_name=list");

?>