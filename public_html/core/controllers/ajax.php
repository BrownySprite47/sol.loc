<?php

function action_add_project() {

    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/library/projectSqlStr.php';

    //$project_title = getSaveData($_POST['project_title']);
    if ($_POST['project_title'] != '') {
        $resultTitle = dbQuery("SELECT id_proj FROM projects WHERE project_title = '".checkChars($_POST['project_title'])."'");
        $myrowTitle = mysqli_fetch_array($resultTitle);
        if (!empty($myrowTitle['id_proj']) ) {
            exit('proj_exists');
        }
    }else{
        exit('empty');
    }

    if ($_POST['site'] != '') {
        $resultSite = dbQuery("SELECT id_proj FROM projects WHERE site = '".checkChars($_POST['site'])."'");
        $myrowSite = mysqli_fetch_array($resultSite);
        if (!empty($myrowSite['id_proj'])) {
            exit('site_exists');
        }
    }
    if ($_SESSION['role'] == 'admin') {
        $sql = dbQuery("SELECT user_id FROM liders WHERE id_lid = '".checkChars($_POST['id_lid'])."'");

        $user = mysqli_fetch_array($sql);
        // view($user);
        if (empty($user['user_id'])) {
            $user = 'admin';
        }else{
            $user = $user['user_id'];
        }
        $status = '1';
    }else{
        $user = $_SESSION['id'];
        $status = '0';
    }
    $img = basename($_POST['liders_photo']);
//получить id лидера
    $query = "INSERT INTO projects (id_proj, user_id, id_project, general_online, only_online, general_offline, totally_offline, first_level, second_level, third_level, business, engineer, eq, it_prof, personal, proforient, arts, lingvistic, pedagogy, sport, social, techno, naturall, r_00_07, r_08_11, r_12_15, r_16_18, r_19_25, r_all_life, r_parents, r_teachers, r_others, project_title, short_title, project_description, site, author, stage_of_project, author_location, start_year, image_name, offline_geography, checked) VALUES (NULL, '".$user."', '', '".$general_online."', '".$only_online."', '".$general_offline."', '".$totally_offline."', '".$first_level."', '".$second_level."', '".$third_level."', '".$business."', '".$engineer."', '".$eq."', '".$it_prof."', '".$personal."', '".$proforient."', '".$arts."', '".$lingvistic."', '".$pedagogy."', '".$sport."', '".$social."', '".$techno."', '".$naturall."', '".$r_00_07."', '".$r_08_11."', '".$r_12_15."', '".$r_16_18."', '".$r_19_25."', '".$r_all_life."', '".$r_parents."', '".$r_teachers."', '".$r_others."', '".$project_title."', '".$short_title."', '".$project_description."', '".$site."', '".$author."', '".$stage_of_project."', '".$author_location."', '".$start_year."', '".$img."', '".$offline_geography."', '".(($_SESSION['role'] == 'admin') ? '1' : '0')."')";

    $pushProjectToDb = dbQuery($query);

    function checkAndPushToDb($lider, $project_title, $status){
        if ($lider['fio'] == '') {
            return false;
        }
        pushToDB($lider, $project_title, $status);
        return true;
    }

    if (empty($lider0) && empty($lider1) && empty($lider2) && empty($lider3) && empty($lider4)) {
       pushToDBUser($_SESSION['id'],  $project_title, $status);
    }

    checkAndPushToDb($lider0, $project_title, $status);
    checkAndPushToDb($lider1, $project_title, $status);
    checkAndPushToDb($lider2, $project_title, $status);
    checkAndPushToDb($lider3, $project_title, $status);
    checkAndPushToDb($lider4, $project_title, $status);

    function add_files_to_db($filename, $description, $project_title){
        if ($filename == '') {
            return false;
        }
        $id_proj = getData(dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'"));
        $sql = "INSERT INTO projects_uploads (id_proj, filename, description) VALUES ('".$id_proj[0]['id_proj']."', '".$filename."', '".$description."')";
        dbQuery($sql);
    }
    add_files_to_db($filename0, $description0, $project_title);
    add_files_to_db($filename1, $description1, $project_title);
    add_files_to_db($filename2, $description2, $project_title);
    add_files_to_db($filename3, $description3, $project_title);
    add_files_to_db($filename4, $description4, $project_title);

    if ($_SESSION['role'] == 'admin'){
        exit('success_admin');
    }
    if ($_SESSION['role'] == 'user'){
        exit('success_user');
    }

}

function action_ajax_check_unique_fio(){
    if(isset($_GET['fio_lid'])){
        $fio_lid = dbSaveData(htmlspecialchars($_GET['fio_lid']));

        $result = dbQuery("SELECT id_lid FROM liders WHERE fio = '".$fio_lid."'");
        $myrow = mysqli_fetch_array($result);

        if (!empty($myrow['id_lid'])) {
            echo "lider_exists";
            exit;
        }
    }
}

function action_ajax_check_unique_title(){
    if(isset($_GET['project_title']) && !empty($_GET['project_title'])){
        $project_title = checkChars($_GET['project_title']);

        $result = dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'");
        $myrow = mysqli_fetch_array($result);

        if (!empty($myrow['id_proj'])) {
            echo "project_title_exists";
            exit;
        }
    }
}

function action_ajax_check_unique_site(){
    if(isset($_GET['site']) && !empty($_GET['site'])){
        $site = checkChars($_GET['site']);

        $result = dbQuery("SELECT id_proj FROM projects WHERE site = '".$site."'");
        $myrow = mysqli_fetch_array($result);

        if (!empty($myrow['id_proj'])) {
            echo "site_exists";
            exit;
        }
    }

}

function action_edit_user() {
    // view($_POST);
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/models/user.php';
    require SITE_DIR . '/core/library/liderSqlStr.php';

    if ($_POST['familya'] == '' || $_POST['name'] == '') {
        exit("empty fio");
    }
    // if ($_POST['email'] == '') {
    //     exit("empty email");
    // }
    
    $img = basename($_POST['liders_photo']);
    $checked = getData(dbQuery("SELECT checked FROM liders WHERE id_lid = '".checkChars($_POST['id_lid'])."'"));
    if ($checked[0]['checked'] == '0') {
        $checked ='0';
    }else{
        $checked = '3';
    }

    $pushLiderToDb = dbQuery("UPDATE liders SET fio = '".$fio."', familya = '".$familya."', name = '".$name."', otchestvo = '".$otchestvo."', male_female = '".$male_female."', city = '".$city."', telephone = '".$telephone."', email = '".$email."', region = '".$region."', birthday = '".$birthday."', i_need = '".$i_need."', i_can = '".$i_can."', social = '".$social."', contact_info = '".$contact_info."', image_name = '".$img."', checked = ".(($_SESSION['role'] == 'admin') ? '1' : $checked)." WHERE id_lid = '".checkChars($_POST['id_lid'])."'");
    $pushLiderToDb = dbQuery("UPDATE lider_project SET checked = ".(($_SESSION['role'] == 'admin') ? '1' : $checked)." WHERE id_lid = '".checkChars($_POST['id_lid'])."'");

    // function add_files_to_db($filename, $description, $fio, $email){
    //     if ($filename == '') {
    //         return false;
    //     }
    //     $sql = "SELECT id_lid FROM liders WHERE fio = '".$fio."' AND email = '".$email."'";
        
    //     $id_lid = getData(dbQuery($sql));
    //     $sql = "INSERT INTO liders_uploads (id_lid, filename, description) VALUES ('".$id_lid[0]['id_lid']."', '".$filename."', '".$description."')";
    //     dbQuery($sql);
    // }
    // echo "string";
    // add_files_to_db($filename0, $description0, $fio, $email);
    // add_files_to_db($filename1, $description1, $fio, $email);
    // add_files_to_db($filename2, $description2, $fio, $email);
    // add_files_to_db($filename3, $description3, $fio, $email);
    // add_files_to_db($filename4, $description4, $fio, $email);


    if ($_SESSION['role'] == 'user') {
        $id_lid = getData(dbQuery("SELECT id_lid FROM liders WHERE user_id = '".$_SESSION['id']."'"));
        dbQuery("DELETE FROM liders_uploads WHERE id_lid = '".$id_lid[0]['id_lid']."'");
    }
    if ($_SESSION['role'] == 'admin') {
        $id_lid = getData(dbQuery("SELECT id_lid FROM liders WHERE id_lid = '".checkChars($_POST['id_lid'])."'"));
        dbQuery("DELETE FROM liders_uploads WHERE id_lid = '".checkChars($_POST['id_lid'])."'");
    }

    function add_files_to_db($id_lid, $filename, $description, $project_title){
        if ($filename == '') {
            return false;
        }

        $sql = "INSERT INTO liders_uploads (id_lid, filename, description) VALUES ('".$id_lid[0]['id_lid']."', '".$filename."', '".$description."')";
        //echo "$sql"; 
        dbQuery($sql);
    }
    add_files_to_db($id_lid, $filename0, $description0, $fio, $email);
    add_files_to_db($id_lid, $filename1, $description1, $fio, $email);
    add_files_to_db($id_lid, $filename2, $description2, $fio, $email);
    add_files_to_db($id_lid, $filename3, $description3, $fio, $email);
    add_files_to_db($id_lid, $filename4, $description4, $fio, $email);


    if ($_SESSION['role'] == 'admin'){
        exit('success_admin');
    }
    if ($_SESSION['role'] == 'user'){
        exit('success_user');
    }

}

function action_add_lider() {

    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/library/liderSqlStr.php';

    if ($_POST['familya'] == '' && $_POST['name'] == '') {
        exit("empty fio");
    }
    // if ($_POST['email'] == '') {
    //     exit("empty email");
    // }
   // view($_POST);
    $img = basename(checkChars($_POST['liders_photo']));  
    $hash = md5(rand(0, PHP_INT_MAX));
    if ($_SESSION['role'] == 'admin'){
        $sql = "INSERT INTO liders (id_lid, user_id, fio, familya, name, otchestvo, male_female, city, telephone, i_can, i_need, email, region, birthday, social, contact_info, image_name, checked, token) VALUES ('', 'admin', '".$fio."', '".$familya."', '".$name."', '".$otchestvo."', '".$male_female."', '".$city."', '".$telephone."', '".$i_can."', '".$i_need."', '".$email."', '".$region."', '".$birthday."', '".$social."', '".$contact_info."', '".$img."', '1', '".$hash."')";

        $pushLiderToDb = dbQuery ($sql);

        $id_lid = getData(dbQuery("SELECT id_lid FROM liders WHERE token = '".$hash."'"));

        $sql = "INSERT INTO recommend_liders (id_lid, user_id, reason) VALUES ('".$id_lid[0]['id_lid']."', 'admin', '".$reason."')";

        $pushLiderToDb = dbQuery ($sql);
    }
    if ($_SESSION['role'] == 'user'){
        $sql = "INSERT INTO liders (id_lid, fio, familya, name, otchestvo, male_female, city, telephone, i_can, i_need, email, region, birthday, social, contact_info, image_name, checked, token) VALUES ('', '".$fio."', '".$familya."', '".$name."', '".$otchestvo."', '".$male_female."', '".$city."', '".$telephone."', '".$i_can."', '".$i_need."', '".$email."', '".$region."', '".$birthday."', '".$social."', '".$contact_info."', '".$img."', '4', '".$hash."')";
        $pushLiderToDb = dbQuery ($sql);

        $id_lid1 = getData(dbQuery("SELECT id_lid FROM liders WHERE token = '".$hash."'"));

        $sql = "INSERT INTO recommend_liders (id_lid, user_id, reason) VALUES ('".$id_lid1[0]['id_lid']."', '".$id_lid."', '".$reason."')";

        $pushLiderToDb = dbQuery ($sql);
    }
    //view($id_lid);

    // if ($_SESSION['role'] == 'admin'){
    //     $sql = "INSERT INTO liders (id_lid, user_id, recommend, fio, familya, name, otchestvo, male_female, city, telephone, i_can, i_need, email, region, birthday, social, contact_info, image_name, reason, checked, token) VALUES ('', 'admin', 'admin', '".$fio."', '".$familya."', '".$name."', '".$otchestvo."', '".$male_female."', '".$city."', '".$telephone."', '".$i_can."', '".$i_need."', '".$email."', '".$region."', '".$birthday."', '".$social."', '".$contact_info."', '".$img."', '".$reason."', '1', '".$hash."')";

    //     $pushLiderToDb = dbQuery ($sql);
    // }
    // if ($_SESSION['role'] == 'user'){
    //     $sql = "INSERT INTO liders (id_lid, recommend, fio, familya, name, otchestvo, male_female, city, telephone, i_can, i_need, email, region, birthday, social, contact_info, image_name, reason, checked, token) VALUES ('', '".$id_lid."', '".$fio."', '".$familya."', '".$name."', '".$otchestvo."', '".$male_female."', '".$city."', '".$telephone."', '".$i_can."', '".$i_need."', '".$email."', '".$region."', '".$birthday."', '".$social."', '".$contact_info."', '".$img."', '".$reason."', '4', '".$hash."')";
    //     $pushLiderToDb = dbQuery ($sql);
    // }

        // добавление в лист нового адреса
        // $data = array(
        //  'list_id' => '83320450bb', // номер листа вытащить в настройки или в БД
        //  'email'   => "$email",
        //  'status'  => 'subscribed',
        //  'firstname' => "$name",
        //  'lastname' => "$familya",
        //  'token' => "$hash",
        // );
        // $result = mailchimp('add_to_list', $data);

    function add_files_to_db($filename, $description, $fio, $email){
        if ($filename == '') {
            return false;
        }
        $sql = "SELECT id_lid FROM liders WHERE fio = '".$fio."' AND email = '".$email."'";
        
        $id_lid = getData(dbQuery($sql));
        $sql = "INSERT INTO liders_uploads (id_lid, filename, description) VALUES ('".$id_lid[0]['id_lid']."', '".$filename."', '".$description."')";
       // echo $sql;
        dbQuery($sql);
    }
    add_files_to_db($filename0, $description0, $fio, $email);
    add_files_to_db($filename1, $description1, $fio, $email);
    add_files_to_db($filename2, $description2, $fio, $email);
    add_files_to_db($filename3, $description3, $fio, $email);
    add_files_to_db($filename4, $description4, $fio, $email);


        exit('success_user');
}

function action_add_lider_to_project() {
    require SITE_DIR . '/core/models/main.php';
    $filters = getLidersFio();
    $counter = checkChars($_POST['counter']);
    if ($counter > 5) {
        exit;
    }
    if ($counter == 5) {
        if ($_POST['lider0']  == '0') {
            $classCount = 0;
        }
        if ($_POST['lider1'] == '0') {
            $classCount = 1;
        }
        if ($_POST['lider2'] == '0') {
            $classCount = 2;
        }
        if ($_POST['lider3'] == '0') {
            $classCount = 3;
        }
        if ($_POST['lider4'] == '0') {
            $classCount = 4;
        }
    } else {
        $classCount = $counter;
    }

    if ($counter < 6) {
        include SITE_DIR . '/core/views/layouts/lider_blocks.php';
    }
}

function action_add_lider_file_to_project() {
    require SITE_DIR . '/core/models/main.php';
    // $filters = getLidersFio();
    $counter = checkChars($_POST['counter']);
    if ($counter > 5) {
        exit;
    }
    if ($counter == 5) {
        if ($_POST['file0']  == '0') {
            $classCount = 0;
        }
        if ($_POST['file1'] == '0') {
            $classCount = 1;
        }
        if ($_POST['file2'] == '0') {
            $classCount = 2;
        }
        if ($_POST['file3'] == '0') {
            $classCount = 3;
        }
        if ($_POST['file'] == '0') {
            $classCount = 4;
        }
    } else {
        $classCount = $counter;
    }

    if ($counter < 6) {
        include SITE_DIR . '/core/views/layouts/file_blocks.php';
    }
}

function action_upload_img() {
    require SITE_DIR.'/core/models/main.php';
    $req = false;
    // Приведём полученную информацию в удобочитаемый вид
    ob_start();
    function getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    $filename = stripslashes($_FILES['file']['name']);
//    $text = str_replace($rus, $lat, $filename);
    $ext = getExtension($filename);
    $ext = strtolower($ext);

    $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
    if(in_array($ext,$valid_formats)){
        $name = time();
        $newname = 'uploads/images/'.$name.'.'.$ext;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $newname)){

            echo "<img src='/".$newname."' class='liders_photo' style='width: 100%;'>";
        }else{
            echo "<img src='/assets/images/img_not_found.png' class='liders_photo' style='width: 100%;'><p>Произошла ошибка загрузки изображения! Повторите попытку позднее.</p>";
        }

    }else{
        echo "<img src='/assets/images/img_not_found.png' class='liders_photo' style='width: 100%;'><p>Неверный формат изображения!</p>";
    }
    $req = ob_get_contents();
    ob_end_clean();
    echo json_encode($req);
}

