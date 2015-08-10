<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('questiontypes_class.php');
$newQuestiontypes = new questiontypes();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newQuestiontypes->uuid = $_REQUEST['txt_uuid'];
			$newQuestiontypes->name = $_REQUEST['txt_name'];
			$newQuestiontypes->code = $_REQUEST['txt_code'];
			$newQuestiontypes->setQuestiontypes();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newQuestiontypes->uuid = $_REQUEST['txt_uuid'];
			$newQuestiontypes->name = $_REQUEST['txt_name'];
			$newQuestiontypes->code = $_REQUEST['txt_code'];
			$newQuestiontypes->updateQuestiontypes($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newQuestiontypes->deleteQuestiontypes($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newQuestiontypes->message);
	}
?>