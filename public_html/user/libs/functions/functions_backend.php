<?php

function vTransactionLeader($iContentId, $iBackendUserId)
{  $aData = array();

  $oDB = cMyDB::oGetDB("db");

  $sSql = "SELECT
  l.*,
  COALESCE(t.transaction_data_hash, '') AS transaction_data_hash
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON l.transaction_id = t.transaction_id
WHERE
  l.leader_id = " . $iContentId;
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $sTransactionDataHashCurrent = $aRow["transaction_data_hash"];

      unset($aRow["transaction_data_hash"]);
      unset($aRow["transaction_id"]);
      unset($aRow["leader_id"]);

      ksort($aRow);
      $aData["content"] = $aRow;
    }
    $oResult->close();
  }

  $sSql = "SELECT
  lp.*
FROM
  " . DB_PREFIX . "leaders_projects AS lp
WHERE
  lp.leader_id = " . $iContentId . "
ORDER BY
  lp.leader_project_id";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      if(!isset($aData["leaders_projects"]))
      {      	$aData["leaders_projects"] = array();      }

      ksort($aRow);
      $aData["leaders_projects"][] = $aRow;
    }
    $oResult->close();
  }

  $sSql = "SELECT
  r.*
FROM
  " . DB_PREFIX . "recommendations AS r
WHERE
  r.leader_id_from = " . $iContentId . "
ORDER BY
  r.recommendation_id";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      if(!isset($aData["recommendations"]))
      {
      	$aData["recommendations"] = array();
      }

      ksort($aRow);
      $aData["recommendations"][] = $aRow;
    }
    $oResult->close();
  }

  $sSql = "SELECT
  cov.option_value_id
FROM
  " . DB_PREFIX . "contents_option_values AS cov
WHERE
  cov.content_id = " . $iContentId . " AND
  cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . "
ORDER BY
  cov.option_value_id";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      if(!isset($aData["content_options"]))
      {
      	$aData["content_options"] = array();
      }

      $aData["content_options"][] = $aRow["option_value_id"];
    }
    $oResult->close();
  }

  if(isset($aData["content"]))
  {  	$sTransactionData = serialize($aData);
  	$sTransactionDataHash = md5($sTransactionData);

  	if($sTransactionDataHashCurrent != $sTransactionDataHash)
  	{  	  //создаем новую транзакцию

  	  $sSql = "INSERT INTO
  " . DB_PREFIX . "transactions
SET
  transaction_create_datetime = NOW(),
  backend_user_id = " . $iBackendUserId . ",
  content_type_id = " . LEADER_CONTENT_TYPE_ID . ",
  content_id = " . $iContentId . ",
  transaction_data_hash = '" . $oDB->escape_string($sTransactionDataHash) . "',
  transaction_data = '" . $oDB->escape_string($sTransactionData) . "'";
      if($oResult = $oDB->query($sSql) and $oDB->affected_rows === 1)
      {
        $iTransactionId = $oDB->insert_id;

        $sSql = "UPDATE
  " . DB_PREFIX . "leaders AS l
SET
  l.transaction_id = " . $iTransactionId . "
WHERE
  l.leader_id = " . $iContentId;
        if($oResult = $oDB->query($sSql))
        {        }      }  	}  }}

function vTransactionProject($iContentId, $iBackendUserId)
{
  $aData = array();

  $oDB = cMyDB::oGetDB("db");

  $sSql = "SELECT
  p.*,
  COALESCE(t.transaction_data_hash, '') AS transaction_data_hash
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON p.transaction_id = t.transaction_id
WHERE
  p.project_id = " . $iContentId;
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $sTransactionDataHashCurrent = $aRow["transaction_data_hash"];

      unset($aRow["transaction_data_hash"]);
      unset($aRow["transaction_id"]);
      unset($aRow["project_id"]);

      ksort($aRow);
      $aData["content"] = $aRow;
    }
    $oResult->close();
  }

  $sSql = "SELECT
  lp.*
FROM
  " . DB_PREFIX . "leaders_projects AS lp
WHERE
  lp.project_id = " . $iContentId . "
ORDER BY
  lp.leader_project_id";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      if(!isset($aData["leaders_projects"]))
      {
      	$aData["leaders_projects"] = array();
      }

      ksort($aRow);
      $aData["leaders_projects"][] = $aRow;
    }
    $oResult->close();
  }

  $sSql = "SELECT
  cov.option_value_id
FROM
  " . DB_PREFIX . "contents_option_values AS cov
WHERE
  cov.content_id = " . $iContentId . " AND
  cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . "
ORDER BY
  cov.option_value_id";
  if($oResult = $oDB->query($sSql))
  {
    while($aRow = $oResult->fetch_assoc())
    {
      if(!isset($aData["content_options"]))
      {
      	$aData["content_options"] = array();
      }

      $aData["content_options"][] = $aRow["option_value_id"];
    }
    $oResult->close();
  }

  if(isset($aData["content"]))
  {
  	$sTransactionData = serialize($aData);
  	$sTransactionDataHash = md5($sTransactionData);

  	if($sTransactionDataHashCurrent != $sTransactionDataHash)
  	{
  	  //создаем новую транзакцию

  	  $sSql = "INSERT INTO
  " . DB_PREFIX . "transactions
SET
  transaction_create_datetime = NOW(),
  backend_user_id = " . $iBackendUserId . ",
  content_type_id = " . PROJECT_CONTENT_TYPE_ID . ",
  content_id = " . $iContentId . ",
  transaction_data_hash = '" . $oDB->escape_string($sTransactionDataHash) . "',
  transaction_data = '" . $oDB->escape_string($sTransactionData) . "'";
      if($oResult = $oDB->query($sSql) and $oDB->affected_rows === 1)
      {
        $iTransactionId = $oDB->insert_id;

        $sSql = "UPDATE
  " . DB_PREFIX . "projects AS p
SET
  p.transaction_id = " . $iTransactionId . "
WHERE
  p.project_id = " . $iContentId;
        if($oResult = $oDB->query($sSql))
        {
        }
      }
  	}
  }
}

?>