function action_upload_file() {
    require SITE_DIR.'/core/models/main.php';
        $req = false;
    // Приведём полученную информацию в удобочитаемый вид
    ob_start();
    function getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    $filename = stripslashes($_FILES['file']['name']);
//    $text = str_replace($rus, $lat, $filename);
    $ext = getExtension($filename);
    $ext = strtolower($ext);

        $name = time();
        $newname = 'uploads/files/'.$name.'.'.$ext;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $newname)){
            echo $name.'.'.$ext;;
        }
        // else{
        //     echo "Произошла ошибка загрузки изображения! Повторите попытку позднее.";
        // }

    // }else{
    //     echo "Неверный формат изображения!";
            $req = ob_get_contents();
    ob_end_clean();
    echo json_encode($req);

}

function action_check_status(){
    require SITE_DIR . '/core/models/main.php';
    if (isset($_POST['id_proj']) && $_POST['id_proj'] != '') {
        $pushLiderToDb = dbQuery("UPDATE projects SET checked = '".checkChars($_POST['status'])."' WHERE id_proj = '".checkChars($_POST['id_proj'])."'");
        $pushLiderToDb = dbQuery ("UPDATE lider_project SET checked = '".checkChars($_POST['status'])."' WHERE id_proj = '".checkChars($_POST['id_proj'])."'");

        exit('project_update_success');
    }

    if (isset($_POST['id_lid']) && $_POST['id_lid'] != '') {
        $pushLiderToDb = dbQuery ("UPDATE liders SET checked = '".checkChars($_POST['status'])."' WHERE id_lid = '".checkChars($_POST['id_lid'])."'");
        $pushLiderToDb = dbQuery ("UPDATE lider_project SET checked = '".checkChars($_POST['status'])."' WHERE id_lid = '".checkChars($_POST['id_lid'])."'");

        exit('lider_update_success');
    }
    if (isset($_POST['id_lid_recom']) && $_POST['id_lid_recom'] != '') {
        if (isset($_POST['exist']) && $_POST['exist'] == '1') {
            $pushLiderToDb = dbQuery ("UPDATE recommend_liders SET checked = '".checkChars($_POST['status'])."' WHERE id_lid = '".checkChars($_POST['id_lid_recom'])."' AND user_id = '".checkChars($_POST['user_id'])."'");
        }else if (isset($_POST['exist']) && $_POST['exist'] == '0') {
            $pushLiderToDb = dbQuery ("UPDATE liders SET checked = '".checkChars($_POST['status'])."' WHERE id_lid = '".checkChars($_POST['id_lid_recom'])."'");
            $pushLiderToDb = dbQuery ("UPDATE recommend_liders SET checked = '".checkChars($_POST['status'])."' WHERE id_lid = '".checkChars($_POST['id_lid_recom'])."' AND user_id = '".checkChars($_POST['user_id'])."'");
        }        

        exit('recom_update_success');
    }
}
function action_update_project(){
// view($_POST);
    require SITE_DIR . '/core/models/main.php';
    require SITE_DIR . '/core/library/projectSqlStr.php';
    if ($_POST['project_title'] == '') {
        exit("empty");
    }

    $img = basename(checkChars($_POST['liders_photo']));

    $queryProj = "UPDATE projects SET
    project_title = '".checkChars($project_title)."',
    short_title = '".checkChars($short_title)."',
    project_description = '".checkChars($project_description)."',
    site = '".checkChars($site)."',
    business = '".checkChars($business)."',
    engineer = '".checkChars($engineer)."',
    eq = '".checkChars($eq)."',
    it_prof = '".checkChars($it_prof)."',
    personal = '".checkChars($personal)."',
    proforient = '".checkChars($proforient)."',
    arts = '".checkChars($arts)."',
    lingvistic = '".checkChars($lingvistic)."',
    pedagogy = '".checkChars($pedagogy)."',
    sport = '".checkChars($sport)."',
    social = '".checkChars($social)."',
    techno = '".checkChars($techno)."',
    naturall = '".checkChars($naturall)."',
    r_00_07 = '".checkChars($r_00_07)."',
    r_12_15 = '".checkChars($r_12_15)."',
    r_16_18 = '".checkChars($r_16_18)."',
    r_19_25 = '".checkChars($r_19_25)."',
    r_08_11 = '".checkChars($r_08_11)."',
    r_all_life = '".checkChars($r_all_life)."',
    r_others = '".checkChars($r_others)."',
    r_parents = '".checkChars($r_parents)."',
    r_teachers = '".checkChars($r_teachers)."',
    general_online = '".checkChars($general_online)."',
    only_online = '".checkChars($only_online)."',
    general_offline = '".checkChars($general_offline)."',
    totally_offline = '".checkChars($totally_offline)."',
    first_level = '".checkChars($first_level)."',
    second_level = '".checkChars($second_level)."',
    third_level = '".checkChars($third_level)."',
    author = '".checkChars($author)."',
    stage_of_project = '".checkChars($stage_of_project)."',
    author_location = '".checkChars($author_location)."',
    start_year = '".checkChars($start_year)."',
    offline_geography = '".checkChars($offline_geography)."',
    image_name = '".checkChars($img)."',
    checked = '".(($_SESSION['role'] == 'admin') ? '1' : '3')."' WHERE id_proj = '".$_POST['id_proj']."'";
    $pushLiderToDb = dbQuery($queryProj);

    $DelDb = dbQuery ("DELETE FROM lider_project WHERE id_proj = '".$_POST['id_proj']."'");
    if ($_SESSION['role'] == 'admin'){
        $status = '1';
    }
    if ($_SESSION['role'] == 'user'){
        $status = '0';
    }
    function checkAndPushToDb($lider, $project_title, $status){
        if ($lider['fio'] == '') {
            return false;
        }
        pushToDB($lider, $project_title, $status);
        return true;
    }
    

    if (empty($lider0) && empty($lider1) && empty($lider2) && empty($lider3) && empty($lider4)) {
       pushToDBUser($_SESSION['id'],  $project_title, $status);
    }

    checkAndPushToDb($lider0, $project_title, $status);
    checkAndPushToDb($lider1, $project_title, $status);
    checkAndPushToDb($lider2, $project_title, $status);
    checkAndPushToDb($lider3, $project_title, $status);
    checkAndPushToDb($lider4, $project_title, $status);

    
    $id_proj = getData(dbQuery("SELECT id_proj FROM projects WHERE project_title = '".$project_title."'"));

    dbQuery("DELETE FROM projects_uploads WHERE id_proj = '".$id_proj[0]['id_proj']."'");
    function add_files_to_db($id_proj, $filename, $description, $project_title){
        if ($filename == '') {
            return false;
        }

        $sql = "INSERT INTO projects_uploads (id_proj, filename, description) VALUES ('".$id_proj[0]['id_proj']."', '".$filename."', '".$description."')";
        dbQuery($sql);
    }
    add_files_to_db($id_proj, $filename0, $description0, $project_title);
    add_files_to_db($id_proj, $filename1, $description1, $project_title);
    add_files_to_db($id_proj, $filename2, $description2, $project_title);
    add_files_to_db($id_proj, $filename3, $description3, $project_title);
    add_files_to_db($id_proj, $filename4, $description4, $project_title);

    if ($_SESSION['role'] == 'admin'){
        exit('success_admin');
    }
    if ($_SESSION['role'] == 'user'){
        exit('success_user');
    }
}

