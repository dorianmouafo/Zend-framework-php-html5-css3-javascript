<?
// Page cr��e le 15/09/2006 23:07:12 par myGenerator 2006
Class classe
	{
	// variables correspondant aux champs de la table classe
	var $id;
	var $Code;
	var $Nom;
	// $message contient le resultat de l'ex�cution des operations
	var $message;
	
	function classe()
		{
		$this->id = -1;
		// Informations de connexion de l'utilisateur
		$host = "localhost";
		$user = "root"; 
		$password = ""; 
		// Base des donn�es utilis�e
		$database_name = "exemple";
		// Connexion mysql
		$connexion = mysql_connect($host, $user, $password) or die (mysql_error());
		// S�lection de la base des donn�es
		$db = mysql_select_db($database_name, $connexion) or die(mysql_error());
		}

	// Recherche par le champ identifiant d'un enregistrement 
	function getClasse($id)
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM classe ";
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
			$this->Code = mysql_result($rsql, 0, "Code");
			$this->Nom = mysql_result($rsql, 0, "Nom");
			}
		}

	// Affichage par crit�re sp�cifi� de tous les enregistrements		
	function getAllClasse($critere='')
		{
		// Requ�te
		$sql = "SELECT * ";
		$sql .= "FROM classe ";
		if($critere)
			{
			$sql .= "Where $critere ";
			}
		$sql .= "Order by id";
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
	function setClasse()
		{
		// Requ�te
		$sql = "INSERT INTO classe (Code, Nom, id) ";
		$sql .= "VALUES (
				'".$this->formatData($this->Code)."',
				'".$this->formatData($this->Nom)."',
				'".$this->getNewId()."'); ";
		// Ex�cution et r�sultat
		if (mysql_query($sql))
			{
			$this->message = "Enregistrement effectu� avec succ�s!";
			}
		else 
			{
			$this->message = "Un probl�me est survenu lors de l'enregistrement!";
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
	function deleteClasse($id)
		{
		// Requ�te
		$sql = "DELETE FROM classe WHERE id = '$id';"; 
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
		$sql = mysql_query(" select max(id) from classe ");
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