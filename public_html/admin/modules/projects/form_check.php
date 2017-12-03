<?php

$bResult = false;
$aContentDataErrors = array();

if(isset($_POST["project_name_code"], $_POST["project_name"], $_POST["project_interview_date"], $_POST["project_start_date"], $_POST["project_create_date"], $_POST["project_question_34"], $_POST["project_question_35"], $_POST["project_question_36"], $_POST["project_question_37"], $_POST["project_question_38"], $_POST["project_question_39"]))
{
  if(get_magic_quotes_gpc())
  {
    $_POST["project_name_code"] = stripslashes($_POST["project_name_code"]);
    $_POST["project_name"] = stripslashes($_POST["project_name"]);
    $_POST["project_interview_date"] = stripslashes($_POST["project_interview_date"]);
    $_POST["project_start_date"] = stripslashes($_POST["project_start_date"]);
    $_POST["project_create_date"] = stripslashes($_POST["project_create_date"]);
    $_POST["project_question_34"] = stripslashes($_POST["project_question_34"]);
    $_POST["project_question_35"] = stripslashes($_POST["project_question_35"]);
    $_POST["project_question_36"] = stripslashes($_POST["project_question_36"]);
    $_POST["project_question_37"] = stripslashes($_POST["project_question_37"]);
    $_POST["project_question_38"] = stripslashes($_POST["project_question_38"]);
    $_POST["project_question_39"] = stripslashes($_POST["project_question_39"]);
  }
  $_POST["project_name_code"] = trim($_POST["project_name_code"]);
  $_POST["project_name"] = trim($_POST["project_name"]);
  $_POST["project_interview_date"] = trim($_POST["project_interview_date"]);
  $_POST["project_start_date"] = trim($_POST["project_start_date"]);
  $_POST["project_create_date"] = trim($_POST["project_create_date"]);
  $_POST["project_question_34"] = trim($_POST["project_question_34"]);
  $_POST["project_question_35"] = trim($_POST["project_question_35"]);
  $_POST["project_question_36"] = trim($_POST["project_question_36"]);
  $_POST["project_question_37"] = trim($_POST["project_question_37"]);
  $_POST["project_question_38"] = trim($_POST["project_question_38"]);
  $_POST["project_question_39"] = trim($_POST["project_question_39"]);

  if($_POST["project_name_code"] !== "" and mb_strlen($_POST["project_name_code"], "utf-8") > 12)
  {
  	$aContentDataErrors[] = "project_name_code";
  }

  if($_POST["project_name"] === "")
  {
  	$aContentDataErrors[] = "project_name";
  }

  if($_POST["project_interview_date"] !== "" and !bIsDate($_POST["project_interview_date"]))
  {
  	$aContentDataErrors[] = "project_interview_date";
  }

  if($_POST["project_start_date"] !== "" and !bIsDate($_POST["project_start_date"]) and !bIsDate($_POST["project_start_date"] . "-01") and !bIsDate($_POST["project_start_date"] . "-07-01"))
  {
  	$aContentDataErrors[] = "project_start_date";
  }

  if($_POST["project_create_date"] !== "" and !bIsDate($_POST["project_create_date"]))
  {
  	$aContentDataErrors[] = "project_create_date";
  }

  if($_POST["project_question_34"] !== "" and !bIsInt($_POST["project_question_34"], 0))
  {
  	$aContentDataErrors[] = "project_question_34";
  }

  if($_POST["project_question_35"] !== "" and !bIsInt($_POST["project_question_35"], 0))
  {
  	$aContentDataErrors[] = "project_question_35";
  }

  if($_POST["project_question_36"] !== "" and !bIsInt($_POST["project_question_36"], 0))
  {
  	$aContentDataErrors[] = "project_question_36";
  }

  if($_POST["project_question_37"] !== "" and !bIsInt($_POST["project_question_37"], 0))
  {
  	$aContentDataErrors[] = "project_question_37";
  }

  if($_POST["project_question_38"] !== "" and !bIsInt($_POST["project_question_38"], 0))
  {
  	$aContentDataErrors[] = "project_question_38";
  }

  if($_POST["project_question_39"] !== "" and !bIsInt($_POST["project_question_39"], 0))
  {
  	$aContentDataErrors[] = "project_question_39";
  }

  if(empty($aContentDataErrors))
  {  	$bResult = true;  }
  else
  {  	$aContentDataErrors = array_unique($aContentDataErrors);  }
}

$aData = array("result" => (int) $bResult, "data" => $aContentDataErrors);
echo json_encode($aData);

?>