function action_delete_project(){
    require SITE_DIR . '/core/models/main.php';
    $resultDelProjects = dbQuery("DELETE FROM projects WHERE id_proj = '".checkChars($_POST['del_proj_id'])."'");

    $resultDelLiderProjects  = dbQuery("DELETE FROM lider_project WHERE id_proj = '".checkChars($_POST['del_proj_id'])."'");
    $resultDelLiderProjects  = dbQuery("DELETE FROM projects_uploads WHERE id_proj = '".checkChars($_POST['del_proj_id'])."'");
    if ($_SESSION['role'] == 'admin'){
        exit('project_deleted_admin');
    }
    if ($_SESSION['role'] == 'user'){
        exit('project_deleted_user');
    }
}
function action_delete_lider(){
    require SITE_DIR . '/core/models/main.php';
    $resultDelProjects = dbQuery("DELETE FROM liders WHERE id_lid = '".checkChars($_POST['del_lid_id'])."'");

    $resultDelLiderProjects  = dbQuery("DELETE FROM lider_project WHERE id_lid = '".checkChars($_POST['del_lid_id'])."'");
    $sql = "DELETE FROM liders_uploads WHERE id_lid = '".checkChars($_POST['del_lid_id'])."'";
    //echo "$sql";
    $resultDelLiderProjects  = dbQuery($sql);
    if ($_SESSION['role'] == 'admin'){
        exit('lider_deleted_admin');
    }
    if ($_SESSION['role'] == 'user'){
        exit('lider_deleted_user');
    }
}

