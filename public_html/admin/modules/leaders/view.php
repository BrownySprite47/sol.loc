<?php

$oSmarty = new cMySmarty();
$oDB = cMyDB::oGetDB("db");

$iContentId = 0;

$sLeaderCreateDateRecommend = date("Y-m-d");

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $sSql = "SELECT
  l.leader_id,
  l.leader_create_datetime,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  COALESCE(l.city_id, '') AS city_id,
  COALESCE(l.sex_id, '') AS sex_id,
  l.leader_city_name,
  l.leader_done,
  l.leader_done_1,
  l.leader_done_2,
  l.leader_done_3,
  l.leader_done_4,
  l.leader_enabled,
  l.leader_phone,
  l.leader_email,
  l.leader_skype,
  l.leader_company,
  l.leader_position,
  COALESCE(l.leader_birth_date, '') AS leader_birth_date,
  COALESCE(l.leader_create_date, '') AS leader_create_date,
  IF(l.leader_birth_date IS NULL, 0, l.leader_birth_date_correct) AS leader_birth_date_correct,
  l.leader_enabled,
  l.leader_done,
  l.leader_high_priority,
  l.leader_create_backend_user_id,
  COALESCE(l.leader_interview_backend_user_id, '') AS leader_interview_backend_user_id,
  COALESCE(l.leader_write_backend_user_id, '') AS leader_write_backend_user_id,
  COALESCE(l.leader_interview_date, '') AS leader_interview_date,
  COALESCE(t.transaction_id, '') AS transaction_id,
  COALESCE(t.transaction_create_datetime, '') AS transaction_create_datetime,
  COALESCE(t.backend_user_id, '') AS transaction_backend_user_id,
  COALESCE(l.leader_interview_type, '') AS leader_interview_type,
  l.leader_contact_from,
  l.leader_interview_result,
  l.leader_social_network,
  l.leader_contacts,
  l.leader_question_01,
  COALESCE(l.leader_question_02, '') AS leader_question_02,
  l.leader_question_03,
  l.leader_question_04,
  l.leader_question_05,
  l.leader_question_06,
  l.leader_question_07,
  l.leader_question_10,
  l.leader_question_11,
  l.leader_question_12,
  l.leader_question_13,
  l.leader_question_14,
  l.leader_question_15,
  l.leader_question_16,
  l.leader_question_17,
  l.leader_question_18,
  l.leader_question_19,
  l.leader_question_20,
  l.leader_question_21,
  COALESCE(l.leader_question_08, '') AS leader_question_08,
  COALESCE(l.leader_question_09, '') AS leader_question_09,
  COUNT(r.recommendation_id) AS recommendations_to_count_all,
  SUM(IF(l.leader_interview_date <= r.recommendation_create_datetime OR r.recommendation_id IS NULL, 0, 1)) AS recommendations_to_count_for_interview
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "transactions AS t ON l.transaction_id = t.transaction_id
  LEFT JOIN " . DB_PREFIX . "recommendations AS r ON r.leader_id_to = " . $_GET["content_id"] . "
WHERE
  l.leader_id = " . $_GET["content_id"] . "
