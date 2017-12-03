<?php

class cBackendUser
{  private $iBackendUserId = null;
  private $aBackendUserInfo = null;

  public function __construct()
  {    if(isset($_SESSION["iBackendUserId"]))
    {      $this->vGetBackendUserData($_SESSION["iBackendUserId"]);    }  }

  private function vGetBackendUserData($iBackendUserId)
  {    $oDB = cMyDB::oGetDB("db");

    $sSql = "
SELECT
  bu.backend_user_id,
  bu.backend_user_login,
  bu.backend_user_name,
  COALESCE(GROUP_CONCAT(DISTINCT bubat.backend_access_type_id ORDER BY bubat.backend_access_type_id), '') AS backend_access_type_ids,
  COALESCE(GROUP_CONCAT(DISTINCT bat.backend_access_type_internal_name ORDER BY bubat.backend_access_type_id), '') AS backend_access_type_internal_names,
  COALESCE(GROUP_CONCAT(DISTINCT bat.backend_module_names ORDER BY bubat.backend_access_type_id), '') AS backend_module_names
FROM
  " . DB_PREFIX . "backend_users AS bu
  LEFT JOIN " . DB_PREFIX . "backend_users_backend_access_types AS bubat ON bu.backend_user_id = bubat.backend_user_id
  LEFT JOIN " . DB_PREFIX . "backend_access_types AS bat ON bubat.backend_access_type_id = bat.backend_access_type_id
WHERE
  bu.backend_user_id = '" . $iBackendUserId . "' AND
  bu.backend_user_enabled = 1
GROUP BY
  bu.backend_user_id
LIMIT
  1";
    if($oResult = $oDB->query($sSql))
    {      if($aRow = $oResult->fetch_array())
      {
        $this->iBackendUserId = $aRow["backend_user_id"];

        $aBackendAccessTypes = array();
        $aBackendModuleNames = array("login", "index", "logout");

        if(!empty($aRow["backend_access_type_ids"]) and !empty($aRow["backend_access_type_internal_names"]) and !empty($aRow["backend_module_names"]))
        {
          $aBackendAccessTypeIds = explode(",", $aRow["backend_access_type_ids"]);
          $aBackendAccessTypeInternalNames = explode(",", $aRow["backend_access_type_internal_names"]);
          $aBackendModuleNames = array_merge($aBackendModuleNames, explode(",", $aRow["backend_module_names"]));
          $aBackendModuleNames = array_unique($aBackendModuleNames);

          foreach($aBackendAccessTypeIds as $iKey => $iTemp)
          {
          	$aBackendAccessTypes[$aBackendAccessTypeInternalNames[$iKey]] = $iTemp;
          }
        }

        $this->aBackendUserInfo = array("backend_user_id" => $aRow["backend_user_id"], "backend_user_login" => $aRow["backend_user_login"], "backend_user_name" => $aRow["backend_user_name"], "backend_access_types" => $aBackendAccessTypes, "backend_module_names" => $aBackendModuleNames);
      }
      else
      {        $this->vLogOut();      }

      $oResult->close();    }  }

  public function bAuthorization($sBackendUserLogin, $sBackendUserPassword)
  {
    $oDB = cMyDB::oGetDB("db");

    $sSql = "
SELECT
  bu.backend_user_id,
  bu.backend_user_login,
  bu.backend_user_name,
  COALESCE(GROUP_CONCAT(DISTINCT bubat.backend_access_type_id ORDER BY bubat.backend_access_type_id), '') AS backend_access_type_ids,
  COALESCE(GROUP_CONCAT(DISTINCT bat.backend_access_type_internal_name ORDER BY bubat.backend_access_type_id), '') AS backend_access_type_internal_names,
  COALESCE(GROUP_CONCAT(DISTINCT bat.backend_module_names ORDER BY bubat.backend_access_type_id), '') AS backend_module_names
FROM
  " . DB_PREFIX . "backend_users AS bu
  LEFT JOIN " . DB_PREFIX . "backend_users_backend_access_types AS bubat ON bu.backend_user_id = bubat.backend_user_id
  LEFT JOIN " . DB_PREFIX . "backend_access_types AS bat ON bubat.backend_access_type_id = bat.backend_access_type_id
WHERE
  bu.backend_user_login = '" . $oDB->escape_string($sBackendUserLogin) . "' AND
  bu.backend_user_password_hash = MD5(CONCAT(bu.backend_user_hash, '_', '" . $oDB->escape_string($sBackendUserPassword) . "')) AND
  bu.backend_user_enabled = 1
GROUP BY
  bu.backend_user_id
LIMIT
  1";
    if($oResult = $oDB->query($sSql))
    {
      if($aRow = $oResult->fetch_array())
      {
        $this->iBackendUserId = $aRow["backend_user_id"];

        $aBackendAccessTypes = array();
        $aBackendModuleNames = array("login", "index", "logout");

        if(!empty($aRow["backend_access_type_ids"]) and !empty($aRow["backend_access_type_internal_names"]) and !empty($aRow["backend_module_names"]))
        {
          $aBackendAccessTypeIds = explode(",", $aRow["backend_access_type_ids"]);
          $aBackendAccessTypeInternalNames = explode(",", $aRow["backend_access_type_internal_names"]);
          $aBackendModuleNames = array_merge($aBackendModuleNames, explode(",", $aRow["backend_module_names"]));
          $aBackendModuleNames = array_unique($aBackendModuleNames);

          foreach($aBackendAccessTypeIds as $iKey => $iTemp)
          {
          	$aBackendAccessTypes[$aBackendAccessTypeInternalNames[$iKey]] = $iTemp;
          }
        }

        $this->aBackendUserInfo = array("backend_user_id" => $aRow["backend_user_id"], "backend_user_login" => $aRow["backend_user_login"], "backend_user_name" => $aRow["backend_user_name"], "backend_access_types" => $aBackendAccessTypes, "backend_module_names" => $aBackendModuleNames);

        $_SESSION["iBackendUserId"] = $this->iBackendUserId;
      }

      $oResult->close();
    }

    return $this->bIsAuth();
  }

  public function bIsAuth()
  {
    return isset($this->iBackendUserId);  }

  public function vLogOut()
  {
    $this->iBackendUserId = null;
    $this->iBackendUserInfo = null;

    if(isset($_SESSION["iBackendUserId"]))
    {
      unset($_SESSION["iBackendUserId"]);
    }
  }

  public function iGetBackendUserId()
  {
  	return $this->iBackendUserId;
  }

  public function aGetBackendUserInfo()
  {
  	return $this->aBackendUserInfo;
  }}
?>