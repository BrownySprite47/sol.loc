<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $iProjectId = $oDB->aGetDataByFilters(DB_PREFIX . "leaders_projects", "project_id", array("leader_project_id" => $_GET["content_id"]));

  if(!is_null($iProjectId))
  {  	$sUrlPostfix = "view&content_id=" . $iProjectId;

  	$sSql = "DELETE
  lp
FROM
  " . DB_PREFIX . "leaders_projects AS lp
WHERE
  lp.leader_project_id = " . $_GET["content_id"];
    if($oResult = $oDB->query($sSql) and $oDB->affected_rows === 1)
    {      vTransactionProject($iProjectId, $aBackendUserInfo["backend_user_id"]);
    }  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=projects&action_name=" . $sUrlPostfix);
?>