GROUP BY
  l.leader_id
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $iContentId = $aRow["leader_id"];

      if($aRow["leader_interview_date"] !== "" and $sLeaderCreateDateRecommend > $aRow["leader_interview_date"])
      {
      	$sLeaderCreateDateRecommend = $aRow["leader_interview_date"];
      }

      if(($sLeaderCreateDateRecommend . " 00:00:00") > $aRow["leader_create_datetime"])
      {
      	$sLeaderCreateDateRecommend = substr($aRow["leader_create_datetime"], 0, 10);
      }

      $aRow["leader_surname"] = htmlspecialchars($aRow["leader_surname"]);
      $aRow["leader_name"] = htmlspecialchars($aRow["leader_name"]);
      $aRow["leader_patronymic"] = htmlspecialchars($aRow["leader_patronymic"]);
      $aRow["leader_city_name"] = htmlspecialchars($aRow["leader_city_name"]);
      $aRow["leader_email"] = htmlspecialchars($aRow["leader_email"]);
      $aRow["leader_skype"] = htmlspecialchars($aRow["leader_skype"]);
      $aRow["leader_company"] = htmlspecialchars($aRow["leader_company"]);
      $aRow["leader_position"] = htmlspecialchars($aRow["leader_position"]);
      $aRow["leader_contact_from"] = htmlspecialchars($aRow["leader_contact_from"]);
      $aRow["leader_interview_result"] = htmlspecialchars($aRow["leader_interview_result"]);
      $aRow["leader_social_network"] = htmlspecialchars($aRow["leader_social_network"]);
      $aRow["leader_contacts"] = htmlspecialchars($aRow["leader_contacts"]);
      $aRow["leader_question_01"] = htmlspecialchars($aRow["leader_question_01"]);
      $aRow["leader_question_03"] = htmlspecialchars($aRow["leader_question_03"]);
      $aRow["leader_question_04"] = htmlspecialchars($aRow["leader_question_04"]);
      $aRow["leader_question_05"] = htmlspecialchars($aRow["leader_question_05"]);
      $aRow["leader_question_06"] = htmlspecialchars($aRow["leader_question_06"]);
      $aRow["leader_question_07"] = htmlspecialchars($aRow["leader_question_07"]);
      $aRow["leader_question_10"] = htmlspecialchars($aRow["leader_question_10"]);
      $aRow["leader_question_11"] = htmlspecialchars($aRow["leader_question_11"]);
      $aRow["leader_question_12"] = htmlspecialchars($aRow["leader_question_12"]);
      $aRow["leader_question_13"] = htmlspecialchars($aRow["leader_question_13"]);
      $aRow["leader_question_14"] = htmlspecialchars($aRow["leader_question_14"]);
      $aRow["leader_question_15"] = htmlspecialchars($aRow["leader_question_15"]);
      $aRow["leader_question_16"] = htmlspecialchars($aRow["leader_question_16"]);
      $aRow["leader_question_17"] = htmlspecialchars($aRow["leader_question_17"]);
      $aRow["leader_question_18"] = htmlspecialchars($aRow["leader_question_18"]);
      $aRow["leader_question_19"] = htmlspecialchars($aRow["leader_question_19"]);
      $aRow["leader_question_20"] = htmlspecialchars($aRow["leader_question_20"]);
      $aRow["leader_question_21"] = htmlspecialchars($aRow["leader_question_21"]);

      $oSmarty->assign("aContentData", $aRow);

      $sSql = "SELECT
  lp.leader_project_id,
  lp.leader_role,
  lp.project_order,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(p.project_id, '') AS project_id,
  COALESCE(p.project_name, lp.project_name, '') AS project_name,
  (SELECT COALESCE(CONCAT(l.leader_surname, IF(l.leader_name = '', '', CONCAT(' ', l.leader_name, IF(l.leader_patronymic = '', '', CONCAT(' ', l.leader_patronymic))))), CONCAT(lp_l.leader_surname, IF(lp_l.leader_name IS NULL, '', CONCAT(' ', lp_l.leader_name, IF(lp_l.leader_patronymic IS NULL, '', CONCAT(' ', lp_l.leader_patronymic)))))) FROM " . DB_PREFIX . "leaders_projects AS lp_l LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp_l.leader_id = l.leader_id WHERE lp.project_id = lp_l.project_id ORDER BY lp_l.leader_order, lp_l.leader_surname, lp_l.leader_name, lp_l.leader_patronymic, l.leader_surname, l.leader_name, l.leader_patronymic, l.leader_create_datetime, l.leader_id LIMIT 1) AS leader_name
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
WHERE
  lp.leader_id = " . $iContentId . "
