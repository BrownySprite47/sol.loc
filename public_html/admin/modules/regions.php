<?php

$aActionNamesEnabled = array("list", "edit", "view", "delete");

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{  $sActionName = $_GET["action_name"];}
else
{  $sActionName = "list";}

require_once MODULES_PATH . "regions/" . $sActionName . ".php";
?>