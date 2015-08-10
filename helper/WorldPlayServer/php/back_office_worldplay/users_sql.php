<? 
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
require_once('users_class.php');
$newUsers = new users();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newUsers->uuid = $_REQUEST['txt_uuid'];
			$newUsers->name = $_REQUEST['txt_name'];
			$newUsers->email = $_REQUEST['txt_email'];
			$newUsers->password = $_REQUEST['txt_password'];
			$newUsers->blob_styles = $_REQUEST['txt_blob_styles'];
			$newUsers->isprof = $_REQUEST['txt_isprof'];
			$newUsers->setUsers();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newUsers->uuid = $_REQUEST['txt_uuid'];
			$newUsers->name = $_REQUEST['txt_name'];
			$newUsers->email = $_REQUEST['txt_email'];
			$newUsers->password = $_REQUEST['txt_password'];
			$newUsers->blob_styles = $_REQUEST['txt_blob_styles'];
			$newUsers->isprof = $_REQUEST['txt_isprof'];
			$newUsers->updateUsers($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newUsers->deleteUsers($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newUsers->message);
	}
?>