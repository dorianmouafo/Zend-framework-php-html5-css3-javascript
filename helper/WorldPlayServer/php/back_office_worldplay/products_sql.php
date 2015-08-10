<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('products_class.php');
$newProducts = new products();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newProducts->uuid = $_REQUEST['txt_uuid'];
			$newProducts->name = $_REQUEST['txt_name'];
			$newProducts->price = $_REQUEST['txt_price'];
			$newProducts->blob_questions = $_REQUEST['txt_blob_questions'];
			$newProducts->setProducts();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newProducts->uuid = $_REQUEST['txt_uuid'];
			$newProducts->name = $_REQUEST['txt_name'];
			$newProducts->price = $_REQUEST['txt_price'];
			$newProducts->blob_questions = $_REQUEST['txt_blob_questions'];
			$newProducts->updateProducts($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newProducts->deleteProducts($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newProducts->message);
	}
?>