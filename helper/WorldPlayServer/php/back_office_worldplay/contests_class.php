<?
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
Class contests
	{
	// variables correspondant aux champs de la table contests
	var $id;
	var $uuid;
	var $cp_id;
	var $teach_id;
	var $name;
	var $data;
	var $blob_questions;
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function contests()
		{
		$this->id = -1;
		// Informations de connexion de l'utilisateur
		$host = "localhost";
		$user = "root"; 
		$password = "root"; 
		// Base des donn�es utilis�e
		$database_name = "worldplay";
		// Connexion mysql
		$connexion = mysql_connect($host, $user, $password) or die (mysql_error());
		// S�lection de la base des donn�es
		$db = mysql_select_db($database_name, $connexion) or die(mysql_error());
		}

	// Recherche par le champ identifiant d'un enregistrement 
	function getContests($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM contests ";
		$sql .= "WHERE id = '$id';"; 
		// Ex�cution
		$rsql = mysql_query($sql);
		// R�sultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d'�chec
			$this->id = -1; 
			}
		else
			{ 
			// Cas de succ�s
			$this->id = mysql_result($rsql, 0, "id");
			$this->uuid = mysql_result($rsql, 0, "uuid");
			$this->cp_id = mysql_result($rsql, 0, "cp_id");
			$this->teach_id = mysql_result($rsql, 0, "teach_id");
			$this->name = mysql_result($rsql, 0, "name");
			$this->data = mysql_result($rsql, 0, "data");
			$this->blob_questions = mysql_result($rsql, 0, "blob_questions");
			}
		}

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	
	// La forme du variable $whereCritere peut �tre la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut �tre la suivante :
	// critere1, critere2, critere3
	
	function getAllContests($whereCritere='', $orderCritere='')
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM contests ";
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
		// Ex�cution						
		$rsql = mysql_query($sql);
		// R�sultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d'�chec
			$this->id = -1; 
			}
		else
			{ 
			// Cas de succ�s
			$ret = array();
			while($line=mysql_fetch_object($rsql))
				{
					$ret[] = $line;
				}
			return $ret;
			}
			
		}
		
	// Enregistrement d'un enregistrement
	function setContests()
		{
		// Requ�te
		$sql = "INSERT INTO contests (`uuid`, `cp_id`, `teach_id`, `name`, `data`, `blob_questions`, `id`) ";
		$sql .= "VALUES (
				'".$this->formatData($this->uuid)."',
				'".$this->formatData($this->cp_id)."',
				'".$this->formatData($this->teach_id)."',
				'".$this->formatData($this->name)."',
				'".$this->formatData($this->data)."',
				'".$this->formatData($this->blob_questions)."',
				'".$this->getNewId()."'); ";
		// Ex�cution et r�sultat
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
	function updateContests($id)
		{
		$sql = "UPDATE contests SET ";
		$sql .= "`uuid` = '".$this->formatData($this->uuid)."', ";
		$sql .= "`cp_id` = '".$this->formatData($this->cp_id)."', ";
		$sql .= "`teach_id` = '".$this->formatData($this->teach_id)."', ";
		$sql .= "`name` = '".$this->formatData($this->name)."', ";
		$sql .= "`data` = '".$this->formatData($this->data)."', ";
		$sql .= "`blob_questions` = '".$this->formatData($this->blob_questions)."', ";
		$sql .= "`id` = '$id' ";
		$sql .= "WHERE `id` = '$id';"; 
		// Ex�cution et r�sultat
		if(mysql_query($sql))
			{
			$this->message = "Modification effectu� avec succ�s!";
			}
		else 
			{
			$this->message = "Un probl�me est survenu lors de la modification!";
			}
		}

	// Suppression d'un enregistrement
	function deleteContests($id)
		{
		// Requ�te
		$sql = "DELETE FROM contests WHERE id = '$id';"; 
		// Ex�cution et r�sultat	
		if (mysql_query($sql)) 
			{
			$this->message = "Suppression effectu� avec succ�s!";
			}
		else
			{ 
			$this->message = "Un probl�me est survenu lors de la suppression!";
			}
		}

	// Cr�ation d'un nouveau id par incr�mentation	
	function getNewId()
		{
		$sql = mysql_query(" select max(id) from contests ");
		$line = mysql_fetch_row($sql);
		$newId = $line[0]+1;
		return $newId;
		}

	// Formattage des donn�es pour �viter les �ventuels probl�mes qui peuvent �tre caus�s par les caract�res interpr�tables par PHP, par Mysql ou par HTML (accentu�s ou sp�ciaux)
	function formatData($d)
		{
		return (htmlentities($d, ENT_QUOTES));
		}		
	}
?>