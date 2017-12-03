<?php

function getUrnSegments() {
    $urn = (isset($_GET['urn'])) ? strtolower($_GET['urn']) : '';
    $segments = explode('/', $urn);

    return $segments;
}

function show404page() {
    header('HTTP/1.1 404 Not Found');
    renderView('404');
}

function renderView($name, $data = []) {
    require_once SITE_DIR . '/core/views/' . $name . '.php';
}

function view($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
function getSaveData($data){
	$utext = trim($data);
	$utext = strip_tags($utext);
	$utext = htmlspecialchars($utext,ENT_QUOTES);
	$utext = stripslashes($utext);
	return $utext;
}

