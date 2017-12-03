<?php

if(isset($_GET["content_id"]) and bIsInt($_GET["content_id"], 1))
{
  $oDB = cMyDB::oGetDB("db");

  $sSql = "DELETE
  ov
FROM
  " . DB_PREFIX . "option_values AS ov
  INNER JOIN " . DB_PREFIX . "options AS o ON ov.option_id = o.option_id
  LEFT JOIN " . DB_PREFIX . "contents_option_values AS cov ON
    ov.option_value_id = cov.option_value_id AND
    o.option_multi_enabled = 1
  LEFT JOIN " . DB_PREFIX . "leaders AS l ON
    ov.option_value_id IN (l.leader_interview_type, l.leader_question_08, l.leader_question_09) AND
    o.option_multi_enabled = 0
  LEFT JOIN " . DB_PREFIX . "projects AS p ON
    ov.option_value_id IN (p.project_question_12, p.project_question_13, p.project_question_14, p.project_question_15, p.project_question_16, p.project_question_17, p.project_question_40, p.project_question_41, p.project_question_42) AND
    o.option_multi_enabled = 0
WHERE
  ov.option_value_id = " . $_GET["content_id"] . " AND
  l.leader_id IS NULL AND
  p.project_id IS NULL AND
  cov.option_value_id IS NULL";
  if($oResult = $oDB->query($sSql))
  {
  }
}

header("Location: " . PROJECT_BACKEND_URL . "index.php?module_name=option_values&action_name=list");
?>