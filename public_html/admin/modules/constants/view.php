<?php

$bResult = false;

if(isset($_GET["constant_type_id"]) and bIsInt($_GET["constant_type_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "SELECT
  ct.constant_type_id,
  ct.constant_type_name,
  c.constant_id,
  c.constant_name,
  c.constant_text,
  c.constant_value
FROM
  " . DB_PREFIX . "constants AS c
  INNER JOIN " . DB_PREFIX . "constant_types AS ct ON ct.constant_type_id = " . $_GET["constant_type_id"]  . "
WHERE
  c.constant_type_id = " . $_GET["constant_type_id"]  . "
ORDER BY
  c.constant_name";
  if($oResult = $oDB->query($sSql))
  {
    if($oResult->num_rows > 0)
    {      $bResult = true;

      $oSmarty = new cMySmarty();

      while($aRow = $oResult->fetch_array())
      {
        $aRow["constant_type_name"] = htmlspecialchars($aRow["constant_type_name"]);
        $aRow["constant_name"] = htmlspecialchars($aRow["constant_name"]);
        $aRow["constant_text"] = htmlspecialchars($aRow["constant_text"]);
        $aRow["constant_value"] = htmlspecialchars($aRow["constant_value"]);

        $oSmarty->append("aContentList", $aRow);
      }

      $aPageData = array();
      $aPageData["html_title"] = "Панель управления. Настройки.";

      $aMenu["constants"]["active"] = true;

      $oSmarty->assign("aPageData", $aPageData);
      $oSmarty->assign("aMenu", $aMenu);
      $oSmarty->assign("sInnerPage", "backend_constants_view");
      $oSmarty->display("backend_main.tpl");    }

    $oResult->close();
  }
}

if(!$bResult)
{  header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=constants&action_name=list");}
?>