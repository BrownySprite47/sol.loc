<?php

$aActionNamesEnabled = array("list", "view", "edit", "delete");

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{
else
{

require_once MODULES_PATH . "backend_users/" . $sActionName . ".php";
?>