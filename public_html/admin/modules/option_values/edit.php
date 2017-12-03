<?php

$sUrlPostfix = "";

if(isset($_POST["option_order"], $_POST["option_value"], $_POST["option_value_small"], $_POST["option_value_comment"], $_POST["option_value_help"]))
{
  $oDB = cMyDB::oGetDB("db");

  $bContentEdit = isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1);

  if($bContentEdit)
  {
    $sUrlPostfix = "&content_id=" . $_GET["content_id"];
    $_POST["option_id"] = "";
  }
  else
  {
    $sUrlPostfix = "";
  }

  if(get_magic_quotes_gpc())
  {
    $_POST["option_order"] = stripslashes($_POST["option_order"]);
    $_POST["option_value"] = stripslashes($_POST["option_value"]);
    $_POST["option_value_small"] = stripslashes($_POST["option_value_small"]);
    $_POST["option_value_comment"] = stripslashes($_POST["option_value_comment"]);
    $_POST["option_value_help"] = stripslashes($_POST["option_value_help"]);
  }
  $_POST["option_order"] = trim($_POST["option_order"]);
  $_POST["option_value"] = trim($_POST["option_value"]);
  $_POST["option_value_small"] = trim($_POST["option_value_small"]);
  $_POST["option_value_comment"] = trim($_POST["option_value_comment"]);
  $_POST["option_value_help"] = trim($_POST["option_value_help"]);

  $aContentDataErrors = array();

  if($_POST["option_value"] === "")
  {  	$aContentDataErrors["option_value"] = "Поле обязательно для заполнения";  }

  if(!bIsInt($_POST["option_order"], 1))
  {  	$aContentDataErrors["option_order"] = "";  }

  if(!$bContentEdit and (!isset($_POST["option_id"]) or !bIsInt($_POST["option_id"], 1) or !$oDB->bCheckDataByFilters(DB_PREFIX . "options", array("option_id" => $_POST["option_id"]))))
  {  	$aContentDataErrors["option_id"] = "";
  	$_POST["option_id"] = "";  }

  if(empty($aContentDataErrors))
  {
    if($bContentEdit)
    {
      $sSql = "UPDATE";
    }
    else
    {
      $sSql = "INSERT INTO";
    }

    $sSql .= "
  " . DB_PREFIX . "option_values
SET
  option_order = " . $_POST["option_order"] . ",
  option_value = '" . $oDB->escape_string($_POST["option_value"]) . "',
  option_value_small = '" . $oDB->escape_string($_POST["option_value_small"]) . "',
  option_value_help = '" . $oDB->escape_string($_POST["option_value_help"]) . "',
  option_value_comment = '" . $oDB->escape_string($_POST["option_value_comment"]) . "'";

    if($bContentEdit)
    {
      $sSql .= "
WHERE
  option_value_id = " . $_GET["content_id"];
    }
    else
    {      $sSql .= ",
  option_id = " . $_POST["option_id"];    }

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
    $aContentData["option_value"] = htmlspecialchars($_POST["option_value"]);
    $aContentData["option_value_small"] = htmlspecialchars($_POST["option_value_small"]);
    $aContentData["option_order"] = htmlspecialchars($_POST["option_order"]);
    $aContentData["option_value_comment"] = htmlspecialchars($_POST["option_value_comment"]);
    $aContentData["option_value_help"] = htmlspecialchars($_POST["option_value_help"]);
    $aContentData["option_id"] = $_POST["option_id"];

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=option_values&action_name=view" . $sUrlPostfix);

?>