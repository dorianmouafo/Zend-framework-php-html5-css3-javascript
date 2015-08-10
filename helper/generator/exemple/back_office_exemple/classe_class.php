<?
// Page créée le 15/09/2006 23:07:12 par myGenerator 2006
Class classe
	{
	// variables correspondant aux champs de la table classe
	var $id;
	var $Code;
	var $Nom;
	// $message contient le resultat de l'exécution des operations
	var $message;
	
	function classe()
		{
		$this->id = -1;
		// Informations de connexion de l'utilisateur
		$host = "localhost";
		$user = "root"; 
		$password = ""; 
		// Base des données utilisée
		$database_name = "exemple";
		// Connexion mysql
		$connexion = mysql_connect($host, $user, $password) or die (mysql_error());
		// Sélection de la base des données
		$db = mysql_select_db($database_name, $connexion) or die(mysql_error());
		}

	// Recherche par le champ identifiant d'un enregistrement 
	function getClasse($id)
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM classe ";
		$sql .= "WHERE id = '$id';"; 
		// Exécution
		$rsql = mysql_query($sql);
		// Résultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d'échec
			$this->id = -1; 
			}
		else
			{ 
			// Cas de succès
			$this->id = mysql_result($rsql, 0, "id");
			$this->Code = mysql_result($rsql, 0, "Code");
			$this->Nom = mysql_result($rsql, 0, "Nom");
			}
		}

	// Affichage par critère spécifié de tous les enregistrements		
	function getAllClasse($critere='')
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM classe ";
		if($critere)
			{
			$sql .= "Where $critere ";
			}
		$sql .= "Order by id";
		// Exécution						
		$rsql = mysql_query($sql);
		// Résultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d'échec
			$this->id = -1; 
			}
		else
			{ 
			// Cas de succès
			$ret = array();
			while($line=mysql_fetch_object($rsql))
				{
					$ret[] = $line;
				}
			return $ret;
			}
			
		}
		
	// Enregistrement d'un enregistrement
	function setClasse()
		{
		// Requête
		$sql = "INSERT INTO classe (Code, Nom, id) ";
		$sql .= "VALUES (
				'".$this->formatData($this->Code)."',
				'".$this->formatData($this->Nom)."',
				'".$this->getNewId()."'); ";
		// Exécution et résultat
		if (mysql_query($sql))
			{
			$this->message = "Enregistrement effectué avec succès!";
			}
		else 
			{
			$this->message = "Un problème est survenu lors de l'enregistrement!";
			}
		}			

	// Modification d'un enregistrement
	function updateClasse($id)
		{
		$sql = "UPDATE classe SET ";
		$sql .= "Code = '".$this->formatData($this->Code)."', ";
		$sql .= "Nom = '".$this->formatData($this->Nom)."', ";
		$sql .= "id = '$id' ";
		$sql .= "WHERE id = '$id';"; 
		// Exécution et résultat
		if(mysql_query($sql))
			{
			$this->message = "Modification effectué avec succès!";
			}
		else 
			{
			$this->message = "Un problème est survenu lors de la modification!";
			}
		}

	// Suppression d'un enregistrement
	function deleteClasse($id)
		{
		// Requête
		$sql = "DELETE FROM classe WHERE id = '$id';"; 
		// Exécution et résultat	
		if (mysql_query($sql)) 
			{
			$this->message = "Suppression effectué avec succès!";
			}
		else
			{ 
			$this->message = "Un problème est survenu lors de la suppression!";
			}
		}

	// Création d'un nouveau id par incrémentation	
	function getNewId()
		{
		$sql = mysql_query(" select max(id) from classe ");
		$line = mysql_fetch_row($sql);
		$newId = $line[0]+1;
		return $newId;
		}

	// Formattage des données pour éviter les éventuels problèmes qui peuvent être causés par les caractères interprétables par PHP, par Mysql ou par HTML (accentués ou spéciaux)
	function formatData($d)
		{
		return (htmlentities($d, ENT_QUOTES));
		}		
	}
?>