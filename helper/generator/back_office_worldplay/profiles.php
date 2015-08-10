<? 
include('config.php');
require_once('profiles_class.php');
$newProfiles = new profiles();

?>
<!-- Page créée le 03/12/2012 16:21:25 par myGenerator 2006 -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Profiles - <? echo $dConfig['titreAction']; ?></title>
<script language="javascript">
<!--
function isDataValid(theForm)
	{
	if(theForm.txt_uuid.value == ""){
		alert("Uuid invalide!");
		theForm.txt_uuid.focus();
		return (false);
		}
	if(theForm.txt_lang_id.value == ""){
		alert("Lang_id invalide!");
		theForm.txt_lang_id.focus();
		return (false);
		}
	if(theForm.txt_lev_id.value == ""){
		alert("Lev_id invalide!");
		theForm.txt_lev_id.focus();
		return (false);
		}
	if(theForm.txt_lev_goal_id.value == ""){
		alert("Lev_goal_id invalide!");
		theForm.txt_lev_goal_id.focus();
		return (false);
		}
	if(theForm.txt_user_id.value == ""){
		alert("User_id invalide!");
		theForm.txt_user_id.focus();
		return (false);
		}
	if(theForm.txt_points_questions.value == ""){
		alert("Points_questions invalide!");
		theForm.txt_points_questions.focus();
		return (false);
		}
	if(theForm.txt_points_answers.value == ""){
		alert("Points_answers invalide!");
		theForm.txt_points_answers.focus();
		return (false);
		}
	if(theForm.txt_blob_ques_points.value == ""){
		alert("Blob_ques_points invalide!");
		theForm.txt_blob_ques_points.focus();
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
          <td><a href="index.php">Administration</a> &gt; Profiles </td>
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
                        <th bgcolor="#FFFFFF"><div align="left"><strong>Profiles &raquo; <? echo $dConfig['titreAction']; ?> </strong></div></th>
                      </tr>
                      <form name="formProfiles" onSubmit="return(isDataValid(this))" method="post" action="profiles_sql.php?action=<? echo $_REQUEST['action'];?>">
                        <tr>
                          <td nowrap bgcolor="#FFFFFF"><div align="left">
                              <?
if(($_REQUEST['action']=="Enregistrer")||($_REQUEST['id']))
	{
	if($_REQUEST['id'])
		{
		$newProfiles->getProfiles($_REQUEST['id']);
		}
	
?>
                              <input name="redirect" type="hidden" value="<? echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>">
                                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                  <tr>
                                    <td nowrap bgcolor="#FFFFFF"><input type="hidden" name="txt_id" value="<? if ($_REQUEST['id']){echo $_REQUEST['id'];} ?>">
                                        <table width="100%" border="0" cellpadding="3" cellspacing="0">                                           <tr valign="top">
                                            <td nowrap>Uuid</td>
                                            <td><input type="text" name="txt_uuid" maxlength="36" value="<? if ($_REQUEST['id']){echo $newProfiles->uuid;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Lang_id</td>
                                            <td><input type="text" name="txt_lang_id" maxlength="36" value="<? if ($_REQUEST['id']){echo $newProfiles->lang_id;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Lev_id</td>
                                            <td><input type="text" name="txt_lev_id" maxlength="36" value="<? if ($_REQUEST['id']){echo $newProfiles->lev_id;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Lev_goal_id</td>
                                            <td><input type="text" name="txt_lev_goal_id" maxlength="36" value="<? if ($_REQUEST['id']){echo $newProfiles->lev_goal_id;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>User_id</td>
                                            <td><input type="text" name="txt_user_id" maxlength="36" value="<? if ($_REQUEST['id']){echo $newProfiles->user_id;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Points_questions</td>
                                            <td><input type="text" name="txt_points_questions" maxlength="11" value="<? if ($_REQUEST['id']){echo $newProfiles->points_questions;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Points_answers</td>
                                            <td><input type="text" name="txt_points_answers" maxlength="11" value="<? if ($_REQUEST['id']){echo $newProfiles->points_answers;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
                                                                                     <tr valign="top">
                                            <td nowrap>Blob_ques_points</td>
                                            <td><input type="text" name="txt_blob_ques_points" maxlength="16777215" value="<? if ($_REQUEST['id']){echo $newProfiles->blob_ques_points;} ?>" <? if($_REQUEST['action']=="Supprimer"){?>readonly="1"<? }?>></td>
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
                                    <th nowrap><div align="left">N&deg;</div></th>                                     <th nowrap><div align="left">Uuid</div></th>                                     <th nowrap><div align="left">Lang_id</div></th>                                     <th nowrap><div align="left">Lev_id</div></th>                                     <th nowrap><div align="left">Lev_goal_id</div></th>                                     <th nowrap><div align="left">User_id</div></th>                                     <th nowrap><div align="left">Points_questions</div></th>                                     <th nowrap><div align="left">Points_answers</div></th>                                     <th nowrap><div align="left">Blob_ques_points</div></th>                                    <? if($_REQUEST['action']!="Consulter"){?>
                                    <th nowrap><div align="left">Op&eacute;ration</div></th>
                                    <? }?>
                                  </tr>
                                  <?
	$array=$newProfiles->getAllProfiles('id>0','id');
	
	if (!empty($array))
		{
		$i=0; 
		while(!empty($array[$i]))
			{
	?>
                                  <tr valign="top">
                                    <td bgcolor="#FFFFFF"><? echo $i+1;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->uuid;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->lang_id;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->lev_id;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->lev_goal_id;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->user_id;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->points_questions;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->points_answers;?></td>                                    <td bgcolor="#FFFFFF"><? echo $array[$i]->blob_ques_points;?></td>                                    <? if($_REQUEST['action']!="Consulter")
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
    <td colspan="3" bgcolor="#FFFFFF"><div align="center" style="font-size:10px ">Back office cr&eacute;e le 03/12/2012 16:21:25  </div></td>
  </tr>
</table>
</body>

</html>