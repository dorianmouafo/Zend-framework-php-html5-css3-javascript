<? 
// Page cr��e le 03/12/2012 16:21:25 par myGenerator 2006
require_once('styles_class.php');
$newStyles = new styles();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'op�ration
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newStyles->uuid = $_REQUEST['txt_uuid'];
			$newStyles->name = $_REQUEST['txt_name'];
			$newStyles->url = $_REQUEST['txt_url'];
			$newStyles->setStyles();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newStyles->uuid = $_REQUEST['txt_uuid'];
			$newStyles->name = $_REQUEST['txt_name'];
			$newStyles->url = $_REQUEST['txt_url'];
			$newStyles->updateStyles($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newStyles->deleteStyles($_REQUEST['txt_id']);
			break;
		}
	
	//R�direction + r�sultat de l'ex�cution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newStyles->message);
	}
?>