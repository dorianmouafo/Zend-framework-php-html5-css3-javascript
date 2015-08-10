<?
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006

// initialisation des options de configuration de php
	ini_set("register_globals","off");
	ini_set("display_errors","off");  
	ini_set("expose_php","off");

// Choix du titre de l'action
switch ($_REQUEST["action"]) 
	{
    case "Enregistrer":
        $dConfig["titreAction"]="Enregistrement";
        break;
    case "Modifier":
        $dConfig["titreAction"]="Modification";
        break;
    case "Supprimer":
        $dConfig["titreAction"]="Suppression";
        break;
	case "Activer":
        $dConfig["titreAction"]="Activation";
        break;
	case "Désactiver":
        $dConfig["titreAction"]="Désactivation";
        break;
	default:
		$_REQUEST["action"]="Consulter";
		$dConfig["titreAction"]="Consultation";
        break;
	}
?>