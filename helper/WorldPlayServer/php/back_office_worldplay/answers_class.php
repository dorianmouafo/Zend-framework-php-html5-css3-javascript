<?
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
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
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function answers()
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
	function getAnswers($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM answers ";
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

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	
	// La forme du variable $whereCritere peut �tre la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut �tre la suivante :
	// critere1, critere2, critere3
	
	function getAllAnswers($whereCritere='', $orderCritere='')
		{
		// Requ�te
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
	function setAnswers()
		{
		// Requ�te
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
	function deleteAnswers($id)
		{
		// Requ�te
		$sql = "DELETE FROM answers WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from answers ");
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