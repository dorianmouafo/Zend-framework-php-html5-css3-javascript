<?php

require_once('back_office_worldplay/users_class.php');
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
	$arrayName = array('state' => $err->json(), 'users' => $user->getAllUsers('id>0','id') );
	echo json_encode($arrayName);
}


$action = (isset($_GET['action'])) ? ($_GET['action']) : NULL;
if ($action == NULL) {
	printerr(Error::withMessage("You should specify action"));
	return;
}

// Action all
if (!strcmp($action, "all")) {
	allData(new users());
	return;
}


// Login
$login = (isset($_POST['login'])) ? ($_POST['login']) : NULL;
if ($login == NULL ) {
	$login = (isset($_GET['login'])) ? ($_GET['login']) : NULL;
}
if ($login == NULL ) {
	printerr( Error::withMessage('You should specify login'));
	return;
}

// Password
$password = (isset($_POST['password'])) ? ($_POST['password']) : NULL;
if ($password == NULL ) {
	$password = (isset($_GET['password'])) ? ($_GET['password']) : NULL;
}
if ($password == NULL ) {
	printerr( Error::withMessage('You should specify password'));
	return;
}

// Email
$email = (isset($_POST['email'])) ? ($_POST['email']) : NULL;
if ($email == NULL ) {
	$email = (isset($_GET['email'])) ? ($_GET['email']) : NULL;
}
if ($email == NULL ) {
	printerr( Error::withMessage('You should specify email'));
	return;	
}

// Email
$isProf = (isset($_POST['isProf'])) ? ($_POST['isProf']) : NULL;
if ($isProf == NULL ) {
	$isProf = (isset($_GET['isProf'])) ? ($_GET['isProf']) : NULL;
}
if ($isProf == NULL ) {
	printerr( Error::withMessage('You should specify isProf'));
	return;	
}


if (!strcmp($action, "create")) {
	$user = new users();
	$user->uuid = Guid::uuid();
	$user->email = $email;
	$user->password = sha1($password);
	$user->name = $login;
	$user->isprof = $isProf;
	$user->setUsers();
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