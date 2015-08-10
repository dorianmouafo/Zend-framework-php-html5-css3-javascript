<? 
// Page créée le 03/12/2012 16:21:25 par myGenerator 2006
require_once('prices_class.php');
$newPrices = new prices();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch ($_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':
			$newPrices->uuid = $_REQUEST['txt_uuid'];
			$newPrices->name = $_REQUEST['txt_name'];
			$newPrices->price = $_REQUEST['txt_price'];
			$newPrices->setPrices();
			break;
		
		//Cas de modification
		case 'Modifier':
			$newPrices->uuid = $_REQUEST['txt_uuid'];
			$newPrices->name = $_REQUEST['txt_name'];
			$newPrices->price = $_REQUEST['txt_price'];
			$newPrices->updatePrices($_REQUEST['txt_id']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			$newPrices->deletePrices($_REQUEST['txt_id']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newPrices->message);
	}
?>