// function action_change_password(){
//     require SITE_DIR . '/core/models/main.php';
//     if ($_POST['password1'] != $_POST['password2']) {
//         exit("password_wrong_user");
//     }if (($_POST['password1'] == '') || ($_POST['password2'] == '')) {
//         exit("password_wrong_user_empty");
//     }else{
//         $sql = "UPDATE users SET password = '".md5($_POST['password1'] . KEY)."' WHERE id = '".$_SESSION['id']."'";
//         dbQuery($sql);
//         $sql = "UPDATE liders SET token = '' WHERE user_id = '".$_SESSION['id']."'";
//         dbQuery($sql);
//         exit("password_success_user");
//     }

// }

// function action_update_user(){
//     require SITE_DIR . '/core/models/main.php';

//     $email = getData(dbQuery("SELECT id FROM users WHERE email = '".$_POST['email']."'"));


//     if ($email[0]['id'] != $_SESSION['id']) {
//         exit("Данный email уже занят!");
//     }
//     if ($_POST['password1'] != $_POST['password2']) {
//         exit("Пароли дожны совпадать!");
//     }
//     if ($_POST['password1'] == '' || $_POST['password2'] == '' || $_POST['login'] == '' || $_POST['email'] == '') {
//         exit("Заполните все поля");
//     }
//     $sql = "UPDATE users SET password = '".md5($_POST['password1'] . KEY)."', login = '".$_POST['login']."', email = '".$_POST['email']."' WHERE id = '".$_SESSION['id']."'";
//     dbQuery($sql);
//     exit("Изменения успешно сохранены!");
// }

