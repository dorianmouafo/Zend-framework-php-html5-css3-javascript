<? 
include('config.php');
require_once('answers_class.php');
$newAnswers = new answers();

?>
<!-- Page créée le 29/11/2012 12:48:10 par myGenerator 2006 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Answers - <? echo $dConfig['titreAction']; ?></title>
<script language="javascript">
<!--
function isDataValid(theForm)
	{
	if(theForm.txt_uuid.value == ""){
		alert("Uuid invalide!");
		theForm.txt_uuid.focus();
		return (false);
		}
	if(theForm.txt_ques_uuid.value == ""){
		alert("Ques_uuid invalide!");
		theForm.txt_ques_uuid.focus();
		return (false);
		}
	if(theForm.txt_ans_1.value == ""){
		alert("Ans_1 invalide!");
		theForm.txt_ans_1.focus();
		return (false);
		}
	if(theForm.txt_ans_2.value == ""){
		alert("Ans_2 invalide!");
		theForm.txt_ans_2.focus();
		return (false);
		}
	if(theForm.txt_ans_3.value == ""){
		alert("Ans_3 invalide!");
		theForm.txt_ans_3.focus();
		return (false);
		}
	if(theForm.txt_ans_4.value == ""){
		alert("Ans_4 invalide!");
		theForm.txt_ans_4.focus();
		return (false);
		}
	if(theForm.txt_sol_1.value == ""){
		alert("Sol_1 invalide!");
		theForm.txt_sol_1.focus();
		return (false);
		}
	if(theForm.txt_sol_2.value == ""){
		alert("Sol_2 invalide!");
		theForm.txt_sol_2.focus();
		return (false);
		}
	if(theForm.txt_sol_3.value == ""){
		alert("Sol_3 invalide!");
		theForm.txt_sol_3.focus();
		return (false);
		}
	if(theForm.txt_sol_4.value == ""){
		alert("Sol_4 invalide!");
		theForm.txt_sol_4.focus();
		return (false);
		}
	}
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
    <th colspan="3" bgcolor="#EAEAEA"><div align="center"><strong>Back office pour la base des donn&eacute;es : WORLDPLAY</strong></div></th>
  </tr>
  <tr>
    <td height="100%" colspan="3" bgcolor="#FFFFFF"><div align="center">
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><a href="index.php">Administration</a> &gt; Answers </td>
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
                        <th bgcolor="#FFFFFF"><div align="left"><strong>Answers &raquo; <? echo $dConfig['titreAction']; ?> </strong></div></th>
                      </tr>
                      <form name="formAnswers" onSubmit="return(isDataValid(this))" method="post" action="answers_sql.php?action=<? echo $_REQUEST['action'];?>">
                        <tr>
                          <td nowrap bgcolor="#FFFFFF"><div align="left">
                              <?
if(($_REQUEST['action']=="Enregistrer")||($_REQUEST['id']))
	{
	if($_REQUEST['id'])
		{
		$newAnswers->getAnswers($_REQUEST['id']);
		}
	
?>
                              <input name="redirect" type="hidden" value="<? echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                  <tr>
                                    <td nowrap bgcolor="#FFFFFF"><input type="hidden" name="txt_id" value="<? if ($_REQUEST['id']){echo $_REQUEST['id'];} ?>">
                                        <table width="100%" border="0" cellpadding="3" cellspacing="0">                                           <tr valign="top">
                                            <td nowrap>Uuid</td>
                                            <td><input type="text" name="txt_uuid" maxlength="36" value="<? if ($_REQUEST['id']){echo $newAnswers->uuid;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Ques_uuid</td>
                                            <td><input type="text" name="txt_ques_uuid" maxlength="36" value="<? if ($_REQUEST['id']){echo $newAnswers->ques_uuid;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Ans_1</td>
                                            <td><input type="text" name="txt_ans_1" maxlength="128" value="<? if ($_REQUEST['id']){echo $newAnswers->ans_1;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Ans_2</td>
                                            <td><input type="text" name="txt_ans_2" maxlength="128" value="<? if ($_REQUEST['id']){echo $newAnswers->ans_2;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Ans_3</td>
                                            <td><input type="text" name="txt_ans_3" maxlength="128" value="<? if ($_REQUEST['id']){echo $newAnswers->ans_3;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Ans_4</td>
                                            <td><input type="text" name="txt_ans_4" maxlength="255" value="<? if ($_REQUEST['id']){echo $newAnswers->ans_4;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Sol_1</td>
                                            <td><input type="text" name="txt_sol_1" maxlength="11" value="<? if ($_REQUEST['id']){echo $newAnswers->sol_1;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Sol_2</td>
                                            <td><input type="text" name="txt_sol_2" maxlength="11" value="<? if ($_REQUEST['id']){echo $newAnswers->sol_2;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Sol_3</td>
                                            <td><input type="text" name="txt_sol_3" maxlength="11" value="<? if ($_REQUEST['id']){echo $newAnswers->sol_3;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Sol_4</td>
                                            <td><input type="text" name="txt_sol_4" maxlength="11" value="<? if ($_REQUEST['id']){echo $newAnswers->sol_4;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                </table>
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
                                    <th nowrap><div align="left">N&deg;</div></th>                                     <th nowrap><div align="left">Uuid</div></th>                                     <th nowrap><div align="left">Ques_uuid</div></th>                                     <th nowrap><div align="left">Ans_1</div></th>                                     <th nowrap><div align="left">Ans_2</div></th>                                     <th nowrap><div align="left">Ans_3</div></th>                                     <th nowrap><div align="left">Ans_4</div></th>                                     <th nowrap><div align="left">Sol_1</div></th>                                     <th nowrap><div align="left">Sol_2</div></th>                                     <th nowrap><div align="left">Sol_3</div></th>                                     <th nowrap><div align="left">Sol_4</div></th>                                    <? if($_REQUEST['action']!="Consulter"){?>
                                    <th nowrap><div align="left">Op&eacute;ration</div></th>
                                    <? }?>
                                  </tr>
                                  <?
	$array=$newAnswers->getAllAnswers('id>0','id');
	
	if (!empty($array))
		{
		$i=0; 
		while(!empty($array[$i]))
			{
	?>
                                  <tr valign="top">
                                    <td bgcolor="#FFFFFF"><? echo $i+1;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->uuid;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->ques_uuid;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->ans_1;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->ans_2;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->ans_3;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->ans_4;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->sol_1;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->sol_2;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->sol_3;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->sol_4;?></td>                                    <? if($_REQUEST['action']!="Consulter")
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
    <td colspan="3" bgcolor="#FFFFFF"><div align="center" style="font-size:10px ">Back office cr&eacute;e le 29/11/2012 12:48:10  </div></td>
  </tr>
</table>
</body>

</html>