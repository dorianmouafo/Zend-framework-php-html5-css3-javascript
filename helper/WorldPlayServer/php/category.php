<?php

require_once('back_office_worldplay/categories_class.php');
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
	$arrayName = array('state' => $err->json(), 'categories' => $user->getAllcategories('id>0','id') );
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
	allData(new categories());
	return;
}

// categorie
$category = (isset($_POST['category'])) ? ($_POST['category']) : NULL;
if ($category == NULL) {
	$category = (isset($_GET['category'])) ? ($_GET['category']) : NULL;
}
if ($category == NULL) {
	printerr( Error::withMessage('You should specify category name'));
	return;
}

// key
$key = (isset($_POST['code'])) ? ($_POST['code']) : NULL;
if ($key == NULL) {
	$key = (isset($_GET['code'])) ? ($_GET['code']) : NULL;
}
if ($key == NULL ) {
	printerr( Error::withMessage('You should specify category code'));
	return;
}
$errG;

if (!strcmp($action, "create")){
	$user = new categories();
	$user-> uuid = Guid::uuid();
	$user-> name = $category;
	$user-> code = $key;
	$user->setcategories();
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