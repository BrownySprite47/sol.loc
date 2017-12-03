<?php

$bResult = false;
$aContentDataErrors = array();

if(isset($_POST["leader_surname"], $_POST["leader_email"], $_POST["leader_phone"], $_POST["leader_question_02"], $_POST["leader_create_date"], $_POST["leader_interview_date"], $_POST["leader_birth_date"]))
{
  if(get_magic_quotes_gpc())
  {
    $_POST["leader_surname"] = stripslashes($_POST["leader_surname"]);
    $_POST["leader_email"] = stripslashes($_POST["leader_email"]);
    $_POST["leader_phone"] = stripslashes($_POST["leader_phone"]);
    $_POST["leader_question_02"] = stripslashes($_POST["leader_question_02"]);
    $_POST["leader_create_date"] = stripslashes($_POST["leader_create_date"]);
    $_POST["leader_interview_date"] = stripslashes($_POST["leader_interview_date"]);
    $_POST["leader_birth_date"] = stripslashes($_POST["leader_birth_date"]);
  }
  $_POST["leader_surname"] = trim($_POST["leader_surname"]);
  $_POST["leader_email"] = trim($_POST["leader_email"]);
  $_POST["leader_phone"] = trim($_POST["leader_phone"]);
  $_POST["leader_question_02"] = trim($_POST["leader_question_02"]);
  $_POST["leader_create_date"] = trim($_POST["leader_create_date"]);
  $_POST["leader_interview_date"] = trim($_POST["leader_interview_date"]);
  $_POST["leader_birth_date"] = trim($_POST["leader_birth_date"]);

  $_POST["leader_email"] = mb_strtolower($_POST["leader_email"], "utf-8");
  $_POST["leader_phone"] = preg_replace("/[^0-9]+/", "", $_POST["leader_phone"]);

  if(strlen($_POST["leader_phone"]) === 11 and ($_POST["leader_phone"][0] === "7" or $_POST["leader_phone"][0] === "8"))
  {
    $_POST["leader_phone"] = substr($_POST["leader_phone"], 1);
  }

  if($_POST["leader_phone"] !== "" and strlen($_POST["leader_phone"]) !== 10)
  {  	$aContentDataErrors[] = "leader_phone";  }

  if($_POST["leader_question_02"] !== "" and !bIsInt($_POST["leader_question_02"], 0))
  {
  	$aContentDataErrors[] = "leader_question_02";
  }

  if($_POST["leader_surname"] === "")
  {  	$aContentDataErrors[] = "leader_surname";  }

  if($_POST["leader_interview_date"] !== "" and !bIsDate($_POST["leader_interview_date"]))
  {
  	$aContentDataErrors[] = "leader_interview_date";
  }

  if($_POST["leader_birth_date"] !== "" and !bIsDate($_POST["leader_birth_date"]) and !bIsDate($_POST["leader_birth_date"] . "-01") and !bIsDate($_POST["leader_birth_date"] . "-07-01"))
  {
  	$aContentDataErrors[] = "leader_birth_date";
  }

  if($_POST["leader_create_date"] !== "" and !bIsDate($_POST["leader_create_date"]))
  {
  	$aContentDataErrors[] = "leader_create_date";
  }

  if($_POST["leader_email"] !== "" and !bIsEmail($_POST["leader_email"]))
  {
  	$aContentDataErrors[] = "leader_email";
  }

  if(empty($aContentDataErrors))
  {  	$bResult = true;  }
  else
  {  	$aContentDataErrors = array_unique($aContentDataErrors);  }
}

$aData = array("result" => (int) $bResult, "data" => $aContentDataErrors);
echo json_encode($aData);

?>