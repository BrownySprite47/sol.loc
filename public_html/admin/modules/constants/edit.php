<?php

$sUrlPostfix = "";

if(isset($_POST["constant_values"], $_GET["constant_type_id"]) and is_array($_POST["constant_values"]) and bIsInt($_GET["constant_type_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  foreach($_POST["constant_values"] as $iConstantId => $sConstantValue)
  {
  	if(bIsInt($iConstantId, 1))
  	{
  	  if(get_magic_quotes_gpc())
      {
        $sConstantValue = stripslashes($sConstantValue);
      }
      $sConstantValue = trim($sConstantValue);

      $sSql = "UPDATE
  " . DB_PREFIX . "constants AS c
SET
  c.constant_value = '" . $oDB->escape_string($sConstantValue) . "'
WHERE
  c.constant_id = " . $iConstantId . " AND
  c.constant_type_id = " . $_GET["constant_type_id"] . "
LIMIT
  1";
      if($oResult = $oDB->query($sSql))
      {      }  	}  }

  header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=constants&action_name=view&constant_type_id=" . $_GET["constant_type_id"]);
}
else
{  header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=constants&action_name=list");}
?>