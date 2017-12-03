<?php

if(isset($_POST["backend_user_login"], $_POST["backend_user_password"]))
{  if(get_magic_quotes_gpc())
  {
    $_POST["backend_user_login"] = stripslashes($_POST["backend_user_login"]);
    $_POST["backend_user_password"] = stripslashes($_POST["backend_user_password"]);
  }

  if($oBackendUser->bAuthorization($_POST["backend_user_login"], $_POST["backend_user_password"]))
  {
    header("Location: " . PROJECT_BACKEND_URL);  }
  else
  {
    $aContentData = array();
    $aContentData["backend_user_login"] = htmlspecialchars($_POST["backend_user_login"]);
    $aContentData["backend_user_password"] = "";

    $aContentDataErrors = array();
    $aContentDataErrors["backend_user_login"] = "";
    $aContentDataErrors["backend_user_password"] = "";

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;

    header("Location: " . PROJECT_BACKEND_URL . "index.php?modile=login");  }}
else
{  $oSmarty = new cMySmarty();

  vSetFormErrors($oSmarty);

  $aPageData = array();
  $aPageData["html_title"] = "Панель управления. Вход.";

  $oSmarty->assign("aPageData", $aPageData);
  $oSmarty->display("backend_login.tpl");}
?>