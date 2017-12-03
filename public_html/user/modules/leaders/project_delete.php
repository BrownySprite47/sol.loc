<?php

$sUrlPostfix = "list";

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $iLeaderId = $oDB->aGetDataByFilters(DB_PREFIX . "leaders_projects", "leader_id", array("leader_project_id" => $_GET["content_id"]));

  if(!is_null($iLeaderId))
  {  	$sUrlPostfix = "view&content_id=" . $iLeaderId;

  	$sSql = "DELETE
  lp
FROM
  " . DB_PREFIX . "leaders_projects AS lp
WHERE
  lp.leader_project_id = " . $_GET["content_id"];
    if($oResult = $oDB->query($sSql) and $oDB->affected_rows === 1)
    {
      vTransactionLeader($_GET["content_id"], $aBackendUserInfo["backend_user_id"]);
    }  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=" . $sUrlPostfix);
?>