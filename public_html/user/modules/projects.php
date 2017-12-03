<?php

$aActionNamesEnabled = array("list", "edit", "view", "create");

if(isset($aBackendUserInfo["backend_access_types"]["leader_project_delete_enabled"]))
{
  $aActionNamesEnabled[] = "leader_delete";
}

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{  $sActionName = $_GET["action_name"];}
else
{  $sActionName = "list";}

require_once MODULES_PATH . "projects/" . $sActionName . ".php";
?>