<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('questions_class.php');
$newQuestions = new questions();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newQuestions->uuid = $_REQUEST['txt_uuid'];
			$newQuestions->teach_id = $_REQUEST['txt_teach_id'];
			$newQuestions->cat_id = $_REQUEST['txt_cat_id'];
			$newQuestions->qt_id = $_REQUEST['txt_qt_id'];
			$newQuestions->lang_id = $_REQUEST['txt_lang_id'];
			$newQuestions->lev_id = $_REQUEST['txt_lev_id'];
			$newQuestions->title = $_REQUEST['txt_title'];
			$newQuestions->description = $_REQUEST['txt_description'];
			$newQuestions->points = $_REQUEST['txt_points'];
			$newQuestions->setQuestions();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newQuestions->uuid = $_REQUEST['txt_uuid'];
			$newQuestions->teach_id = $_REQUEST['txt_teach_id'];
			$newQuestions->cat_id = $_REQUEST['txt_cat_id'];
			$newQuestions->qt_id = $_REQUEST['txt_qt_id'];
			$newQuestions->lang_id = $_REQUEST['txt_lang_id'];
			$newQuestions->lev_id = $_REQUEST['txt_lev_id'];
			$newQuestions->title = $_REQUEST['txt_title'];
			$newQuestions->description = $_REQUEST['txt_description'];
			$newQuestions->points = $_REQUEST['txt_points'];
			$newQuestions->updateQuestions($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newQuestions->deleteQuestions($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newQuestions->message);
	}
?>