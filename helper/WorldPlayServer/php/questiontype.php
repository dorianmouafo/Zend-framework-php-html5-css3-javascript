<?php

require_once('back_office_worldplay/questiontypes_class.php');
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
	$arrayName = array('state' => $err->json(), 'questiontypes' => $user->getAllquestiontypes('id>0','id') );
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
	allData(new questiontypes());
	return;
}

// questiontype
$questiontype = (isset($_POST['questiontype'])) ? ($_POST['questiontype']) : NULL;
if ($questiontype == NULL) {
	$questiontype = (isset($_GET['questiontype'])) ? ($_GET['questiontype']) : NULL;
}
if ($questiontype == NULL) {
	printerr( Error::withMessage('You should specify questiontype name'));
	return;
}

// key
$key = (isset($_POST['code'])) ? ($_POST['code']) : NULL;
if ($key == NULL) {
	$key = (isset($_GET['code'])) ? ($_GET['code']) : NULL;
}
if ($key == NULL ) {
	printerr( Error::withMessage('You should specify questiontype code'));
	return;
}
$errG;

if (!strcmp($action, "create")){
	$user = new questiontypes();
	$user-> uuid = Guid::uuid();
	$user-> name = $questiontype;
	$user-> code = $key;
	$user->setquestiontypes();
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