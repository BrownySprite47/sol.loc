<?php

$aActionNamesEnabled = array("list", "view", "create", "create_from_recommendation", "docx", "view_without_edit");

if(isset($aBackendUserInfo["backend_access_types"]["recommendation_delete_enabled"]))
{
  $aActionNamesEnabled[] = "recommendation_delete";
}

if(isset($aBackendUserInfo["backend_access_types"]["leader_project_delete_enabled"]))
{
  $aActionNamesEnabled[] = "project_delete";
}

if(isset($aBackendUserInfo["backend_access_types"]["leaders_edit"]))
{
  $aActionNamesEnabled[] = "edit";
  $aActionNamesEnabled[] = "form_check";
}

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{  $sActionName = $_GET["action_name"];}
else
{  $sActionName = "list";}

if($sActionName === "view" and !isset($aBackendUserInfo["backend_access_types"]["leaders_edit"]))
{  $sActionName = "view_without_edit";}

if($sActionName === "view_without_edit")
{
  require_once MODULES_PATH . "leaders/view.php";}
else
{
  require_once MODULES_PATH . "leaders/" . $sActionName . ".php";
}

?>