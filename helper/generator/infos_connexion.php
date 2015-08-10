<?
include('config.php');
$msg=1;
$filename = 'infos_de_connexion.txt';
if(isset($_REQUEST['cmd_continuer']))
	{
	if(mysql_connect($_REQUEST['txt_host'], $_REQUEST['txt_user'], $_REQUEST['txt_pwd']))
		{
		$contenu = $_REQUEST['txt_user'].";".$_REQUEST['txt_host'].";".$_REQUEST['txt_pwd'].";";
		$f = fopen($filename, "w+");
		fputs($f, $contenu);
		fclose($f);
		// Redirection à la page d'accueil
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php?msg=".$msg);
		}
	else
		{
		$msg=0;
		}
	}
require_once('myGenerator.class.php');
$newMyGenerator = new myGenerator();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Informations de connexion - myGenerator 2006</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function isDataValid(theForm)
	{
	if(theForm.txt_user.value == ""){
		alert("Nom d'utilisateur invalide!");
		theForm.txt_user.focus();
		return (false);
		}
	if(theForm.txt_host.value == ""){
		alert("Serveur invalide!");
		theForm.txt_host.focus();
		return (false);
		}
	if(theForm.txt_pwd.value != theForm.txt_confirm_pwd.value){
		alert("Mot de passe invalide! Il est différent de sa confirmation");
		theForm.txt_pwd.focus();
		return (false);
		}
	}

function MM_goToURL() { //v3.0
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
                    <h2 align="left">Indiquer les informations de connection &agrave; MySql </h2>
                    <div align="justify">
                      <p>MyGenerator pour bien fonctionner a besoin de se connecter &agrave; MySQL. Il est recommand&eacute; de lui fournir les informations de connexion du root ou autre utilisateur ayant tous les droits d'administration de vos bases des donn&eacute;es. Par d&eacute;faut myGenerator 2006 utilise ('<strong>localhost</strong>', '<strong>root</strong>', '<em>sans mot de passe</em>').</p>
                    </div>
                        <form name="form_infos_de_connexion" method="post" action="<? echo $_SERVER['PHP_SELF']?>" onSubmit="return(isDataValid(this))">
                          <div align="left" style="border: <? if(!$msg){ ?>#FF0000<? }else{ ?>#69A2AD<? } ?> 1px solid; padding:10px ">  
<? if(!$msg){?><span class="ROUGE"><img src="images/ico_error.gif" width="32" height="32" align="absmiddle"> Une erreur est survenue lors de l'enregistrement! Entrez les informations de connexion valides.</span><br>
<br><? }?> 
 
<table  border="0" cellspacing="0" cellpadding="3">
  <tr >
    <td>Serveur</td>
    <td><input name="txt_host" type="text" value="localhost"></td>
  </tr>
    <tr >
      <td>Nom de l'utilisateur </td>
      <td><input name="txt_user" type="text" value="root"></td>
    </tr>
    <tr >
      <td>Mot de pass&eacute; </td>
      <td><input name="txt_pwd" type="password"></td>
    </tr>
    <tr >
      <td>Entrer &agrave; nouveau </td>
      <td><input name="txt_confirm_pwd" type="password" ></td>
    </tr>
  </table>
                            <div align="left" style="MARGIN-TOP: 20px; background-color:#CAEBF0; padding:5px">
                              <input name="cmd_annuler" type="button" onClick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Annuler">
                              <input name="cmd_retablir" type="reset" value="Rétablir">    
<input name="cmd_continuer" type="submit" value="Enregistrer">
  </div>
                          </div>
                        </form>
                  </div>
                    </td>
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
