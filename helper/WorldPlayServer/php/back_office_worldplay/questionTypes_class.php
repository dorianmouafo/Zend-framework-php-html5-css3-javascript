<?
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
Class questiontypes
	{
	// variables correspondant aux champs de la table questiontypes
	var $id;
	var $uuid;
	var $name;
	var $code;
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function questiontypes()
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
	function getQuestiontypes($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM questiontypes ";
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
			$this->name = mysql_result($rsql, 0, "name");
			$this->code = mysql_result($rsql, 0, "code");
			}
		}

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	
	// La forme du variable $whereCritere peut �tre la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut �tre la suivante :
	// critere1, critere2, critere3
	
	function getAllQuestiontypes($whereCritere='', $orderCritere='')
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM questiontypes ";
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
	function setQuestiontypes()
		{
		// Requ�te
		$sql = "INSERT INTO questiontypes (`uuid`, `name`, `code`, `id`) ";
		$sql .= "VALUES (
				'".$this->formatData($this->uuid)."',
				'".$this->formatData($this->name)."',
				'".$this->formatData($this->code)."',
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
	function updateQuestiontypes($id)
		{
		$sql = "UPDATE questiontypes SET ";
		$sql .= "`uuid` = '".$this->formatData($this->uuid)."', ";
		$sql .= "`name` = '".$this->formatData($this->name)."', ";
		$sql .= "`code` = '".$this->formatData($this->code)."', ";
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
	function deleteQuestiontypes($id)
		{
		// Requ�te
		$sql = "DELETE FROM questiontypes WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from questiontypes ");
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