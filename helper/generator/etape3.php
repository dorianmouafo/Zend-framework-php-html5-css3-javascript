<?
/* 
//print_r($_REQUEST) ; exit;
$i=0;
while ($i < $_REQUEST['nbTables'])
	{
	if(!empty($_REQUEST[$_REQUEST['table'][$i].'_checked']))
		{
		echo '<strong>'.$_REQUEST['table'][$i].'</strong><br>';
		$j=0;

		if(!empty($_REQUEST[$_REQUEST['table'][$i].'_idField']))
			{
			echo '-> id: '.$_REQUEST[$_REQUEST['table'][$i].'_idField'];
			}
		while ($j < $_REQUEST[$_REQUEST['table'][$i].'_nbField'])
			{
			echo $_REQUEST[$_REQUEST['table'][$i].'_field'][$j].' ';
			
			if(!empty($_REQUEST[$_REQUEST['table'][$i].'_hasRelationWith'][$j]))
				{
				list($table,$champ,$cle) = explode(" - ", $_REQUEST[$_REQUEST['table'][$i].'_hasRelationWith'][$j]);
				echo $table.' '.$champ.' '.$cle.''; 
				$c='
list($table,$champ,$cle) = explode(" - ", $arr[$arr['table'][$nbtable].'_hasRelationWith'][$j]);
$contenuPage = $contenuPage.
'											<td><select name="cbx_'.$arr[$arr['table'][$nbtable].'_field'][$j].'" <? if('."$".'_REQUEST[\'action\']=="Supprimer"){?> disabled<? }?>>
<option value=""></option>
<? 
	$array'.ucfirst($table).' = '."$".'new'.ucfirst($table).'->getAll'.ucfirst($table).'();
	
	if (!empty('."$".'array'.ucfirst($table).'))
		{
		$i=0; 
		while(!empty('."$".'array'.ucfirst($table).'[$i]))
			{
			?>
			<option <? if ('."$".'_REQUEST[\''.$arr[$arr['table'][$nbtable].'_idField'].'\'] && ('."$".'newEtudiant->'.$arr[$arr['table'][$nbtable].'_field'][$j].' == '."$".'array'.ucfirst($table).'['."$".'i]->'.$cle.')){echo \'selected\';} ?> value="<? echo '."$".'array'.ucfirst($table).'['."$".'i]->'.$cle.';?>"><? echo '."$".'array'.ucfirst($table).'['."$".'i]->'.$champ.';?></option>
			<? 
			'."$".'i++;
			}
		}
			
?>                                                
</select></td>';	

echo $c;
				
				
				echo $_REQUEST[$_REQUEST['table'][$i].'_hasRelationWith'][$j].' ';
				}
			echo '<br>';
			$j++;
			}
		}
	$i++;
	}
exit;
//*/
 
// Si rien n'a été posté
if(empty($_REQUEST['database_name']))
	{
	// Redirection à l'étape 1
	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/etape1.php");
	}
