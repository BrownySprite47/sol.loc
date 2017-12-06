<?php
//echo "gxgxgd";
$db = [
	'host' => 'localhost',
    'user' => 'suppor1k_vtemp',
    'pass' => 'G3xx*yWq',
    'name' => 'suppor1k_vtemp',
];
    



function dbConnect() {
    $link = @mysqli_connect('localhost', 'suppor1k_vtemp', 'G3xx*yWq', 'gb_db_leaders');

    if (!$link) {
        if (DEBUG) {
            die(mysqli_error($link));
        } else {
            die(renderView('error'));
        }
    }

    return $link;
}

function dbQuery($sql) {
    $link = dbConnect();
    $result = mysqli_query($link, $sql);

    if (!$result){
        if (DEBUG) {
            die(mysqli_error($link));
        } else {
            die(renderView('error'));
        }
    }
   return $result;
}

function getData($data){
    while($result[] = mysqli_fetch_assoc($data));

    return $result;
}

// $liders = getData(dbQuery("SELECT leader_id, leader_question_10, leader_question_11, leader_question_12, leader_question_13, leader_question_14, leader_question_15, leader_question_16, leader_question_17, leader_question_18, leader_question_19, leader_question_20 FROM leaders_leaders"));

$liders = getData(dbQuery("SELECT leader_id, leader_done FROM leaders_leaders"));





foreach ($liders as $key => $value) {
    if ($value['leader_done'] == '1') {
        $sql = "UPDATE leaders_leaders SET leader_done_1 ='1' WHERE leader_id = '{$value['leader_id']}'";
          echo $sql;
          $result = dbQuery($sql);
    }
}




// foreach ($liders as $key => $value) {
//     $i = 0;
//     if ($value['leader_question_10'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_11'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_12'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_13'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_14'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_15'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_16'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_17'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_18'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_19'] == '') {
//         $i++;
//     }
//     if ($value['leader_question_20'] == '') {
//         $i++;
//     }
//     $liders[$key]['количество'] = $i;

//     if ($i < 6) {
//         $sql = "UPDATE leaders_leaders SET leader_done_1 ='1', leader_done_2 ='1', leader_done_3 ='1', leader_done_4 ='1' WHERE leader_id = '{$value['leader_id']}'";
//           echo $sql;
//           $result = dbQuery($sql);
//     }
// }

// $sql = "UPDATE leaders_leaders SET fio='{$value2['fio']}', familya='{$value2['familya']}', name='{$value2['name']}', otchestvo='{$value2['otchestvo']}', city='{$value2['city']}', region='{$value2['region']}', social='{$value2['social']}', contact_info='{$value2['contact_info']}', birthday='{$value2['birthday']}' WHERE id_lider='{$value2['id_lider']}'";
//          echo $sql;
//          $result = dbQuery($sql);

// $liders = getData(dbQuery("SELECT id_lider FROM liders"));

// $liders2 = getData(dbQuery("SELECT * FROM liders_tmp"));


// foreach ($liders as $key => $value) {
// 	foreach ($liders2 as $key2 => $value2) {
// 	    if ($value['id_lider'] == $value2['id_lider']) {
// 	    	$sql = "UPDATE liders SET fio='{$value2['fio']}', familya='{$value2['familya']}', name='{$value2['name']}', otchestvo='{$value2['otchestvo']}', city='{$value2['city']}', region='{$value2['region']}', social='{$value2['social']}', contact_info='{$value2['contact_info']}', birthday='{$value2['birthday']}' WHERE id_lider='{$value2['id_lider']}'";
// 	    	echo $sql;
// 	    	$result = dbQuery($sql);
// 	    }
// 	}
// }

// $projects = getData(dbQuery("SELECT id_project FROM projects"));

// $projects2 = getData(dbQuery("SELECT * FROM projects_tmp"));


// foreach ($projects as $key => $value) {
// 	foreach ($projects2 as $key2 => $value2) {
// 	    if ($value['id_project'] == $value2['id_project']) {
// 	    	$queryProj = "UPDATE projects SET
//                 project_title = '".$value2['project_title']."',
//                 short_title = '".$value2['short_title']."',
//                 project_description = '".$value2['project_description']."',
//                 site = '".$value2['site']."',
//                 business = '".$value2['business']."',
//                 engineer = '".$value2['engineer']."',
//                 eq = '".$value2['eq']."',
//                 it_prof = '".$value2['it_prof']."',
//                 personal = '".$value2['personal']."',
//                 proforient = '".$value2['proforient']."',
//                 arts = '".$value2['arts']."',
//                 lingvistic = '".$value2['lingvistic']."',
//                 pedagogy = '".$value2['pedagogy']."',
//                 sport = '".$value2['sport']."',
//                 social = '".$value2['social']."',
//                 techno = '".$value2['techno']."',
//                 naturall = '".$value2['naturall']."',
//                 r_00_07 = '".$value2['r_00_07']."',
//                 R_12_15 = '".$value2['R_12_15']."',
//                 r_16_18 = '".$value2['r_16_18']."',
//                 r_19_25 = '".$value2['r_19_25']."',
//                 r_08_11 = '".$value2['r_08_11']."',
//                 r_all_life = '".$value2['r_all_life']."',
//                 r_others = '".$value2['r_others']."',
//                 r_parents = '".$value2['r_parents']."',
//                 r_teachers = '".$value2['r_teachers']."',
//                 general_online = '".$value2['general_online']."',
//                 only_online = '".$value2['only_online']."',
//                 general_offline = '".$value2['general_offline']."',
//                 totally_offline = '".$value2['totally_offline']."',
//                 first_level = '".$value2['first_level']."',
//                 second_level = '".$value2['second_level']."',
//                 third_level = '".$value2['third_level']."',
//                 author = '".$value2['author']."',
//                 stage_of_project = '".$value2['stage_of_project']."',
//                 author_location = '".$value2['author_location']."',
//                 start_year = '".$value2['start_year']."',
//                 offline_geography = '".$value2['offline_geography']."' WHERE id_project='".$value2['id_project']."'";

//                 $pushLiderToDb = dbQuery($queryProj);
// 	    }
// 	}
// }
// echo '<pre>';
// var_dump($liders);
// echo '</pre>';


