<?php

$bResult = false;

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "SELECT
  l.leader_id,
  l.leader_create_datetime,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  COALESCE(c.city_name, '') AS city_name,
  l.leader_city_name,
  l.leader_done,
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
  COALESCE(bu_interview.backend_user_name, '') AS leader_interview_backend_user_name,
  COALESCE(bu_write.backend_user_name, '') AS leader_write_backend_user_name,
  COALESCE(l.leader_interview_date, '') AS leader_interview_date,
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
  COALESCE(l.leader_question_09, '') AS leader_question_09
FROM
  " . DB_PREFIX . "leaders AS l
  LEFT JOIN " . DB_PREFIX . "cities AS c ON l.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu_interview ON l.leader_interview_backend_user_id = bu_interview.backend_user_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu_write ON l.leader_write_backend_user_id = bu_write.backend_user_id
WHERE
  l.leader_id = " . $_GET["content_id"] . "
LIMIT
  1";
  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {
      $iContentId = $aRow["leader_id"];

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
  o.option_id IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
GROUP BY
  o.option_id
ORDER BY
  o.option_id";
      if($oOptionsResult = $oDB->query($sSql))
      {
        while($aOptionsRow = $oOptionsResult->fetch_assoc())
        {
          $aOptionValueId = explode("###", $aOptionsRow["option_value_id"]);
          $aOptionValue = explode("###", $aOptionsRow["option_value"]);
          $aOptionSelected = explode("###", $aOptionsRow["option_selected"]);

          unset($aOptionsRow["option_value_id"]);
          unset($aOptionsRow["option_value"]);
          unset($aOptionsRow["option_selected"]);

          foreach($aOptionValueId as $iTemp => $iOptionValueId)
          {
            $aOptionsRow["option_value"][$iOptionValueId] = array("option_value_id" => $iOptionValueId, "option_value" => $aOptionValue[$iTemp], "option_selected" => $aOptionSelected[$iTemp]);
          }

          $aOptions[$aOptionsRow["option_id"]] = $aOptionsRow;
        }
        $oOptionsResult->close();
      }

      $bResult = true;

      require_once "libs/Zend/Stdlib/Autoloader.php";
      require_once "libs/PhpOffice/Common/Autoloader.php";
      require_once "libs/PhpOffice/PhpWord/Autoloader.php";

      \Zend\Stdlib\Autoloader::register();
      \PhpOffice\PhpWord\Autoloader::register();
      \PhpOffice\Common\Autoloader::register();

      $oPhpWord = new \PhpOffice\PhpWord\PhpWord();
      $oTemplate = new \PhpOffice\PhpWord\TemplateProcessor(LEADER_DOCX_TEMPLATE_FILE);

      $sLeaderFullName = $aRow["leader_surname"];

      if($aRow["leader_name"] !== "")
      {
      	if($sLeaderFullName !== "")
      	{
      	  $sLeaderFullName .= " ";
      	}
      	$sLeaderFullName .= $aRow["leader_name"];
      }

      if($aRow["leader_patronymic"] !== "")
      {
      	if($sLeaderFullName !== "")
      	{
      	  $sLeaderFullName .= " ";
      	}
      	$sLeaderFullName .= $aRow["leader_patronymic"];
      }

      if(mb_strlen($aRow["leader_phone"], "utf-8") === 10)
      {
        $aRow["leader_phone"] = "+7" . $aRow["leader_phone"];
      }

      if($aRow["leader_city_name"] !== "")
      {
      	if($aRow["city_name"] === "")
      	{
      	  $aRow["city_name"] = $aRow["leader_city_name"];
      	}
      	else
      	{
      	  $aRow["city_name"] .= " (" . $aRow["leader_city_name"] . ")";
      	}
      }

      if($aRow["leader_interview_type"] !== "" and isset($aOptions[1]["option_value"][$aRow["leader_interview_type"]]))
      {
      	$aRow["leader_interview_type"] = $aOptions[1]["option_value"][$aRow["leader_interview_type"]]["option_value"];
      }
      else
      {
      	$aRow["leader_interview_type"] = "";
      }

      $oTemplate->setValue("leader_id", $aRow["leader_id"]);
      $oTemplate->setValue("leader_email", htmlspecialchars($aRow["leader_email"]));
      $oTemplate->setValue("leader_full_name", htmlspecialchars($sLeaderFullName));
      $oTemplate->setValue("leader_skype", htmlspecialchars($aRow["leader_skype"]));
      $oTemplate->setValue("leader_position", htmlspecialchars($aRow["leader_position"]));
      $oTemplate->setValue("leader_company", htmlspecialchars($aRow["leader_company"]));
      $oTemplate->setValue("leader_phone", $aRow["leader_phone"]);
      $oTemplate->setValue("leader_birth_date", $aRow["leader_birth_date"]);
      $oTemplate->setValue("leader_contacts", htmlspecialchars($aRow["leader_contacts"]));
      $oTemplate->setValue("leader_interview_date", $aRow["leader_interview_date"]);
      $oTemplate->setValue("leader_social_network", htmlspecialchars($aRow["leader_social_network"]));
      $oTemplate->setValue("leader_contact_from", htmlspecialchars($aRow["leader_contact_from"]));
      $oTemplate->setValue("leader_interview_result", htmlspecialchars($aRow["leader_interview_result"]));
      $oTemplate->setValue("city_name", htmlspecialchars($aRow["city_name"]));
      $oTemplate->setValue("leader_interview_type", htmlspecialchars($aRow["leader_interview_type"]));
      $oTemplate->setValue("leader_interview_backend_user_name", htmlspecialchars($aRow["leader_interview_backend_user_name"]));
      $oTemplate->setValue("leader_write_backend_user_name", htmlspecialchars($aRow["leader_write_backend_user_name"]));
      $oTemplate->setValue("leader_question_03", htmlspecialchars($aRow["leader_question_03"]));
      $oTemplate->setValue("leader_question_04", htmlspecialchars($aRow["leader_question_04"]));
      $oTemplate->setValue("leader_question_05", htmlspecialchars($aRow["leader_question_05"]));
      $oTemplate->setValue("leader_question_06", htmlspecialchars($aRow["leader_question_06"]));
      $oTemplate->setValue("leader_question_07", htmlspecialchars($aRow["leader_question_07"]));
      $oTemplate->setValue("leader_question_10", htmlspecialchars($aRow["leader_question_10"]));
      $oTemplate->setValue("leader_question_11", htmlspecialchars($aRow["leader_question_11"]));
      $oTemplate->setValue("leader_question_12", htmlspecialchars($aRow["leader_question_12"]));
      $oTemplate->setValue("leader_question_13", htmlspecialchars($aRow["leader_question_13"]));
      $oTemplate->setValue("leader_question_14", htmlspecialchars($aRow["leader_question_14"]));
      $oTemplate->setValue("leader_question_15", htmlspecialchars($aRow["leader_question_15"]));
      $oTemplate->setValue("leader_question_16", htmlspecialchars($aRow["leader_question_16"]));
      $oTemplate->setValue("leader_question_17", htmlspecialchars($aRow["leader_question_17"]));
      $oTemplate->setValue("leader_question_18", htmlspecialchars($aRow["leader_question_18"]));
      $oTemplate->setValue("leader_question_19", htmlspecialchars($aRow["leader_question_19"]));
      $oTemplate->setValue("leader_question_20", htmlspecialchars($aRow["leader_question_20"]));

      //рекомендации

      $sSql = "SELECT
  r.recommendation_reason,
  COALESCE(l.leader_surname, r.leader_surname) AS leader_surname,
  COALESCE(l.leader_name, r.leader_name) AS leader_name,
  COALESCE(l.leader_patronymic, r.leader_patronymic) AS leader_patronymic,
  COALESCE(c_leader.city_name, c.city_name, '') AS city_name,
  COALESCE(l.leader_city_name, r.leader_city_name) AS leader_city_name,
  COALESCE(l.leader_email, r.leader_email, '') AS recommendation_leader_email,
  r.leader_project_name,
  COALESCE(l.leader_phone, r.leader_phone, '') AS recommendation_leader_phone,
  SUBSTRING_INDEX(COALESCE(GROUP_CONCAT(COALESCE(IF(p.project_name_small = '', p.project_name, p.project_name_small), lp.project_name, '') ORDER BY lp.project_order, lp.project_name, p.project_name, p.project_create_datetime, p.project_id SEPARATOR '###'), ''), '###', 1) AS recommendation_project_name
FROM
  " . DB_PREFIX . "recommendations AS r
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON r.leader_id_to = l.leader_id
  LEFT JOIN " . DB_PREFIX . "leaders_projects AS lp ON l.leader_id = lp.leader_id
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
  LEFT JOIN " . DB_PREFIX . "cities AS c ON r.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "cities AS c_leader ON l.city_id = c_leader.city_id
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
        $iRecommendationNumber = 1;
        $iRecommendationCount = $oRecommendationsResult->num_rows + 5;

        $oTemplate->cloneBlock("recommendation_block", $iRecommendationCount);

        while($aRecommendationsRow = $oRecommendationsResult->fetch_assoc())
        {
          if(mb_strlen($aRecommendationsRow["recommendation_leader_phone"], "utf-8") === 10)
          {
          	$aRecommendationsRow["recommendation_leader_phone"] = "+7" . $aRecommendationsRow["recommendation_leader_phone"];
          }

          $sLeaderName = $aRecommendationsRow["leader_surname"];

          if($aRecommendationsRow["leader_surname"] !== "" and $aRecommendationsRow["leader_name"] !== "")
          {
          	$sLeaderName = $sLeaderName . " " . $aRecommendationsRow["leader_name"];

          	if($aRecommendationsRow["leader_patronymic"] !== "")
            {
          	  $sLeaderName = $sLeaderName . " " . $aRecommendationsRow["leader_patronymic"];
            }
          }

          if($aRecommendationsRow["recommendation_project_name"] === "")
          {
          	$aRecommendationsRow["recommendation_project_name"] = $aRecommendationsRow["leader_project_name"];
          }

          $sCityName = $aRecommendationsRow["city_name"];

          if($aRecommendationsRow["leader_city_name"] !== "")
          {
          	if($sCityName === "")
          	{
          	  $sCityName = $aRecommendationsRow["leader_city_name"];
          	}
          	else
          	{
          	  $sCityName .= " (" . $aRecommendationsRow["leader_city_name"] . ")";
          	}
          }

          $oTemplate->setValue("recommendation_number#" . $iRecommendationNumber, $iRecommendationNumber);
          $oTemplate->setValue("recommendation_reason#" . $iRecommendationNumber, $aRecommendationsRow["recommendation_reason"]);
          $oTemplate->setValue("recommendation_leader_email#" . $iRecommendationNumber, $aRecommendationsRow["recommendation_leader_email"]);
          $oTemplate->setValue("recommendation_leader_phone#" . $iRecommendationNumber, $aRecommendationsRow["recommendation_leader_phone"]);
          $oTemplate->setValue("recommendation_leader_name#" . $iRecommendationNumber, $sLeaderName);
          $oTemplate->setValue("recommendation_project_name#" . $iRecommendationNumber, $aRecommendationsRow["recommendation_project_name"]);
          $oTemplate->setValue("recommendation_city_name#" . $iRecommendationNumber, $sCityName);

          $iRecommendationNumber++;
        }
        $oRecommendationsResult->close();

        for($iTemp = 1; $iTemp <= 5; $iTemp++)
        {
          $oTemplate->setValue("recommendation_number#" . $iRecommendationNumber, $iRecommendationNumber);
          $oTemplate->setValue("recommendation_reason#" . $iRecommendationNumber, "");
          $oTemplate->setValue("recommendation_leader_email#" . $iRecommendationNumber, "");
          $oTemplate->setValue("recommendation_leader_phone#" . $iRecommendationNumber, "");
          $oTemplate->setValue("recommendation_leader_name#" . $iRecommendationNumber, "");
          $oTemplate->setValue("recommendation_project_name#" . $iRecommendationNumber, "");
          $oTemplate->setValue("recommendation_city_name#" . $iRecommendationNumber, "");

          $iRecommendationNumber++;
        }
      }

      //проекты

      $sSql = "SELECT
  lp.leader_project_id,
  lp.leader_role,
  lp.project_order,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(p.project_id, '') AS project_id,
  COALESCE(p.project_name, lp.project_name, '') AS project_name,
  COALESCE(p.project_name_small, '') AS project_name_small,
  COALESCE(p.project_name_code, '') AS project_name_code,
  COALESCE(bu_interview.backend_user_name, '') AS project_interview_backend_user_name,
  COALESCE(bu_write.backend_user_name, '') AS project_write_backend_user_name,
  COALESCE(p.project_interview_date, '') AS project_interview_date,
  COALESCE(p.project_text, '') AS project_text,
  COALESCE(p.project_site, '') AS project_site,
  COALESCE(l.leader_id, '') AS leader_id,
  COALESCE(l.leader_surname, '') AS leader_surname,
  COALESCE(l.leader_name, p.leader_name) AS leader_name,
  COALESCE(l.leader_patronymic, '') AS leader_patronymic,
  COALESCE(p.project_question_01, '') AS project_question_01,
  COALESCE(p.project_question_02, '') AS project_question_02,
  COALESCE(p.project_question_03, '') AS project_question_03,
  COALESCE(p.project_question_04, '') AS project_question_04,
  COALESCE(p.project_question_05, '') AS project_question_05,
  COALESCE(p.project_question_06, '') AS project_question_06,
  COALESCE(p.project_question_07, '') AS project_question_07,
  COALESCE(p.project_question_08, '') AS project_question_08,
  COALESCE(p.project_question_09, '') AS project_question_09,
  COALESCE(p.project_question_10, '') AS project_question_10,
  COALESCE(p.project_question_11, '') AS project_question_11,
  COALESCE(p.project_question_12, '') AS project_question_12,
  COALESCE(p.project_question_13, '') AS project_question_13,
  COALESCE(p.project_question_14, '') AS project_question_14,
  COALESCE(p.project_question_15, '') AS project_question_15,
  COALESCE(p.project_question_16, '') AS project_question_16,
  COALESCE(p.project_question_17, '') AS project_question_17,
  COALESCE(p.project_question_18, '') AS project_question_18,
  COALESCE(p.project_question_19, '') AS project_question_19,
  COALESCE(p.project_question_20, '') AS project_question_20,
  COALESCE(p.project_question_21, '') AS project_question_21,
  COALESCE(p.project_question_22, '') AS project_question_22,
  COALESCE(p.project_question_23, '') AS project_question_23,
  COALESCE(p.project_question_24, '') AS project_question_24,
  COALESCE(p.project_question_25, '') AS project_question_25,
  COALESCE(p.project_question_26, '') AS project_question_26,
  COALESCE(p.project_question_27, '') AS project_question_27,
  COALESCE(p.project_question_28, '') AS project_question_28,
  COALESCE(p.project_question_29, '') AS project_question_29,
  COALESCE(p.project_question_30, '') AS project_question_30,
  COALESCE(p.project_question_31, '') AS project_question_31,
  COALESCE(p.project_question_34, '') AS project_question_34,
  COALESCE(p.project_question_35, '') AS project_question_35,
  COALESCE(p.project_question_36, '') AS project_question_36,
  COALESCE(p.project_question_37, '') AS project_question_37,
  COALESCE(p.project_question_38, '') AS project_question_38,
  COALESCE(p.project_question_39, '') AS project_question_39,
  COALESCE(p.project_question_40, '') AS project_question_40,
  COALESCE(p.project_question_32, '') AS project_question_32,
  COALESCE(p.project_question_33, '') AS project_question_33,
  COALESCE(p.project_city_name, '') AS project_city_name,
  COALESCE(c.city_name, '') AS city_name,
  COALESCE(p.project_start_date, '') AS project_start_date,
  COALESCE(p.project_create_date, '') AS project_create_date,
  COALESCE(p.project_question_41, '') AS project_question_41,
  COALESCE(p.project_question_42, '') AS project_question_42,
  COALESCE(p.project_question_43, '') AS project_question_43,
  COALESCE(p.project_question_44, '') AS project_question_44,
  COALESCE(p.project_question_45, '') AS project_question_45,
  COALESCE(p.project_question_46, '') AS project_question_46,
  COALESCE(p.project_question_47, '') AS project_question_47
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  LEFT JOIN " . DB_PREFIX . "projects AS p ON lp.project_id = p.project_id
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON p.leader_id = l.leader_id
  LEFT JOIN " . DB_PREFIX . "cities AS c ON p.city_id = c.city_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu_interview ON p.project_interview_backend_user_id = bu_interview.backend_user_id
  LEFT JOIN " . DB_PREFIX . "backend_users AS bu_write ON p.project_write_backend_user_id = bu_write.backend_user_id
