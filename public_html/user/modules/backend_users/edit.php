<?php

$sUrlPostfix = "";

if(isset($_POST["backend_user_login"], $_POST["backend_user_password"], $_POST["backend_user_name"], $_POST["backend_user_comment"]))
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
    $_POST["backend_user_login"] = stripslashes($_POST["backend_user_login"]);
    $_POST["backend_user_password"] = stripslashes($_POST["backend_user_password"]);
    $_POST["backend_user_name"] = stripslashes($_POST["backend_user_name"]);
    $_POST["backend_user_comment"] = stripslashes($_POST["backend_user_comment"]);
  }
  $_POST["backend_user_login"] = trim($_POST["backend_user_login"]);
  $_POST["backend_user_password"] = trim($_POST["backend_user_password"]);
  $_POST["backend_user_name"] = trim($_POST["backend_user_name"]);
  $_POST["backend_user_comment"] = trim($_POST["backend_user_comment"]);

  $aContentDataErrors = array();

  if(empty($_POST["backend_user_name"]))
  {  	$aContentDataErrors["backend_user_name"] = "Поле обязательно для заполнения";  }

  if(empty($_POST["backend_user_login"]))
  {
  	$aContentDataErrors["backend_user_login"] = "Поле обязательно для заполнения";
  }

  if(empty($_POST["backend_user_password"]) and !$bContentEdit)
  {
  	$aContentDataErrors["backend_user_password"] = "Поле обязательно для заполнения";
  }

  $iBackendUserEnabled = (int) isset($_POST["backend_user_enabled"]);

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
  " . DB_PREFIX . "backend_users
SET
  backend_user_login = '" . $oDB->escape_string($_POST["backend_user_login"]) . "',
  backend_user_name = '" . $oDB->escape_string($_POST["backend_user_name"]) . "',
  backend_user_comment = '" . $oDB->escape_string($_POST["backend_user_comment"]) . "',
  backend_user_enabled = " . $iBackendUserEnabled;

    if($bContentEdit)
    {
      if(!empty($_POST["backend_user_password"]))
      {
        $sSql .= ",
  backend_user_password_hash = MD5(CONCAT(backend_user_hash, '_', '" . $oDB->escape_string($_POST["backend_user_password"]) . "'))";
      }

      $sSql .= "
WHERE
  backend_user_id = " . $_GET["content_id"];
    }
    else
    {
      $sBackendUserHash = sGetHash(32);

      $sSql .= ",
  backend_user_create_datetime = NOW(),
  backend_user_password_hash = '" . $oDB->escape_string(md5($sBackendUserHash . "_" . $_POST["backend_user_password"])) . "',
  backend_user_hash = '" . $oDB->escape_string($sBackendUserHash) . "'";
    }

    if($oResult = $oDB->query($sSql))
    {
      if($bContentEdit)
      {
        $iBackendUserId = $_GET["content_id"];
      }
      else
      {
        $iBackendUserId = $oDB->insert_id;
        $sUrlPostfix = "&content_id=" . $iBackendUserId;
      }

      $sSql = "DELETE
  bubat
FROM
  " . DB_PREFIX . "backend_users_backend_access_types AS bubat
WHERE
  backend_user_id = " . $iBackendUserId;
      if($oResult = $oDB->query($sSql))
      {
      }

      if(isset($_POST["backend_access_types"]) and is_array($_POST["backend_access_types"]))
      {
        $aBackendAccessTypes = array();

        foreach($_POST["backend_access_types"] as $iBackendAccessTypeId)
        {
          if(bIsInt($iBackendAccessTypeId, 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "backend_access_types", array("backend_access_type_id" => $iBackendAccessTypeId)))
          {
            $aBackendAccessTypes[] = $iBackendAccessTypeId;
          }
        }

        if(!empty($aBackendAccessTypes))
        {
          $sSql = "INSERT INTO
  " . DB_PREFIX . "backend_users_backend_access_types (backend_user_id, backend_access_type_id)
VALUES
  (" . $iBackendUserId . ", " . implode("),
  (" . $iBackendUserId . ", ", $aBackendAccessTypes) . ")";
          if($oResult = $oDB->query($sSql))
          {
          }
        }
      }
    }
  }
  else
  {  	$aContentData = array();
    $aContentData["backend_user_name"] = htmlspecialchars($_POST["backend_user_name"]);
    $aContentData["backend_user_login"] = htmlspecialchars($_POST["backend_user_login"]);
    $aContentData["backend_user_comment"] = htmlspecialchars($_POST["backend_user_comment"]);
    $aContentData["backend_user_enabled"] = $iBackendUserEnabled;

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=backend_users&action_name=view" . $sUrlPostfix);
?>