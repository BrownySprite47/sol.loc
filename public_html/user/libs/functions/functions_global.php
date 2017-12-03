<?php

function bIsInt($sNumber, $iNumberFrom = -2147483648, $iNumberTo = 2147483647)
{
  $sNumber = (string) $sNumber;

  return (string) intval($sNumber) === $sNumber and $sNumber >= $iNumberFrom and $sNumber <= $iNumberTo;
}

function sGetHash($iCharsCount = 64)
{
  $sHash = "";

  $iCycleCount = ceil($iCharsCount / 32);

  for($iTemp = 1; $iTemp <= $iCycleCount; $iTemp++)
  {
  	$sHash .= md5(rand() . "_" . md5(rand() . "_" . time() . "_" . rand()) . "_" . rand());
  }

  $sHash = substr($sHash, 0, $iCharsCount);

  return $sHash;
}

function bIsDate($sDate)
{
  $bCorrectDate = false;

  if(preg_match("/^([1-2][0-9]{3})-([0-1][0-9])-([0-3][0-9])$/", $sDate, $matches))
  {
    $bCorrectDate = checkdate($matches[2], $matches[3], $matches[1]);
  }

  return $bCorrectDate;
}

function bIsEmail($sEmail)
{
  return preg_match('/^([a-zA-Z0-9_-]+\.)*[\+a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,9}$/', $sEmail);
}

function sGetNameByCount($iCount, $aNames = array("день", "дня", "дней"))
{
  // $aNames[0] - 1, 101, 201 ...
  // $aNames[1] = 2, 3, 4, 22, 23, 24, 32 ...
  // $aNames[2] = 5, 6, 7 ... 20, 30, 40, ... 100, 105, 106 ...

  if(bIsInt(fmod($iCount, 100), 5, 20))
  {
    $sStr = $aNames[2];
  }
  else
  {
    $iMod = fmod($iCount, 10);
    if($iMod == 1)
    {
      $sStr = $aNames[0];
    }
    else
    {
      if(($iMod > 1) and ($iMod < 5))
      {
        $sStr = $aNames[1];
      }
      else
      {
        $sStr = $aNames[2];
      }
    }
  }

  return $sStr;
}

