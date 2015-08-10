<? include('config.php');
require_once('etudiant_class.php');
$newEtudiant = new etudiant();
require_once('classe_class.php');
$newClasse = new classe(); 

?>
<!-- Page créée le 15/09/2006 23:07:12 par myGenerator 2006 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Etudiant - <? echo $dConfig['titreAction']; ?></title>
<script language="javascript">
<!--
function isDataValid(theForm)
	{
	if(theForm.txt_matricule.value == ""){
		alert("Matricule invalide!");
		theForm.txt_matricule.focus();
		return (false);
		}
	if(theForm.txt_nom.value == ""){
		alert("Nom invalide!");
		theForm.txt_nom.focus();
		return (false);
		}
	if(theForm.txt_prenom.value == ""){
		alert("Prenom invalide!");
		theForm.txt_prenom.focus();
		return (false);
		}
	if(theForm.cbx_id_classe.selectedIndex == 0)
		{
		alert("id_classe invalide!");
		theForm.cbx_id_classe.focus();
		return (false);
		}
	}
//-->
</script>

</head>

<body style="font-family:Verdana ">
<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th colspan="3" bgcolor="#EAEAEA"><div align="center"><strong>Back office pour la base des donn&eacute;es : EXEMPLE</strong></div></th>
  </tr>
  <tr>
    <td height="100%" colspan="3" bgcolor="#FFFFFF"><div align="center">
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><a href="index.php">Administration</a> &gt; Etudiant </td>
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
                        <th bgcolor="#FFFFFF"><div align="left"><strong>Etudiant &raquo; <? echo $dConfig['titreAction']; ?> </strong></div></th>
                      </tr>
                      <form name="formEtudiant" onSubmit="return(isDataValid(this))" method="post" action="etudiant_sql.php?action=<? echo $_REQUEST['action'];?>">
                        <tr>
                          <td nowrap bgcolor="#FFFFFF"><div align="left">
                              <?
if(($_REQUEST['action']=="Enregistrer")||($_REQUEST['id']))
	{
	if($_REQUEST['id'])
		{
		$newEtudiant->getEtudiant($_REQUEST['id']);
		}
	
?>
                              <input name="redirect" type="hidden" value="<? echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                  <tr>
                                    <td nowrap bgcolor="#FFFFFF"><input type="hidden" name="txt_id" value="<? if ($_REQUEST['id']){echo $_REQUEST['id'];} ?>">
                                        <table width="100%" border="0" cellpadding="3" cellspacing="0">                                           <tr valign="top">
                                            <td nowrap>Matricule</td>
                                            <td><input type="text" name="txt_matricule" maxlength="10" value="<? if ($_REQUEST['id']){echo $newEtudiant->matricule;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Nom</td>
                                            <td><input type="text" name="txt_nom" maxlength="50" value="<? if ($_REQUEST['id']){echo $newEtudiant->nom;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Prenom</td>
                                            <td><input type="text" name="txt_prenom" maxlength="20" value="<? if ($_REQUEST['id']){echo $newEtudiant->prenom;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                          											<tr valign="top">
                                            <td nowrap>Id_classe</td>
											<td><select name="cbx_id_classe" <? if($_REQUEST['action']=="Supprimer"){?> disabled<? }?>>
<option value=""></option>
<? 
	$arrayClasse = $newClasse->getAllClasse();
	
	if (!empty($arrayClasse))
		{
		$i=0; 
		while(!empty($arrayClasse[$i]))
			{
			?>
			<option <? if ($_REQUEST['id'] && ($newEtudiant->id_classe == $arrayClasse[$i]->id)){echo 'selected';} ?> value="<? echo $arrayClasse[$i]->id;?>"><? echo $arrayClasse[$i]->Nom;?></option>
			<? 
			$i++;
			}
		}
			
?>                                                
</select></td></tr>                                      </table>
                                        <div align="left"></div></td>
                                  </tr>
                                  <tr>
                                    <td nowrap bgcolor="#CCCCCC"><div align="left">
                                        <input type="submit" name="cmd_submit" value="<? echo $_REQUEST['action'];?>" <? if ($_REQUEST['action']=="Supprimer") {echo 'onClick="return(confirm(\'Voulez-vous r&eacute;ellement supprimer cet enregistrement?\'))"';}?>>
                                        <input type="reset" name="reset" value="R&eacute;tablir">
                                      </div></td>
                                  </tr>
                                </table>
                                <?
	}
else
	{
	if($_REQUEST['message']){echo '<strong  style="color:#FF0000; ">'.$_REQUEST['message'].'</strong>';}
?>
                                <table width="100%"  border="0" cellpadding="5" cellspacing="1" bgcolor="#F5F5F5">
                                  <tr bgcolor="#CCCCCC">
                                    <th nowrap><div align="left">N&deg;</div></th>                                     <th nowrap><div align="left">Matricule</div></th>                                     <th nowrap><div align="left">Nom</div></th>                                     <th nowrap><div align="left">Prenom</div></th>                                     <th nowrap><div align="left">Id_classe</div></th>                                    <? if($_REQUEST['action']!="Consulter"){?>
                                    <th nowrap><div align="left">Op&eacute;ration</div></th>
                                    <? }?>
                                  </tr>
                                  <?
	
	
	$array=$newEtudiant->getAllEtudiant();
	
	if (!empty($array))
		{
		$i=0; 
		while(!empty($array[$i]))
			{
	?>
                                  <tr valign="top">
                                    <td bgcolor="#FFFFFF"><? echo $i+1;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->matricule;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->nom;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->prenom;?></td>                                    <td bgcolor="#FFFFFF"><? $newClasse->getClasse($array[$i]->id_classe); echo $newClasse->Nom;?></td>                                    <? if($_REQUEST['action']!="Consulter")
			{?>
                                    <td bgcolor="#F7F7F7"><a href="?action=<? echo $_REQUEST['action'].'&id='.$array[$i]->id;?>">
                                      <? echo $_REQUEST['action'];?>
                                      </a></td>
                                  </tr>
                                  <? 	}?>
                                  <? 		$i++;} 
	}
else
	{?>
                                  <tr>
                                    <td colspan="30" bgcolor="#FFFFFF">Aucune information n'a &eacute;t&eacute; trouv&eacute;! </td>
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
    <td colspan="3" bgcolor="#FFFFFF"><div align="center" style="font-size:10px ">Back office cr&eacute;e le 15/09/2006 23:07:12 par <a href="#">myGenerator 2006</a> </div></td>
  </tr>
</table>
</body>

</html>