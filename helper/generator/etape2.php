<? 
// Si rien n'a été posté
if(empty($_REQUEST['database_name']))
	{
	// Redirection à l'étape 1
	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/etape1.php");
	}

include('config.php');
require_once('myGenerator.class.php');
$newMyGenerator = new myGenerator($_REQUEST['database_name']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Choix des tables - myGenerator 2006</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body><SCRIPT 
src="css/tablist.js" 
type=text/javascript></SCRIPT>
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
          <td height="100%">

	<table width="100%" height="100%"  border="0" cellpadding="10" cellspacing="0">
              <form name="form_etape2" method="post" action="etape3.php"><tr>
                <td valign="top" bgcolor="#FFFFFF"><div id="contenu">
                    <h2 align="left">Etape 2 : Choix des tables</h2>
                    <p>D&eacute;s&eacute;lectionner les tables que vous ne voulez pas g&eacute;rer dans le back office qui va &ecirc;tre g&eacute;n&eacute;r&eacute; puis apr&egrave;s avoir d&eacute;velopper chaque table et indiquer ses &eacute;ventuels cl&eacute;s secondaires (relations avec d'autres tables) de chaque table. </p>
                    <p>Chaque table doit avoir une cl&eacute; primaire pour que MyGenerator puisse la prendre en compte! Ce champ sera cach&eacute; (<strong>type hidden</strong>) dans le formulaire g&eacute;n&eacute;r&eacute; et ces valeurs <strong>automatiquement incr&eacute;ment&eacute;s</strong>; il est fortement conseill&eacute; d'utiliser un identifiant de <strong>type int</strong> et <strong>non modifiable</strong>. </p>
                    <p>Cliquer sur terminer pour commencer la g&eacute;n&eacute;ration du back office. </p>
                    <div align="left" style="border: #69A2AD 1px solid; padding:10px ">
	<div id="bd" style="MARGIN-BOTTOM: 15px;"> <a href="javascript:expandAll()"><img src="images/expand_all.gif" width="19" height="17" border=0 align="absmiddle" title="Développer toutes les tables"></a>&nbsp;<a href="javascript:collapseAll()"><img src="images/collapse_all.gif" width="19" height="17" border="0" align="absmiddle" title="Réduire toutes les tables"></a> Base des donn&eacute;es : <strong><? echo $_REQUEST['database_name']?></strong>
                                          <input name="database_name" type="hidden" value="<? echo $_REQUEST['database_name'];?>">
                                          <br>
                        <br>
                        <?
$arrayTables = $newMyGenerator->getAllTables();
	
	if (!empty($arrayTables))
		{
		$i=0; $nbTable=0;
		while(!empty($arrayTables[$i]))
			{
			$arrayFields = $newMyGenerator->getAllFields($arrayTables[$i]);
				
			if (!empty($arrayFields))
				{
				$j=0;
				
				// cle primaire
				$m=0;$primaryKeyField='';
				while ($arrayFields[$m])
					{
					if(!empty($arrayFields[$m]['isId']))
						{
						$primaryKeyField = $arrayFields[$m]['name'];
						}
					$m++;
					}
					
				
?>
			<div id="<? echo $arrayTables[$i]; ?>Parent" style="MARGIN-BOTTOM: 0px; MARGIN-LEFT: 25px"><input name="<? echo $arrayTables[$i]; ?>_checked" type="checkbox" <? if(!empty($primaryKeyField)){?>checked<? }else{?>disabled<? }?> align="absmiddle"><img src="images/plus.gif" name="imEx" hspace="3" border="0" align="absmiddle" id="<? echo $arrayTables[$i]; ?>Img" title="Développer/Réduire la table <? echo $arrayTables[$i]; ?>" onClick="expandBase('<? echo $arrayTables[$i]; ?>', true); return false;"><strong><input name="table[]" type="hidden" value="<? echo $arrayTables[$i]; ?>"><? echo $arrayTables[$i]; ?></strong><? if(empty($primaryKeyField)){echo ' <span class="ROUGE">(Aucune clé primaire!)</span>';}else{$nbTable++;}?><br>
			</div>
<?				
				 
$arrayRelations = $newMyGenerator->getAllRelationFields($arrayTables[$i]);
if (!empty($arrayRelations))
	{
	$k=0; 
	$table=''; 
	$champ='';
	$cbxRelation='';
	$tableOption='';
	while(!empty($arrayRelations[$k]))
		{
		list($table,$champ) = explode(" - ",$arrayRelations[$k]);
		if($table==$arrayTables[$i])
			{
			$cbxRelation='';
			break;
			}
		if($table != $tableOption)
			{
			$tableOption=$table;
			$cbxRelation .= '
<optgroup label="'.$table.'">';
			}
		$cbxRelation .= '
<option value="'.$arrayRelations[$k].'">'.$champ.'</option>';
		$k++;
		list($table,$champ) = explode(" - ",$arrayRelations[$k]);
		if($table != $tableOption)
			{
			$cbxRelation .= '
</optgroup>';
			}
		}
	}?>
                        <div class="notice-child" id="<? echo $arrayTables[$i]; ?>Child" style=" MARGIN-BOTTOM: 10px; MARGIN-LEFT: 50px">
                          <table border="0" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#69A2AD">
                            <tr bordercolor="#FFFFFF" bgcolor="#CAEBF0">
                              <td><div align="left"><strong>Champ</strong></div></td>
                              <td><div align="left"><strong>Clé primaire</strong></div></td>
                              <td><div align="left"><strong>Relation</strong></div></td>
                              <td><div align="left"><strong>Type</strong></div></td>
                              <td><div align="left"><strong>Taille</strong></div></td>
                            </tr>
                            <? while(!empty($arrayFields[$j])){?>
                            <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                              <td><input name="<? echo $arrayTables[$i];?>_field[]" type="hidden" value="<? echo $arrayFields[$j]['name'];?>"><? echo $arrayFields[$j]['name'];?> </td>
                              <td><div align="center">
                                  <input type="radio" name="<? echo $arrayTables[$i];?>_idField" value="<? echo $arrayFields[$j]['name'];?>" <? if($arrayFields[$j]['isId']){echo 'checked';}?> disabled>
                                  <? if($arrayFields[$j]['isId']){?><input type="hidden" name="<? echo $arrayTables[$i];?>_idField" value="<? echo $arrayFields[$j]['name'];?>"><? }?>
                              </div></td>
                              <td><div align="center">
                                <? if(empty($arrayFields[$j]['isId'])&& !empty($primaryKeyField)){?>
								<select name="<? echo $arrayTables[$i];?>_hasRelationWith[<? echo $j;?>]">
                                  <option value=""></option>
                                  <? echo $cbxRelation; ?>
                                </select><? }?>
</div></td>
                              <td>
                                <div align="left">
                                  <input name="<? echo $arrayTables[$i];?>_type[]" type="hidden" value="<? echo $arrayFields[$j]['type'];?>">
                                <? echo $arrayFields[$j]['type'];?> </div></td>
                              <td><div align="center">
                                <input name="<? echo $arrayTables[$i];?>_len[]" type="hidden" value="<? echo $arrayFields[$j]['len'];?>">
                                <? echo $arrayFields[$j]['len'];?></div></td>
                            </tr>
                            <? $j++; } echo '<input name="'.$arrayTables[$i].'_nbField" type="hidden" value="'.$j.'">'; ?>
                          </table>
                        </div>
                        <?
				
				} 
			$i++;
			}
		echo '<input name="nbTables" type="hidden" value="'.$i.'">';
		
		}
?>
                        <? if($nbTable==0){echo "<br><br><img src=\"images/ico_error.gif\" width=\"32\" height=\"32\" align=\"absmiddle\"> <strong>Au moins une table doit être pris en compte pour générer le back office !</strong>";}?>
</div>
                                        <div align="left" style="background-color:#CAEBF0; padding:5px">
                                          <input type="button" name="Submit" value="&laquo; Pr&eacute;cedent" onClick="javascript:history.back(1)">
                                          <input type="submit" name="cmd_etape3" value="Terminer &raquo;" <? if($nbTable==0){echo 'disabled';}?>> 
                                          </div>
                    </div>
</div>

				</td>
              </tr></form>
          </table>
</td>
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
