<? 
// Page créée le 15/09/2006 23:07:12 par myGenerator 2006
require_once('etudiant_class.php');
$newEtudiant = new etudiant();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newEtudiant->matricule = $_REQUEST['txt_matricule'];
			$newEtudiant->nom = $_REQUEST['txt_nom'];
			$newEtudiant->prenom = $_REQUEST['txt_prenom'];
			$newEtudiant->id_classe = $_REQUEST['cbx_id_classe'];
			$newEtudiant->setEtudiant();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newEtudiant->matricule = $_REQUEST['txt_matricule'];
			$newEtudiant->nom = $_REQUEST['txt_nom'];
			$newEtudiant->prenom = $_REQUEST['txt_prenom'];
			$newEtudiant->id_classe = $_REQUEST['cbx_id_classe'];
			$newEtudiant->updateEtudiant($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newEtudiant->deleteEtudiant($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newEtudiant->message);
	}
?>