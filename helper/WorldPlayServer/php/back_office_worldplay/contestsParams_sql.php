<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('contestsparams_class.php');
$newContestsparams = new contestsparams();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newContestsparams->uuid = $_REQUEST['txt_uuid'];
			$newContestsparams->time_1 = $_REQUEST['txt_time_1'];
			$newContestsparams->time_2 = $_REQUEST['txt_time_2'];
			$newContestsparams->time_3 = $_REQUEST['txt_time_3'];
			$newContestsparams->points = $_REQUEST['txt_points'];
			$newContestsparams->setContestsparams();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newContestsparams->uuid = $_REQUEST['txt_uuid'];
			$newContestsparams->time_1 = $_REQUEST['txt_time_1'];
			$newContestsparams->time_2 = $_REQUEST['txt_time_2'];
			$newContestsparams->time_3 = $_REQUEST['txt_time_3'];
			$newContestsparams->points = $_REQUEST['txt_points'];
			$newContestsparams->updateContestsparams($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newContestsparams->deleteContestsparams($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newContestsparams->message);
	}
?>