//include('config.php');
require_once('myGenerator.class.php');
$newMyGenerator = new myGenerator($_REQUEST['database_name']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>G&eacute;n&eacute;ration des pages web en PHP - myGenerator 2006</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() 
	{ //v3.0
	var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
	for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
	}
//-->
</script>
</head>

<body>
<table width="100%" height="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#69A2AD" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/logo_1.jpg" width="351" height="136"></td>
            <td width="100%" valign="baseline" background="images/logo_1_line.jpg"><table  border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td nowrap><div id="menu" align="center" style="padding-left:3px; "><a href="http://www.membres.lycos.fr/bnizworks/mygenerator/" target="_blank"><img src="images/home_by_bniz.gif" width="17" height="17" hspace="2" border="0" align="absmiddle">Site officiel </a></div></td>
                <td nowrap><div id="menu" align="center" style="padding-left:3px; "><a href="uc.php" target="_blank"><img src="images/faq.png" width="12" height="15" hspace="2" border="0" align="absmiddle">FAQ</a></div></td>
                <td nowrap><div id="menu" align="center" style="padding-left:3px; "><a href="uc.php" target="_blank"><img src="images/help.png" width="12" height="15" hspace="2" border="0" align="absmiddle">Documentation</a></div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="100%"><table width="100%" height="100%"  border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td valign="top" bgcolor="#FFFFFF">
                  <div id="contenu">
                    <h2 align="left">Etape 3 : Cr&eacute;ation de back office pour la base des donn&eacute;es <? echo strtoupper($newMyGenerator->db_name); ?></h2>
<?
if(!isset($_REQUEST['cmd_continuer']))
	{
	if (is_dir($newMyGenerator->backOfficeDir))
		{
		$newMyGenerator->backOfficeDir = $newMyGenerator->temporaryDir;
		$newMyGenerator->emptyDir($newMyGenerator->backOfficeDir);
		}
 	if (!is_dir($newMyGenerator->backOfficeDir))
		{
		mkdir($newMyGenerator->backOfficeDir, 0777);
		}
	// Generation des pages web
	$newMyGenerator->backOfficeFileList = array();
	
	// Page index.php
	$newMyGenerator->backOfficeFileList[0] = $newMyGenerator->generateIndexPage($_REQUEST);
	// Page config.php
	$newMyGenerator->backOfficeFileList[1] = $newMyGenerator->generateConfigPage();
	
	$i=0;
	$j=2;
	while ($i < $_REQUEST['nbTables'])
		{
		if(!empty($_REQUEST[$_REQUEST['table'][$i].'_checked']))
			{
			// Page table.php
			$newMyGenerator->backOfficeFileList[$j++] = $newMyGenerator->generatePage($_REQUEST, $i);
			// Page table_sql.php
			$newMyGenerator->backOfficeFileList[$j++] = $newMyGenerator->generateClassPage($_REQUEST, $i);
			// Page table_class.php
			$newMyGenerator->backOfficeFileList[$j++] = $newMyGenerator->generateSqlPage($_REQUEST, $i);
			}
		$i++;
		}
	}
else
	{
	//die (print_r($_REQUEST));
	
	if($_REQUEST['rdb_existe'])
		{
		// Copie de tmp dans le dossier back office
		$newMyGenerator->copyFiles($newMyGenerator->temporaryDir, $newMyGenerator->backOfficeDir);
		}
	else
		{
		// Copie de tmp dans le dossier back office
		$newMyGenerator->backOfficeDir = $newMyGenerator->getNewNameDir();
		$newMyGenerator->copyFiles($newMyGenerator->temporaryDir, $newMyGenerator->backOfficeDir);
		}
	}
// Si le back office est dans le fichier temporaire
if($newMyGenerator->backOfficeDir == $newMyGenerator->temporaryDir)
	{
	$newMyGenerator->backOfficeDir = 'back_office_'.$newMyGenerator->db_name;
?>
<form action="<? echo $_SERVER['PHP_SELF']?>" method="post" name="form_existe">
  <div align="left" style="border: #F3A948 1px solid; padding:10px "> 
    <input type="hidden" name="database_name" value="<? echo $newMyGenerator->db_name; ?>">
    <img src="images/ico_warning.gif" align="absmiddle"> <strong>Le dossier back office ( <? echo $newMyGenerator->backOfficeDir ;?> ) existe d&eacute;j&agrave;!</strong><br>
      <br>
    Que voulez vous faire ?
    <div align="left">
      <div align="left" style="MARGIN-LEFT: 20px; MARGIN-TOP: 5px;">
        <input type="radio" name="rdb_existe" value="1" align="absmiddle" checked>
        Il s'agit d'une ancienne version, remplacer son contenu par celui de myGenerator (recommand&eacute;) </div>
      <div align="left" style="MARGIN-LEFT: 20px; MARGIN-TOP: 5px;">
        <input type="radio" name="rdb_existe" value="0" align="absmiddle">
        Cr&eacute;er un autre dossier (<strong><? echo $newMyGenerator->getNewNameDir() ;?></strong>) et garder les diff&eacute;rentes versions.</div>
      <div align="left" style="background-color:#CAEBF0; MARGIN-TOP: 5px;">
        <table  border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td><div align="center">
                <input type="button" name="Submit" value="&laquo; Pr&eacute;cedent" onClick="javascript:history.back(1)">
            </div></td>
            <td><div align="center">
                <input type="submit" name="cmd_continuer" value="Continuer &raquo;">
            </div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</form>
<?	
	}
// Affichage de l'arborescence du back office
else
	{
?>
<div align="justify" style="MARGIN-BOTTOM: 15px; MARGIN-TOP: 15px; border: #07AB14 1px solid; padding:10px">					
<div align="left" style="MARGIN-BOTTOM: 15px; "><img src="images/ico_success.gif" width="32" height="32" align="absmiddle"> <strong>  Back office g&eacute;n&eacute;r&eacute;  avec succ&egrave;s !</strong></div>
<div align="left" style="MARGIN-BOTTOM: 15px; "> Cliquer sur le nom du dossier back office pour acceder au back office.</div>
                      
                      <div align="left" style="MARGIN-BOTTOM: 10px;"><img src="images/dir.png" width="16" height="14" hspace="2" align="absmiddle"> <strong><? echo '<a href="'.$newMyGenerator->backOfficeDir.'/" target="_blank">'.$newMyGenerator->backOfficeDir.'</a>'; ?></strong>				      </div>
                       
<? 
sort($newMyGenerator->backOfficeFileList);
	foreach ($newMyGenerator->backOfficeFileList as $v) 
		{
		echo '<div align="left" style="MARGIN-BOTTOM: 5px; MARGIN-LEFT: 18px"><img src="images/filephp.png" width="15" height="16" hspace="2" align="absmiddle"><a href="'.$newMyGenerator->backOfficeDir."/".$v.'" target="_blank">'.$v.'</a></div>';
		}
?>
<? 
					  
					
					  ?> 
				  
                    </div>
<p> <? echo count($newMyGenerator->backOfficeFileList);?> pages web en php ont &eacute;t&eacute; cr&eacute;&eacute;es avec succ&egrave;ss par myGenerator 2006 et peuvent servir de back office pour la base des donn&eacute;es <strong><? echo $newMyGenerator->db_name; ?></strong>.</p>
                      <div align="left" style="background-color:#CAEBF0; padding:5px">
                        <input name="Submit" type="button" onClick="MM_goToURL('parent','etape1.php');return document.MM_returnValue" value="« Recommencer">
                      </div>
<? 	// Copie d'images 
	copy('images/im2bo/consulter_by_bniz.png', $newMyGenerator->backOfficeDir.'/consulter_by_bniz.png');
	copy('images/im2bo/enregistrer_by_bniz.png', $newMyGenerator->backOfficeDir.'/enregistrer_by_bniz.png');
	copy('images/im2bo/modifier_by_bniz.png', $newMyGenerator->backOfficeDir.'/modifier_by_bniz.png');
	copy('images/im2bo/supprimer_by_bniz.png', $newMyGenerator->backOfficeDir.'/supprimer_by_bniz.png');
	}
 ?>
                  </div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="100%"><table width="100%"  border="0" cellpadding="3" cellspacing="0" bgcolor="#CFEEF1">
          <tr>
            <td><div align="center">&copy; 2006 Tous droits r&eacute;serv&eacute;s. Powered and designed by <a href="http://membres.lycos.fr/bnizworks/" target="_blank">bnizworks</a>. </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