ORDER BY
  lp.project_order,
  lp.project_name,
  p.project_name,
  p.project_create_datetime,
  p.project_id";
      if($oProjectsResult = $oDB->query($sSql))
      {
        while($aProjectsRow = $oProjectsResult->fetch_assoc())
        {
          $aProjectsRow["leader_role"] = htmlspecialchars($aProjectsRow["leader_role"]);
          $aProjectsRow["project_name"] = htmlspecialchars($aProjectsRow["project_name"]);
          $aProjectsRow["leader_name"] = htmlspecialchars($aProjectsRow["leader_name"]);

          $oSmarty->append("aProjects", $aProjectsRow);
        }
        $oProjectsResult->close();
      }

      $sSql = "SELECT
  r.recommendation_id,
  r.recommendation_reason,
  r.recommendation_comment,
  COALESCE(l.leader_id, '') AS leader_id_to,
  COALESCE(l.leader_surname, r.leader_surname) AS leader_surname,
  COALESCE(l.leader_name, r.leader_name) AS leader_name,
  COALESCE(l.leader_patronymic, r.leader_patronymic) AS leader_patronymic,
  COALESCE(r.city_id, '') AS city_id,
  r.leader_city_name,
  r.leader_email,
  r.leader_project_name,
  COALESCE(r.leader_phone, '') AS leader_phone,
  SUBSTRING_INDEX(COALESCE(GROUP_CONCAT(COALESCE(IF(p.project_name_small = '', p.project_name, p.project_name_small), lp.project_name, '') ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id SEPARATOR '###'), ''), '###', 1) AS project_name
FROM
  " . DB_PREFIX . "recommendations AS r
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON r.leader_id_to = l.leader_id
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON l.leader_id = lp.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
WHERE
  r.leader_id_from = " . $iContentId . "
GROUP BY
  r.recommendation_id
ORDER BY
  r.leader_surname,
  r.leader_name,
  r.leader_patronymic,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  r.recommendation_create_datetime,
  r.recommendation_id";
      if($oRecommendationsResult = $oDB->query($sSql))
      {
        while($aRecommendationsRow = $oRecommendationsResult->fetch_assoc())
        {
          $aRecommendationsRow["recommendation_reason"] = htmlspecialchars($aRecommendationsRow["recommendation_reason"]);
          $aRecommendationsRow["recommendation_comment"] = htmlspecialchars($aRecommendationsRow["recommendation_comment"]);
          $aRecommendationsRow["leader_surname"] = htmlspecialchars($aRecommendationsRow["leader_surname"]);
          $aRecommendationsRow["leader_name"] = htmlspecialchars($aRecommendationsRow["leader_name"]);
          $aRecommendationsRow["leader_patronymic"] = htmlspecialchars($aRecommendationsRow["leader_patronymic"]);
          $aRecommendationsRow["leader_city_name"] = htmlspecialchars($aRecommendationsRow["leader_city_name"]);
          $aRecommendationsRow["leader_email"] = htmlspecialchars($aRecommendationsRow["leader_email"]);
          $aRecommendationsRow["leader_project_name"] = htmlspecialchars($aRecommendationsRow["leader_project_name"]);
          $aRecommendationsRow["project_name"] = htmlspecialchars($aRecommendationsRow["project_name"]);

          $oSmarty->append("aRecommendations", $aRecommendationsRow);
        }
        $oRecommendationsResult->close();
      }

      $sSql = "SELECT
  l.leader_id,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  IF(l.leader_interview_date <= DATE(NOW()), l.leader_interview_date, DATE('" . $aRow["leader_create_datetime"] . "')) AS leader_create_date_recommend,
  SUBSTRING_INDEX(COALESCE(GROUP_CONCAT(COALESCE(IF(p.project_name_small = '', p.project_name, p.project_name_small), lp.project_name, '') ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id SEPARATOR '###'), ''), '###', 1) AS project_name
FROM
  " . DB_PREFIX . "recommendations AS r
  INNER JOIN " . DB_PREFIX . "leaders AS l ON r.leader_id_from = l.leader_id
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON r.leader_id_from = lp.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
WHERE
  r.leader_id_to = " . $iContentId . "
GROUP BY
  l.leader_id
