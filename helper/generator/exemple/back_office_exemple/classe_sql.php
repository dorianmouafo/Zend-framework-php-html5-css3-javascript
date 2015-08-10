<? 
// Page créée le 15/09/2006 23:07:12 par myGenerator 2006
require_once('classe_class.php');
$newClasse = new classe();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newClasse->Code = $_REQUEST['txt_Code'];
			$newClasse->Nom = $_REQUEST['txt_Nom'];
			$newClasse->setClasse();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newClasse->Code = $_REQUEST['txt_Code'];
			$newClasse->Nom = $_REQUEST['txt_Nom'];
			$newClasse->updateClasse($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newClasse->deleteClasse($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newClasse->message);
	}
?>