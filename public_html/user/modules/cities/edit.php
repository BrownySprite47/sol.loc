<?php

$sUrlPostfix = "";

if(isset($_POST["city_order"], $_POST["city_name"], $_POST["city_comment"]))
{
  $bContentEdit = isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1);

  if($bContentEdit)
  {
    $sUrlPostfix = "&content_id=" . $_GET["content_id"];
  }
  else
  {
    $sUrlPostfix = "";
  }

  if(get_magic_quotes_gpc())
  {
    $_POST["city_order"] = stripslashes($_POST["city_order"]);
    $_POST["city_name"] = stripslashes($_POST["city_name"]);
    $_POST["city_comment"] = stripslashes($_POST["city_comment"]);
  }
  $_POST["city_order"] = trim($_POST["city_order"]);
  $_POST["city_name"] = trim($_POST["city_name"]);
  $_POST["city_comment"] = trim($_POST["city_comment"]);

  $aContentDataErrors = array();

  if($_POST["city_name"] === "")
  {  	$aContentDataErrors["city_name"] = "Поле обязательно для заполнения";  }

  if(!bIsInt($_POST["city_order"], 1))
  {  	$aContentDataErrors["city_order"] = "";  }

  if(empty($aContentDataErrors))
  {
    $oDB = cMyDB::oGetDB("db");

    if($bContentEdit)
    {
      $sSql = "UPDATE";
    }
    else
    {
      $sSql = "INSERT INTO";
    }

    $sSql .= "
  " . DB_PREFIX . "cities
SET
  city_order = " . $_POST["city_order"] . ",
  city_name = '" . $oDB->escape_string($_POST["city_name"]) . "',
  city_comment = '" . $oDB->escape_string($_POST["city_comment"]) . "'";

    if($bContentEdit)
    {
      $sSql .= "
WHERE
  city_id = " . $_GET["content_id"];
    }

    if($oResult = $oDB->query($sSql))
    {
      if($bContentEdit)
      {
        $iContentId = $_GET["content_id"];
      }
      else
      {
        $iContentId = $oDB->insert_id;
        $sUrlPostfix = "&content_id=" . $iContentId;
      }
    }
  }
  else
  {  	$aContentData = array();
    $aContentData["city_name"] = htmlspecialchars($_POST["city_name"]);
    $aContentData["city_order"] = htmlspecialchars($_POST["city_order"]);
    $aContentData["city_comment"] = htmlspecialchars($_POST["city_comment"]);

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=cities&action_name=view" . $sUrlPostfix);

?>