<?
// Page créée le 29/11/2012 12:48:10 par myGenerator 2006
Class answers
	{
	// variables correspondant aux champs de la table answers
	var $id;
	var $uuid;
	var $ques_uuid;
	var $ans_1;
	var $ans_2;
	var $ans_3;
	var $ans_4;
	var $sol_1;
	var $sol_2;
	var $sol_3;
	var $sol_4;
	// $message contient le resultat de l'exécution des operations
	var $message;
	
	function answers()
		{
		$this->id = -1;
		// Informations de connexion de l'utilisateur
		$host = "localhost";
		$user = "root"; 
		$password = "root"; 
		// Base des données utilisée
		$database_name = "worldplay";
		// Connexion mysql
		$connexion = mysql_connect($host, $user, $password) or die (mysql_error());
		// Sélection de la base des données
		$db = mysql_select_db($database_name, $connexion) or die(mysql_error());
		}

	// Recherche par le champ identifiant d'un enregistrement 
	function getAnswers($id)
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM answers ";
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
			$this->uuid = mysql_result($rsql, 0, "uuid");
			$this->ques_uuid = mysql_result($rsql, 0, "ques_uuid");
			$this->ans_1 = mysql_result($rsql, 0, "ans_1");
			$this->ans_2 = mysql_result($rsql, 0, "ans_2");
			$this->ans_3 = mysql_result($rsql, 0, "ans_3");
			$this->ans_4 = mysql_result($rsql, 0, "ans_4");
			$this->sol_1 = mysql_result($rsql, 0, "sol_1");
			$this->sol_2 = mysql_result($rsql, 0, "sol_2");
			$this->sol_3 = mysql_result($rsql, 0, "sol_3");
			$this->sol_4 = mysql_result($rsql, 0, "sol_4");
			}
		}

	// Affichage par critère spécifié de tous les enregistrements		
	
	// La forme du variable $whereCritere peut être la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut être la suivante :
	// critere1, critere2, critere3
	
	function getAllAnswers($whereCritere='', $orderCritere='')
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM answers ";
		if($whereCritere)
			{
			$sql .= "Where $whereCritere ";
			}
		if($orderCritere)
			{
			$sql .= "Order by $orderCritere ";
			}
		/*if($critere)
			{
			$sql .= "Where $critere ";
			}
		$sql .= "Order by id";*/
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
	function setAnswers()
		{
		// Requête
		$sql = "INSERT INTO answers (`uuid`, `ques_uuid`, `ans_1`, `ans_2`, `ans_3`, `ans_4`, `sol_1`, `sol_2`, `sol_3`, `sol_4`, `id`) ";
		$sql .= "VALUES (
				'".$this->formatData($this->uuid)."',
				'".$this->formatData($this->ques_uuid)."',
				'".$this->formatData($this->ans_1)."',
				'".$this->formatData($this->ans_2)."',
				'".$this->formatData($this->ans_3)."',
				'".$this->formatData($this->ans_4)."',
				'".$this->formatData($this->sol_1)."',
				'".$this->formatData($this->sol_2)."',
				'".$this->formatData($this->sol_3)."',
				'".$this->formatData($this->sol_4)."',
				'".$this->getNewId()."'); ";
		// Exécution et résultat
		if (mysql_query($sql))
			{
			$this->message = "OK";
			}
		else 
			{
			$this->message = "KO";
			}
		}			

	// Modification d'un enregistrement
	function updateAnswers($id)
		{
		$sql = "UPDATE answers SET ";
		$sql .= "`uuid` = '".$this->formatData($this->uuid)."', ";
		$sql .= "`ques_uuid` = '".$this->formatData($this->ques_uuid)."', ";
		$sql .= "`ans_1` = '".$this->formatData($this->ans_1)."', ";
		$sql .= "`ans_2` = '".$this->formatData($this->ans_2)."', ";
		$sql .= "`ans_3` = '".$this->formatData($this->ans_3)."', ";
		$sql .= "`ans_4` = '".$this->formatData($this->ans_4)."', ";
		$sql .= "`sol_1` = '".$this->formatData($this->sol_1)."', ";
		$sql .= "`sol_2` = '".$this->formatData($this->sol_2)."', ";
		$sql .= "`sol_3` = '".$this->formatData($this->sol_3)."', ";
		$sql .= "`sol_4` = '".$this->formatData($this->sol_4)."', ";
		$sql .= "`id` = '$id' ";
		$sql .= "WHERE `id` = '$id';"; 
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
	function deleteAnswers($id)
		{
		// Requête
		$sql = "DELETE FROM answers WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from answers ");
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