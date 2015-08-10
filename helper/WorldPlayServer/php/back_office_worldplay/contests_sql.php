<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('contests_class.php');
$newContests = new contests();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newContests->uuid = $_REQUEST['txt_uuid'];
			$newContests->cp_id = $_REQUEST['txt_cp_id'];
			$newContests->teach_id = $_REQUEST['txt_teach_id'];
			$newContests->name = $_REQUEST['txt_name'];
			$newContests->data = $_REQUEST['txt_data'];
			$newContests->blob_questions = $_REQUEST['txt_blob_questions'];
			$newContests->setContests();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newContests->uuid = $_REQUEST['txt_uuid'];
			$newContests->cp_id = $_REQUEST['txt_cp_id'];
			$newContests->teach_id = $_REQUEST['txt_teach_id'];
			$newContests->name = $_REQUEST['txt_name'];
			$newContests->data = $_REQUEST['txt_data'];
			$newContests->blob_questions = $_REQUEST['txt_blob_questions'];
			$newContests->updateContests($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newContests->deleteContests($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newContests->message);
	}
?>