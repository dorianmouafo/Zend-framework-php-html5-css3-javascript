<? 
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
require_once('languages_class.php');
$newLanguages = new languages();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'op�ration
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newLanguages->uuid = $_REQUEST['txt_uuid'];
			$newLanguages->name = $_REQUEST['txt_name'];
			$newLanguages->code = $_REQUEST['txt_code'];
			$newLanguages->setLanguages();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newLanguages->uuid = $_REQUEST['txt_uuid'];
			$newLanguages->name = $_REQUEST['txt_name'];
			$newLanguages->code = $_REQUEST['txt_code'];
			$newLanguages->updateLanguages($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newLanguages->deleteLanguages($_REQUEST['txt_id']);
			break;
		}
	
	//R�direction + r�sultat de l'ex�cution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newLanguages->message);
	}
?>