ORDER BY
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_create_datetime,
  l.leader_id";
      if($oRecommendationsResult = $oDB->query($sSql))
      {
        while($aRecommendationsRow = $oRecommendationsResult->fetch_assoc())
        {
          $aRecommendationsRow["leader_surname"] = htmlspecialchars($aRecommendationsRow["leader_surname"]);
          $aRecommendationsRow["leader_name"] = htmlspecialchars($aRecommendationsRow["leader_name"]);
          $aRecommendationsRow["leader_patronymic"] = htmlspecialchars($aRecommendationsRow["leader_patronymic"]);
          $aRecommendationsRow["project_name"] = htmlspecialchars($aRecommendationsRow["project_name"]);

          $oSmarty->append("aRecommendationsFrom", $aRecommendationsRow);

          if($sLeaderCreateDateRecommend > $aRecommendationsRow["leader_create_date_recommend"])
          {
          	$sLeaderCreateDateRecommend = $aRecommendationsRow["leader_create_date_recommend"];
          }
        }
        $oRecommendationsResult->close();
      }
    }
    $oResult->close();
  }
}

vSetFormErrors($oSmarty);

$sSql = "SELECT
  c.city_id,
  c.city_name
FROM
  " . DB_PREFIX . "cities AS c
ORDER BY
  c.city_order,
  c.city_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["city_name"] = htmlspecialchars($aRow["city_name"]);

    $oSmarty->append("aCities", $aRow);
  }
  $oResult->close();
}

$sSql = "SELECT
  s.sex_id,
  s.sex_name
FROM
  " . DB_PREFIX . "sex AS s
ORDER BY
  s.sex_order,
  s.sex_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["sex_name"] = htmlspecialchars($aRow["sex_name"]);

    $oSmarty->append("aSex", $aRow);
  }
  $oResult->close();
}

$aBackendUsers = array();

$sSql = "SELECT
  bu.backend_user_id,
  bu.backend_user_name
FROM
  " . DB_PREFIX . "backend_users AS bu
ORDER BY
  bu.backend_user_name";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aRow["backend_user_name"] = htmlspecialchars($aRow["backend_user_name"]);

    $aBackendUsers[$aRow["backend_user_id"]] = $aRow;
  }
  $oResult->close();
}

if(!empty($aBackendUsers))
{
  $oSmarty->assign("aBackendUsers", $aBackendUsers);
}

$aOptions = array();

$sSql = "SELECT
  o.option_id,
  o.option_type_id,
  o.option_multi_enabled,
  GROUP_CONCAT(ov.option_value_id ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_value_id,
  GROUP_CONCAT(ov.option_value ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_value,
  GROUP_CONCAT(IF(cov.option_value_id IS NULL, 0, 1) ORDER BY ov.option_order, ov.option_value SEPARATOR '###') AS option_selected
FROM
  " . DB_PREFIX . "options AS o
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON o.option_id = ov.option_id
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    cov.content_id = " . $iContentId . " AND
    cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . " AND
    ov.option_value_id = cov.option_value_id AND
    o.option_multi_enabled = 1
WHERE
  o.option_id IN (1, 2, 3, 4)
GROUP BY
  o.option_id
ORDER BY
  o.option_id";
if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aOptionValueId = explode("###", $aRow["option_value_id"]);
    $aOptionValue = explode("###", $aRow["option_value"]);
    $aOptionSelected = explode("###", $aRow["option_selected"]);

    unset($aRow["option_value_id"]);
    unset($aRow["option_value"]);
    unset($aRow["option_selected"]);

    foreach($aOptionValueId as $iTemp => $iOptionValueId)
    {
      $aRow["option_value"][$iOptionValueId] = array("option_value_id" => $iOptionValueId, "option_value" => $aOptionValue[$iTemp], "option_selected" => $aOptionSelected[$iTemp]);
    }

    $aOptions[$aRow["option_id"]] = $aRow;
  }
  $oResult->close();
}

if(!empty($aOptions))
{
  $oSmarty->assign("aOptions", $aOptions);
}

$oSmarty->assign("sLeaderCreateDateRecommend", $sLeaderCreateDateRecommend);
$oSmarty->assign("iBackendUserId", $aBackendUserInfo["backend_user_id"]);
$oSmarty->assign("bRecommendationDeleteEnabled", isset($aBackendUserInfo["backend_access_types"]["recommendation_delete_enabled"]));
$oSmarty->assign("bLeaderProjectDeleteEnabled", isset($aBackendUserInfo["backend_access_types"]["leader_project_delete_enabled"]));
$oSmarty->assign("bLeadersEdit", isset($aBackendUserInfo["backend_access_types"]["leaders_edit"]));

