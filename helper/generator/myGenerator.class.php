<?
/********************************************************/
/*  myGenerator.class.php  v 1.1 du 31/08/2006          */ 
/*  Crée par NIYIBIZI Emile Bniz (bnizworks@gmail.com)  */
/*  pour myGenerator 2006 (http://www.myGenerator.com)  */
/*  Licence d'utilisation GNU/GPL                       */
/*  Copie de sécurite safe/myGenerator.class-safe.php   */
/*  A utiliser avec précaution : certainess fonctions   */
/*  peuventeffacer vos fichiers et/ou dossiers sans     */
/*  demander votre confirmation                         */
/********************************************************/
Class mygenerator
	{
	// variables 
	var $host;
	var $user; 
	var $pwd; 
	var $connexion;
	var $db_name;
	var $backOfficeDir ;
	var $temporaryDir;
	var $backOfficeFileList;


	function myGenerator($database='')
		{
		$filename = 'infos_de_connexion.txt';
		if (file_exists($filename)) 
			{
			$f = fopen ($filename,'r');
			if (!feof ($f)) 
				{
				$buffer = fgets($f, 4096);
				list($this->user,$this->host,$this->pwd) = explode(";",$buffer);
				}
			fclose ($f);
			}
		// Connexion mysql
		$this->connexion = mysql_connect($this->host, $this->user, $this->pwd);
		// Si la base des données a été spécifiée
		if($database)
			{
			// Sélection de la base des données
			$this->db_name = $database;
			$db = mysql_select_db($this->db_name, $this->connexion) or die(mysql_error());
			}
		// Dossier back office
		$this->backOfficeDir = 'back_office_'.$this->db_name;
		// Dossier temporaire 
		$this->temporaryDir = 'tmp';
		}

	// Toutes les bases de données de mysql
	function getAllDataBases ()
		{
		// Requête + exécution
		$db_list = mysql_list_dbs($this->connexion);
		// Résultat
		$rst = array();
		while ($row = mysql_fetch_object($db_list)) 
			{
			$rst[] = $row;
			}
		return $rst;
		}
	
	// Toutes les tables de la base des données selectionnée
	function getAllTables ()
		{
		// Requête + exécution
		$sql = mysql_list_tables($this->db_name);
		// Résultat
		$rst = array();
		while ($row = mysql_fetch_row($sql)) 
			{
			$rst[] = $row[0];
			}
		mysql_free_result($sql);
		return $rst;
		}
	
	// Tous les champs de la table spécifiée
	function getAllFields ($table='')
		{
		// Requête + exécution
		$sql = mysql_list_fields($this->db_name, $table);
		// Résultat
		$columns = mysql_num_fields($sql);
		$rst = array();
		for ($i = 0; $i < $columns; $i++) 
			{
			$rst[$i]['name'] = mysql_field_name($sql, $i); // Le nom du champ 
			$rst[$i]['type'] = mysql_field_type($sql, $i); // Le type du champ
			$rst[$i]['len'] = mysql_field_len($sql, $i); // La taille du champ
			$rst[$i]['flags'] = mysql_field_flags($sql, $i); // Les indicateurs associés au champ
			// Le champ est-il un identifiant
			$rst[$i]['isId'] = in_array("primary_key", explode(" ",$rst[$i]['flags'])); 
			}
		mysql_free_result($sql);
		return $rst;
		}
	
	// Les champs relations pour la liste de selection
	function getAllRelationFields ($table)
		{
		// Requête + exécution
		$sql1 = mysql_list_tables($this->db_name);
		// Résultat
		$arr = array();
		while ($tbl = mysql_fetch_row($sql1)) 
			{
			$sql2 = mysql_list_fields($this->db_name, $tbl[0]);
			$cols = mysql_num_fields($sql2);
			// cle primaire 
			$primaryKeyField='';
			for ($m = 0; $m < $cols; $m++) 
				{
				if(in_array("primary_key", explode(" ", mysql_field_flags($sql2, $m))))
					{
					$primaryKeyField = mysql_field_name($sql2, $m);
					}
				}
			
			for ($m = 0; $m < $cols; $m++) 
				{
				$t=$tbl[0];
				$fieldName = mysql_field_name($sql2, $m);
				//
				//if($t!=$table)die (print($tbl[0].' '.$table));
				if(($t!=$table) && (!empty($primaryKeyField)) && ($fieldName != $primaryKeyField))
					{
					$arr[] = $tbl[0].' - '.$fieldName.' - '.$primaryKeyField;
					}
				}
			}
		mysql_free_result($sql1);
		mysql_free_result($sql2);
		return $arr;
		}

	// vider un dossier
	function getNewNameDir()
		{
		$dir = '.';
		$v = 1;
		if ($dh = opendir($dir)) 
			{
			while (($file = readdir($dh)) !== false) 
				{
				$fileUrl = $dir."/".$file; 
				
				if(is_dir($fileUrl))
					{
					if(substr($file, 0, strlen($this->backOfficeDir)) == $this->backOfficeDir)
						{
						$i = substr($file, strlen($this->backOfficeDir), strlen($file));
						if($i!='' && $i==$v)
							{$v++;}
						}
					}
				}
			closedir($dh);
			}
		return ($this->backOfficeDir.$v);
		}

// vider un dossier
	function emptyDir($dir)
		{
		if(is_dir($dir))
			{
			if ($dh = opendir($dir)) 
				{
				while (($file = readdir($dh)) !== false) 
					{
					$fileUrl = $dir."/".$file; 
					
					if(is_dir($fileUrl) && $file != '..'  && $file != '.')
						{
						$this->emptyDir($fileUrl);
						rmdir($fileUrl);
						}
					elseif($file != '..'  && $file != '.') 
						{
						unlink($fileUrl);
						}
					}
				closedir($dh);
				}
			}
		return true;
		}

	// Copier le contenu de tmp vers un dossier
	function copyFiles($dir2copy, $dir_paste)
		{
		$i = 0;
		// On vérifie si $dir2copy est un dossier
		if (is_dir($dir2copy)) 
			{
			// Si oui, on l'ouvre
			if ($dh = opendir($dir2copy)) 
				{     
				// On liste les dossiers et fichiers de $dir2copy
				while (($file = readdir($dh)) !== false) 
					{
					// Si le dossier dans lequel on veut coller n'existe pas, on le créé
					if (!is_dir($dir_paste)) 
						{
						mkdir ($dir_paste, 0777);
						}
					// S'il sagit d'un fichier, on le copie simplement
					if(!is_dir($dir2copy.'/'.$file) && $file != '..'  && $file != '.') 
						{
						$this->backOfficeFileList[$i] = $file;
						copy ( $dir2copy.'/'.$file, $dir_paste.'/'.$file );
						$i++;
						}
					}
			// On ferme $dir2copy
			closedir($dh);
			}
		}   
	}
	
	// Génération de la page index.php	
	function generateIndexPage($arr)
		{
		// Contenu de la page à générer
		$contenuPage=
'<!-- Page créée le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).' par myGenerator 2006 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Back office pour la base des données : '.$this->db_name.'</title>
<style type="text/css">
<!--
BODY {
	BACKGROUND-COLOR: #ffffff;
	margin: 10px 10px 10px 10px;
}
INPUT, TEXTAREA, SELECT, FONT, TD, BODY, A, TH{
	FONT-FAMILY: verdana, "Verdana Ref";
	font-size:10px;
}

-->
</style>
</head>

<body style="font-family:Verdana">
<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th colspan="3" bgcolor="#EAEAEA"><div align="center"><strong>Back office pour la base des donn&eacute;es : '.strtoupper($this->db_name).'</strong></div></th>
  </tr>
  <tr>
    <td height="100%" colspan="3" bgcolor="#FFFFFF"><div align="center">
      <table border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th colspan="2" bgcolor="#FFFFFF"><div align="left"><strong>Administration</strong></div></th>
          </tr>
';
		$i=0; $ii=1;
		while ($i < $arr['nbTables'])
			{
			if(!empty($arr[$arr['table'][$i].'_checked']))
				{
$contenuPage = $contenuPage.
'		  <tr>
			<td bgcolor="#FFFFFF">'.($ii++).'</td>
            <td nowrap bgcolor="#FFFFFF"><div align="left"><strong>'.$arr['table'][$i].'</strong> (<a href="'.$arr['table'][$i].'.php?action=Enregistrer">Enregistrer</a>, <a href="'.$arr['table'][$i].'.php?action=Modifier">Modifier</a>, <a href="'.$arr['table'][$i].'.php?action=Supprimer">Supprimer</a>, <a href="'.$arr['table'][$i].'.php?action=Consulter">Consulter</a>) </div></td>
		  </tr>
';
				 }
			$i++;
			}
$contenuPage = $contenuPage.
'		  </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center" style="font-size:10px ">Back office cr&eacute;e le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).' </div></td>
  </tr>
</table>
</body>

</html>';
		// Nom et url de la page à générer
		$pageName = "index.php";
		$pageUrl = $this->backOfficeDir."/".$pageName;
		// Création de la page
		$f = fopen($pageUrl, "w+");
		fputs($f, $contenuPage);
		fclose($f);
		return $pageName;
		}
	
	// Génération de la page config.php	
	function generateConfigPage()
		{
		// Contenu de la page à générer
		$contenuPage=
'<?
// Page créée le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).' par myGenerator 2006

// initialisation des options de configuration de php
	ini_set("register_globals","off");
	ini_set("display_errors","off");  
	ini_set("expose_php","off");

// Choix du titre de l\'action
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
?>';
		
		// Nom et url de la page à générer
		$pageName = "config.php";
		$pageUrl = $this->backOfficeDir."/".$pageName;
		// Création de la page
		$f = fopen($pageUrl, "w+");
		fputs($f, $contenuPage);
		fclose($f);
		return $pageName;
		}
		
	// Génération de la page table.php
	function generatePage($arr, $nbtable)
		{
		// Contenu de la page à générer
		$contenuPage=
'<? 
include(\'config.php\');
require_once(\''.$arr['table'][$nbtable].'_class.php\');
'."$".'new'.ucfirst($arr['table'][$nbtable]).' = new '.$arr['table'][$nbtable].'();';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
		list($relationTable, $relationChamp, $relationCle) = explode(" - ", $arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]);
$contenuPage = $contenuPage.'
require_once(\''.$relationTable.'_class.php\');
'."$".'new'.ucfirst($relationTable).' = new '.$relationTable.'(); ';		
		}
	$j++;
	}
$contenuPage = $contenuPage.
'

?>
<!-- Page créée le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).' par myGenerator 2006 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>'.ucfirst($arr['table'][$nbtable]).' - <? echo '."$".'dConfig[\'titreAction\']; ?></title>
<script language="javascript">
<!--
function isDataValid(theForm)
	{
';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.
'	if(theForm.txt_'.$arr[$arr['table'][$nbtable].'_field'][$j].'.value == ""){
		alert("'.ucfirst($arr[$arr['table'][$nbtable].'_field'][$j]).' invalide!");
		theForm.txt_'.$arr[$arr['table'][$nbtable].'_field'][$j].'.focus();
		return (false);
		}
';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.
'	if(theForm.cbx_'.$arr[$arr['table'][$nbtable].'_field'][$j].'.selectedIndex == 0)
		{
		alert("'.$arr[$arr['table'][$nbtable].'_field'][$j].' invalide!");
		theForm.cbx_'.$arr[$arr['table'][$nbtable].'_field'][$j].'.focus();
		return (false);
		}
';		
		}
	$j++;
	}

