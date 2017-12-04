<?php

error_reporting(E_ALL);
ini_set("display_errors", "1");
mb_internal_encoding("utf-8");

//paths

// define("PROJECT_BACKEND_PATH", "/home/virtwww/w_soldb_33c91896/http/");
define("PROJECT_BACKEND_PATH", "C:/OSPanel/domains/localhost/sol.loc/public_html/admin/");
define("CONFIGS_PATH", PROJECT_BACKEND_PATH . "libs/configs/");
define("LIBS_PATH", PROJECT_BACKEND_PATH . "libs/");

//URLs

// define("PROJECT_BACKEND_URL", "https://www.soldb.ru/");
define("PROJECT_BACKEND_URL", "http://sol.loc/admin/");

//DB
define("DB_HOST", "localhost");
define("DB_USER", "suppor1k_vtemp");
define("DB_PASSWORD", "G3xx*yWq");
define("DB_NAME", "gb_db_leaders");
define("DB_TABLE_PREFIX", "leaders_");
define("DB_PREFIX", DB_NAME . "." . DB_TABLE_PREFIX);

//constants

define("LEADER_CONTENT_TYPE_ID", 1);
define("PROJECT_CONTENT_TYPE_ID", 2);

define("LEADER_DOCX_TEMPLATE_FILE", PROJECT_BACKEND_PATH . "files/leader_template.docx");

?>