<?php

require_once LIBS_PATH . "DB/cMySQL.php";

class cMyDB
{
  private static $aDBObjects = array();
  private static $aDBConnects = array();

  public static function vSetDBConnect($sDBConnectName, $sDBConnectHost, $sDBConnectUser, $sDBConnectPassword)
  {  	self::$aDBConnects[$sDBConnectName] = array("db_host" => $sDBConnectHost, "db_user" => $sDBConnectUser, "db_password" => $sDBConnectPassword);  }

  public static function oGetDB($sDBConnectName)
  {
    if(!isset(self::$aDBObjects[$sDBConnectName]))
    {      self::$aDBObjects[$sDBConnectName] = new cMySQL(self::$aDBConnects[$sDBConnectName]["db_host"], self::$aDBConnects[$sDBConnectName]["db_user"], self::$aDBConnects[$sDBConnectName]["db_password"]);
      self::$aDBObjects[$sDBConnectName]->query("SET NAMES utf8");
      self::$aDBObjects[$sDBConnectName]->query("USE " . DB_NAME);    }

    return self::$aDBObjects[$sDBConnectName];  }
}
?>