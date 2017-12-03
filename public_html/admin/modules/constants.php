<?php

$aActionNamesEnabled = array("list", "view", "edit");

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{  $sActionName = $_GET["action_name"];}
else
{  $sActionName = "list";}

require_once MODULES_PATH . "constants/" . $sActionName . ".php";
?>