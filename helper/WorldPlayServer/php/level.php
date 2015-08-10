<?php

require_once('back_office_worldplay/levels_class.php');
require_once('guid.php');
require_once('error.php');

 function printerr($err)
{
	$arrayName = array('state' => $err->json());
	echo json_encode($arrayName);
}

 function allData($user)
{
	$err = new Error();
	$arrayName = array('state' => $err->json(), 'levels' => $user->getAlllevels('id>0','id') );
	echo json_encode($arrayName);
}

// Action
$action = (isset($_GET['action'])) ? ($_GET['action']) : NULL;
if ($action == NULL) {
	printerr(Error::withMessage("You should specify action"));
	return;
}

// Action all
if (!strcmp($action, "all")){
	allData(new levels());
	return;
}

// level
$level = (isset($_POST['level'])) ? ($_POST['level']) : NULL;
if ($level == NULL) {
	$level = (isset($_GET['level'])) ? ($_GET['level']) : NULL;
}
if ($level == NULL) {
	printerr( Error::withMessage('You should specify level name'));
	return;
}

// key
$key = (isset($_POST['code'])) ? ($_POST['code']) : NULL;
if ($key == NULL) {
	$key = (isset($_GET['code'])) ? ($_GET['code']) : NULL;
}
if ($key == NULL ) {
	printerr( Error::withMessage('You should specify level code'));
	return;
}
$errG;

if (!strcmp($action, "create")){
	$user = new levels();
	$user-> uuid = Guid::uuid();
	$user-> name = $level;
	$user-> code = $key;
	$user->setlevels();
	if (strcmp("OK", $user->message)) {
		printerr( Error::withMessage('Error during the recording'));
	}
	else {
		printerr( new Error());
	}
	return;
}


printerr( Error::withMessage('Command not taking into account'));

?>