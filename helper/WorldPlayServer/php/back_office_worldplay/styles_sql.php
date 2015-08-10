<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('styles_class.php');
$newStyles = new styles();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
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
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newStyles->message);
	}
?>