function action_search_recommend(){
    require SITE_DIR . '/core/models/main.php';
    // $search = getData(dbQuery("SELECT id_lid FROM liders WHERE familya = '".$_POST['familya']."'"));
    // view($search);
    $search = checkChars($_POST['search']);
       if($search == ''){
          exit();
       }
    $db = dbConnect();
    //mysql_select_db("suppor1k_vtemp",$db);
    //mysql_query("SET NAMES ut");
    //$sql = "SELECT * FROM liders WHERE MATCH(text) AGAINST('$search')";
    $sql = "SELECT id_lid, fio, image_name FROM liders  WHERE familya = '".$search."'";
    //echo "$sql";      
    $query = mysqli_query($db, $sql);
    //view($query);
    if(mysqli_num_rows($query) > 0){
        $sql = mysqli_fetch_array($query);
        $id_user = getData(dbQuery("SELECT id_lid FROM liders WHERE user_id = '".$_SESSION['id']."'"));

        $exist_recom = "SELECT id FROM recommend_liders WHERE id_lid = '".$sql["id_lid"]."' AND user_id = '".$id_user[0]['id_lid']."'";
        //echo "$sql";      
        $result = mysqli_query($db, $exist_recom);
       //view($result);
        if(mysqli_num_rows($result) === 0){
            do{
                if (!empty($sql['image_name'])) {
                    $id = 'no_btn_'.$sql["id_lid"];
                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/lider?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='/uploads/images/".$sql['image_name']."'><a style='margin: 0 15px;' href='/lider?id=".$sql['id_lid']."&recom=true' class='btn btn-success'>Да</a>"."<a onclick=\"checkSearch('".$id."')\" class='btn btn-danger'>Нет</a></div>";
                }else{
                    $id = 'no_btn_'.$sql["id_lid"];
                    // echo "<div>".$sql['id_lid']."</div>"."<div>".$sql['fio']."</div>"."<div><img src='/uploads/images/img_not_found.png'></div>";
                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/lider?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='/uploads/images/img_not_found.png'><a id='yes_btn' style='margin: 0 15px;'  href='/lider?id=".$sql['id_lid']."&recom=true' class='btn btn-success'>Да</a>"."<a onclick=\"checkSearch('".$id."')\" class='btn btn-danger'>Нет</a></div>";
                }

            }while($sql = mysqli_fetch_array($query));
       }else{
            do{
                if (!empty($sql['image_name'])) {
                    $id = 'no_btn_'.$sql["id_lid"];
                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/lider?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='/uploads/images/".$sql['image_name']."'><p style='margin: text-align: center;'>Вы уже рекомендовали данного лидера</p></div>";
                }else{
                    $id = 'no_btn_'.$sql["id_lid"];
                    // echo "<div>".$sql['id_lid']."</div>"."<div>".$sql['fio']."</div>"."<div><img src='/uploads/images/img_not_found.png'></div>";
                    echo "<div style='margin: 10px; text-align: center; width: 278px; border: 1px #474747 solid; padding: 30px 10px 34px 10px; background: #e7e7e7;' class='search_box_".$id."'><a onclick=\"checkSearch('".$id."')\"><i style='position: absolute; top: 19px; right: 22px;' class='fa fa-times' aria-hidden='true'></i></a><p>Возможно вы имеете в виду этого лидера?</p><a href='/lider?id=".$sql['id_lid']."'>".$sql['fio']."</a>"."<img style='margin: 36px 0; width: 100%;' src='/uploads/images/img_not_found.png'><p style='margin: text-align: center;'>Вы уже рекомендовали данного лидера</p></div>";
                }
            }while($sql = mysqli_fetch_array($query));
        }
    }
}


function action_create_recom(){
    require SITE_DIR . '/core/models/main.php';

    $recommend = checkChars($_POST['id_lid']);
    $reason = checkChars($_POST['reason']);
    $id_lid = getData(dbQuery("SELECT id_lid FROM liders WHERE user_id = '".$_SESSION['id']."'"));
    $exist_recom = getData(dbQuery("SELECT id FROM recommend_liders WHERE id_lid = '".$sql["id_lid"]."' AND user_id = '".$id_user[0]['id_lid']."'"));
    if (empty($exist_recom[0]['id'])) {
        $sql = "INSERT INTO recommend_liders (id_lid, user_id, reason, exist) VALUES ('".$recommend."', '".$id_lid[0]['id_lid']."', '".$reason."', '1')";
    }
    

    $pushLiderToDb = dbQuery ($sql);
    exit("lider_recom_success");
}
