<?php

class cMySQL extends mysqli
{
  {
  	$this->close();
  }

  public function bCheckDataBySql($sSql)
  {

  	if($oResult = $this->query($sSql))
  	{
  	  {

  	  $oResult->free();

  	return $iCnt > 0;

  public function bCheckDataByFilters($sTableName, $aFilters)
  {
    $aWhere = array();

  	foreach($aFilters as $sFieldName => $sFieldValue)
    {
      $aWhere[] = "t.`" . $sFieldName . "` = '" . $this->escape_string($sFieldValue) . "'";
    }

    $sSql = "SELECT
  COUNT(*) AS cnt
FROM
  " . $sTableName . " AS t
WHERE
  " . implode($aWhere, " AND
  ");

    return $this->bCheckDataBySql($sSql);
  }

  public function aGetDataByFilters($sTableName, $aFields, $aFilters)
  {
    $aResult = null;

    $aWhere = array();

  	foreach($aFilters as $sFieldName => $sFieldValue)
    {
      $aWhere[] = "t.`" . $sFieldName . "` = '" . $this->escape_string($sFieldValue) . "'";
    }

    $sSql = "SELECT
  ";

    if(is_null($aFields))
    {
    else
    {
      {
  ", $aFields);
      else
      {

    $sSql .= "
FROM
  " . $sTableName . " AS t
WHERE
  " . implode($aWhere, " AND
  ") . "
LIMIT
  1";
    if($oResult = $this->query($sSql))
  	{
  	  if($aRow = $oResult->fetch_array())
  	  {
  	  	if(is_array($aFields) or is_null($aFields))
  	  	{
  	  	else
  	  	{
  	  }

  	  $oResult->free();
  	}

  	return $aResult;
  }
}
?>