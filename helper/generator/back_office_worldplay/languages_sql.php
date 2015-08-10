<? 
// Page créée le 03/12/2012 16:21:25 par myGenerator 2006
require_once('languages_class.php');
$newLanguages = new languages();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
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
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newLanguages->message);
	}
?>