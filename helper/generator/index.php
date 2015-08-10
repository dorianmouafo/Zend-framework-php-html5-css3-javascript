<? 
include('config.php');
require_once('myGenerator.class.php');
$newMyGenerator = new myGenerator();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Bienvenue &agrave; myGenerator 2006</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
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
                    <h2 align="left">Bienvenue &agrave; myGenerator 2006 </h2>
                    <div align="justify">
                      <p>MyGenerator 2006 est un g&eacute;n&eacute;rateur de back office en <strong>PHP</strong> (pages web d'administration), pour les bases des donn&eacute;es <strong>MySql</strong>, simple &agrave; utiliser et facile &agrave; int&eacute;grer dans votre site Internet. MyGenerator 2006 est distribu&eacute; sous licence GNU : voir le fichier <a href="GNU-License.txt" target="_blank">GNU-License.txt</a> pour plus d'infos. Il est aussi conseill&eacute; de lire le fichier <a href="lisez-moi.txt" target="_blank">lisez-moi.txt</a> si c'est la premi&egrave;re fois que vous allez utiliser myGenerator 2006.
                    </div></p>
<div align="justify" style="border: <? if($_REQUEST['msg']){ ?>#07AB14<? }else{ ?>#69A2AD<? } ?> 1px solid; padding:10px "> 
  <? if($_REQUEST['msg']){?><img src="images/ico_success.gif" width="32" height="32" align="absmiddle"> Informations de connexion enregistrées avec succès!<br><br><? }?>
  Les informations de connexion &agrave; MySql ('<strong><? echo $newMyGenerator->host; ?></strong>', '<strong><? echo $newMyGenerator->user; ?></strong>', '<em><? if($newMyGenerator->pwd) {echo 'avec mot de passe';} else {echo 'sans mot de passe';} ?></em>') sont 
  <? if($newMyGenerator->connexion){?>
  valide.
  <? }else{?><span class="ROUGE">invalide!</span><? }?><br>
  <br>
  Utiliser le bouton <em>Changer infos de connexion MySql </em> pour fournir d'autres informations de connexion &agrave; myGenerator 2006. Celles de l'utilisateur root sont recommand&eacute;.<br>
  <br>
  <span <? if(!$newMyGenerator->connexion) echo 'class="disabled_text"';?>>Cliquer sur <em>Passer &agrave; l'&eacute;tape 1</em> pour commencer la g&eacute;n&eacute;ration de back office.</span>
  <div align="left" style="MARGIN-TOP: 20px; background-color:#CAEBF0; padding:5px">
     <input name="cmd_continuer" type="button" onClick="MM_goToURL('parent','infos_connexion.php');return document.MM_returnValue" value="Changer infos de connexion MySql">
     <input name="cmd_continuer" type="button" onClick="MM_goToURL('parent','etape1.php');return document.MM_returnValue" value="Passer à l'étape 1 »" <? if(!$newMyGenerator->connexion) echo 'disabled';?>>
     </div>
</div>
                  </div>
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