$aPageData = array();
$aPageData["html_title"] = "Панель управления. Лидеры ЛИСС.";
$aPageData["java_scripts"] = array(PROJECT_BACKEND_URL . "js/forms/form_leaders.js");

$aMenu["leaders"]["active"] = true;

$oSmarty->assign("aPageData", $aPageData);
$oSmarty->assign("aMenu", $aMenu);

// запрос на получение списка объектов для тегов
// 

$sSql = "SELECT * FROM " . DB_PREFIX . "tags_leaders WHERE id_leader = '".htmlspecialchars($_GET["content_id"])."'";


if($oResult = $oDB->query($sSql))
{
  $i = 0;
  while($aRow = $oResult->fetch_assoc())
  {

    $aTagsLiders[$i]['data'] = $aRow;

    $sSqlObjects = "SELECT * FROM " . DB_PREFIX . "tags_objects WHERE id = '".$aRow['id_name_object']."'";
    if($oResultObjects = $oDB->query($sSqlObjects))
    {
      while($aObjects = $oResultObjects->fetch_assoc())
      {
        $aTagsLiders[$i]['object']['name'] = $aObjects;
      }
    }

    $sSqlTags = "SELECT * FROM " . DB_PREFIX . "tags_object_leader WHERE id = '".$aRow['id_name_object']."'";
    if($oResultTags = $oDB->query($sSqlTags))
    {
      while($aTags = $oResultTags->fetch_assoc())
      {
        $aTagsLiders[$i]['object']['value'] = $aTags;
      }
    }

    $sSqlTags = "SELECT * FROM " . DB_PREFIX . "tags_names WHERE id = '".$aRow['id_name_tag_1']."'";
    if($oResultTags = $oDB->query($sSqlTags))
    {
      while($aTags = $oResultTags->fetch_assoc())
      {
        $aTagsLiders[$i]['tag_1'] = $aTags;
      }
    }

    $sSqlTags = "SELECT * FROM " . DB_PREFIX . "tags_names WHERE id = '".$aRow['id_name_tag_2']."'";
    if($oResultTags = $oDB->query($sSqlTags))
    {
      while($aTags = $oResultTags->fetch_assoc())
      {
        $aTagsLiders[$i]['tag_2'] = $aTags;
      }
    }

    $sSqlTags = "SELECT * FROM " . DB_PREFIX . "tags_names WHERE id = '".$aRow['id_name_tag_3']."'";
    if($oResultTags = $oDB->query($sSqlTags))
    {
      while($aTags = $oResultTags->fetch_assoc())
      {
        $aTagsLiders[$i]['tag_3'] = $aTags;
      }
    }    

    $i++;
  }
  $oResult->close();
// echo "<pre>";
//     print_r($aTagsLiders);
// echo "</pre>";
if(isset($aTagsLiders) && !empty($aTagsLiders))
{
  $oSmarty->assign("aTagsLiders", $aTagsLiders);
}else{
  $oSmarty->assign("aTagsLiders", 'NEW');
}

}


$sSql = "SELECT * FROM " . DB_PREFIX . "tags";


if($oResult = $oDB->query($sSql))
{
  while($aRow = $oResult->fetch_assoc())
  {
    $aTags[] = $aRow;
  }
  $oResult->close();
// echo "<pre>";
//     print_r($aTags);
// echo "</pre>";

$oSmarty->assign("aTags", $aTags);
}



if($sActionName === "view")
{
  $oSmarty->assign("sInnerPage", "backend_leaders_view");
  $oSmarty->display("backend_main.tpl");
}
else
{
  if($iContentId === 0)
  {
  	header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=list");
  }
  else
  {
  	$oSmarty->assign("sInnerPage", "backend_leaders_view_without_edit");
    $oSmarty->display("backend_main.tpl");
  }
}

?>