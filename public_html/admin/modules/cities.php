<?php

$aActionNamesEnabled = array("list", "edit", "view", "delete");

if(isset($_GET["action_name"]) and in_array($_GET["action_name"], $aActionNamesEnabled))
{
else
{

require_once MODULES_PATH . "cities/" . $sActionName . ".php";
?>