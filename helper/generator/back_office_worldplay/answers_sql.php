<? 
// Page créée le 03/12/2012 16:21:25 par myGenerator 2006
require_once('answers_class.php');
$newAnswers = new answers();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newAnswers->uuid = $_REQUEST['txt_uuid'];
			$newAnswers->ques_uuid = $_REQUEST['txt_ques_uuid'];
			$newAnswers->ans_1 = $_REQUEST['txt_ans_1'];
			$newAnswers->ans_2 = $_REQUEST['txt_ans_2'];
			$newAnswers->ans_3 = $_REQUEST['txt_ans_3'];
			$newAnswers->ans_4 = $_REQUEST['txt_ans_4'];
			$newAnswers->sol_1 = $_REQUEST['txt_sol_1'];
			$newAnswers->sol_2 = $_REQUEST['txt_sol_2'];
			$newAnswers->sol_3 = $_REQUEST['txt_sol_3'];
			$newAnswers->sol_4 = $_REQUEST['txt_sol_4'];
			$newAnswers->setAnswers();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newAnswers->uuid = $_REQUEST['txt_uuid'];
			$newAnswers->ques_uuid = $_REQUEST['txt_ques_uuid'];
			$newAnswers->ans_1 = $_REQUEST['txt_ans_1'];
			$newAnswers->ans_2 = $_REQUEST['txt_ans_2'];
			$newAnswers->ans_3 = $_REQUEST['txt_ans_3'];
			$newAnswers->ans_4 = $_REQUEST['txt_ans_4'];
			$newAnswers->sol_1 = $_REQUEST['txt_sol_1'];
			$newAnswers->sol_2 = $_REQUEST['txt_sol_2'];
			$newAnswers->sol_3 = $_REQUEST['txt_sol_3'];
			$newAnswers->sol_4 = $_REQUEST['txt_sol_4'];
			$newAnswers->updateAnswers($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newAnswers->deleteAnswers($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newAnswers->message);
	}
?>