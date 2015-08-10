<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('levels_class.php');
$newLevels = new levels();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newLevels->uuid = $_REQUEST['txt_uuid'];
			$newLevels->name = $_REQUEST['txt_name'];
			$newLevels->code = $_REQUEST['txt_code'];
			$newLevels->setLevels();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newLevels->uuid = $_REQUEST['txt_uuid'];
			$newLevels->name = $_REQUEST['txt_name'];
			$newLevels->code = $_REQUEST['txt_code'];
			$newLevels->updateLevels($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newLevels->deleteLevels($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newLevels->message);
	}
?>