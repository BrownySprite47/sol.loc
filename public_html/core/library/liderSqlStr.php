<?php
(isset($_POST['id_lid'])       ? $id_lid = checkChars($_POST['id_lid'])             : $id_lid = '');
(isset($_POST['familya'])      ? $familya = checkChars($_POST['familya'])           : $familya = '');
(isset($_POST['name'])         ? $name = checkChars($_POST['name'])                 : $name = '');
(isset($_POST['otchestvo'])    ? $otchestvo = checkChars($_POST['otchestvo'])       : $otchestvo = '');
(isset($_POST['city'])         ? $city = checkChars($_POST['city'])                 : $city = '');
(isset($_POST['region'])       ? $region = checkChars($_POST['region'])             : $region = '');
(isset($_POST['birthday'])     ? $birthday = checkChars($_POST['birthday'])         : $birthday = '');
(isset($_POST['social'])       ? $social = checkChars($_POST['social'])             : $social = '');
(isset($_POST['contact_info']) ? $contact_info = checkChars($_POST['contact_info']) : $contact_info = '');
(isset($_POST['telephone'])    ? $telephone = checkChars($_POST['telephone'])       : $telephone = '');
(isset($_POST['email'])        ? $email = checkChars($_POST['email'])               : $email = '');
(isset($_POST['reason'])       ? $reason = checkChars($_POST['reason'])             : $reason = '');
(isset($_POST['i_can'])        ? $i_can = checkChars($_POST['i_can'])               : $i_can = '');
(isset($_POST['i_need'])       ? $i_need = checkChars($_POST['i_need'])             : $i_need = '');
(isset($_POST['male_female'])  ? $male_female = checkChars($_POST['male_female'])   : $male_female = '');

$fio = $familya." ".$name." ".$otchestvo;


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









