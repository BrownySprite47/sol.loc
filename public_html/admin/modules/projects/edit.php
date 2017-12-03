<?php

$sUrlPostfix = "";

$aPostData = array();
$aPostData["project_name"] = array("isset" => 1, "trim" => 1);
$aPostData["project_name_small"] = array("isset" => 1, "trim" => 1);
$aPostData["project_name_code"] = array("isset" => 1, "trim" => 1);
$aPostData["project_text"] = array("isset" => 1, "trim" => 1);
$aPostData["project_site"] = array("isset" => 1, "trim" => 1);
$aPostData["leader_name"] = array("isset" => 1, "trim" => 1);
$aPostData["project_interview_date"] = array("isset" => 1, "trim" => 1);
$aPostData["project_create_date"] = array("isset" => 1, "trim" => 1);
$aPostData["project_interview_backend_user_id"] = array("isset" => 1, "trim" => 0);
$aPostData["project_write_backend_user_id"] = array("isset" => 1, "trim" => 0);
$aPostData["project_area"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_01"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_02"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_03"] = array("isset" => 1, "trim" => 0);
$aPostData["project_question_04"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_05"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_06"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_07"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_08"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_09"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_10"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_11"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_18"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_19"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_20"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_21"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_22"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_23"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_24"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_25"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_26"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_27"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_28"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_29"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_30"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_31"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_32"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_33"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_34"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_35"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_36"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_37"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_38"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_39"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_40"] = array("isset" => 1, "trim" => 0);
$aPostData["project_question_41"] = array("isset" => 1, "trim" => 0);
$aPostData["project_question_42"] = array("isset" => 1, "trim" => 0);
$aPostData["project_question_43"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_44"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_45"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_46"] = array("isset" => 1, "trim" => 1);
$aPostData["project_question_47"] = array("isset" => 1, "trim" => 1);
$aPostData["city_id"] = array("isset" => 1, "trim" => 0);
$aPostData["project_city_name"] = array("isset" => 1, "trim" => 1);
$aPostData["project_start_date"] = array("isset" => 1, "trim" => 1);
$aPostData["transaction_id"] = array("isset" => 1, "trim" => 0);

$bResult = true;

foreach($aPostData as $sFieldName => $aFieldData)
{  if($aFieldData["isset"] === 1 and !isset($_POST[$sFieldName]))
  {
  	$bResult = false;  }}

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

  $aContentDataErrors = array();

  if($bContentEdit)
  {
    $aContentDataErrors["transaction_id"] = "";

    $iTransactionId = $oDB->aGetDataByFilters(DB_PREFIX . "projects", "transaction_id", array("project_id" => $_GET["content_id"]));

    if((is_null($iTransactionId) and $_POST["transaction_id"] === "") or (bIsInt($_POST["transaction_id"], 1) and !is_null($iTransactionId) and $iTransactionId == $_POST["transaction_id"]))
    {
      unset($aContentDataErrors["transaction_id"]);
    }
  }

  if($_POST["project_name_code"] !== "" and mb_strlen($_POST["project_name_code"], "utf-8") > 12)
  {  	$aContentDataErrors["project_name_code"] = "";  }

  if($_POST["project_name"] === "")
  {  	$aContentDataErrors["project_name"] = "Поле обязательно для заполнения";  }

  if($_POST["project_interview_date"] !== "" and !bIsDate($_POST["project_interview_date"]))
  {
  	$aContentDataErrors["project_interview_date"] = "";
  }

  if($_POST["project_start_date"] !== "" and !bIsDate($_POST["project_start_date"]))
  {
  	if(!bIsDate($_POST["project_start_date"] . "-01"))
  	{
  	  if(!bIsDate($_POST["project_start_date"] . "-07-01"))
  	  {
  		$aContentDataErrors["project_start_date"] = "";
  	  }
  	  else
  	  {
  	  	$_POST["project_start_date"] = $_POST["project_start_date"] . "-07-01";
  	  }
  	}
  	else
  	{
  	  $_POST["project_start_date"] = $_POST["project_start_date"] . "-01";
  	}
  }

  if($_POST["project_create_date"] !== "" and !bIsDate($_POST["project_create_date"]))
  {
  	$aContentDataErrors["project_create_date"] = "";
  }

  if(bIsInt($_POST["project_interview_backend_user_id"], 1))
  {
  	if(!$oDB->bCheckDataByFilters(DB_PREFIX . "backend_users", array("backend_user_id" => $_POST["project_interview_backend_user_id"])))
  	{
  	  $aContentDataErrors["project_interview_backend_user_id"] = "";
  	  $_POST["project_interview_backend_user_id"] = "";
  	}
  }
  else
  {
    $_POST["project_interview_backend_user_id"] = "";
  }

  if(bIsInt($_POST["project_write_backend_user_id"], 1))
  {
  	if(!$oDB->bCheckDataByFilters(DB_PREFIX . "backend_users", array("backend_user_id" => $_POST["project_write_backend_user_id"])))
  	{  	  $aContentDataErrors["project_write_backend_user_id"] = "";
  	  $_POST["project_write_backend_user_id"] = "";  	}
  }
  else
  {
    $_POST["project_write_backend_user_id"] = "";
  }

  $aProjectQuestions = array();
  $aProjectQuestions["03"] = 7;
  $aProjectQuestions["12"] = 2;
  $aProjectQuestions["13"] = 8;
  $aProjectQuestions["14"] = 8;
  $aProjectQuestions["15"] = 8;
  $aProjectQuestions["16"] = 8;
  $aProjectQuestions["17"] = 8;
  $aProjectQuestions["34"] = 0;
  $aProjectQuestions["35"] = 0;
  $aProjectQuestions["36"] = 0;
  $aProjectQuestions["37"] = 0;
  $aProjectQuestions["38"] = 0;
  $aProjectQuestions["39"] = 0;
  $aProjectQuestions["40"] = 9;
  $aProjectQuestions["41"] = 11;
  $aProjectQuestions["42"] = 12;

  foreach($aProjectQuestions as $sProjectQuestionId => $iOptionId)
  {  	if($iOptionId === 0)
  	{  	  if($_POST["project_question_" . $sProjectQuestionId] !== "" and !bIsInt($_POST["project_question_" . $sProjectQuestionId], 0))
  	  {  	  	$aContentDataErrors["project_question_" . $sProjectQuestionId] = "";  	  }
  	  else
  	  {  	  	if($_POST["project_question_" . $sProjectQuestionId] === "")
  	  	{  	  	  $aProjectQuestions[$sProjectQuestionId] = "NULL";  	  	}
  	  	else
  	  	{  	  	  $aProjectQuestions[$sProjectQuestionId] = $_POST["project_question_" . $sProjectQuestionId];  	  	}  	  }  	}
  	else
  	{  	  if(!isset($_POST["project_question_" . $sProjectQuestionId]) or !bIsInt($_POST["project_question_" . $sProjectQuestionId], 1) or !$oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $_POST["project_question_" . $sProjectQuestionId], "option_id" => $iOptionId)))
  	  {
  	    $_POST["project_question_" . $sProjectQuestionId] = "";
  	    $aProjectQuestions[$sProjectQuestionId] = "NULL";
  	  }
  	  else
  	  {
  	    $aProjectQuestions[$sProjectQuestionId] = $_POST["project_question_" . $sProjectQuestionId];
  	  }  	}  }

  if(bIsInt($_POST["city_id"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id"])))
  {  	$iCityId = $_POST["city_id"];  }
  else
  {  	$iCityId = "NULL";
  	$_POST["city_id"] = "";  }

  $iProjectEnabled = (int) isset($_POST["project_enabled"]);
  $iProjectDone = (int) isset($_POST["project_done"]);

  if(empty($aContentDataErrors))
  {
    if($_POST["project_interview_date"] === "")
  	{
  	  $sProjectInterviewDate = "NULL";
  	}
  	else
  	{  	  $sProjectInterviewDate = "'" . $_POST["project_interview_date"] . "'";  	}

  	if($_POST["project_start_date"] === "")
  	{
  	  $sProjectStartDate = "NULL";
  	}
  	else
  	{
  	  $sProjectStartDate = "'" . $_POST["project_start_date"] . "'";
  	}

  	if($_POST["project_create_date"] === "")
  	{
  	  $sProjectCreateDate = "NULL";
  	}
  	else
  	{
  	  $sProjectCreateDate = "'" . $_POST["project_create_date"] . "'";
  	}

  	if($_POST["project_interview_backend_user_id"] === "")
  	{
  	  $sProjectInterviewBackendUserId = "NULL";
  	}
  	else
  	{
  	  $sProjectInterviewBackendUserId = $_POST["project_interview_backend_user_id"];
  	}

  	if($_POST["project_write_backend_user_id"] === "")
  	{
  	  $sProjectWriteBackendUserId = "NULL";
  	}
  	else
  	{
  	  $sProjectWriteBackendUserId = $_POST["project_write_backend_user_id"];
  	}

  	if(bIsInt($_POST["leader_name"], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "leaders", array("leader_id" => $_POST["leader_name"])))
    {
      $iLeaderId = $_POST["leader_name"];
      $_POST["leader_name"] = "";;
    }
    else
    {
      $iLeaderId = "NULL";
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
  " . DB_PREFIX . "projects
SET
  leader_name = '" . $oDB->escape_string($_POST["leader_name"]) . "',
  leader_id = " . $iLeaderId . ",
  project_name = '" . $oDB->escape_string($_POST["project_name"]) . "',
  project_name_small = '" . $oDB->escape_string($_POST["project_name_small"]) . "',
  project_name_code = '" . $oDB->escape_string($_POST["project_name_code"]) . "',
  project_text = '" . $oDB->escape_string($_POST["project_text"]) . "',
  project_site = '" . $oDB->escape_string($_POST["project_site"]) . "',
  project_interview_date = " . $sProjectInterviewDate . ",
  project_start_date = " . $sProjectStartDate . ",
  project_create_date = " . $sProjectCreateDate . ",
  project_interview_backend_user_id = " . $sProjectInterviewBackendUserId . ",
  project_write_backend_user_id = " . $sProjectWriteBackendUserId . ",
  project_area = '" . $oDB->escape_string($_POST["project_area"]) . "',
  city_id = " . $iCityId . ",
  project_city_name = '" . $oDB->escape_string($_POST["project_city_name"]) . "',
  project_question_01 = '" . $oDB->escape_string($_POST["project_question_01"]) . "',
  project_question_02 = '" . $oDB->escape_string($_POST["project_question_02"]) . "',
  project_question_04 = '" . $oDB->escape_string($_POST["project_question_04"]) . "',
  project_question_05 = '" . $oDB->escape_string($_POST["project_question_05"]) . "',
  project_question_06 = '" . $oDB->escape_string($_POST["project_question_06"]) . "',
  project_question_07 = '" . $oDB->escape_string($_POST["project_question_07"]) . "',
  project_question_08 = '" . $oDB->escape_string($_POST["project_question_08"]) . "',
  project_question_09 = '" . $oDB->escape_string($_POST["project_question_09"]) . "',
  project_question_10 = '" . $oDB->escape_string($_POST["project_question_10"]) . "',
  project_question_11 = '" . $oDB->escape_string($_POST["project_question_11"]) . "',
  project_question_32 = '" . $oDB->escape_string($_POST["project_question_32"]) . "',
  project_question_33 = '" . $oDB->escape_string($_POST["project_question_33"]) . "',
  project_question_43 = '" . $oDB->escape_string($_POST["project_question_43"]) . "',
  project_question_44 = '" . $oDB->escape_string($_POST["project_question_44"]) . "',
  project_question_45 = '" . $oDB->escape_string($_POST["project_question_45"]) . "',
  project_question_46 = '" . $oDB->escape_string($_POST["project_question_46"]) . "',
  project_question_47 = '" . $oDB->escape_string($_POST["project_question_47"]) . "',
  project_question_03 = " . $aProjectQuestions["03"] . ",
  project_question_12 = " . $aProjectQuestions["12"] . ",
  project_question_13 = " . $aProjectQuestions["13"] . ",
  project_question_14 = " . $aProjectQuestions["14"] . ",
  project_question_15 = " . $aProjectQuestions["15"] . ",
  project_question_16 = " . $aProjectQuestions["16"] . ",
  project_question_17 = " . $aProjectQuestions["17"] . ",
  project_question_18 = '" . $oDB->escape_string($_POST["project_question_18"]) . "',
  project_question_19 = '" . $oDB->escape_string($_POST["project_question_19"]) . "',
  project_question_20 = '" . $oDB->escape_string($_POST["project_question_20"]) . "',
  project_question_21 = '" . $oDB->escape_string($_POST["project_question_21"]) . "',
  project_question_22 = '" . $oDB->escape_string($_POST["project_question_22"]) . "',
  project_question_23 = '" . $oDB->escape_string($_POST["project_question_23"]) . "',
  project_question_24 = '" . $oDB->escape_string($_POST["project_question_24"]) . "',
  project_question_25 = '" . $oDB->escape_string($_POST["project_question_25"]) . "',
  project_question_26 = '" . $oDB->escape_string($_POST["project_question_26"]) . "',
  project_question_27 = '" . $oDB->escape_string($_POST["project_question_27"]) . "',
  project_question_28 = '" . $oDB->escape_string($_POST["project_question_28"]) . "',
  project_question_29 = '" . $oDB->escape_string($_POST["project_question_29"]) . "',
  project_question_30 = '" . $oDB->escape_string($_POST["project_question_30"]) . "',
  project_question_31 = '" . $oDB->escape_string($_POST["project_question_31"]) . "',
  project_question_34 = " . $aProjectQuestions["34"] . ",
  project_question_35 = " . $aProjectQuestions["35"] . ",
  project_question_36 = " . $aProjectQuestions["36"] . ",
  project_question_37 = " . $aProjectQuestions["37"] . ",
  project_question_38 = " . $aProjectQuestions["38"] . ",
  project_question_39 = " . $aProjectQuestions["39"] . ",
  project_question_40 = " . $aProjectQuestions["40"] . ",
  project_question_41 = " . $aProjectQuestions["41"] . ",
  project_question_42 = " . $aProjectQuestions["42"] . ",
  project_enabled = " . $iProjectEnabled . ",
  project_done = " . $iProjectDone;

    if($bContentEdit)
    {
      $sSql .= "
WHERE
  project_id = " . $_GET["content_id"];
    }
    else
    {      $sSql .= ",
  project_create_backend_user_id = " . $aBackendUserInfo["backend_user_id"] . ",
  project_create_datetime = NOW()";    }

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

      $aOptionIds = array(5, 6, 10);

      $sSql = "DELETE
  cov
FROM
  " . DB_PREFIX . "contents_option_values AS cov
  INNER JOIN " . DB_PREFIX . "option_values AS ov ON cov.option_value_id = ov.option_value_id
WHERE
  cov.content_id = " . $iContentId . " AND
  cov.content_type_id = " . PROJECT_CONTENT_TYPE_ID . " AND
  ov.option_id IN (" . implode(", ", $aOptionIds) . ")";
      if($oResult = $oDB->query($sSql))
      {
      }

      $aOptionValues = array();

      foreach($aOptionIds as $iOptionId)
      {      	if(isset($_POST["options"][$iOptionId]) and is_array($_POST["options"][$iOptionId]))
      	{
          foreach($_POST["options"][$iOptionId] as $iOptionValueId)
          {          	if(bIsInt($iOptionValueId, 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "option_values", array("option_value_id" => $iOptionValueId, "option_id" => $iOptionId)))
          	{          	  $aOptionValues[] = "(" . $iContentId . ", " . PROJECT_CONTENT_TYPE_ID . ", " . $iOptionValueId . ")";          	}          }      	}      }

      if(!empty($aOptionValues))
      {      	$sSql = "INSERT INTO
  " . DB_PREFIX . "contents_option_values (content_id, content_type_id, option_value_id)
VALUES
  " . implode(",
  ", $aOptionValues);
        if($oResult = $oDB->query($sSql))
        {        }      }

      //лидеры

      if(isset($_POST["leader_surname_new"], $_POST["leader_name_new"], $_POST["leader_patronymic_new"], $_POST["leader_role_new"], $_POST["leader_date_from_new"], $_POST["leader_date_to_new"], $_POST["leader_order_new"]) and is_array($_POST["leader_surname_new"]) and is_array($_POST["leader_name_new"]) and is_array($_POST["leader_patronymic_new"]) and is_array($_POST["leader_role_new"]) and is_array($_POST["leader_date_from_new"]) and is_array($_POST["leader_date_to_new"]) and is_array($_POST["leader_order_new"]))
      {
      	foreach($_POST["leader_order_new"] as $iLeaderProjectId => $iLeaderOrder)
      	{
      	  if(bIsInt($iLeaderOrder, 1) and isset($_POST["leader_surname_new"][$iLeaderProjectId], $_POST["leader_name_new"][$iLeaderProjectId], $_POST["leader_patronymic_new"][$iLeaderProjectId], $_POST["leader_role_new"][$iLeaderProjectId], $_POST["leader_date_from_new"][$iLeaderProjectId], $_POST["leader_date_to_new"][$iLeaderProjectId]))
      	  {
            if(get_magic_quotes_gpc())
            {
              $_POST["leader_surname_new"][$iLeaderProjectId] = stripslashes($_POST["leader_surname_new"][$iLeaderProjectId]);
              $_POST["leader_name_new"][$iLeaderProjectId] = stripslashes($_POST["leader_name_new"][$iLeaderProjectId]);
              $_POST["leader_patronymic_new"][$iLeaderProjectId] = stripslashes($_POST["leader_patronymic_new"][$iLeaderProjectId]);
              $_POST["leader_role_new"][$iLeaderProjectId] = stripslashes($_POST["leader_role_new"][$iLeaderProjectId]);
              $_POST["leader_date_from_new"][$iLeaderProjectId] = stripslashes($_POST["leader_date_from_new"][$iLeaderProjectId]);
              $_POST["leader_date_to_new"][$iLeaderProjectId] = stripslashes($_POST["leader_date_to_new"][$iLeaderProjectId]);
            }
            $_POST["leader_surname_new"][$iLeaderProjectId] = trim($_POST["leader_surname_new"][$iLeaderProjectId]);
            $_POST["leader_name_new"][$iLeaderProjectId] = trim($_POST["leader_name_new"][$iLeaderProjectId]);
            $_POST["leader_patronymic_new"][$iLeaderProjectId] = trim($_POST["leader_patronymic_new"][$iLeaderProjectId]);
            $_POST["leader_role_new"][$iLeaderProjectId] = trim($_POST["leader_role_new"][$iLeaderProjectId]);
            $_POST["leader_date_from_new"][$iLeaderProjectId] = trim($_POST["leader_date_from_new"][$iLeaderProjectId]);
            $_POST["leader_date_to_new"][$iLeaderProjectId] = trim($_POST["leader_date_to_new"][$iLeaderProjectId]);

            if($_POST["leader_surname_new"][$iLeaderProjectId] !== "")
            {
              if(bIsInt($_POST["leader_surname_new"][$iLeaderProjectId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "leaders", array("leader_id" => $_POST["leader_surname_new"][$iLeaderProjectId])))
              {
              	$iLeaderId = $_POST["leader_surname_new"][$iLeaderProjectId];
              	$sLeaderSurname = "NULL";
              	$sLeaderName = "NULL";
              	$sLeaderPatronymic = "NULL";
              }
              else
              {
              	$iLeaderId = "NULL";
              	$sLeaderSurname = "'" . $oDB->escape_string($_POST["leader_surname_new"][$iLeaderProjectId]) . "'";
              	$sLeaderName = "'" . $oDB->escape_string($_POST["leader_name_new"][$iLeaderProjectId]) . "'";
              	$sLeaderPatronymic = "'" . $oDB->escape_string($_POST["leader_patronymic_new"][$iLeaderProjectId]) . "'";
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
  project_id = " . $iContentId . ",
  leader_id = " . $iLeaderId . ",
  leader_surname = " . $sLeaderSurname . ",
  leader_name = " . $sLeaderName . ",
  leader_patronymic = " . $sLeaderPatronymic . ",
  leader_role = '" . $oDB->escape_string($_POST["leader_role_new"][$iLeaderProjectId]) . "',
  leader_date_from = " . $sLeaderDateFrom . ",
  leader_date_to = " . $sLeaderDateTo . ",
  leader_order = " . $iLeaderOrder;
              if($oResult = $oDB->query($sSql))
              {
              }
            }
      	  }
      	}
      }

      if(isset($_POST["leader_role_old"], $_POST["leader_date_from_old"], $_POST["leader_date_to_old"], $_POST["leader_order_old"]) and is_array($_POST["leader_role_old"]) and is_array($_POST["leader_date_from_old"]) and is_array($_POST["leader_date_to_old"]) and is_array($_POST["leader_order_old"]))
      {
      	foreach($_POST["leader_order_old"] as $iLeaderProjectId => $iLeaderOrder)
      	{
      	  if(bIsInt($iLeaderProjectId, 1) and bIsInt($iLeaderOrder, 1) and isset($_POST["leader_role_old"][$iLeaderProjectId], $_POST["leader_date_from_old"][$iLeaderProjectId], $_POST["leader_date_to_old"][$iLeaderProjectId]))
      	  {
            if(!isset($_POST["leader_surname_old"][$iLeaderProjectId]))
            {
              $_POST["leader_surname_old"][$iLeaderProjectId] = "";
            }

            if(!isset($_POST["leader_name_old"][$iLeaderProjectId]))
            {
              $_POST["leader_name_old"][$iLeaderProjectId] = "";
            }

            if(!isset($_POST["leader_patronymic_old"][$iLeaderProjectId]))
            {
              $_POST["leader_patronymic_old"][$iLeaderProjectId] = "";
            }

            if(get_magic_quotes_gpc())
            {
              $_POST["leader_surname_old"][$iLeaderProjectId] = stripslashes($_POST["leader_surname_old"][$iLeaderProjectId]);
              $_POST["leader_name_old"][$iLeaderProjectId] = stripslashes($_POST["leader_name_old"][$iLeaderProjectId]);
              $_POST["leader_patronymic_old"][$iLeaderProjectId] = stripslashes($_POST["leader_patronymic_old"][$iLeaderProjectId]);
              $_POST["leader_role_old"][$iLeaderProjectId] = stripslashes($_POST["leader_role_old"][$iLeaderProjectId]);
              $_POST["leader_date_from_old"][$iLeaderProjectId] = stripslashes($_POST["leader_date_from_old"][$iLeaderProjectId]);
              $_POST["leader_date_to_old"][$iLeaderProjectId] = stripslashes($_POST["leader_date_to_old"][$iLeaderProjectId]);
            }
            $_POST["leader_surname_old"][$iLeaderProjectId] = trim($_POST["leader_surname_old"][$iLeaderProjectId]);
            $_POST["leader_name_old"][$iLeaderProjectId] = trim($_POST["leader_name_old"][$iLeaderProjectId]);
            $_POST["leader_patronymic_old"][$iLeaderProjectId] = trim($_POST["leader_patronymic_old"][$iLeaderProjectId]);
            $_POST["leader_role_old"][$iLeaderProjectId] = trim($_POST["leader_role_old"][$iLeaderProjectId]);
            $_POST["leader_date_from_old"][$iLeaderProjectId] = trim($_POST["leader_date_from_old"][$iLeaderProjectId]);
            $_POST["leader_date_to_old"][$iLeaderProjectId] = trim($_POST["leader_date_to_old"][$iLeaderProjectId]);


            if(bIsInt($_POST["leader_surname_old"][$iLeaderProjectId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "leaders", array("leader_id" => $_POST["leader_surname_old"][$iLeaderProjectId])))
            {
              $iLeaderId = $_POST["leader_surname_old"][$iLeaderProjectId];
              $sLeaderSurname = "NULL";
              $sLeaderName = "NULL";
              $sLeaderPatronymic = "NULL";
            }
            else
            {
              $iLeaderId = "NULL";
              $sLeaderSurname = "'" . $oDB->escape_string($_POST["leader_surname_old"][$iLeaderProjectId]) . "'";
              $sLeaderName = "'" . $oDB->escape_string($_POST["leader_name_old"][$iLeaderProjectId]) . "'";
              $sLeaderPatronymic = "'" . $oDB->escape_string($_POST["leader_patronymic_old"][$iLeaderProjectId]) . "'";
            }

            if(bIsDate($_POST["leader_date_from_old"][$iLeaderProjectId]))
            {
              $sLeaderDateFrom = "'" . $_POST["leader_date_from_old"][$iLeaderProjectId] . "'";
            }
            else
            {
              $sLeaderDateFrom = "NULL";
            }

            if(bIsDate($_POST["leader_date_to_old"][$iLeaderProjectId]))
            {
              $sLeaderDateTo = "'" . $_POST["leader_date_to_old"][$iLeaderProjectId] . "'";
            }
            else
            {
              $sLeaderDateTo = "NULL";
            }

            $sSql = "UPDATE
  " . DB_PREFIX . "leaders_projects AS lp
SET
  lp.leader_id = IF(lp.leader_id IS NULL, " . $iLeaderId . ", lp.leader_id),
  lp.leader_surname = IF(lp.leader_id IS NULL, " . $sLeaderSurname . ", NULL),
  lp.leader_name = IF(lp.leader_id IS NULL, " . $sLeaderName . ", NULL),
  lp.leader_patronymic = IF(lp.leader_id IS NULL, " . $sLeaderPatronymic . ", NULL),
  lp.leader_role = '" . $oDB->escape_string($_POST["leader_role_old"][$iLeaderProjectId]) . "',
  lp.leader_date_from = " . $sLeaderDateFrom . ",
  lp.leader_date_to = " . $sLeaderDateTo . ",
  lp.leader_order = " . $iLeaderOrder . "
WHERE
  lp.leader_project_id = " . $iLeaderProjectId . " AND
  lp.project_id = " . $iContentId . " AND
  (lp.leader_id IS NOT NULL OR " . $iLeaderId . " IS NOT NULL OR " . $sLeaderSurname . " != '')";
            if($oResult = $oDB->query($sSql))
            {
            }
      	  }
        }
      }

      //филиалы

      if(isset($_POST["city_id_new"], $_POST["filial_city_name_new"], $_POST["filial_address_new"], $_POST["filial_comment_new"], $_POST["filial_order_new"]) and is_array($_POST["city_id_new"]) and is_array($_POST["filial_city_name_new"]) and is_array($_POST["filial_address_new"]) and is_array($_POST["filial_comment_new"]) and is_array($_POST["filial_order_new"]))
      {
      	foreach($_POST["filial_order_new"] as $iFilialId => $iFilialOrder)
      	{
      	  if(bIsInt($iFilialOrder, 1) and isset($_POST["city_id_new"][$iFilialId], $_POST["filial_city_name_new"][$iFilialId], $_POST["filial_address_new"][$iFilialId], $_POST["filial_comment_new"][$iFilialId]))
      	  {
            if(get_magic_quotes_gpc())
            {
              $_POST["filial_city_name_new"][$iFilialId] = stripslashes($_POST["filial_city_name_new"][$iFilialId]);
              $_POST["filial_address_new"][$iFilialId] = stripslashes($_POST["filial_address_new"][$iFilialId]);
              $_POST["filial_comment_new"][$iFilialId] = stripslashes($_POST["filial_comment_new"][$iFilialId]);
            }
            $_POST["filial_city_name_new"][$iFilialId] = trim($_POST["filial_city_name_new"][$iFilialId]);
            $_POST["filial_address_new"][$iFilialId] = trim($_POST["filial_address_new"][$iFilialId]);
            $_POST["filial_comment_new"][$iFilialId] = trim($_POST["filial_comment_new"][$iFilialId]);

            $iCityId = "NULL";

            if(bIsInt($_POST["city_id_new"][$iFilialId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id_new"][$iFilialId])))
            {
              $iCityId = $_POST["city_id_new"][$iFilialId];
            }

            if($iCityId !== "NULL" or $_POST["filial_city_name_new"][$iFilialId] !== "")
            {
              $sSql = "INSERT INTO
  " . DB_PREFIX . "filials
SET
  project_id = " . $iContentId . ",
  city_id = " . $iCityId . ",
  filial_city_name = '" . $oDB->escape_string($_POST["filial_city_name_new"][$iFilialId]) . "',
  filial_address = '" . $oDB->escape_string($_POST["filial_address_new"][$iFilialId]) . "',
  filial_comment = '" . $oDB->escape_string($_POST["filial_comment_new"][$iFilialId]) . "',
  filial_order = " . $iFilialOrder;
              if($oResult = $oDB->query($sSql))
              {
              }
            }
      	  }
      	}
      }

      if(isset($_POST["city_id_old"], $_POST["filial_city_name_old"], $_POST["filial_address_old"], $_POST["filial_comment_old"], $_POST["filial_order_old"]) and is_array($_POST["city_id_old"]) and is_array($_POST["filial_city_name_old"]) and is_array($_POST["filial_address_old"]) and is_array($_POST["filial_comment_old"]) and is_array($_POST["filial_order_old"]))
      {
      	foreach($_POST["filial_order_old"] as $iFilialId => $iFilialOrder)
      	{
      	  if(bIsInt($iFilialOrder, 1) and bIsInt($iFilialId, 1) and isset($_POST["city_id_old"][$iFilialId], $_POST["filial_city_name_old"][$iFilialId], $_POST["filial_address_old"][$iFilialId], $_POST["filial_comment_old"][$iFilialId]))
      	  {
            if(get_magic_quotes_gpc())
            {
              $_POST["filial_city_name_old"][$iFilialId] = stripslashes($_POST["filial_city_name_old"][$iFilialId]);
              $_POST["filial_address_old"][$iFilialId] = stripslashes($_POST["filial_address_old"][$iFilialId]);
              $_POST["filial_comment_old"][$iFilialId] = stripslashes($_POST["filial_comment_old"][$iFilialId]);
            }
            $_POST["filial_city_name_old"][$iFilialId] = trim($_POST["filial_city_name_old"][$iFilialId]);
            $_POST["filial_address_old"][$iFilialId] = trim($_POST["filial_address_old"][$iFilialId]);
            $_POST["filial_comment_old"][$iFilialId] = trim($_POST["filial_comment_old"][$iFilialId]);

            $iCityId = "NULL";

            if(bIsInt($_POST["city_id_old"][$iFilialId], 1) and $oDB->bCheckDataByFilters(DB_PREFIX . "cities", array("city_id" => $_POST["city_id_old"][$iFilialId])))
            {
              $iCityId = $_POST["city_id_old"][$iFilialId];
            }

            if($iCityId !== "NULL" or $_POST["filial_city_name_old"][$iFilialId] !== "")
            {
              $sSql = "UPDATE
  " . DB_PREFIX . "filials AS f
SET
  f.city_id = " . $iCityId . ",
  f.filial_city_name = '" . $oDB->escape_string($_POST["filial_city_name_old"][$iFilialId]) . "',
  f.filial_address = '" . $oDB->escape_string($_POST["filial_address_old"][$iFilialId]) . "',
  f.filial_comment = '" . $oDB->escape_string($_POST["filial_comment_old"][$iFilialId]) . "',
  f.filial_order = " . $iFilialOrder . "
WHERE
  f.filial_id = " . $iFilialId . " AND
  f.project_id = " . $iContentId;
              if($oResult = $oDB->query($sSql))
              {
              }
            }
      	  }
      	}
      }

      vTransactionProject($iContentId, $aBackendUserInfo["backend_user_id"]);
    }
  }
  else
  {
  	$aContentData = array();
    $aContentData["project_name"] = htmlspecialchars($_POST["project_name"]);
    $aContentData["project_name_small"] = htmlspecialchars($_POST["project_name_small"]);
    $aContentData["project_name_code"] = htmlspecialchars($_POST["project_name_code"]);
    $aContentData["project_text"] = htmlspecialchars($_POST["project_text"]);
    $aContentData["project_site"] = htmlspecialchars($_POST["project_site"]);
    $aContentData["project_area"] = htmlspecialchars($_POST["project_area"]);
    $aContentData["project_question_01"] = htmlspecialchars($_POST["project_question_01"]);
    $aContentData["project_question_02"] = htmlspecialchars($_POST["project_question_02"]);
    $aContentData["project_question_03"] = $_POST["project_question_03"];
    $aContentData["project_question_04"] = htmlspecialchars($_POST["project_question_04"]);
    $aContentData["project_question_05"] = htmlspecialchars($_POST["project_question_05"]);
    $aContentData["project_question_06"] = htmlspecialchars($_POST["project_question_06"]);
    $aContentData["project_question_07"] = htmlspecialchars($_POST["project_question_07"]);
    $aContentData["project_question_08"] = htmlspecialchars($_POST["project_question_08"]);
    $aContentData["project_question_09"] = htmlspecialchars($_POST["project_question_09"]);
    $aContentData["project_question_10"] = htmlspecialchars($_POST["project_question_10"]);
    $aContentData["project_question_11"] = htmlspecialchars($_POST["project_question_11"]);
    $aContentData["project_question_12"] = $_POST["project_question_12"];
    $aContentData["project_question_13"] = $_POST["project_question_13"];
    $aContentData["project_question_14"] = $_POST["project_question_14"];
    $aContentData["project_question_15"] = $_POST["project_question_15"];
    $aContentData["project_question_16"] = $_POST["project_question_16"];
    $aContentData["project_question_17"] = $_POST["project_question_17"];
    $aContentData["project_question_18"] = htmlspecialchars($_POST["project_question_18"]);
    $aContentData["project_question_19"] = htmlspecialchars($_POST["project_question_19"]);
    $aContentData["project_question_20"] = htmlspecialchars($_POST["project_question_20"]);
    $aContentData["project_question_21"] = htmlspecialchars($_POST["project_question_21"]);
    $aContentData["project_question_22"] = htmlspecialchars($_POST["project_question_22"]);
    $aContentData["project_question_23"] = htmlspecialchars($_POST["project_question_23"]);
    $aContentData["project_question_24"] = htmlspecialchars($_POST["project_question_24"]);
    $aContentData["project_question_25"] = htmlspecialchars($_POST["project_question_25"]);
    $aContentData["project_question_26"] = htmlspecialchars($_POST["project_question_26"]);
    $aContentData["project_question_27"] = htmlspecialchars($_POST["project_question_27"]);
    $aContentData["project_question_28"] = htmlspecialchars($_POST["project_question_28"]);
    $aContentData["project_question_29"] = htmlspecialchars($_POST["project_question_29"]);
    $aContentData["project_question_30"] = htmlspecialchars($_POST["project_question_30"]);
    $aContentData["project_question_31"] = htmlspecialchars($_POST["project_question_31"]);
    $aContentData["project_question_32"] = htmlspecialchars($_POST["project_question_32"]);
    $aContentData["project_question_33"] = htmlspecialchars($_POST["project_question_33"]);
    $aContentData["project_question_34"] = htmlspecialchars($_POST["project_question_34"]);
    $aContentData["project_question_35"] = htmlspecialchars($_POST["project_question_35"]);
    $aContentData["project_question_36"] = htmlspecialchars($_POST["project_question_36"]);
    $aContentData["project_question_37"] = htmlspecialchars($_POST["project_question_37"]);
    $aContentData["project_question_38"] = htmlspecialchars($_POST["project_question_38"]);
    $aContentData["project_question_39"] = htmlspecialchars($_POST["project_question_39"]);
    $aContentData["project_question_40"] = $_POST["project_question_40"];
    $aContentData["project_question_41"] = $_POST["project_question_41"];
    $aContentData["project_question_42"] = $_POST["project_question_42"];
    $aContentData["project_question_43"] = htmlspecialchars($_POST["project_question_43"]);
    $aContentData["project_question_44"] = htmlspecialchars($_POST["project_question_44"]);
    $aContentData["project_question_45"] = htmlspecialchars($_POST["project_question_45"]);
    $aContentData["project_question_46"] = htmlspecialchars($_POST["project_question_46"]);
    $aContentData["project_question_47"] = htmlspecialchars($_POST["project_question_47"]);
    $aContentData["leader_name"] = htmlspecialchars($_POST["leader_name"]);
    $aContentData["project_interview_date"] = htmlspecialchars($_POST["project_interview_date"]);
    $aContentData["project_create_date"] = htmlspecialchars($_POST["project_create_date"]);
    $aContentData["project_start_date"] = htmlspecialchars($_POST["project_start_date"]);
    $aContentData["project_interview_backend_user_id"] = $_POST["project_interview_backend_user_id"];
    $aContentData["project_write_backend_user_id"] = $_POST["project_write_backend_user_id"];
    $aContentData["project_enabled"] = $iProjectEnabled;
    $aContentData["project_done"] = $iProjectDone;
    $aContentData["city_id"] = $_POST["city_id"];
    $aContentData["project_city_name"] = htmlspecialchars($_POST["project_city_name"]);

    $_SESSION["content_data"] = $aContentData;
    $_SESSION["content_data_errors"] = $aContentDataErrors;  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=projects&action_name=view" . $sUrlPostfix);

?>