<?
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
Class profiles
	{
	// variables correspondant aux champs de la table profiles
	var $id;
	var $uuid;
	var $lang_id;
	var $lev_id;
	var $lev_goal_id;
	var $user_id;
	var $points_questions;
	var $points_answers;
	var $blob_ques_points;
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function profiles()
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
	function getProfiles($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM profiles ";
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
			$this->lang_id = mysql_result($rsql, 0, "lang_id");
			$this->lev_id = mysql_result($rsql, 0, "lev_id");
			$this->lev_goal_id = mysql_result($rsql, 0, "lev_goal_id");
			$this->user_id = mysql_result($rsql, 0, "user_id");
			$this->points_questions = mysql_result($rsql, 0, "points_questions");
			$this->points_answers = mysql_result($rsql, 0, "points_answers");
			$this->blob_ques_points = mysql_result($rsql, 0, "blob_ques_points");
			}
		}

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	
	// La forme du variable $whereCritere peut �tre la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut �tre la suivante :
	// critere1, critere2, critere3
	
	function getAllProfiles($whereCritere='', $orderCritere='')
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM profiles ";
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
	function setProfiles()
		{
		// Requ�te
		$sql = "INSERT INTO profiles (`uuid`, `lang_id`, `lev_id`, `lev_goal_id`, `user_id`, `points_questions`, `points_answers`, `blob_ques_points`, `id`) ";
		$sql .= "VALUES (
				'".$this->formatData($this->uuid)."',
				'".$this->formatData($this->lang_id)."',
				'".$this->formatData($this->lev_id)."',
				'".$this->formatData($this->lev_goal_id)."',
				'".$this->formatData($this->user_id)."',
				'".$this->formatData($this->points_questions)."',
				'".$this->formatData($this->points_answers)."',
				'".$this->formatData($this->blob_ques_points)."',
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
	function updateProfiles($id)
		{
		$sql = "UPDATE profiles SET ";
		$sql .= "`uuid` = '".$this->formatData($this->uuid)."', ";
		$sql .= "`lang_id` = '".$this->formatData($this->lang_id)."', ";
		$sql .= "`lev_id` = '".$this->formatData($this->lev_id)."', ";
		$sql .= "`lev_goal_id` = '".$this->formatData($this->lev_goal_id)."', ";
		$sql .= "`user_id` = '".$this->formatData($this->user_id)."', ";
		$sql .= "`points_questions` = '".$this->formatData($this->points_questions)."', ";
		$sql .= "`points_answers` = '".$this->formatData($this->points_answers)."', ";
		$sql .= "`blob_ques_points` = '".$this->formatData($this->blob_ques_points)."', ";
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
	function deleteProfiles($id)
		{
		// Requ�te
		$sql = "DELETE FROM profiles WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from profiles ");
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