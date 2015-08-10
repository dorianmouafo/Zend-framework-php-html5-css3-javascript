<?

 function printerr($err)
{
	$arrayName = array('state' => $err->json());
	echo json_encode($arrayName);
}

 function allData($user)
{
	$err = new Error();
	$arrayName = array('state' => $err->json(), 'users' => $user->getAllLanguages('id>0','id') );
	echo json_encode($arrayName);
}

?>