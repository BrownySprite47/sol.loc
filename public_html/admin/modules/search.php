<?php

$aData = array();
$tag = '0';

if(isset($_POST["search_text"], $_POST["type_id"]) and bIsInt($_POST["type_id"], 1, 100))
{
  if(get_magic_quotes_gpc())
  {
    $_POST["search_text"] = stripslashes($_POST["search_text"]);
  }
  $_POST["search_text"] = trim($_POST["search_text"]);

  if(mb_strlen($_POST["search_text"], "utf-8") > 2)
  {
  	$oDB = cMyDB::oGetDB("db");

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
  IF(p.project_name_code LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%', 1, 0) AS search_order_06,
  SUBSTRING_INDEX(COALESCE(GROUP_CONCAT(COALESCE(CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic))))), CONCAT(lp.leader_surname, IF(lp.leader_name IS NULL, '', CONCAT(' ', lp.leader_name, IF(lp.leader_patronymic IS NULL, '', CONCAT(' ', lp.leader_patronymic))))), '') ORDER BY lp.leader_order, lp.leader_surname, lp.leader_name, lp.leader_patronymic, l.leader_surname, l.leader_name, l.leader_patronymic, l.leader_create_datetime, l.leader_id SEPARATOR '###'), ''), '###', 1) AS content_name_other
FROM
  " . DB_PREFIX . "projects AS p
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON p.project_id = lp.project_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
WHERE
  (p.project_name LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' OR
  p.project_name_small LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' OR
  p.project_name_code LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%') AND
  p.project_enabled = 1
GROUP BY
  p.project_id
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
  IF(l.leader_surname = '" . $oDB->escape_string($_POST["search_text"]) . "', 1, 0) AS search_order_01,
  SUBSTRING_INDEX(COALESCE(GROUP_CONCAT(COALESCE(IF(p.project_name_small = '', p.project_name, p.project_name_small), lp.project_name, '') ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id SEPARATOR '###'), ''), '###', 1) AS content_name_other
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON l.leader_id = lp.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
WHERE
  l.leader_surname LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' AND
  l.leader_enabled = 1
GROUP BY
  l.leader_id
ORDER BY
  search_order_01 DESC,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_id";

  	    break;
  	  }
      case 3:
      {
        //теги

        // SELECT CONCAT ( 'Happy ', 'Birthday ', 11, '/', '25' ) AS Result;
        $sSql = "SELECT id AS content_id, name AS content_name, name AS content_name_other, name AS content_url FROM " . DB_PREFIX . "tags_objects WHERE name LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' GROUP BY id ORDER BY id";
        // echo $sSql;
        $tag = '1';
        break;
      }

      case 4:
      {
        //теги

        // SELECT CONCAT ( 'Happy ', 'Birthday ', 11, '/', '25' ) AS Result;
        $sSql = "SELECT id AS content_id, name AS content_name, name AS content_name_other, name AS content_url FROM " . DB_PREFIX . "tags_names WHERE name LIKE '%" . $oDB->escape_string($_POST["search_text"]) . "%' GROUP BY id ORDER BY id";
        // echo $sSql;
        $tag = '1';
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

        if ($tag == '1') {
          $aData[] = array("content_id" => $aRow["content_id"], "content_name" => htmlspecialchars($aRow["content_name"]), "content_name_other" => '', "content_url" => '', "content_odd" => $aRow["content_odd"], "content_tag" => '1');
        }else{
          $aData[] = array("content_id" => $aRow["content_id"], "content_name" => htmlspecialchars($aRow["content_name"]), "content_name_other" => htmlspecialchars($aRow["content_name_other"]), "content_url" => $aRow["content_url"], "content_odd" => $aRow["content_odd"]);
        }
        
      }
      $oResult->close();
    }
  }
}

if(!empty($aData))
{
  echo json_encode($aData);
}

?>