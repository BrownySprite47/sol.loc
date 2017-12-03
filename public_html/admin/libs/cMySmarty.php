<?php

define("SMARTY_DIR", LIBS_PATH . "Smarty/");

require_once SMARTY_DIR . "Smarty.class.php";

class cMySmarty extends Smarty
{
  public function __construct()
  {
    parent::__construct();

    $this->debugging = false;
    $this->caching = false;

    $this->template_dir = SMARTY_TEMPLATES_PATH;
    $this->compile_dir = SMARTY_TEMPLATES_C_PATH;
    $this->config_dir = SMARTY_CONFIGS_PATH;
    $this->cache_dir = SMARTY_CACHE_PATH;
  }
}
?>