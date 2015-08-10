<?
// Page cr��e le 29/11/2012 12:48:10 par myGenerator 2006
Class questions
	{
	// variables correspondant aux champs de la table questions
	var $id;
	var $uuid;
	var $teach_id;
	var $cat_id;
	var $qt_id;
	var $lang_id;
	var $lev_id;
	var $title;
	var $description;
	var $points;
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function questions()
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
	function getQuestions($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM questions ";
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
			$this->teach_id = mysql_result($rsql, 0, "teach_id");
			$this->cat_id = mysql_result($rsql, 0, "cat_id");
			$this->qt_id = mysql_result($rsql, 0, "qt_id");
			$this->lang_id = mysql_result($rsql, 0, "lang_id");
			$this->lev_id = mysql_result($rsql, 0, "lev_id");
			$this->title = mysql_result($rsql, 0, "title");
			$this->description = mysql_result($rsql, 0, "description");
			$this->points = mysql_result($rsql, 0, "points");
			}
		}

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	
	// La forme du variable $whereCritere peut �tre la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut �tre la suivante :
	// critere1, critere2, critere3
	
	function getAllQuestions($whereCritere='', $orderCritere='')
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM questions ";
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
	function setQuestions()
		{
		// Requ�te
		$sql = "INSERT INTO questions (`uuid`, `teach_id`, `cat_id`, `qt_id`, `lang_id`, `lev_id`, `title`, `description`, `points`, `id`) ";
		$sql .= "VALUES (
				'".$this->formatData($this->uuid)."',
				'".$this->formatData($this->teach_id)."',
				'".$this->formatData($this->cat_id)."',
				'".$this->formatData($this->qt_id)."',
				'".$this->formatData($this->lang_id)."',
				'".$this->formatData($this->lev_id)."',
				'".$this->formatData($this->title)."',
				'".$this->formatData($this->description)."',
				'".$this->formatData($this->points)."',
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
	function updateQuestions($id)
		{
		$sql = "UPDATE questions SET ";
		$sql .= "`uuid` = '".$this->formatData($this->uuid)."', ";
		$sql .= "`teach_id` = '".$this->formatData($this->teach_id)."', ";
		$sql .= "`cat_id` = '".$this->formatData($this->cat_id)."', ";
		$sql .= "`qt_id` = '".$this->formatData($this->qt_id)."', ";
		$sql .= "`lang_id` = '".$this->formatData($this->lang_id)."', ";
		$sql .= "`lev_id` = '".$this->formatData($this->lev_id)."', ";
		$sql .= "`title` = '".$this->formatData($this->title)."', ";
		$sql .= "`description` = '".$this->formatData($this->description)."', ";
		$sql .= "`points` = '".$this->formatData($this->points)."', ";
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
	function deleteQuestions($id)
		{
		// Requ�te
		$sql = "DELETE FROM questions WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from questions ");
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