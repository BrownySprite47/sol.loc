<?php

require_once LIBS_PATH . "DB/cMySQL.php";

class cMyDB
{
  private static $aDBObjects = array();
  private static $aDBConnects = array();

  public static function vSetDBConnect($sDBConnectName, $sDBConnectHost, $sDBConnectUser, $sDBConnectPassword)
  {

  public static function oGetDB($sDBConnectName)
  {
    if(!isset(self::$aDBObjects[$sDBConnectName]))
    {
      self::$aDBObjects[$sDBConnectName]->query("SET NAMES utf8");
      self::$aDBObjects[$sDBConnectName]->query("USE " . DB_NAME);

    return self::$aDBObjects[$sDBConnectName];
}
?>