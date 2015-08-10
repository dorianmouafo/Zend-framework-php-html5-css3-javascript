<?php
	require_once('back_office_worldplay/styles_class.php');
	require_once('guid.php');
	
	$newstyles = new styles();
	print json_encode($newstyles->getAllStyles('stl_id>0','stl_id'));
	
	echo "<br/>";
	
	$newstyles->uuid = Guid::uuid();
	$newstyles->name = "hallowen";
	$newstyles->url = "/styles/test.zip";
	$newstyles->setStyles();
	
	
?>