function sGetStringByNumber($iNumber, $iType = 0)
{  //$iType - род; 0 - мужской род, 1 - женский род, 2 - средний род

  $sNumber = "";

  $iNumber3Count = ceil(strlen($iNumber) / 3);
  $iNumberCount = strlen($iNumber);

  $aNumbers = array();

  for($iTemp = 1; $iTemp <= $iNumber3Count; $iTemp++)
  {  	$iTempPosition = $iNumberCount - 3 * $iTemp;
  	$iTempCount = 3;

  	if($iTempPosition < 0)
  	{
  	  $iTempCount = $iTempCount + $iTempPosition;
  	  $iTempPosition = 0;  	}

  	$aNumbers[] = ltrim(substr($iNumber, $iTempPosition, $iTempCount), "0");  }

  $aNumbers = array_reverse($aNumbers);

  //0 - мужской род, 1 - женский род, 2 - средний род

  $aNumberNames = array();
  $aNumberNames[0] = array("ноль");
  $aNumberNames[1] = array("один", "одна", "одно");
  $aNumberNames[2] = array("два", "две", "два");
  $aNumberNames[3] = array("три");
  $aNumberNames[4] = array("четыре");
  $aNumberNames[5] = array("пять");
  $aNumberNames[6] = array("шесть");
  $aNumberNames[7] = array("семь");
  $aNumberNames[8] = array("восемь");
  $aNumberNames[9] = array("девять");
  $aNumberNames[10] = array("десять");
  $aNumberNames[11] = array("одинадцать");
  $aNumberNames[12] = array("двенадцать");
  $aNumberNames[13] = array("тринадцать");
  $aNumberNames[14] = array("четырнадцать");
  $aNumberNames[15] = array("пятнадцать");
  $aNumberNames[16] = array("шестнадцать");
  $aNumberNames[17] = array("семнадцать");
  $aNumberNames[18] = array("восемнадцать");
  $aNumberNames[19] = array("девятнадцать");
  $aNumberNames[20] = array("двадцать");
  $aNumberNames[30] = array("тридцать");
  $aNumberNames[40] = array("сорок");
  $aNumberNames[50] = array("пятьдесят");
  $aNumberNames[60] = array("шестьдесят");
  $aNumberNames[70] = array("семьдесят");
  $aNumberNames[80] = array("восемьдесят");
  $aNumberNames[90] = array("девяносто");
  $aNumberNames[100] = array("сто");
  $aNumberNames[200] = array("двести");
  $aNumberNames[300] = array("триста");
  $aNumberNames[400] = array("четыреста");
  $aNumberNames[500] = array("пятьсот");
  $aNumberNames[600] = array("шестьсот");
  $aNumberNames[700] = array("семьсот");
  $aNumberNames[800] = array("восемьсот");
  $aNumberNames[900] = array("девятьсот");

  $aNumberPositionNames = array();
  $aNumberPositionNames[1] = array("", "", "", $iType);
  $aNumberPositionNames[2] = array("тысяча", "тысячи", "тысяч", 1);
  $aNumberPositionNames[3] = array("миллион", "миллиона", "миллионов", 0);
  $aNumberPositionNames[4] = array("миллиард", "миллиарда", "миллиардов", 0);
  $aNumberPositionNames[5] = array("триллион", "триллиона", "триллионов", 0);

  if($iNumber == 0)
  {  	$sNumber = "ноль";  }
  else
  {
  	foreach($aNumbers as $iKeyTemp =>$sTempNumber)
  	{
      if(!empty($sTempNumber))
      {      	//род и порядок
        $iNumberPosition = $iNumber3Count - $iKeyTemp;
        $iNumberType = $aNumberPositionNames[$iNumberPosition][3];

        $aNumbersTemp = array();

        if($sTempNumber > 20 and !isset($aNumberNames[$sTempNumber]))
        {
      	  if(strlen($sTempNumber) === 3)
      	  {
      	    $aNumbersTemp[] = $sTempNumber[0] . "00";

            $iNumberTempXX = substr($sTempNumber, 1, 2);

            if($iNumberTempXX > 20 and !isset($aNumberNames[$iNumberTempXX]))
            {
          	  $aNumbersTemp[] = $iNumberTempXX[0] . "0";
              $aNumbersTemp[] = $iNumberTempXX[1];
            }
            else
            {
          	  $aNumbersTemp[] = $iNumberTempXX;
            }
      	  }
      	  else
      	  {
      	    $aNumbersTemp[] = $sTempNumber[0] . "0";
            $aNumbersTemp[] = $sTempNumber[1];
      	  }
        }
        else
        {
          $aNumbersTemp[] = $sTempNumber;
        }

        foreach($aNumbersTemp as $iTemp)
        {
      	  if(isset($aNumberNames[$iTemp][$iNumberType]))
      	  {
      	    $sNumber .= $aNumberNames[$iTemp][$iNumberType] . " ";
      	  }
      	  else
      	  {
      	    $sNumber .= $aNumberNames[$iTemp][0] . " ";
      	  }
        }

        $sNumber .= sGetNameByCount($sTempNumber, $aNumberPositionNames[$iNumberPosition]) . " ";      }  	}  }

  return trim($sNumber);}

