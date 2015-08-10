<?php

require_once('back_office_worldplay/languages_class.php');
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
	$arrayName = array('state' => $err->json(), 'languages' => $user->getAllLanguages('id>0','id') );
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
	allData(new languages());
	return;
}

// Language
$language = (isset($_POST['language'])) ? ($_POST['language']) : NULL;
if ($language == NULL) {
	$language = (isset($_GET['language'])) ? ($_GET['language']) : NULL;
}
if ($language == NULL) {
	printerr( Error::withMessage('You should specify language name'));
	return;
}

// key
$key = (isset($_POST['code'])) ? ($_POST['code']) : NULL;
if ($key == NULL) {
	$key = (isset($_GET['code'])) ? ($_GET['code']) : NULL;
}
if ($key == NULL ) {
	printerr( Error::withMessage('You should specify language code'));
	return;
}
$errG;

if (!strcmp($action, "create")){
	$user = new languages();
	$user-> uuid = Guid::uuid();
	$user-> name = $language;
	$user-> code = $key;
	$user->setLanguages();
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