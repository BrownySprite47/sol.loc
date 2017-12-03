<?php

if(isset($aBackendUserInfo["backend_access_types"]["leaders"]))
{  header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=list");}
else
{  $oSmarty = new cMySmarty();

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления.";

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->assign("aMenu", $aMenu);
  $oSmarty->assign("sInnerPage", "backend_index");
  $oSmarty->display("backend_main.tpl");}

?>