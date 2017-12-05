<?php

$sUrlPostfix = "";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$aPostData = array();
$aPostData["leader_surname"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_name"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_patronymic"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_interview_date"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_create_date"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_interview_backend_user_id"] = array("isset" => 1, "trim" => 0);
$aPostData["leader_write_backend_user_id"] = array("isset" => 1, "trim" => 0);
$aPostData["leader_interview_type"] = array("isset" => 1, "trim" => 0);
$aPostData["leader_contact_from"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_interview_result"] = array("isset" => 1, "trim" => 1);
$aPostData["city_id"] = array("isset" => 1, "trim" => 0);
$aPostData["leader_city_name"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_birth_date"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_company"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_position"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_phone"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_email"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_skype"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_social_network"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_contacts"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_01"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_02"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_03"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_04"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_05"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_06"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_07"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_10"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_11"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_12"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_13"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_14"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_15"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_16"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_17"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_18"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_19"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_20"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_question_21"] = array("isset" => 1, "trim" => 1);
$aPostData["transaction_id"] = array("isset" => 1, "trim" => 0);

$bResult = true;

foreach($aPostData as $sFieldName => $aFieldData)
{
  if($aFieldData["isset"] === 1 and !isset($_POST[$sFieldName]))
  {
  	$bResult = false;
  }
}

if($bResult)
{
  $oDB = cMyDB::oGetDB("db");

  $bContentEdit = isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1);

  if($bContentEdit)
  {
    $sUrlPostfix = "&content_id=" . $_GET["content_id"];
  }
  else
  {
    $sUrlPostfix = "";
  }

  foreach($aPostData as $sFieldName => $aFieldData)
  {
    if($aFieldData["trim"] === 1)
    {
  	  if(get_magic_quotes_gpc())
      {
        $_POST[$sFieldName] = stripslashes($_POST[$sFieldName]);
      }
      $_POST[$sFieldName] = trim($_POST[$sFieldName]);
    }
  }

  $_POST["leader_email"] = mb_strtolower($_POST["leader_email"], "utf-8");
  $_POST["leader_phone"] = preg_replace("/[^0-9]+/", "", $_POST["leader_phone"]);

  if(strlen($_POST["leader_phone"]) === 11 and ($_POST["leader_phone"][0] === "7" or $_POST["leader_phone"][0] === "8"))
  {
    $_POST["leader_phone"] = substr($_POST["leader_phone"], 1);
  }

  $aContentDataErrors = array();

  if($bContentEdit)
  {
    $aContentDataErrors["transaction_id"] = "";

    $iTransactionId = $oDB->aGetDataByFilters(DB_PREFIX . "leaders", "transaction_id", array("leader_id" => $_GET["content_id"]));

    if((is_null($iTransactionId) and $_POST["transaction_id"] === "") or (bIsInt($_POST["transaction_id"], 1) and !is_null($iTransactionId) and $iTransactionId == $_POST["transaction_id"]))
    {
      unset($aContentDataErrors["transaction_id"]);
    }
  }

  if($_POST["leader_phone"] !== "" and strlen($_POST["leader_phone"]) !== 10)
  {
  	$aContentDataErrors["leader_phone"] = "";
  }

  if($_POST["leader_question_02"] !== "" and !bIsInt($_POST["leader_question_02"], 0))
  {
  	$aContentDataErrors["leader_question_02"] = "";
  }

  if($_POST["leader_surname"] === "")
  {
  	$aContentDataErrors["leader_surname"] = "Поле обязательно для заполнения";
  }

  if($_POST["leader_interview_date"] !== "" and !bIsDate($_POST["leader_interview_date"]))
  {
  	$aContentDataErrors["leader_interview_date"] = "";
  }

  if($_POST["leader_birth_date"] !== "" and !bIsDate($_POST["leader_birth_date"]))
  {
  	if(!bIsDate($_POST["leader_birth_date"] . "-01"))
  	{
  	  if(!bIsDate($_POST["leader_birth_date"] . "-07-01"))
  	  {
  		$aContentDataErrors["leader_birth_date"] = "";
  	  }
  	  else
  	  {
  	  	$_POST["leader_birth_date"] = $_POST["leader_birth_date"] . "-07-01";
  	  }
  	}
  	else
  	{
  	  $_POST["leader_birth_date"] = $_POST["leader_birth_date"] . "-01";
  	}
  }

  if($_POST["leader_create_date"] !== "" and !bIsDate($_POST["leader_create_date"]))
  {
  	$aContentDataErrors["leader_create_date"] = "";
  }

  if($_POST["leader_email"] !== "" and !bIsEmail($_POST["leader_email"]))
  {
  	$aContentDataErrors["leader_email"] = "";
  }

  if(bIsInt($_POST["leader_interview_backend_user_id"], 1))
  {
  	if(!$oDB->bCheckDataByFilters(DB_PREFIX . "backend_users", array("backend_user_id" => $_POST["leader_interview_backend_user_id"])))
  	{
  	  $aContentDataErrors["leader_interview_backend_user_id"] = "";
  	  $_POST["leader_interview_backend_user_id"] = "";
  	}
  }
  else
  {
    $_POST["leader_interview_backend_user_id"] = "";
  }

  if(bIsInt($_POST["leader_write_backend_user_id"], 1))
  {
  	if(!$oDB->bCheckDataByFilters(DB_PREFIX . "backend_users", array("backend_user_id" => $_POST["leader_write_backend_user_id"])))
  	{
  	  $aContentDataErrors["leader_write_backend_user_id"] = "";
  	  $_POST["leader_write_backend_user_id"] = "";
  	}
  }
  else
  {
    $_POST["leader_write_backend_user_id"] = "";
  }

  if(bIsInt($_POST["leader_interview_type"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $_POST["leader_interview_type"], "option_id" => "1")))
  {
  	$iLeaderInterviewType = $_POST["leader_interview_type"];
  }
  else
  {
  	$iLeaderInterviewType = "NULL";
  	$_POST["leader_interview_type"] = "";
  }

  if(isset($_POST["leader_question_08"]) and bIsInt($_POST["leader_question_08"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $_POST["leader_question_08"], "option_id" => "2")))
  {
  	$iLeaderQuestion08 = $_POST["leader_question_08"];
  }
  else
  {
  	$iLeaderQuestion08 = "NULL";
  	$_POST["leader_question_08"] = "";
  }

  if(isset($_POST["leader_question_09"]) and bIsInt($_POST["leader_question_09"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $_POST["leader_question_09"], "option_id" => "3")))
  {
  	$iLeaderQuestion09 = $_POST["leader_question_09"];
  }
  else
  {
  	$iLeaderQuestion09 = "NULL";
  	$_POST["leader_question_09"] = "";
  }

  if(isset($_POST["sex_id"]) and bIsInt($_POST["sex_id"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "sex", array("sex_id" => $_POST["sex_id"])))
  {
  	$iSexId = $_POST["sex_id"];
  }
  else
  {
  	$iSexId = "NULL";
  	$_POST["sex_id"] = "";
  }

  if(bIsInt($_POST["city_id"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id"])))
  {
  	$iCityId = $_POST["city_id"];
  }
  else
  {
  	$iCityId = "NULL";
  	$_POST["city_id"] = "";
  }

  $iLeaderEnabled = (int) isset($_POST["leader_enabled"]);
  $iLeaderDone = (int) isset($_POST["leader_done"]);
  $iLeaderBirthDateCorrect = (int) (isset($_POST["leader_birth_date_correct"]) and !isset($aContentDataErrors["leader_birth_date"]) and $_POST["leader_birth_date"] !== "");
  $iLeaderHighPriority = (int) isset($_POST["leader_high_priority"]);

  if(empty($aContentDataErrors))
  {
    if(strlen($_POST["leader_phone"]) === 10)
    {
      $iLeaderPhone = $_POST["leader_phone"];
    }
    else
    {
      $iLeaderPhone	= "NULL";
    }

    if($_POST["leader_question_02"] === "")
    {
      $iLeaderQuestion02 = "NULL";
    }
    else
    {
      $iLeaderQuestion02 = $_POST["leader_question_02"];
    }

    if($_POST["leader_interview_date"] === "")
  	{
  	  $sLeaderInterviewDate = "NULL";
  	}
  	else
  	{
  	  $sLeaderInterviewDate = "'" . $_POST["leader_interview_date"] . "'";
  	}

  	if($_POST["leader_create_date"] === "")
  	{
  	  $sLeaderCreateDate = "NULL";
  	}
  	else
  	{
  	  $sLeaderCreateDate = "'" . $_POST["leader_create_date"] . "'";
  	}

  	if($_POST["leader_birth_date"] === "")
  	{
  	  $sLeaderBirthDate = "NULL";
  	}
  	else
  	{
  	  $sLeaderBirthDate = "'" . $_POST["leader_birth_date"] . "'";
  	}

  	if($_POST["leader_interview_backend_user_id"] === "")
  	{
  	  $sLeaderInterviewBackendUserId = "NULL";
  	}
  	else
  	{
  	  $sLeaderInterviewBackendUserId = $_POST["leader_interview_backend_user_id"];
  	}

  	if($_POST["leader_write_backend_user_id"] === "")
  	{
  	  $sLeaderWriteBackendUserId = "NULL";
  	}
  	else
  	{
  	  $sLeaderWriteBackendUserId = $_POST["leader_write_backend_user_id"];
  	}

    if($bContentEdit)
    {
      $sSql = "UPDATE";
    }
    else
    {
      $sSql = "INSERT INTO";
    }

    $sSql .= "
  " . DB_PREFIX . "leaders
SET
  leader_surname = '" . $oDB->escape_string($_POST["leader_surname"]) . "',
  leader_name = '" . $oDB->escape_string($_POST["leader_name"]) . "',
  leader_patronymic = '" . $oDB->escape_string($_POST["leader_patronymic"]) . "',
  leader_interview_date = " . $sLeaderInterviewDate . ",
  leader_create_date = " . $sLeaderCreateDate . ",
  leader_birth_date = " . $sLeaderBirthDate . ",
  leader_interview_backend_user_id = " . $sLeaderInterviewBackendUserId . ",
  leader_write_backend_user_id = " . $sLeaderWriteBackendUserId . ",
  leader_contact_from = '" . $oDB->escape_string($_POST["leader_contact_from"]) . "',
  leader_interview_result = '" . $oDB->escape_string($_POST["leader_interview_result"]) . "',
  leader_company = '" . $oDB->escape_string($_POST["leader_company"]) . "',
  leader_position = '" . $oDB->escape_string($_POST["leader_position"]) . "',
  leader_email = '" . $oDB->escape_string($_POST["leader_email"]) . "',
  leader_skype = '" . $oDB->escape_string($_POST["leader_skype"]) . "',
  leader_social_network = '" . $oDB->escape_string($_POST["leader_social_network"]) . "',
  leader_contacts = '" . $oDB->escape_string($_POST["leader_contacts"]) . "',
  leader_phone = " . $iLeaderPhone . ",
  leader_interview_type = " . $iLeaderInterviewType . ",
  sex_id = " . $iSexId . ",
  city_id = " . $iCityId . ",
  leader_city_name = '" . $oDB->escape_string($_POST["leader_city_name"]) . "',
  leader_enabled = " . $iLeaderEnabled . ",
  leader_done = " . $iLeaderDone . ",
  leader_birth_date_correct = " . $iLeaderBirthDateCorrect . ",
  leader_high_priority = " . $iLeaderHighPriority . ",
  leader_question_01 = '" . $oDB->escape_string($_POST["leader_question_01"]) . "',
  leader_question_03 = '" . $oDB->escape_string($_POST["leader_question_03"]) . "',
  leader_question_04 = '" . $oDB->escape_string($_POST["leader_question_04"]) . "',
  leader_question_05 = '" . $oDB->escape_string($_POST["leader_question_05"]) . "',
  leader_question_06 = '" . $oDB->escape_string($_POST["leader_question_06"]) . "',
  leader_question_07 = '" . $oDB->escape_string($_POST["leader_question_07"]) . "',
  leader_question_10 = '" . $oDB->escape_string($_POST["leader_question_10"]) . "',
  leader_question_11 = '" . $oDB->escape_string($_POST["leader_question_11"]) . "',
  leader_question_12 = '" . $oDB->escape_string($_POST["leader_question_12"]) . "',
  leader_question_13 = '" . $oDB->escape_string($_POST["leader_question_13"]) . "',
  leader_question_14 = '" . $oDB->escape_string($_POST["leader_question_14"]) . "',
  leader_question_15 = '" . $oDB->escape_string($_POST["leader_question_15"]) . "',
  leader_question_16 = '" . $oDB->escape_string($_POST["leader_question_16"]) . "',
  leader_question_17 = '" . $oDB->escape_string($_POST["leader_question_17"]) . "',
  leader_question_18 = '" . $oDB->escape_string($_POST["leader_question_18"]) . "',
  leader_question_19 = '" . $oDB->escape_string($_POST["leader_question_19"]) . "',
  leader_question_20 = '" . $oDB->escape_string($_POST["leader_question_20"]) . "',
  leader_question_21 = '" . $oDB->escape_string($_POST["leader_question_21"]) . "',
  leader_question_02 = " . $iLeaderQuestion02 . ",
  leader_question_08 = " . $iLeaderQuestion08 . ",
  leader_question_09 = " . $iLeaderQuestion09;

    if($bContentEdit)
    {
      $sSql .= "
WHERE
  leader_id = " . $_GET["content_id"];
    }
    else
    {
      $sSql .= ",
  leader_create_backend_user_id = " . $aBackendUserInfo["backend_user_id"] . ",
  leader_create_datetime = NOW()";
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

      //обновление свойств

      $aOptionIds = array(4);

      $sSql = "DELETE
  cov
FROM
  " . DB_PREFIX . "contents_option_values AS cov
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON cov.option_value_id = ov.option_value_id
WHERE
  cov.content_id = " . $iContentId . " AND
  cov.content_type_id = " . LEADER_CONTENT_TYPE_ID . " AND
  ov.option_id IN (" . implode(", ", $aOptionIds) . ")";
      if($oResult = $oDB->query($sSql))
      {
      }

      $aOptionValues = array();

      foreach($aOptionIds as $iOptionId)
      {
      	if(isset($_POST["options"][$iOptionId]) and is_array($_POST["options"][$iOptionId]))
      	{
          foreach($_POST["options"][$iOptionId] as $iOptionValueId)
          {
          	if(bIsInt($iOptionValueId, 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $iOptionValueId, "option_id" => $iOptionId)))
          	{
          	  $aOptionValues[] = "(" . $iContentId . ", " . LEADER_CONTENT_TYPE_ID . ", " . $iOptionValueId . ")";
          	}
          }
      	}
      }

      if(!empty($aOptionValues))
      {
      	$sSql = "INSERT INTO
  " . DB_PREFIX . "contents_option_values (content_id, content_type_id, option_value_id)
VALUES
  " . implode(",
  ", $aOptionValues);
        if($oResult = $oDB->query($sSql))
        {
        }
      }

      //проекты

      if(isset($_POST["project_name_new"], $_POST["leader_role_new"], $_POST["leader_date_from_new"], $_POST["leader_date_to_new"], $_POST["project_order_new"]) and is_array($_POST["project_name_new"]) and is_array($_POST["leader_role_new"]) and is_array($_POST["leader_date_from_new"]) and is_array($_POST["leader_date_to_new"]) and is_array($_POST["project_order_new"]))
      {
      	foreach($_POST["project_order_new"] as $iLeaderProjectId => $iProjectOrder)
      	{
      	  if(bIsInt($iProjectOrder, 1) and isset($_POST["project_name_new"][$iLeaderProjectId], $_POST["leader_role_new"][$iLeaderProjectId], $_POST["leader_date_from_new"][$iLeaderProjectId], $_POST["leader_date_to_new"][$iLeaderProjectId]))
      	  {
            if(get_magic_quotes_gpc())
            {
              $_POST["project_name_new"][$iLeaderProjectId] = stripslashes($_POST["project_name_new"][$iLeaderProjectId]);
              $_POST["leader_role_new"][$iLeaderProjectId] = stripslashes($_POST["leader_role_new"][$iLeaderProjectId]);
              $_POST["leader_date_from_new"][$iLeaderProjectId] = stripslashes($_POST["leader_date_from_new"][$iLeaderProjectId]);
              $_POST["leader_date_to_new"][$iLeaderProjectId] = stripslashes($_POST["leader_date_to_new"][$iLeaderProjectId]);
            }
            $_POST["project_name_new"][$iLeaderProjectId] = trim($_POST["project_name_new"][$iLeaderProjectId]);
            $_POST["leader_role_new"][$iLeaderProjectId] = trim($_POST["leader_role_new"][$iLeaderProjectId]);
            $_POST["leader_date_from_new"][$iLeaderProjectId] = trim($_POST["leader_date_from_new"][$iLeaderProjectId]);
            $_POST["leader_date_to_new"][$iLeaderProjectId] = trim($_POST["leader_date_to_new"][$iLeaderProjectId]);

            if($_POST["project_name_new"][$iLeaderProjectId] !== "")
            {
              if(bIsInt($_POST["project_name_new"][$iLeaderProjectId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "projects", array("project_id" => $_POST["project_name_new"][$iLeaderProjectId])))
              {
              	$iProjectId = $_POST["project_name_new"][$iLeaderProjectId];
              	$sProjectName = "NULL";
              }
              else
              {
              	$iProjectId = "NULL";
              	$sProjectName = "'" . $oDB->escape_string($_POST["project_name_new"][$iLeaderProjectId]) . "'";
              }

              if(bIsDate($_POST["leader_date_from_new"][$iLeaderProjectId]))
              {
              	$sLeaderDateFrom = "'" . $_POST["leader_date_from_new"][$iLeaderProjectId] . "'";
              }
              else
              {
              	$sLeaderDateFrom = "NULL";
              }

              if(bIsDate($_POST["leader_date_to_new"][$iLeaderProjectId]))
              {
              	$sLeaderDateTo = "'" . $_POST["leader_date_to_new"][$iLeaderProjectId] . "'";
              }
              else
              {
              	$sLeaderDateTo = "NULL";
              }

              $sSql = "INSERT INTO
  " . DB_PREFIX . "leaders_projects
SET
  leader_id = " . $iContentId . ",
  project_id = " . $iProjectId . ",
  project_name = " . $sProjectName . ",
  leader_role = '" . $oDB->escape_string($_POST["leader_role_new"][$iLeaderProjectId]) . "',
  leader_date_from = " . $sLeaderDateFrom . ",
  leader_date_to = " . $sLeaderDateTo . ",
  project_order = " . $iProjectOrder;
              if($oResult = $oDB->query($sSql))
              {
              }
            }
      	  }
      	}
      }

      if(isset($_POST["leader_role"], $_POST["leader_date_from"], $_POST["leader_date_to"], $_POST["project_order"]) and is_array($_POST["leader_role"]) and is_array($_POST["leader_date_from"]) and is_array($_POST["leader_date_to"]) and is_array($_POST["project_order"]))
      {
      	foreach($_POST["project_order"] as $iLeaderProjectId => $iProjectOrder)
      	{
      	  if(bIsInt($iLeaderProjectId, 1) and bIsInt($iProjectOrder, 1) and isset($_POST["leader_role"][$iLeaderProjectId], $_POST["leader_date_from"][$iLeaderProjectId], $_POST["leader_date_to"][$iLeaderProjectId]))
      	  {
            if(!isset($_POST["project_name"][$iLeaderProjectId]))
            {
              $_POST["project_name"][$iLeaderProjectId] = "";
            }

            if(get_magic_quotes_gpc())
            {
              $_POST["project_name"][$iLeaderProjectId] = stripslashes($_POST["project_name"][$iLeaderProjectId]);
              $_POST["leader_role"][$iLeaderProjectId] = stripslashes($_POST["leader_role"][$iLeaderProjectId]);
              $_POST["leader_date_from"][$iLeaderProjectId] = stripslashes($_POST["leader_date_from"][$iLeaderProjectId]);
              $_POST["leader_date_to"][$iLeaderProjectId] = stripslashes($_POST["leader_date_to"][$iLeaderProjectId]);
            }
            $_POST["project_name"][$iLeaderProjectId] = trim($_POST["project_name"][$iLeaderProjectId]);
            $_POST["leader_role"][$iLeaderProjectId] = trim($_POST["leader_role"][$iLeaderProjectId]);
            $_POST["leader_date_from"][$iLeaderProjectId] = trim($_POST["leader_date_from"][$iLeaderProjectId]);
            $_POST["leader_date_to"][$iLeaderProjectId] = trim($_POST["leader_date_to"][$iLeaderProjectId]);

            if(bIsInt($_POST["project_name"][$iLeaderProjectId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "projects", array("project_id" => $_POST["project_name"][$iLeaderProjectId])))
            {
              $iProjectId = $_POST["project_name"][$iLeaderProjectId];
              $sProjectName = "NULL";
            }
            else
            {
              $iProjectId = "NULL";
              $sProjectName = "'" . $oDB->escape_string($_POST["project_name"][$iLeaderProjectId]) . "'";
            }

            if(bIsDate($_POST["leader_date_from"][$iLeaderProjectId]))
            {
              $sLeaderDateFrom = "'" . $_POST["leader_date_from"][$iLeaderProjectId] . "'";
            }
            else
            {
              $sLeaderDateFrom = "NULL";
            }

            if(bIsDate($_POST["leader_date_to"][$iLeaderProjectId]))
            {
              $sLeaderDateTo = "'" . $_POST["leader_date_to"][$iLeaderProjectId] . "'";
            }
            else
            {
              $sLeaderDateTo = "NULL";
            }

            $sSql = "UPDATE
  " . DB_PREFIX . "leaders_projects AS lp
SET
  lp.project_id = IF(lp.project_id IS NULL, " . $iProjectId . ", lp.project_id),
  lp.project_name = IF(lp.project_id IS NULL, " . $sProjectName . ", NULL),
  lp.leader_role = '" . $oDB->escape_string($_POST["leader_role"][$iLeaderProjectId]) . "',
  lp.leader_date_from = " . $sLeaderDateFrom . ",
  lp.leader_date_to = " . $sLeaderDateTo . ",
  lp.project_order = " . $iProjectOrder . "
WHERE
  lp.leader_project_id = " . $iLeaderProjectId . " AND
  lp.leader_id = " . $iContentId . " AND
  (lp.project_id IS NOT NULL OR " . $iProjectId . " IS NOT NULL OR " . $sProjectName . " != '')";
            if($oResult = $oDB->query($sSql))
            {
            }
      	  }
      	}
      }

      //рекомендации
      if(isset($_POST["leader_surname_new"], $_POST["leader_name_new"], $_POST["leader_patronymic_new"], $_POST["leader_project_name_new"], $_POST["leader_email_new"], $_POST["leader_phone_new"], $_POST["recommendation_reason_new"], $_POST["recommendation_comment_new"], $_POST["city_id_new"], $_POST["leader_city_name_new"]) and is_array($_POST["leader_surname_new"]) and is_array($_POST["leader_name_new"]) and is_array($_POST["leader_patronymic_new"]) and is_array($_POST["leader_project_name_new"]) and is_array($_POST["leader_email_new"]) and is_array($_POST["leader_phone_new"]) and is_array($_POST["recommendation_reason_new"]) and is_array($_POST["recommendation_comment_new"]) and is_array($_POST["city_id_new"]) and is_array($_POST["leader_city_name_new"]))
      {
      	foreach($_POST["recommendation_reason_new"] as $iRecommendationId => $sRecommendationReason)
      	{
      	  if(isset($_POST["leader_surname_new"][$iRecommendationId], $_POST["leader_name_new"][$iRecommendationId], $_POST["leader_patronymic_new"][$iRecommendationId], $_POST["leader_project_name_new"][$iRecommendationId], $_POST["leader_email_new"][$iRecommendationId], $_POST["leader_phone_new"][$iRecommendationId], $_POST["city_id_new"][$iRecommendationId], $_POST["leader_city_name_new"][$iRecommendationId], $_POST["recommendation_comment_new"][$iRecommendationId]))
      	  {
            if(get_magic_quotes_gpc())
            {
              $_POST["leader_surname_new"][$iRecommendationId] = stripslashes($_POST["leader_surname_new"][$iRecommendationId]);
              $_POST["leader_name_new"][$iRecommendationId] = stripslashes($_POST["leader_name_new"][$iRecommendationId]);
              $_POST["leader_patronymic_new"][$iRecommendationId] = stripslashes($_POST["leader_patronymic_new"][$iRecommendationId]);
              $_POST["leader_project_name_new"][$iRecommendationId] = stripslashes($_POST["leader_project_name_new"][$iRecommendationId]);
              $_POST["leader_email_new"][$iRecommendationId] = stripslashes($_POST["leader_email_new"][$iRecommendationId]);
              $_POST["leader_phone_new"][$iRecommendationId] = stripslashes($_POST["leader_phone_new"][$iRecommendationId]);
              $_POST["recommendation_comment_new"][$iRecommendationId] = stripslashes($_POST["recommendation_comment_new"][$iRecommendationId]);
              $_POST["leader_city_name_new"][$iRecommendationId] = stripslashes($_POST["leader_city_name_new"][$iRecommendationId]);
              $sRecommendationReason = stripslashes($sRecommendationReason);
            }
            $_POST["leader_surname_new"][$iRecommendationId] = trim($_POST["leader_surname_new"][$iRecommendationId]);
            $_POST["leader_name_new"][$iRecommendationId] = trim($_POST["leader_name_new"][$iRecommendationId]);
            $_POST["leader_patronymic_new"][$iRecommendationId] = trim($_POST["leader_patronymic_new"][$iRecommendationId]);
            $_POST["leader_project_name_new"][$iRecommendationId] = trim($_POST["leader_project_name_new"][$iRecommendationId]);
            $_POST["leader_email_new"][$iRecommendationId] = trim($_POST["leader_email_new"][$iRecommendationId]);
            $_POST["leader_phone_new"][$iRecommendationId] = trim($_POST["leader_phone_new"][$iRecommendationId]);
            $_POST["recommendation_comment_new"][$iRecommendationId] = trim($_POST["recommendation_comment_new"][$iRecommendationId]);
            $_POST["leader_city_name_new"][$iRecommendationId] = trim($_POST["leader_city_name_new"][$iRecommendationId]);
            $sRecommendationReason = trim($sRecommendationReason);

            $_POST["leader_email_new"][$iRecommendationId] = mb_strtolower($_POST["leader_email_new"][$iRecommendationId], "utf-8");
            $_POST["leader_phone_new"][$iRecommendationId] = preg_replace("/[^0-9]+/", "", $_POST["leader_phone_new"][$iRecommendationId]);

            if(strlen($_POST["leader_phone_new"][$iRecommendationId]) === 11 and ($_POST["leader_phone_new"][$iRecommendationId][0] === "7" or $_POST["leader_phone_new"][$iRecommendationId][0] === "8"))
            {
              $_POST["leader_phone_new"][$iRecommendationId] = substr($_POST["leader_phone_new"][$iRecommendationId], 1);
            }

            if($_POST["leader_surname_new"][$iRecommendationId] !== "")
            {
              $_POST["leader_surname_new"][$iRecommendationId] = mb_strtoupper(mb_substr($_POST["leader_surname_new"][$iRecommendationId], 0, 1, "utf-8"), "utf-8") . mb_substr($_POST["leader_surname_new"][$iRecommendationId], 1, null, "utf-8");

              if(bIsInt($_POST["leader_surname_new"][$iRecommendationId], 1) and $_POST["leader_surname_new"][$iRecommendationId] != $iContentId and $oDB->bCheckDataByFilters(DB_PREFIX . "leaders", array("leader_id" => $_POST["leader_surname_new"][$iRecommendationId])))
              {
                $iLeaderIdTo = $_POST["leader_surname_new"][$iRecommendationId];
                $_POST["leader_phone_new"][$iRecommendationId] = "";
                $_POST["leader_email_new"][$iRecommendationId] = "";
                $_POST["city_id_new"][$iRecommendationId] = "";
                $_POST["leader_city_name_new"][$iRecommendationId] = "";
                $_POST["leader_surname_new"][$iRecommendationId] = "";
                $_POST["leader_name_new"][$iRecommendationId] = "";
                $_POST["leader_patronymic_new"][$iRecommendationId] = "";
                $_POST["leader_project_name_new"][$iRecommendationId] = "";
              }
              else
              {
                $iLeaderIdTo = "NULL";
              }

              if(strlen($_POST["leader_phone_new"][$iRecommendationId]) === 10)
              {
              	$sLeaderPhone = $_POST["leader_phone_new"][$iRecommendationId];
              }
              else
              {
              	$sLeaderPhone = "NULL";
              }

              if(!bIsEmail($_POST["leader_email_new"][$iRecommendationId]))
              {
              	$_POST["leader_email_new"][$iRecommendationId] = "";
              }

              if(bIsInt($_POST["city_id_new"][$iRecommendationId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id_new"][$iRecommendationId])))
              {
              	$iCityId = $_POST["city_id_new"][$iRecommendationId];
              }
              else
              {
              	$iCityId = "NULL";
              }

              $sSql = "INSERT INTO
  " . DB_PREFIX . "recommendations
SET
  recommendation_create_datetime = NOW(),
  leader_id_from = " . $iContentId . ",
  leader_id_to = " . $iLeaderIdTo . ",
  city_id = " . $iCityId . ",
  leader_phone = " . $sLeaderPhone . ",
  leader_city_name = '" . $oDB->escape_string($_POST["leader_city_name_new"][$iRecommendationId]) . "',
  leader_surname = '" . $oDB->escape_string($_POST["leader_surname_new"][$iRecommendationId]) . "',
  leader_name = '" . $oDB->escape_string($_POST["leader_name_new"][$iRecommendationId]) . "',
  leader_patronymic = '" . $oDB->escape_string($_POST["leader_patronymic_new"][$iRecommendationId]) . "',
  leader_project_name = '" . $oDB->escape_string($_POST["leader_project_name_new"][$iRecommendationId]) . "',
  leader_email = '" . $oDB->escape_string($_POST["leader_email_new"][$iRecommendationId]) . "',
  recommendation_reason = '" . $oDB->escape_string($sRecommendationReason) . "',
  recommendation_comment = '" . $oDB->escape_string($_POST["recommendation_comment_new"][$iRecommendationId]) . "'";
              if($oResult = $oDB->query($sSql))
              {
              }
            }
      	  }
      	}
      }

      if(isset($_POST["recommendation_reason_old"], $_POST["recommendation_comment_old"]) and is_array($_POST["recommendation_reason_old"]) and is_array($_POST["recommendation_comment_old"]))
      {
      	foreach($_POST["recommendation_reason_old"] as $iRecommendationId => $sRecommendationReason)
      	{
      	  if(bIsInt($iRecommendationId, 1) and isset($_POST["recommendation_comment_old"][$iRecommendationId]))
      	  {
            if(!isset($_POST["leader_surname_old"][$iRecommendationId]))
            {
              $_POST["leader_surname_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_name_old"][$iRecommendationId]))
            {
              $_POST["leader_name_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_patronymic_old"][$iRecommendationId]))
            {
              $_POST["leader_patronymic_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_email_old"][$iRecommendationId]))
            {
              $_POST["leader_email_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_phone_old"][$iRecommendationId]))
            {
              $_POST["leader_phone_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_project_name_old"][$iRecommendationId]))
            {
              $_POST["leader_project_name_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["city_id_old"][$iRecommendationId]))
            {
              $_POST["city_id_old"][$iRecommendationId] = "";
            }

            if(!isset($_POST["leader_city_name_old"][$iRecommendationId]))
            {
              $_POST["leader_city_name_old"][$iRecommendationId] = "";
            }

            if(get_magic_quotes_gpc())
            {
              $_POST["leader_surname_old"][$iRecommendationId] = stripslashes($_POST["leader_surname_old"][$iRecommendationId]);
              $_POST["leader_name_old"][$iRecommendationId] = stripslashes($_POST["leader_name_old"][$iRecommendationId]);
              $_POST["leader_patronymic_old"][$iRecommendationId] = stripslashes($_POST["leader_patronymic_old"][$iRecommendationId]);
              $_POST["leader_project_name_old"][$iRecommendationId] = stripslashes($_POST["leader_project_name_old"][$iRecommendationId]);
              $_POST["leader_email_old"][$iRecommendationId] = stripslashes($_POST["leader_email_old"][$iRecommendationId]);
              $_POST["leader_phone_old"][$iRecommendationId] = stripslashes($_POST["leader_phone_old"][$iRecommendationId]);
              $_POST["recommendation_comment_old"][$iRecommendationId] = stripslashes($_POST["recommendation_comment_old"][$iRecommendationId]);
              $_POST["leader_city_name_old"][$iRecommendationId] = stripslashes($_POST["leader_city_name_old"][$iRecommendationId]);
              $sRecommendationReason = stripslashes($sRecommendationReason);
            }
            $_POST["leader_surname_old"][$iRecommendationId] = trim($_POST["leader_surname_old"][$iRecommendationId]);
            $_POST["leader_name_old"][$iRecommendationId] = trim($_POST["leader_name_old"][$iRecommendationId]);
            $_POST["leader_patronymic_old"][$iRecommendationId] = trim($_POST["leader_patronymic_old"][$iRecommendationId]);
            $_POST["leader_project_name_old"][$iRecommendationId] = trim($_POST["leader_project_name_old"][$iRecommendationId]);
            $_POST["leader_email_old"][$iRecommendationId] = trim($_POST["leader_email_old"][$iRecommendationId]);
            $_POST["leader_phone_old"][$iRecommendationId] = trim($_POST["leader_phone_old"][$iRecommendationId]);
            $_POST["recommendation_comment_old"][$iRecommendationId] = trim($_POST["recommendation_comment_old"][$iRecommendationId]);
            $_POST["leader_city_name_old"][$iRecommendationId] = trim($_POST["leader_city_name_old"][$iRecommendationId]);
            $sRecommendationReason = trim($sRecommendationReason);

            $_POST["leader_email_old"][$iRecommendationId] = mb_strtolower($_POST["leader_email_old"][$iRecommendationId], "utf-8");
            $_POST["leader_phone_old"][$iRecommendationId] = preg_replace("/[^0-9]+/", "", $_POST["leader_phone_old"][$iRecommendationId]);

            if(strlen($_POST["leader_phone_old"][$iRecommendationId]) === 11 and ($_POST["leader_phone_old"][$iRecommendationId][0] === "7" or $_POST["leader_phone_old"][$iRecommendationId][0] === "8"))
            {
              $_POST["leader_phone_old"][$iRecommendationId] = substr($_POST["leader_phone_old"][$iRecommendationId], 1);
            }

            if($_POST["leader_surname_old"][$iRecommendationId] !== "")
            {
              $_POST["leader_surname_old"][$iRecommendationId] = mb_strtoupper(mb_substr($_POST["leader_surname_old"][$iRecommendationId], 0, 1, "utf-8"), "utf-8") . mb_substr($_POST["leader_surname_old"][$iRecommendationId], 1, null, "utf-8");
            }

            if(bIsInt($_POST["leader_surname_old"][$iRecommendationId], 1) and $_POST["leader_surname_old"][$iRecommendationId] != $iContentId and $oDB->bCheckDataByFilters(DB_PREFIX . "leaders", array("leader_id" => $_POST["leader_surname_old"][$iRecommendationId])))
            {
              $iLeaderIdTo = $_POST["leader_surname_old"][$iRecommendationId];
              $_POST["leader_phone_old"][$iRecommendationId] = "";
              $_POST["leader_email_old"][$iRecommendationId] = "";
              $_POST["city_id_old"][$iRecommendationId] = "";
              $_POST["leader_city_name_old"][$iRecommendationId] = "";
              $_POST["leader_surname_old"][$iRecommendationId] = "";
              $_POST["leader_name_old"][$iRecommendationId] = "";
              $_POST["leader_patronymic_old"][$iRecommendationId] = "";
              $_POST["leader_project_name_old"][$iRecommendationId] = "";
            }
            else
            {
              $iLeaderIdTo = "NULL";
            }

            if(strlen($_POST["leader_phone_old"][$iRecommendationId]) === 10)
            {
              $sLeaderPhone = $_POST["leader_phone_old"][$iRecommendationId];
            }
            else
            {
              $sLeaderPhone = "NULL";
            }

            if(!bIsEmail($_POST["leader_email_old"][$iRecommendationId]))
            {
              $_POST["leader_email_old"][$iRecommendationId] = "";
            }

            if(bIsInt($_POST["city_id_old"][$iRecommendationId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id_old"][$iRecommendationId])))
            {
              $iCityId = $_POST["city_id_old"][$iRecommendationId];
            }
            else
            {
              $iCityId = "NULL";
            }

            $sSql = "UPDATE
  " . DB_PREFIX . "recommendations AS r
SET
  r.leader_id_to = IF(r.leader_id_to IS NULL, " . $iLeaderIdTo . ", r.leader_id_to),
  r.city_id = IF(r.leader_id_to IS NULL, " . $iCityId . ", NULL),
  r.leader_phone = IF(r.leader_id_to IS NULL, " . $sLeaderPhone . ", NULL),
  r.leader_city_name = '" . $oDB->escape_string($_POST["leader_city_name_old"][$iRecommendationId]) . "',
  r.leader_surname = '" . $oDB->escape_string($_POST["leader_surname_old"][$iRecommendationId]) . "',
  r.leader_name = '" . $oDB->escape_string($_POST["leader_name_old"][$iRecommendationId]) . "',
  r.leader_patronymic = '" . $oDB->escape_string($_POST["leader_patronymic_old"][$iRecommendationId]) . "',
  r.leader_project_name = '" . $oDB->escape_string($_POST["leader_project_name_old"][$iRecommendationId]) . "',
  r.leader_email = '" . $oDB->escape_string($_POST["leader_email_old"][$iRecommendationId]) . "',
  r.recommendation_reason = '" . $oDB->escape_string($sRecommendationReason) . "',
  r.recommendation_comment = '" . $oDB->escape_string($_POST["recommendation_comment_old"][$iRecommendationId]) . "'
WHERE
  r.recommendation_id = " . $iRecommendationId . " AND
  r.leader_id_from = " . $iContentId . " AND
  (r.leader_id_to IS NOT NULL OR " . $iLeaderIdTo . " IS NOT NULL OR '" . $oDB->escape_string($_POST["leader_surname_old"][$iRecommendationId]) . "' != '')";
            if($oResult = $oDB->query($sSql))
            {
            }
      	  }
      	}
      }

      vTransactionLeader($iContentId, $aBackendUserInfo["backend_user_id"]);
    }
  }
  else
  {
  	$aContentData = array();
    $aContentData["leader_surname"] = htmlspecialchars($_POST["leader_surname"]);
    $aContentData["leader_name"] = htmlspecialchars($_POST["leader_name"]);
    $aContentData["leader_patronymic"] = htmlspecialchars($_POST["leader_patronymic"]);
    $aContentData["leader_interview_date"] = htmlspecialchars($_POST["leader_interview_date"]);
    $aContentData["leader_create_date"] = htmlspecialchars($_POST["leader_create_date"]);
    $aContentData["leader_contact_from"] = htmlspecialchars($_POST["leader_contact_from"]);
    $aContentData["leader_interview_result"] = htmlspecialchars($_POST["leader_interview_result"]);
    $aContentData["leader_interview_backend_user_id"] = $_POST["leader_interview_backend_user_id"];
    $aContentData["leader_write_backend_user_id"] = $_POST["leader_write_backend_user_id"];
    $aContentData["leader_enabled"] = $iLeaderEnabled;
    $aContentData["leader_done"] = $iLeaderDone;
    $aContentData["leader_high_priority"] = $iLeaderHighPriority;
    $aContentData["sex_id"] = $_POST["sex_id"];
    $aContentData["city_id"] = $_POST["city_id"];
    $aContentData["leader_birth_date_correct"] = $iLeaderBirthDateCorrect;
    $aContentData["leader_birth_date"] = htmlspecialchars($_POST["leader_birth_date"]);
    $aContentData["leader_company"] = htmlspecialchars($_POST["leader_company"]);
    $aContentData["leader_position"] = htmlspecialchars($_POST["leader_position"]);
    $aContentData["leader_city_name"] = htmlspecialchars($_POST["leader_city_name"]);
    $aContentData["leader_email"] = htmlspecialchars($_POST["leader_email"]);
    $aContentData["leader_skype"] = htmlspecialchars($_POST["leader_skype"]);
    $aContentData["leader_social_network"] = htmlspecialchars($_POST["leader_social_network"]);
    $aContentData["leader_contacts"] = htmlspecialchars($_POST["leader_contacts"]);
    $aContentData["leader_phone"] = $_POST["leader_phone"];
    $aContentData["leader_interview_type"] = $_POST["leader_interview_type"];
    $aContentData["leader_question_01"] =  htmlspecialchars($_POST["leader_question_01"]);
    $aContentData["leader_question_02"] =  htmlspecialchars($_POST["leader_question_02"]);
    $aContentData["leader_question_03"] =  htmlspecialchars($_POST["leader_question_03"]);
    $aContentData["leader_question_04"] =  htmlspecialchars($_POST["leader_question_04"]);
    $aContentData["leader_question_05"] =  htmlspecialchars($_POST["leader_question_05"]);
    $aContentData["leader_question_06"] =  htmlspecialchars($_POST["leader_question_06"]);
    $aContentData["leader_question_07"] =  htmlspecialchars($_POST["leader_question_07"]);
    $aContentData["leader_question_10"] =  htmlspecialchars($_POST["leader_question_10"]);
    $aContentData["leader_question_11"] =  htmlspecialchars($_POST["leader_question_11"]);
    $aContentData["leader_question_12"] =  htmlspecialchars($_POST["leader_question_12"]);
    $aContentData["leader_question_13"] =  htmlspecialchars($_POST["leader_question_13"]);
    $aContentData["leader_question_14"] =  htmlspecialchars($_POST["leader_question_14"]);
    $aContentData["leader_question_15"] =  htmlspecialchars($_POST["leader_question_15"]);
    $aContentData["leader_question_16"] =  htmlspecialchars($_POST["leader_question_16"]);
    $aContentData["leader_question_17"] =  htmlspecialchars($_POST["leader_question_17"]);
    $aContentData["leader_question_18"] =  htmlspecialchars($_POST["leader_question_18"]);
    $aContentData["leader_question_19"] =  htmlspecialchars($_POST["leader_question_19"]);
    $aContentData["leader_question_20"] =  htmlspecialchars($_POST["leader_question_20"]);
    $aContentData["leader_question_21"] =  htmlspecialchars($_POST["leader_question_21"]);
    $aContentData["leader_question_08"] = $_POST["leader_question_08"];
    $aContentData["leader_question_09"] = $_POST["leader_question_09"];

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;
  }
}


  if (isset($_POST['leader_done_1'])) {
    $leader_done_1 = '1';
  }else{
    $leader_done_1 = '0';
  }

  if (isset($_POST['leader_done_2'])) {
    $leader_done_2 = '1';
  }else{
    $leader_done_2 = '0';
  }

  if (isset($_POST['leader_done_3'])) {
    $leader_done_3 = '1';
  }else{
    $leader_done_3 = '0';
  }

  if (isset($_POST['leader_done_4'])) {
    $leader_done_4 = '1';
  }else{
    $leader_done_4 = '0';
  }

  $sSql = "UPDATE " . DB_PREFIX . "leaders SET leader_done_1 = ".$leader_done_1.", leader_done_2 = ".$leader_done_2.", leader_done_3 = ".$leader_done_3.", leader_done_4 = ".$leader_done_4." WHERE leader_id = " . $_GET["content_id"];
  if($oResult = $oDB->query($sSql))
  {
  }

  $id_leader = $_GET["content_id"]; 

  $leader_object_new = $_POST['leader_object_new'];

  foreach ($leader_object_new as $key => $value) {
    if ($value != '') {
      $tag['object_id'][] = $value;
    }
  }

  $object_value_new = $_POST['object_value_new'];

  foreach ($object_value_new as $key => $value) {
    if ($value != '') {
      $tag['object_value'][] = $value;
    }
  }

  $leader_tag_new = $_POST['leader_tag_new'];
  $i = 0;
  foreach ($leader_tag_new as $key => $value) {
    
    foreach ($value as $key => $value2) {
      if ($value2 != '') {
        $tag['tag'][$i][][] = $value2;
      }
    }
    $i++;
  }

  $tags_from_db = $tag['tag'];
  foreach ($tags_from_db as $key => $value) {
    foreach ($value as $key => $value2) {
      foreach ($value2 as $key => $value3) {
      $sSql = "SELECT * FROM " . DB_PREFIX . "tags WHERE id_name_tag_1 = " . $value3 . " OR id_name_tag_2 = " . $value3 . " OR id_name_tag_3 = " . $value3;
      if($oResult = $oDB->query($sSql)){
        $aRow[] = $oResult->fetch_assoc();
      }
     }
    }
  }

  $i = 0;
foreach ($tags_from_db as $key => $value) {

  foreach ($value as $key2 => $value2) {
    $tags_post[$i][] = $value2[0];

  }
  $i++;
}


foreach ($tags_post as $key => $value) {
  foreach ($value as $key2 => $value2) {
    
    foreach ($aRow as $key3 => $value3) {
      // if ($aRow[$key3]["id_name_tag_1"] == $value2) {
      //    $result[$key3][]["id_name_tag_1"] = '1';
      // }
      // if ($aRow[$key3]["id_name_tag_2"] == $value2) {
      //    $result[$key3][]["id_name_tag_1"] = '1';
      //    $result[$key3][]["id_name_tag_2"] = '2';
      // }
      // if ($aRow[$key3]["id_name_tag_3"] == $value2) {
      //    $result[$key3][]["id_name_tag_1"] = '1';
      //    $result[$key3][]["id_name_tag_2"] = '2';
      //    $result[$key3][]["id_name_tag_3"] = '3';
      // }
      if ($aRow[$key3]["id_name_tag_1"] == $value2) {
        echo "<br> value3 - id_name_tag_1 = " . $value3['id_name_tag_1'];
        echo "<br> value3 - id_name_tag_2 - нет = " . $value3['id_name_tag_2'];
        echo "<br> value3 - id_name_tag_3 - нет = " . $value3['id_name_tag_3'];
        echo "<br> value2 = " . $value2;
      }
      if ($aRow[$key3]["id_name_tag_2"] == $value2) {
        echo "<br> value3 - id_name_tag_1 = " . $value3['id_name_tag_1'];
        echo "<br> value3 - id_name_tag_2  = " . $value3['id_name_tag_2'];
        echo "<br> value3 - id_name_tag_3 - нет = " . $value3['id_name_tag_3'];
        echo "<br> value2 = " . $value2;
      }
      if ($aRow[$key3]["id_name_tag_3"] == $value2) {
        echo "<br> value3 - id_name_tag_1 = " . $value3['id_name_tag_1'];
        echo "<br> value3 - id_name_tag_2  = " . $value3['id_name_tag_2'];
        echo "<br> value3 - id_name_tag_3  = " . $value3['id_name_tag_3'];
        echo "<br> value2 = " . $value2;
      }
    }
  }
}


// тут либо удалять - либо собирать новый массив!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


// Row  некорректно собирается!! Пересмотреть как по другому собрать нужный массив!! Слишком много циклов а то !!!!

//           echo "<pre>";
//         var_dump($aRow);
//         echo "</pre>";
// foreach ($tags_post as $key => $value) {
//   foreach ($value as $key2 => $value2) {
//     foreach ($aRow as $key3 => $value3) {
//       if ($aRow[$key3]['id_name_tag_1'] == $value2) {
//         unset($aRow[$key3]['id_name_tag_2']);
//         unset($aRow[$key3]['id_name_tag_3']);
//       }
//       if (isset($aRow[$key3]['id_name_tag_2']) && ($aRow[$key3]['id_name_tag_2'] == $value2)) {
//         unset($aRow[$key3]['id_name_tag_3']);
//       }
//       if (isset($aRow[$key3]['id_name_tag_3']) && ($aRow[$key3]['id_name_tag_3'] == $value2)) {
//         # code...
//       }
//     }
//   }
// }






  // foreach ($tags_from_db as $key => $value) {
  //   foreach ($value as $key2 => $value2) {
  //     foreach ($value2 as $key3 => $value3) {
  //       foreach ($aRow as $key4 => $value4) {
  //         echo "<pre>";
  //       var_dump($value4);
  //       echo "</pre>";
  //         if ($value3["id_name_tag_1"] == $value4["id_name_tag_1"]) {
  //           unset($tags_from_db[$key][$key2][$key3]["id_name_tag_2"]);
  //           unset($tags_from_db[$key][$key2][$key3]["id_name_tag_3"]);
  //         }

  //         if ($value3["id_name_tag_2"] == $value4["id_name_tag_2"]) {
  //           unset($tags_from_db[$key][$key2][$key3]["id_name_tag_3"]);
  //         }
  //       }
  //     }
  //   }
  // }

 echo "<pre>";
        var_dump($result);
        echo "</pre>";


 echo "<pre>";
        var_dump($tags_post); // правильный массив тегов
        echo "</pre>";


            echo "<pre>";
        var_dump($aRow);
        echo "</pre>";



        //   echo "<pre>";
        // var_dump($aRow);
        // echo "</pre>";

// array(3) {
//   ["object_id"]=>
//   array(1) {
//     [0]=>
//     string(1) "1"
//   }
//   ["object_value"]=>
//   array(1) {
//     [0]=>
//     string(20) "Ð¿Ð°Ð²Ð¿Ð°Ð¸Ð²Ð°Ð¿Ð¸"
//   }
//   ["tag"]=>
//   array(1) {
//     [0]=>
//     array(4) {
//       [0]=>
//       array(1) {
//         [0]=>
//         string(2) "11"
//       }
//       [1]=>
//       array(1) {
//         [0]=>
//         string(1) "6"
//       }
//       [2]=>
//       array(1) {
//         [0]=>
//         string(1) "4"
//       }
//       [3]=>
//       array(1) {
//         [0]=>
//         string(2) "12"
//       }
//     }
//   }
// }


  // $leader_tag_new_2 = $_POST['leader_tag_new'][2];

  // foreach ($leader_tag_new_2 as $key => $value) {
  //   if ($value != '') {
  //     $leader_tag_new_2_arr[] = $value;
  //   }
  // }

  // $leader_tag_new_3 = $_POST['leader_tag_new'][3];

  // foreach ($leader_tag_new_3 as $key => $value) {
  //   if ($value != '') {
  //     $leader_tag_new_3_arr[] = $value;
  //   }
  // }

  // $leader_tag_new_4 = $_POST['leader_tag_new'][4];

  // foreach ($leader_tag_new_4 as $key => $value) {
  //   if ($value != '') {
  //     $leader_tag_new_4_arr[] = $value;
  //   }
  // }

  // $leader_tag_new_5 = $_POST['leader_tag_new'][5];

  // foreach ($leader_tag_new_5 as $key => $value) {
  //   if ($value != '') {
  //     $leader_tag_new_5_arr[] = $value;
  //   }
  // }

// $arr[] = $leader_object_new_arr;
// $arr[] = $object_value_new_arr;
// $arr[] = $leader_tag_new_1_arr;
// $arr[] = $leader_tag_new_2_arr;
// $arr[] = $leader_tag_new_3_arr;
// $arr[] = $leader_tag_new_4_arr;
// $arr[] = $leader_tag_new_5_arr;

// echo "<pre>";
// var_dump($tag);
// echo "</pre>";

  // $sSql = "SELECT * FROM " . DB_PREFIX . "tags WHERE id_name_tag_1 = " . $_POST["leader_tag_new"][1][1] . " OR id_name_tag_3 = " . $_POST["leader_tag_new"][1][1] . " OR id_name_tag_3 = " . $_POST["leader_tag_new"][1][1];
  // $oResult = $oDB->query($sSql);



  // $sSql = "SELECT * FROM " . DB_PREFIX . "tags WHERE id_name_tag_1 = " . $_POST["leader_tag_new"][1][1] . " OR id_name_tag_3 = " . $_POST["leader_tag_new"][1][1] . " OR id_name_tag_3 = " . $_POST["leader_tag_new"][1][1];
  // $oResult = $oDB->query($sSql);

  // if (!empty($_POST['leader_object_new'][1])) {

  //   $id_name_object = $_POST['leader_object_new'][1];
  //   $id_name_tag_1 = $_POST['leader_object_new'][1];
  //   $id_name_tag_2
  //   $id_name_tag_3
    

  //   $sSql = "INSERT INTO " . DB_PREFIX . "tags_leaders (id_leader, id_name_tag_1, id_name_tag_2, id_name_tag_3, id_name_object) VALUES (".$id_leader.", ".$id_name_tag_1.", ".$id_name_tag_2.", ".$id_name_tag_3.", ".$id_name_object.")";
  //   $oResult = $oDB->query($sSql);

  //     if (!empty($_POST['leader_object_new'][2])) {

  //       $id_name_object = $_POST['leader_object_new'][2];

  //       $sSql = "INSERT INTO " . DB_PREFIX . "tags_leaders (id_leader, id_name_tag_1, id_name_tag_2, id_name_tag_3, id_name_object) VALUES (".$id_leader.", ".$id_name_tag_1.", ".$id_name_tag_2.", ".$id_name_tag_3.", ".$id_name_object.")";
  //       $oResult = $oDB->query($sSql);

  //         if (!empty($_POST['leader_object_new'][3])) {

  //           $id_name_object = $_POST['leader_object_new'][3];

  //           $sSql = "INSERT INTO " . DB_PREFIX . "tags_leaders (id_leader, id_name_tag_1, id_name_tag_2, id_name_tag_3, id_name_object) VALUES (".$id_leader.", ".$id_name_tag_1.", ".$id_name_tag_2.", ".$id_name_tag_3.", ".$id_name_object.")";
  //           $oResult = $oDB->query($sSql);

  //         }
  //     }
  // }



header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=leaders&action_name=view" . $sUrlPostfix);

?>