$contenuPage = $contenuPage.
'	}
//-->
</script>
<style type="text/css">
<!--
BODY {
	BACKGROUND-COLOR: #ffffff;
	margin: 10px 10px 10px 10px;
}
INPUT, TEXTAREA, SELECT, FONT, TD, BODY, A, TH{
	FONT-FAMILY: verdana, "Verdana Ref";
	font-size:10px;
}

-->
</style>
</head>

<body style="font-family:Verdana ">
<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th colspan="3" bgcolor="#EAEAEA"><div align="center"><strong>Back office pour la base des donn&eacute;es : '.strtoupper($this->db_name).'</strong></div></th>
  </tr>
  <tr>
    <td height="100%" colspan="3" bgcolor="#FFFFFF"><div align="center">
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><a href="index.php">Administration</a> &gt; '.ucfirst($arr['table'][$nbtable]).' </td>
        </tr>
        <tr>
          <td height="100%"><div align="center">
            <table border="0" cellspacing="0" cellpadding="5">
                <tr valign="top">
                  <td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                      <tr>
                        <th bgcolor="#FFFFFF"><div align="left"><strong>Op&eacute;ration</strong></div></th>
                      </tr>
                      <tr>
                        <td nowrap bgcolor="#FFFFFF"><div align="left"><a href="?action=Enregistrer"><img src="enregistrer_by_bniz.png" width="16" height="16" hspace="3" border="0" align="absmiddle">Enregistrer</a></div></td>
                      </tr>
                      <tr>
                        <td nowrap bgcolor="#FFFFFF"><div align="left"><a href="?action=Modifier"><img src="modifier_by_bniz.png" width="16" height="16" hspace="3" border="0" align="absmiddle">Modifier</a></div></td>
                      </tr>
                      <tr>
                        <td nowrap bgcolor="#FFFFFF"><div align="left"><a href="?action=Supprimer"><img src="supprimer_by_bniz.png" width="16" height="16" hspace="3" border="0" align="absmiddle">Supprimer</a></div></td>
                      </tr>
                      <tr>
                        <td nowrap bgcolor="#FFFFFF"><div align="left"><a href="?action=Consulter"><img src="consulter_by_bniz.png" width="16" height="16" hspace="3" border="0" align="absmiddle">Consulter</a></div></td>
                      </tr>
                  </table></td>
                  <td><table border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
                      <tr>
                        <th bgcolor="#FFFFFF"><div align="left"><strong>'.ucfirst($arr['table'][$nbtable]).' &raquo; <? echo '."$".'dConfig[\'titreAction\']; ?> </strong></div></th>
                      </tr>
                      <form name="form'.ucfirst($arr['table'][$nbtable]).'" onSubmit="return(isDataValid(this))" method="post" action="'.$arr['table'][$nbtable].'_sql.php?action=<? echo '."$".'_REQUEST[\'action\'];?>">
                        <tr>
                          <td nowrap bgcolor="#FFFFFF"><div align="left">
                              <?
if(('."$".'_REQUEST[\'action\']=="Enregistrer")||('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\']))
	{
	if('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\'])
		{
		'."$".'new'.ucfirst($arr['table'][$nbtable]).'->get'.ucfirst($arr['table'][$nbtable]).'('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\']);
		}
	
?>
                              <input name="redirect" type="hidden" value="<? echo "http://".'."$".'_SERVER[\'HTTP_HOST\'].'."$".'_SERVER[\'PHP_SELF\'];?>">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                  <tr>
                                    <td nowrap bgcolor="#FFFFFF"><input type="hidden" name="txt_'.$arr[$arr['table'][$nbtable].'_idField'].'" value="<? if ('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\']){echo '."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\'];} ?>">
                                        <table width="100%" border="0" cellpadding="3" cellspacing="0">';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.
'                                           <tr valign="top">
                                            <td nowrap>'.ucfirst($arr[$arr['table'][$nbtable].'_field'][$j]).'</td>
                                            <td><input type="text" name="txt_'.$arr[$arr['table'][$nbtable].'_field'][$j].'" maxlength="'.$arr[$arr['table'][$nbtable].'_len'][$j].'" value="<? if ('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\']){echo '."$".'new'.ucfirst($arr['table'][$nbtable]).'->'.$arr[$arr['table'][$nbtable].'_field'][$j].';} ?>" <? if('."$".'_REQUEST[\'action\']=="Supprimer"){?>readonly="1"<? }?>></td>
                                          ';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
list($relationTable, $relationChamp, $relationCle) = explode(" - ", $arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]);

$contenuPage = $contenuPage.
'											<tr valign="top">
                                            <td nowrap>'.ucfirst($arr[$arr['table'][$nbtable].'_field'][$j]).'</td>
											<td><select name="cbx_'.$arr[$arr['table'][$nbtable].'_field'][$j].'" <? if('."$".'_REQUEST[\'action\']=="Supprimer"){?> disabled<? }?>>
<option value=""></option>
<? 
	$array'.ucfirst($relationTable).' = '."$".'new'.ucfirst($relationTable).'->getAll'.ucfirst($relationTable).'();
	
	if (!empty('."$".'array'.ucfirst($relationTable).'))
		{
		$i=0; 
		while(!empty('."$".'array'.ucfirst($relationTable).'[$i]))
			{
			?>
			<option <? if ('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\'] && ('."$".'new'.ucfirst($arr['table'][$nbtable]).'->'.$arr[$arr['table'][$nbtable].'_field'][$j].' == '."$".'array'.ucfirst($relationTable).'['."$".'i]->'.$relationCle.')){echo \'selected\';} ?> value="<? echo '."$".'array'.ucfirst($relationTable).'['."$".'i]->'.$relationCle.';?>"><? echo '."$".'array'.ucfirst($relationTable).'['."$".'i]->'.$relationChamp.';?></option>
			<? 
			'."$".'i++;
			}
		}
			
?>                                                
</select></td></tr>';		
		}
	
	$j++;
	}
$contenuPage = $contenuPage.
'                                      </table>
                                        <div align="left"></div></td>
                                  </tr>
                                  <tr>
                                    <td nowrap bgcolor="#CCCCCC"><div align="left">
                                        <input type="submit" name="cmd_submit" value="<? echo '."$".'_REQUEST[\'action\'];?>" <? if ('."$".'_REQUEST[\'action\']=="Supprimer") {echo \'onClick="return(confirm(\\\'Voulez-vous r&eacute;ellement supprimer cet enregistrement?\\\'))"\';}?>>
                                        <input type="reset" name="reset" value="R&eacute;tablir">
                                      </div></td>
                                  </tr>
                                </table>
                                <?
	}
else
	{
	if('."$".'_REQUEST[\'message\']){echo \'<strong  style="color:#FF0000; ">\'.'."$".'_REQUEST[\'message\'].\'</strong>\';}
?>
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#F5F5F5">
                                  <tr bgcolor="#CCCCCC">
                                    <th nowrap><div align="left">N&deg;</div></th>';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.
'                                     <th nowrap><div align="left">'.ucfirst($arr[$arr['table'][$nbtable].'_field'][$j]).'</div></th>';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.
'                                     <th nowrap><div align="left">'.ucfirst($arr[$arr['table'][$nbtable].'_field'][$j]).'</div></th>';		
		}
	$j++;
	}

$contenuPage = $contenuPage.
'                                    <? if('."$".'_REQUEST[\'action\']!="Consulter"){?>
                                    <th nowrap><div align="left">Op&eacute;ration</div></th>
                                    <? }?>
                                  </tr>
                                  <?
	'."$".'array='."$".'new'.ucfirst($arr['table'][$nbtable]).'->getAll'.ucfirst($arr['table'][$nbtable]).'(\''.$arr[$arr['table'][$nbtable].'_idField'].'>0\',\''.$arr[$arr['table'][$nbtable].'_idField'].'\');
	
	if (!empty('."$".'array))
		{
		'."$".'i=0; 
		while(!empty('."$".'array['."$".'i]))
			{
	?>
                                  <tr valign="top">
                                    <td bgcolor="#FFFFFF"><? echo '."$".'i+1;?></td>';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.
'                                    <td bgcolor="#FFFFFF"><? echo '."$".'array['."$".'i]->'.$arr[$arr['table'][$nbtable].'_field'][$j].';?></td>';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
list($relationTable, $relationChamp, $relationCle) = explode(" - ", $arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]);
$contenuPage = $contenuPage.
'                                    <td bgcolor="#FFFFFF"><? '."$".'new'.ucfirst($relationTable).'->'.$relationChamp.'=""; '."$".'new'.ucfirst($relationTable).'->get'.ucfirst($relationTable).'('."$".'array['."$".'i]->'.$arr[$arr['table'][$nbtable].'_field'][$j].'); echo '."$".'new'.ucfirst($relationTable).'->'.$relationChamp.';?></td>';
		}
	$j++;
	}

$contenuPage = $contenuPage.
'                                    <? if('."$".'_REQUEST[\'action\']!="Consulter")
			{?>
                                    <td bgcolor="#F7F7F7"><a href="?action=<? echo '."$".'_REQUEST[\'action\'].\'&'.$arr[$arr['table'][$nbtable].'_idField'].'=\'.'."$".'array['."$".'i]->'.$arr[$arr['table'][$nbtable].'_idField'].';?>">
                                      <? echo '."$".'_REQUEST[\'action\'];?>
                                      </a></td>
                                  </tr>
                                  <? 	}?>
                                  <? 		'."$".'i++;} 
	}
else
	{?>
                                  <tr>
                                    <td colspan="30" bgcolor="#FFFFFF">Aucune information n\'a &eacute;t&eacute; trouv&eacute;! </td>
                                  </tr>
                                  <?	}?>
                                  </table>
                                <?
	}	
?>
                          </div></td>
                        </tr>
                      </form>
                  </table></td>
                </tr>
                      </table>
          </div></td>
        </tr>
      </table>
      </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center" style="font-size:10px ">Back office cr&eacute;e le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).'  </div></td>
  </tr>
</table>
</body>

</html>';
		
		// Nom et url de la page à générer
		$pageName = $arr['table'][$nbtable].".php";
		$pageUrl = $this->backOfficeDir."/".$pageName;
		// Création de la page
		$f = fopen($pageUrl, "w+");
		fputs($f, $contenuPage);
		fclose($f);
		return $pageName;
		}

	// Génération de la page table_class.php
	function generateClassPage($arr, $nbtable)
		{
// Contenu de la page à générer
		$contenuPage=
'<?
// Page créée le '.date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))).' par myGenerator 2006
Class '.$arr['table'][$nbtable].'
	{
	// variables correspondant aux champs de la table '.$arr['table'][$nbtable].'
	var $'.$arr[$arr['table'][$nbtable].'_idField'].';';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.'
	var $'.$arr[$arr['table'][$nbtable].'_field'][$j].';';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.'
	var $'.$arr[$arr['table'][$nbtable].'_field'][$j].';';				
		}
	$j++;
	}

$contenuPage = $contenuPage.'
	// $message contient le resultat de l\'exécution des operations
	var $message;
	
	function '.$arr['table'][$nbtable].'()
		{
		$this->'.$arr[$arr['table'][$nbtable].'_idField'].' = -1;
		// Informations de connexion de l\'utilisateur
		$host = "'.$this->host.'";
		$user = "'.$this->user.'"; 
		$password = "'.$this->pwd.'"; 
		// Base des données utilisée
		$database_name = "'.$this->db_name.'";
		// Connexion mysql
		$connexion = mysql_connect($host, $user, $password) or die (mysql_error());
		// Sélection de la base des données
		$db = mysql_select_db($database_name, $connexion) or die(mysql_error());
		}

	// Recherche par le champ identifiant d\'un enregistrement 
	function get'.ucfirst($arr['table'][$nbtable]).'($'.$arr[$arr['table'][$nbtable].'_idField'].')
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM '.$arr['table'][$nbtable].' ";
		$sql .= "WHERE '.$arr[$arr['table'][$nbtable].'_idField'].' = \'$'.$arr[$arr['table'][$nbtable].'_idField'].'\';"; 
		// Exécution
		$rsql = mysql_query($sql);
		// Résultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d\'échec
			$this->'.$arr[$arr['table'][$nbtable].'_idField'].' = -1; 
			}
		else
			{ 
			// Cas de succès
			$this->'.$arr[$arr['table'][$nbtable].'_idField'].' = mysql_result($rsql, 0, "'.$arr[$arr['table'][$nbtable].'_idField'].'");';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.'
			$this->'.$arr[$arr['table'][$nbtable].'_field'][$j].' = mysql_result($rsql, 0, "'.$arr[$arr['table'][$nbtable].'_field'][$j].'");';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.'
			$this->'.$arr[$arr['table'][$nbtable].'_field'][$j].' = mysql_result($rsql, 0, "'.$arr[$arr['table'][$nbtable].'_field'][$j].'");';		
		}
	$j++;
	}

$contenuPage = $contenuPage.'
			}
		}

	// Affichage par critère spécifié de tous les enregistrements		
	
	// La forme du variable $whereCritere peut être la suivante :
	// critere1 AND (critere2 OR critere3)

	// La forme du variable $orderCritere peut être la suivante :
	// critere1, critere2, critere3
	
	function getAll'.ucfirst($arr['table'][$nbtable]).'($whereCritere=\'\', $orderCritere=\'\')
		{
		// Requête
		$sql = "SELECT * ";
		$sql .= "FROM '.$arr['table'][$nbtable].' ";
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
		$sql .= "Order by '.$arr[$arr['table'][$nbtable].'_idField'].'";*/
		// Exécution						
		$rsql = mysql_query($sql);
		// Résultats
		if (mysql_num_rows($rsql) == 0) 
			{
			// Cas d\'échec
			$this->'.$arr[$arr['table'][$nbtable].'_idField'].' = -1; 
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
		
	// Enregistrement d\'un enregistrement
	function set'.ucfirst($arr['table'][$nbtable]).'()
		{
		// Requête
		$sql = "INSERT INTO '.$arr['table'][$nbtable].' (';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.
'`'.$arr[$arr['table'][$nbtable].'_field'][$j].'`, ';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.
'`'.$arr[$arr['table'][$nbtable].'_field'][$j].'`, ';				
		}
	$j++;
	}

$contenuPage = $contenuPage.
'`'.$arr[$arr['table'][$nbtable].'_idField'].'`) ";
		$sql .= "VALUES (';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.'
				\'".$this->formatData($this->'.$arr[$arr['table'][$nbtable].'_field'][$j].')."\',';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.'
				\'".$this->formatData($this->'.$arr[$arr['table'][$nbtable].'_field'][$j].')."\',';		
		}
	$j++;
	}

$contenuPage = $contenuPage.
'
				\'".$this->getNewId()."\'); ";
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

	// Modification d\'un enregistrement
	function update'.ucfirst($arr['table'][$nbtable]).'($'.$arr[$arr['table'][$nbtable].'_idField'].')
		{
		$sql = "UPDATE '.$arr['table'][$nbtable].' SET ";';
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage.'
		$sql .= "`'.$arr[$arr['table'][$nbtable].'_field'][$j].'` = \'".$this->formatData($this->'.$arr[$arr['table'][$nbtable].'_field'][$j].')."\', ";';		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage.'
		$sql .= "`'.$arr[$arr['table'][$nbtable].'_field'][$j].'` = \'".$this->formatData($this->'.$arr[$arr['table'][$nbtable].'_field'][$j].')."\', ";';		
		}
	$j++;
	}

$contenuPage = $contenuPage.'
		$sql .= "`'.$arr[$arr['table'][$nbtable].'_idField'].'` = \'$'.$arr[$arr['table'][$nbtable].'_idField'].'\' ";
		$sql .= "WHERE `'.$arr[$arr['table'][$nbtable].'_idField'].'` = \'$'.$arr[$arr['table'][$nbtable].'_idField'].'\';"; 
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

	// Suppression d\'un enregistrement
	function delete'.ucfirst($arr['table'][$nbtable]).'($'.$arr[$arr['table'][$nbtable].'_idField'].')
		{
		// Requête
		$sql = "DELETE FROM '.$arr['table'][$nbtable].' WHERE '.$arr[$arr['table'][$nbtable].'_idField'].' = \'$'.$arr[$arr['table'][$nbtable].'_idField'].'\';"; 
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

	// Création d\'un nouveau id par incrémentation	
	function getNewId()
		{
		$sql = mysql_query(" select max('.$arr[$arr['table'][$nbtable].'_idField'].') from '.$arr['table'][$nbtable].' ");
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
?>';
		
		// Nom et url de la page à générer
		$pageName = $arr['table'][$nbtable]."_class.php";
		$pageUrl = $this->backOfficeDir."/".$pageName;
		// Création de la page
		$f = fopen($pageUrl, "w+");
		fputs($f, $contenuPage);
		fclose($f);
		return $pageName;		
		}

	// Génération de la page table_sql.php
	function generateSqlPage($arr, $nbtable)
		{
// Contenu de la page à générer
		$contenuPage= 
"<? 
// Page créée le ".date("d/m/Y H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")))." par myGenerator 2006
require_once('".$arr['table'][$nbtable]."_class.php');
".'$'."new".ucfirst($arr['table'][$nbtable])." = new ".$arr['table'][$nbtable]."();

if(isset(".'$'."_REQUEST['cmd_submit']))
	{
	//Choix de l'opération
	switch (".'$'."_REQUEST['action']) 
		{
		
		// Cas d'enregistrement
		case 'Enregistrer':";
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->".$arr[$arr['table'][$nbtable].'_field'][$j]." = ".'$'."_REQUEST['txt_".$arr[$arr['table'][$nbtable].'_field'][$j]."'];";		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->".$arr[$arr['table'][$nbtable].'_field'][$j]." = ".'$'."_REQUEST['cbx_".$arr[$arr['table'][$nbtable].'_field'][$j]."'];";		
		}
	$j++;
	}

$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->set".ucfirst($arr['table'][$nbtable])."();
			break;
		
		//Cas de modification
		case 'Modifier':";
$j=0;
while ($j < $arr[$arr['table'][$nbtable].'_nbField'])
	{
	if($arr[$arr['table'][$nbtable].'_field'][$j] != $arr[$arr['table'][$nbtable].'_idField'] && empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j])) 
		{
$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->".$arr[$arr['table'][$nbtable].'_field'][$j]." = ".'$'."_REQUEST['txt_".$arr[$arr['table'][$nbtable].'_field'][$j]."'];";		
		}
	elseif(!empty($arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]))
		{
$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->".$arr[$arr['table'][$nbtable].'_field'][$j]." = ".'$'."_REQUEST['cbx_".$arr[$arr['table'][$nbtable].'_field'][$j]."'];";		
		}
	$j++;
	}

$contenuPage = $contenuPage."
			".'$'."new".ucfirst($arr['table'][$nbtable])."->update".ucfirst($arr['table'][$nbtable])."(".'$'."_REQUEST['txt_".$arr[$arr['table'][$nbtable].'_idField']."']);
			break;
		
		// Cas de suppression
		case 'Supprimer':
			".'$'."new".ucfirst($arr['table'][$nbtable])."->delete".ucfirst($arr['table'][$nbtable])."(".'$'."_REQUEST['txt_".$arr[$arr['table'][$nbtable].'_idField']."']);
			break;
		}
	
	//Rédirection + résultat de l'exécution
	header('Location: '.".'$'."_REQUEST['redirect'].'?message='.".'$'."new".ucfirst($arr['table'][$nbtable])."->message);
	}
?>";

		// Nom et url de la page à générer
		$pageName = $arr['table'][$nbtable]."_sql.php";
		$pageUrl = $this->backOfficeDir."/".$pageName;
		// Création de la page
		$f = fopen($pageUrl, "w+");
		fputs($f, $contenuPage);
		fclose($f);
		return $pageName;		
		}
		
	}
?>