function bMailSend(&$oSmarty, $sMailInternalName, $sUserEmail, $sFilePath = "", $sFileName = "")
{
  $bResult = false;

  $oDB = cMyDB::oGetDB("db");

  $sSql = "SELECT
  m.mail_id,
  m.mail_mail_from_name,
  m.mail_mail_text,
  m.mail_mail_from_email,
  m.mail_mail_subject
FROM
  " . DB_PREFIX . "mails AS m
WHERE";

  if(bIsInt($sMailInternalName, 1))
  {
  	$sSql .= "
  m.mail_id = " . $sMailInternalName;
  }
  else
  {
  	$sSql .= "
   m.mail_internal_name = '" . $oDB->escape_string($sMailInternalName) . "'";
  }

  $sSql .= " AND
  m.mail_enabled = 1
LIMIT
  1";

  if($oResult = $oDB->query($sSql))
  {
    if($aRow = $oResult->fetch_assoc())
    {

      $aRow["mail_mail_subject"] = $oSmarty->fetch('string: {config_load file="config.conf"}' . $aRow["mail_mail_subject"]);
      $aRow["mail_mail_text"] = $oSmarty->fetch('string: {config_load file="config.conf"}' . $aRow["mail_mail_text"]);

      $aFiles = array();

      if(!empty($sFilePath) and !empty($sFileName))
      {
        $aFiles = array();

        if(is_array($sFilePath) and is_array($sFileName) and count($sFilePath) === count($sFileName))
        {
          foreach($sFilePath as $iTemp => $sTemp)
          {
          	if(is_file($sTemp) and isset($sFileName[$iTemp]) and !empty($sFileName[$iTemp]))
          	{
          	  $aFiles[] = array("file_path" => $sTemp, "file_name" => $sFileName[$iTemp]);
          	}
          }
        }
        else
        {
          if(is_file($sFilePath) and !is_array($sFileName))
          {
          	$aFiles[] = array("file_path" => $sFilePath, "file_name" => $sFileName);
          }
        }
      }

      if(empty($aFiles))
      {
        $sHeaders = "MIME-Version: 1.0\r\n";
        $sHeaders .= "Content-type: text/html; charset=utf-8\r\n";
        $sHeaders .= "From: " . mb_encode_mimeheader($aRow["mail_mail_from_name"], "UTF-8", "B") . " <" . $aRow["mail_mail_from_email"] . ">\r\n";

        $sText = $aRow["mail_mail_text"];
      }
      else
      {
        $sStrTemp = "--" . md5(uniqid(time()));

        $sHeaders = "MIME-Version: 1.0\r\n";
        $sHeaders .= "Content-type: multipart/mixed; boundary=\"" . $sStrTemp . "\"\r\n";
        $sHeaders .= "From: " . mb_encode_mimeheader($aRow["mail_mail_from_name"], "UTF-8", "B") . " <" . $aRow["mail_mail_from_email"] . ">\r\n";

        $sText = "--" . $sStrTemp . "\r\n";
        $sText .= "Content-Type: text/html; charset=utf-8\r\n";
        $sText .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $sText .= chunk_split(base64_encode($aRow["mail_mail_text"]));

        foreach($aFiles as $aFile)
        {
          $sText .= "\r\n--" . $sStrTemp . "\r\n";
          $sText .= "Content-Type: application/octet-stream; name=\"" . mb_encode_mimeheader($aFile["file_name"], "UTF-8", "B") . "\"\r\n";
          $sText .= "Content-Transfer-Encoding: base64\r\n";
          $sText .= "Content-Disposition: attachment; filename=\"" . mb_encode_mimeheader($aFile["file_name"], "UTF-8", "B") . "\"\r\n\r\n";
          $sText .= chunk_split(base64_encode(file_get_contents($aFile["file_path"])));
        }

        $sText .= "\r\n--" . $sStrTemp . "--\r\n";
      }

      if(bIsEmail($sUserEmail) and mail($sUserEmail, mb_encode_mimeheader($aRow["mail_mail_subject"], "UTF-8", "B"), $sText, $sHeaders))
      {
      	$sSql = "UPDATE
  " . DB_PREFIX . "mails AS m
SET
  m.mail_send_count = m.mail_send_count + 1,
  m.mail_send_datetime = NOW()
WHERE
  m.mail_id = " . $aRow["mail_id"];
        if($oUpdateResult = $oDB->query($sSql))
        {
          $bResult = true;
        }
      }
    }

    $oResult->close();
  }

  return $bResult;
}

function vSetFormErrors(&$oSmarty)
{
  if(isset($_SESSION["content_data"]))
  {
    $aContentData = $oSmarty->getTemplateVars("aContentData");

    if(isset($aContentData) and is_array($aContentData) and !empty($aContentData))
    {
      $oSmarty->assign("aContentData", array_merge($aContentData, $_SESSION["content_data"]));
    }
    else
    {
      $oSmarty->assign("aContentData", $_SESSION["content_data"]);
    }

    unset($_SESSION["content_data"]);
  }

  if(isset($_SESSION["content_data_errors"]))
  {
    $oSmarty->assign("aContentDataErrors", $_SESSION["content_data_errors"]);
    unset($_SESSION["content_data_errors"]);
  }
}

?>