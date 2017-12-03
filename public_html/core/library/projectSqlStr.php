<?php

((isset($_POST['method']) && $_POST['method'] == 'general_online')  ?  $general_online = 1  : $general_online = '');
((isset($_POST['method']) && $_POST['method'] == 'only_online')     ?  $only_online = 1     : $only_online = '');
((isset($_POST['method']) && $_POST['method'] == 'general_offline') ?  $general_offline = 1 : $general_offline = '');
((isset($_POST['method']) && $_POST['method'] == 'totally_offline') ?  $totally_offline = 1 : $totally_offline = '');

((isset($_POST['level']) && $_POST['level'] == 'first_level')   ?  $first_level = 1  : $first_level = '');
((isset($_POST['level']) && $_POST['level'] == 'second_level')  ?  $second_level = 1 : $second_level = '');
((isset($_POST['level']) && $_POST['level'] == 'third_level')   ?  $third_level = 1  : $third_level = '');

(isset($_POST['offline_geography']) ? $offline_geography = checkChars($_POST['offline_geography']) : $offline_geography = '');

$business = checkChars($_POST['metapredmets']['business']);
$engineer = checkChars($_POST['metapredmets']['engineer']);
$eq = checkChars($_POST['metapredmets']['eq']);
$it_prof = checkChars($_POST['metapredmets']['it_prof']);
$personal = checkChars($_POST['metapredmets']['personal']);
$proforient = checkChars($_POST['metapredmets']['proforient']);

$arts = checkChars($_POST['predmets']['arts']);
$lingvistic = checkChars($_POST['predmets']['lingvistic']);
$pedagogy = checkChars($_POST['predmets']['pedagogy']);
$sport = checkChars($_POST['predmets']['sport']);
$social = checkChars($_POST['predmets']['social']);
$techno = checkChars($_POST['predmets']['techno']);
$naturall = checkChars($_POST['predmets']['naturall']);

$r_00_07 = checkChars($_POST['ages']['r_00_07']);
$r_12_15 = checkChars($_POST['ages']['r_12_15']);
$r_16_18 = checkChars($_POST['ages']['r_16_18']);
$r_19_25 = checkChars($_POST['ages']['r_19_25']);
$r_08_11 = checkChars($_POST['ages']['r_08_11']);
$r_all_life = checkChars($_POST['ages']['r_all_life']);
$r_others = checkChars($_POST['ages']['r_others']);
$r_parents = checkChars($_POST['ages']['r_parents']);
$r_teachers = checkChars($_POST['ages']['r_teachers']);

$project_title = checkChars($_POST['project_title']);
$short_title = checkChars($_POST['short_title']);
$project_description = checkChars($_POST['project_description']);
$site = checkChars($_POST['site']);
$author = checkChars($_POST['author']);
$stage_of_project = checkChars($_POST['stage_of_project']);
$author_location = checkChars($_POST['author_location']);
$start_year = checkChars($_POST['start_year']);

$lider0 = checkChars($_POST['lider0']);
$lider1 = checkChars($_POST['lider1']);
$lider2 = checkChars($_POST['lider2']);
$lider3 = checkChars($_POST['lider3']);
$lider4 = checkChars($_POST['lider4']);


$filename0 = checkChars($_POST['file0']['name']);
$filename1 = checkChars($_POST['file1']['name']);
$filename2 = checkChars($_POST['file2']['name']);
$filename3 = checkChars($_POST['file3']['name']);
$filename4 = checkChars($_POST['file4']['name']);

$description0 = checkChars($_POST['file0']['description']);
$description1 = checkChars($_POST['file1']['description']);
$description2 = checkChars($_POST['file2']['description']);
$description3 = checkChars($_POST['file3']['description']);
$description4 = checkChars($_POST['file4']['description']);









