<? 
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
require_once('prices_class.php');
$newPrices = new prices();

if(isset($_REQUEST['cmd_submit']))
	{
	//Choix de l'op�ration
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
	
	//R�direction + r�sultat de l'ex�cution
	header('Location: '.$_REQUEST['redirect'].'?message='.$newPrices->message);
	}
?>