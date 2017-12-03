<?php

class cConstants
{
  private static $aConstants = null;

  public static function sGetConstant($sConstantInternalName)
  {
    if(is_null(self::$aConstants))
    {
      $oDB = cMyDB::oGetDB("db");

      $sSql = "SELECT
  c.constant_internal_name,
  c.constant_value
FROM
  " . DB_PREFIX . "constants AS c
ORDER BY
  c.constant_internal_name";
      if($oResult = $oDB->query($sSql))
      {
        if($oResult->num_rows > 0)
        {
          self::$aConstants = array();

          while($aRow = $oResult->fetch_array())
          {
            self::$aConstants[$aRow["constant_internal_name"]] = $aRow["constant_value"];
          }
        }

        $oResult->close();
      }
    }

    $sConstantValue = "";

    if(isset(self::$aConstants[$sConstantInternalName]))
    {
      $sConstantValue = self::$aConstants[$sConstantInternalName];
    }

    return $sConstantValue;
  }
}
?>