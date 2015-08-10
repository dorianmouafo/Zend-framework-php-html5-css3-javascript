<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('categories_class.php');
$newCategories = new categories();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newCategories->uuid = $_REQUEST['txt_uuid'];
			$newCategories->name = $_REQUEST['txt_name'];
			$newCategories->code = $_REQUEST['txt_code'];
			$newCategories->setCategories();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newCategories->uuid = $_REQUEST['txt_uuid'];
			$newCategories->name = $_REQUEST['txt_name'];
			$newCategories->code = $_REQUEST['txt_code'];
			$newCategories->updateCategories($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newCategories->deleteCategories($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newCategories->message);
	}
?>