WHERE
  lp.leader_id = " . $iContentId . "
GROUP BY
  lp.leader_project_id
ORDER BY
  lp.project_order,
  lp.project_name,
  p.project_name,
  p.project_create_datetime,
  p.project_id";
      if($oProjectsResult = $oDB->query($sSql))
      {
        $iProjectNumber = 1;
        $iProjectsCount = $oProjectsResult->num_rows;

        if($iProjectsCount === 0)
        {
          $iProjectsCount = 1;
        }

        $oTemplate->cloneBlock("project_block", $iProjectsCount);

        while($aProjectsRow = $oProjectsResult->fetch_assoc())
        {
          if($aProjectsRow["project_id"] !== "")
          {
          	$iProjectId = $aProjectsRow["project_id"];
          }
          else
          {
          	$iProjectId = 0;
          }

          $aProjectOptions = array();

          $sSql = "SELECT
  ov.option_value_id,
  ov.option_id
FROM
  " . DB_PREFIX . "contents_option_values AS cov
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON
    cov.option_value_id = ov.option_value_id AND
    ov.option_id IN (10)
WHERE
  cov.content_id = " . $iProjectId . " AND
  cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . "
ORDER BY
  ov.option_id,
  ov.option_value_id";
          if($oOptionsResult = $oDB->query($sSql))
          {
            while($aOptionsRow = $oOptionsResult->fetch_assoc())
            {
              $aProjectOptions[$aOptionsRow["option_id"]][$aOptionsRow["option_value_id"]] = 1;
            }
            $oOptionsResult->close();
          }

          $aOptionTemp10 = array();

          if(isset($aProjectOptions[10], $aOptions[10]))
          {
          	foreach($aOptions[10]["option_value"] as $iOptionValueId => $aOptionTemp)
          	{
          	  if(isset($aProjectOptions[10][$iOptionValueId]))
          	  {
          	  	$aOptionTemp10[] = $aOptionTemp["option_value"];
          	  }
          	}
          }

          if(!empty($aOptionTemp10))
          {
          	$sOption10 = implode(", ", $aOptionTemp10);
          }
          else
          {
          	$sOption10 = "";
          }

          $aOptionTemp11 = array();

          if(isset($aOptions[11]))
          {
          	foreach($aOptions[11]["option_value"] as $iOptionValueId => $aOptionTemp)
          	{
          	  if($aProjectsRow["project_question_41"] == $iOptionValueId)
          	  {
          	  	$aOptionTemp["option_value"] = $aOptionTemp["option_value"] . " (V)";
          	  }
          	  else
          	  {
          	  	$aOptionTemp["option_value"] = $aOptionTemp["option_value"] . " ( )";
          	  }

          	  $aOptionTemp11[] = $aOptionTemp["option_value"];
          	}
          }

          if(!empty($aOptionTemp11))
          {
          	$sOption11 = implode("   ", $aOptionTemp11);
          }
          else
          {
          	$sOption11 = "";
          }

          $aOptionTemp12 = array();

          if(isset($aOptions[12]))
          {
          	foreach($aOptions[12]["option_value"] as $iOptionValueId => $aOptionTemp)
          	{
          	  if($aProjectsRow["project_question_42"] == $iOptionValueId)
          	  {
          	  	$aOptionTemp["option_value"] = $aOptionTemp["option_value"] . " (V)";
          	  }
          	  else
          	  {
          	  	$aOptionTemp["option_value"] = $aOptionTemp["option_value"] . " ( )";
          	  }

          	  $aOptionTemp12[] = $aOptionTemp["option_value"];
          	}
          }

          if(!empty($aOptionTemp12))
          {
          	$sOption12 = implode("   ", $aOptionTemp12);
          }
          else
          {
          	$sOption12 = "";
          }

          if($aProjectsRow["leader_id"] === "")
          {
          	$sLeaderName = $aProjectsRow["leader_name"];
          }
          else
          {
          	$sLeaderName = $aProjectsRow["leader_surname"];

            if($aProjectsRow["leader_surname"] !== "" and $aProjectsRow["leader_name"] !== "")
            {
          	  $sLeaderName = $sLeaderName . " " . $aProjectsRow["leader_name"];

          	  if($aProjectsRow["leader_patronymic"] !== "")
              {
          	    $sLeaderName = $sLeaderName . " " . $aProjectsRow["leader_patronymic"];
              }
            }
          }

          if($aProjectsRow["project_city_name"] !== "")
          {
      	    if($aProjectsRow["city_name"] === "")
      	    {
      	      $aProjectsRow["city_name"] = $aProjectsRow["project_city_name"];
      	    }
      	    else
      	    {
      	      $aProjectsRow["city_name"] .= " (" . $aProjectsRow["project_city_name"] . ")";
      	    }
          }

          if($aProjectsRow["project_question_03"] !== "" and isset($aOptions[7]["option_value"][$aProjectsRow["project_question_03"]]))
          {
      	    $aProjectsRow["project_question_03"] = $aOptions[7]["option_value"][$aProjectsRow["project_question_03"]]["option_value"];
          }
          else
          {
      	    $aProjectsRow["project_question_03"] = "";
          }

          if($aProjectsRow["project_question_40"] !== "" and isset($aOptions[9]["option_value"][$aProjectsRow["project_question_40"]]))
          {
      	    $aProjectsRow["project_question_40"] = $aOptions[9]["option_value"][$aProjectsRow["project_question_40"]]["option_value"];
          }
          else
          {
      	    $aProjectsRow["project_question_40"] = "";
          }

          $oTemplate->setValue("project_number#" . $iProjectNumber, $iProjectNumber);
          $oTemplate->setValue("project_name#" . $iProjectNumber, $aProjectsRow["project_name"]);
          $oTemplate->setValue("project_name_small#" . $iProjectNumber, $aProjectsRow["project_name_small"]);
          $oTemplate->setValue("project_id#" . $iProjectNumber, $aProjectsRow["project_id"]);
          $oTemplate->setValue("leader_role#" . $iProjectNumber, $aProjectsRow["leader_role"]);
          $oTemplate->setValue("leader_date_from#" . $iProjectNumber, $aProjectsRow["leader_date_from"]);
          $oTemplate->setValue("leader_date_to#" . $iProjectNumber, $aProjectsRow["leader_date_to"]);
          $oTemplate->setValue("project_text#" . $iProjectNumber, $aProjectsRow["project_text"]);
          $oTemplate->setValue("project_site#" . $iProjectNumber, $aProjectsRow["project_site"]);
          $oTemplate->setValue("project_interview_backend_user_name#" . $iProjectNumber, $aProjectsRow["project_interview_backend_user_name"]);
          $oTemplate->setValue("project_write_backend_user_name#" . $iProjectNumber, $aProjectsRow["project_write_backend_user_name"]);
          $oTemplate->setValue("project_interview_date#" . $iProjectNumber, $aProjectsRow["project_interview_date"]);
          $oTemplate->setValue("project_interview_leader_name#" . $iProjectNumber, $sLeaderName);
          $oTemplate->setValue("project_question_01#" . $iProjectNumber, $aProjectsRow["project_question_01"]);
          $oTemplate->setValue("project_question_02#" . $iProjectNumber, $aProjectsRow["project_question_02"]);
          $oTemplate->setValue("project_question_03#" . $iProjectNumber, $aProjectsRow["project_question_03"]);
          $oTemplate->setValue("project_question_04#" . $iProjectNumber, $aProjectsRow["project_question_04"]);
          $oTemplate->setValue("project_question_05#" . $iProjectNumber, $aProjectsRow["project_question_05"]);
          $oTemplate->setValue("project_question_06#" . $iProjectNumber, $aProjectsRow["project_question_06"]);
          $oTemplate->setValue("project_question_07#" . $iProjectNumber, $aProjectsRow["project_question_07"]);
          $oTemplate->setValue("project_question_08#" . $iProjectNumber, $aProjectsRow["project_question_08"]);
          $oTemplate->setValue("project_question_09#" . $iProjectNumber, $aProjectsRow["project_question_09"]);
          $oTemplate->setValue("project_question_10#" . $iProjectNumber, $aProjectsRow["project_question_10"]);
          $oTemplate->setValue("project_question_11#" . $iProjectNumber, $aProjectsRow["project_question_11"]);
          $oTemplate->setValue("project_question_18#" . $iProjectNumber, $aProjectsRow["project_question_18"]);
          $oTemplate->setValue("project_question_19#" . $iProjectNumber, $aProjectsRow["project_question_19"]);
          $oTemplate->setValue("project_question_20#" . $iProjectNumber, $aProjectsRow["project_question_20"]);
          $oTemplate->setValue("project_question_21#" . $iProjectNumber, $aProjectsRow["project_question_21"]);
          $oTemplate->setValue("project_question_22#" . $iProjectNumber, $aProjectsRow["project_question_22"]);
          $oTemplate->setValue("project_question_23#" . $iProjectNumber, $aProjectsRow["project_question_23"]);
          $oTemplate->setValue("project_question_24#" . $iProjectNumber, $aProjectsRow["project_question_24"]);
          $oTemplate->setValue("project_question_25#" . $iProjectNumber, $aProjectsRow["project_question_25"]);
          $oTemplate->setValue("project_question_26#" . $iProjectNumber, $aProjectsRow["project_question_26"]);
          $oTemplate->setValue("project_question_27#" . $iProjectNumber, $aProjectsRow["project_question_27"]);
          $oTemplate->setValue("project_question_28#" . $iProjectNumber, $aProjectsRow["project_question_28"]);
          $oTemplate->setValue("project_question_29#" . $iProjectNumber, $aProjectsRow["project_question_29"]);
          $oTemplate->setValue("project_question_30#" . $iProjectNumber, $aProjectsRow["project_question_30"]);
          $oTemplate->setValue("project_question_31#" . $iProjectNumber, $aProjectsRow["project_question_31"]);
          $oTemplate->setValue("project_question_32#" . $iProjectNumber, $aProjectsRow["project_question_32"]);
          $oTemplate->setValue("project_question_33#" . $iProjectNumber, $aProjectsRow["project_question_33"]);
          $oTemplate->setValue("project_question_34#" . $iProjectNumber, $aProjectsRow["project_question_34"]);
          $oTemplate->setValue("project_question_35#" . $iProjectNumber, $aProjectsRow["project_question_35"]);
          $oTemplate->setValue("project_question_36#" . $iProjectNumber, $aProjectsRow["project_question_36"]);
          $oTemplate->setValue("project_question_37#" . $iProjectNumber, $aProjectsRow["project_question_37"]);
          $oTemplate->setValue("project_question_38#" . $iProjectNumber, $aProjectsRow["project_question_38"]);
          $oTemplate->setValue("project_question_39#" . $iProjectNumber, $aProjectsRow["project_question_39"]);
          $oTemplate->setValue("project_question_40#" . $iProjectNumber, $aProjectsRow["project_question_40"]);
          $oTemplate->setValue("project_question_43#" . $iProjectNumber, $aProjectsRow["project_question_43"]);
          $oTemplate->setValue("project_question_44#" . $iProjectNumber, $aProjectsRow["project_question_44"]);
          $oTemplate->setValue("project_question_45#" . $iProjectNumber, $aProjectsRow["project_question_45"]);
          $oTemplate->setValue("project_question_46#" . $iProjectNumber, $aProjectsRow["project_question_46"]);
          $oTemplate->setValue("project_start_date#" . $iProjectNumber, $aProjectsRow["project_start_date"]);
          $oTemplate->setValue("project_city_name#" . $iProjectNumber, $aProjectsRow["city_name"]);
          $oTemplate->setValue("project_option_10#" . $iProjectNumber, $sOption10);
          $oTemplate->setValue("project_option_11#" . $iProjectNumber, $sOption11);
          $oTemplate->setValue("project_option_12#" . $iProjectNumber, $sOption12);

          $sSql = "SELECT
  lp.leader_role,
  COALESCE(lp.leader_date_from, '') AS leader_date_from,
  COALESCE(lp.leader_date_to, '') AS leader_date_to,
  COALESCE(l.leader_id, '') AS leader_id,
  COALESCE(l.leader_surname, lp.leader_surname, '') AS leader_surname,
  COALESCE(l.leader_name, lp.leader_name, '') AS leader_name,
  COALESCE(l.leader_patronymic, lp.leader_patronymic, '') AS leader_patronymic
FROM
  " . DB_PREFIX . "leaders_projects AS lp
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON lp.leader_id = l.leader_id
WHERE
  lp.project_id = " . $iProjectId . "
ORDER BY
  lp.leader_order,
  lp.leader_surname,
  lp.leader_name,
  lp.leader_patronymic,
  l.leader_surname,
  l.leader_name,
  l.leader_patronymic,
  l.leader_create_datetime,
  l.leader_id";
          if($oLeadersResult = $oDB->query($sSql))
          {
            $iLeadersCount = $oLeadersResult->num_rows + 3;
            $iLeaderNumber = 1;

            $oTemplate->cloneBlock("lp_block#" . $iProjectNumber, $iLeadersCount);

            while($aLPRow = $oLeadersResult->fetch_assoc())
            {
              $sLeaderName = $aLPRow["leader_surname"];

              if($aLPRow["leader_surname"] !== "" and $aLPRow["leader_name"] !== "")
              {
          	    $sLeaderName = $sLeaderName . " " . $aLPRow["leader_name"];

          	    if($aLPRow["leader_patronymic"] !== "")
                {
          	      $sLeaderName = $sLeaderName . " " . $aLPRow["leader_patronymic"];
                }
              }

              $oTemplate->setValue("lp_number#" . $iProjectNumber . "#" . $iLeaderNumber, $iLeaderNumber);
              $oTemplate->setValue("lp_leader_id#" . $iProjectNumber . "#" . $iLeaderNumber, $aLPRow["leader_id"]);
              $oTemplate->setValue("lp_leader_name#" . $iProjectNumber . "#" . $iLeaderNumber, $sLeaderName);
              $oTemplate->setValue("lp_leader_role#" . $iProjectNumber . "#" . $iLeaderNumber, $aLPRow["leader_role"]);
              $oTemplate->setValue("lp_leader_date_from#" . $iProjectNumber . "#" . $iLeaderNumber, $aLPRow["leader_date_from"]);
              $oTemplate->setValue("lp_leader_date_to#" . $iProjectNumber . "#" . $iLeaderNumber, $aLPRow["leader_date_to"]);

              $iLeaderNumber++;
            }
            $oLeadersResult->close();

            for($iTemp = 1; $iTemp <= 3; $iTemp++)
            {
              $oTemplate->setValue("lp_number#" . $iProjectNumber . "#" . $iLeaderNumber, $iLeaderNumber);
              $oTemplate->setValue("lp_leader_id#" . $iProjectNumber . "#" . $iLeaderNumber, "");
              $oTemplate->setValue("lp_leader_name#" . $iProjectNumber . "#" . $iLeaderNumber, "");
              $oTemplate->setValue("lp_leader_role#" . $iProjectNumber . "#" . $iLeaderNumber, "");
              $oTemplate->setValue("lp_leader_date_from#" . $iProjectNumber . "#" . $iLeaderNumber, "");
              $oTemplate->setValue("lp_leader_date_to#" . $iProjectNumber . "#" . $iLeaderNumber, "");

              $iLeaderNumber++;
            }
          }

          $sSql = "SELECT
  COALESCE(c.city_name, '') AS city_name,
  f.filial_city_name,
  f.filial_address
FROM
  " . DB_PREFIX . "filials AS f
  LEFT JOIN " . DB_PREFIX . "cities AS c ON f.city_id = c.city_id
WHERE
  f.project_id = " . $iProjectId . "
ORDER BY
  f.filial_order,
  c.city_order,
  c.city_name,
  f.filial_city_name,
  f.filial_id";
          if($oFilialsResult = $oDB->query($sSql))
          {
            $iFilialsCount = $oFilialsResult->num_rows + 3;
            $iFilialNumber = 1;

            $oTemplate->cloneBlock("filial_block#" . $iProjectNumber, $iFilialsCount);

            while($aFilialRow = $oFilialsResult->fetch_assoc())
            {
              $sFilialCityName = $aFilialRow["city_name"];

              if($aFilialRow["filial_city_name"] !== "")
              {
          	    if($aFilialRow !== "")
                {
          	      $sFilialCityName = $sFilialCityName . " (" . $aFilialRow["filial_city_name"] . ")";
                }
                else
                {
                  $sFilialCityName = $aFilialRow["filial_city_name"];
                }
              }

              $oTemplate->setValue("filial_number#" . $iProjectNumber . "#" . $iFilialNumber, $iFilialNumber);
              $oTemplate->setValue("filial_city_name#" . $iProjectNumber . "#" . $iFilialNumber, $sFilialCityName);
              $oTemplate->setValue("filial_address#" . $iProjectNumber . "#" . $iFilialNumber, $aFilialRow["filial_address"]);

              $iFilialNumber++;
            }
            $oFilialsResult->close();

            for($iTemp = 1; $iTemp <= 3; $iTemp++)
            {
              $oTemplate->setValue("filial_number#" . $iProjectNumber . "#" . $iFilialNumber, $iFilialNumber);
              $oTemplate->setValue("filial_city_name#" . $iProjectNumber . "#" . $iFilialNumber, "");
              $oTemplate->setValue("filial_address#" . $iProjectNumber . "#" . $iFilialNumber, "");

              $iFilialNumber++;
            }
          }

          $iProjectNumber++;
        }
        $oProjectsResult->close();

        if($iProjectNumber === $iProjectsCount)
        {
          $aOptionTemp11 = array();

          if(isset($aOptions[11]))
          {
          	foreach($aOptions[11]["option_value"] as $iOptionValueId => $aOptionTemp)
          	{
          	  $aOptionTemp11[] = $aOptionTemp["option_value"];
          	}
          }

          if(!empty($aOptionTemp11))
          {
          	$sOption11 = implode("   ", $aOptionTemp11);
          }
          else
          {
          	$sOption11 = "";
          }

          $aOptionTemp12 = array();

          if(isset($aOptions[12]))
          {
          	foreach($aOptions[12]["option_value"] as $iOptionValueId => $aOptionTemp)
          	{
          	  $aOptionTemp12[] = $aOptionTemp["option_value"];
          	}
          }

          if(!empty($aOptionTemp12))
          {
          	$sOption12 = implode("   ", $aOptionTemp12);
          }
          else
          {
          	$sOption12 = "";
          }

          $oTemplate->setValue("project_number#" . $iProjectNumber, $iProjectNumber);
          $oTemplate->setValue("project_name#" . $iProjectNumber, "");
          $oTemplate->setValue("project_name_small#" . $iProjectNumber, "");
          $oTemplate->setValue("project_id#" . $iProjectNumber, "");
          $oTemplate->setValue("leader_role#" . $iProjectNumber, "");
          $oTemplate->setValue("leader_date_from#" . $iProjectNumber, "");
          $oTemplate->setValue("leader_date_to#" . $iProjectNumber, "");
          $oTemplate->setValue("project_text#" . $iProjectNumber, "");
          $oTemplate->setValue("project_site#" . $iProjectNumber, "");
          $oTemplate->setValue("project_interview_backend_user_name#" . $iProjectNumber, "");
          $oTemplate->setValue("project_write_backend_user_name#" . $iProjectNumber, "");
          $oTemplate->setValue("project_interview_date#" . $iProjectNumber, "");
          $oTemplate->setValue("project_interview_leader_name#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_01#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_02#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_03#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_04#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_05#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_06#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_07#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_08#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_09#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_10#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_11#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_18#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_19#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_20#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_21#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_22#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_23#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_24#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_25#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_26#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_27#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_28#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_29#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_30#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_31#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_32#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_33#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_34#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_35#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_36#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_37#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_38#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_39#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_40#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_43#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_44#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_45#" . $iProjectNumber, "");
          $oTemplate->setValue("project_question_46#" . $iProjectNumber, "");
          $oTemplate->setValue("project_start_date#" . $iProjectNumber, "");
          $oTemplate->setValue("project_city_name#" . $iProjectNumber, "");
          $oTemplate->setValue("project_option_10#" . $iProjectNumber, "");
          $oTemplate->setValue("project_option_11#" . $iProjectNumber, $sOption11);
          $oTemplate->setValue("project_option_12#" . $iProjectNumber, $sOption12);

          $iLeadersCount = 3;
          $iLeaderNumber = 1;

          $oTemplate->cloneBlock("lp_block#" . $iProjectNumber, $iLeadersCount);

          for($iTemp = 1; $iTemp <= 3; $iTemp++)
          {
            $oTemplate->setValue("lp_number#" . $iProjectNumber . "#" . $iLeaderNumber, $iLeaderNumber);
            $oTemplate->setValue("lp_leader_id#" . $iProjectNumber . "#" . $iLeaderNumber, "");
            $oTemplate->setValue("lp_leader_name#" . $iProjectNumber . "#" . $iLeaderNumber, "");
            $oTemplate->setValue("lp_leader_role#" . $iProjectNumber . "#" . $iLeaderNumber, "");
            $oTemplate->setValue("lp_leader_date_from#" . $iProjectNumber . "#" . $iLeaderNumber, "");
            $oTemplate->setValue("lp_leader_date_to#" . $iProjectNumber . "#" . $iLeaderNumber, "");

            $iLeaderNumber++;
          }

          $iFilialsCount = 3;
          $iFilialNumber = 1;

          $oTemplate->cloneBlock("filial_block#" . $iProjectNumber, $iFilialsCount);

          for($iTemp = 1; $iTemp <= 3; $iTemp++)
          {
            $oTemplate->setValue("filial_number#" . $iProjectNumber . "#" . $iFilialNumber, $iFilialNumber);
            $oTemplate->setValue("filial_city_name#" . $iProjectNumber . "#" . $iFilialNumber, "");
            $oTemplate->setValue("filial_address#" . $iProjectNumber . "#" . $iFilialNumber, "");

            $iFilialNumber++;
          }
        }
      }


      $sFileName = PROJECT_BACKEND_PATH . "temp/docx/" . sGetHash() . ".docx";
      $oTemplate->saveAs($sFileName);

      //отдаем файл

      header("Content-Type: application/msword");
      header("Content-Transfer-Encoding: binary");
      header('Content-Disposition: attachment;filename="docx_' . date("Y_m_d_H_i_s") . '.docx"');
      header('Cache-Control: max-age=0');

      readfile($sFileName);

      if(is_file($sFileName))
      {
        unlink($sFileName);
      }
    }
    $oResult->close();
  }
}

if(!$bResult)
{
  header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=list");
}

?>