<? 
// Page créée le 03/12/2012 16:21:25 par myGenerator 2006
require_once('profiles_class.php');
$newProfiles = new profiles();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newProfiles->uuid = $_REQUEST['txt_uuid'];
			$newProfiles->lang_id = $_REQUEST['txt_lang_id'];
			$newProfiles->lev_id = $_REQUEST['txt_lev_id'];
			$newProfiles->lev_goal_id = $_REQUEST['txt_lev_goal_id'];
			$newProfiles->user_id = $_REQUEST['txt_user_id'];
			$newProfiles->points_questions = $_REQUEST['txt_points_questions'];
			$newProfiles->points_answers = $_REQUEST['txt_points_answers'];
			$newProfiles->blob_ques_points = $_REQUEST['txt_blob_ques_points'];
			$newProfiles->setProfiles();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newProfiles->uuid = $_REQUEST['txt_uuid'];
			$newProfiles->lang_id = $_REQUEST['txt_lang_id'];
			$newProfiles->lev_id = $_REQUEST['txt_lev_id'];
			$newProfiles->lev_goal_id = $_REQUEST['txt_lev_goal_id'];
			$newProfiles->user_id = $_REQUEST['txt_user_id'];
			$newProfiles->points_questions = $_REQUEST['txt_points_questions'];
			$newProfiles->points_answers = $_REQUEST['txt_points_answers'];
			$newProfiles->blob_ques_points = $_REQUEST['txt_blob_ques_points'];
			$newProfiles->updateProfiles($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newProfiles->deleteProfiles($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newProfiles->message);
	}
?>