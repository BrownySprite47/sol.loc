<?php

$sUrlPostfix = "";

if(isset($_POST["region_order"], $_POST["region_name"], $_POST["region_comment"]))
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
    $_POST["region_order"] = stripslashes($_POST["region_order"]);
    $_POST["region_name"] = stripslashes($_POST["region_name"]);
    $_POST["region_comment"] = stripslashes($_POST["region_comment"]);
  }
  $_POST["region_order"] = trim($_POST["region_order"]);
  $_POST["region_name"] = trim($_POST["region_name"]);
  $_POST["region_comment"] = trim($_POST["region_comment"]);

  $aContentDataErrors = array();

  if($_POST["region_name"] === "")
  {  	$aContentDataErrors["region_name"] = "Поле обязательно для заполнения";  }

  if(!bIsInt($_POST["region_order"], 1))
  {  	$aContentDataErrors["region_order"] = "";  }

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
  " . DB_PREFIX . "regions
SET
  region_order = " . $_POST["region_order"] . ",
  region_name = '" . $oDB->escape_string($_POST["region_name"]) . "',
  region_comment = '" . $oDB->escape_string($_POST["region_comment"]) . "'";

    if($bContentEdit)
    {
      $sSql .= "
WHERE
  region_id = " . $_GET["content_id"];
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
    $aContentData["region_name"] = htmlspecialchars($_POST["region_name"]);
    $aContentData["region_order"] = htmlspecialchars($_POST["region_order"]);
    $aContentData["region_comment"] = htmlspecialchars($_POST["region_comment"]);

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=regions&action_name=view" . $sUrlPostfix);

?>