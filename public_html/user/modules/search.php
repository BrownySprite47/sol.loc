<?php

$aData = array();

if(isset($_POST["search_text"], $_POST["type_id"]) and bIsInt($_POST["type_id"], 1, 2))
{  if(get_magic_quotes_gpc())
  {
    $_POST["search_text"] = stripslashes($_POST["search_text"]);
  }
  $_POST["search_text"] = trim($_POST["search_text"]);

  if(mb_strlen($_POST["search_text"], "utf-8") > 2)
  {  	$oDB = cMyDB::oGetDB("db");

  	switch($_POST["type_id"])
    {
  	  case 1:
  	  {
  	    //проекты

  	    $sSql = "SELECT
  p.project_id AS content_id,
  p.project_name AS content_name,
  CONCAT('" . PROJECT_BACKEND_URL . "index.php?module_name=projects&action_name=view&content_id=', p.project_id) AS content_url,
  IF(p.project_name = '" . $oDB->escape_string($_POST["search_text"]) . "', 1, 0) AS search_order_01,
  IF(p.project_name_small = '" . $oDB->escape_string($_POST["search_text"]) . "', 1, 0) AS search_order_02,
  IF(p.project_name_code = '" . $oDB->escape_string($_POST["search_text"]) . "', 1, 0) AS search_order_03,
  IF(p.project_name LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%', 1, 0) AS search_order_04,
  IF(p.project_name_small LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%', 1, 0) AS search_order_05,
  IF(p.project_name_code LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%', 1, 0) AS search_order_06
FROM
  " . DB_PREFIX . "projects AS p
WHERE
  p.project_name LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' OR
  p.project_name_small LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' OR
  p.project_name_code LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%'
ORDER BY
  search_order_01 DESC,
  search_order_02 DESC,
  search_order_03 DESC,
  search_order_04 DESC,
  search_order_05 DESC,
  search_order_06 DESC,
  p.project_name,
  p.project_name_small,
  p.project_name_code,
  p.project_id";

  	    break;
  	  }

  	  case 2:
  	  {
  	    //лидеры

  	    $sSql = "SELECT
  l.leader_id AS content_id,
  CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic))))) AS content_name,
  CONCAT('" . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=view&content_id=', l.leader_id) AS content_url,
  IF(l.leader_surname = '" . $oDB->escape_string($_POST["search_text"]) . "', 1, 0) AS search_order_01
FROM
  " . DB_PREFIX . "leaders AS l
WHERE
  l.leader_surname LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%'
ORDER BY
  search_order_01 DESC,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_id";

  	    break;
  	  }
    }

    if($oResult = $oDB->query($sSql))
    {
      $bOdd = true;

      while($aRow = $oResult->fetch_assoc())
      {
        $aRow["content_odd"] = (int) $bOdd;
        $bOdd = !$bOdd;

        $aData[] = array("content_id" => $aRow["content_id"], "content_name" => htmlspecialchars($aRow["content_name"]), "content_url" => $aRow["content_url"], "content_odd" => $aRow["content_odd"]);
      }
      $oResult->close();
    }  }}

if(!empty($aData))
{  echo json_encode($aData);}

?>