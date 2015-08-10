<? 
include('config.php');
require_once('myGenerator.class.php');
$newMyGenerator = new myGenerator();
// Si les informations de connections ne sont pas valide
if(!$newMyGenerator->connexion)
	{
	// Redirection à la page d'accueil
	header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
	}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Choix de la base des donn&eacute;es MySQL - myGenerator 2006</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
function isDataValid(theForm)
	{
	if(theForm.database_name.selectedIndex == 0)
		{
		alert("Base des données invalide!");
		theForm.database_name.focus();
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
                    <h2 align="left">Etape 1 : Choix de la base des donn&eacute;es MySQL</h2>
                    <div align="justify">
                      <p> Pour commencer indiquer le nom de la base des donn&eacute;es concern&eacute;e puis cliquer sur suivant. </p>
                      
                    </div><form action="etape2.php" method="post" name="form_existe" onSubmit="return(isDataValid(this))">
<div align="left" style="border: #69A2AD 1px solid; padding:10px "> 
<div align="left">
<div align="left" style="MARGIN-TOP: 15px;">
Choisissez le nom de votre base des donn&eacute;es 
  <select name="database_name">
    <option></option>
    <?
$array = $newMyGenerator->getAllDataBases();
	
	if (!empty($array))
		{
		$i=0; 
		while(!empty($array[$i]))
			{?>
    <option value="<? echo $array[$i]->Database; ?>"><? echo $array[$i]->Database; ?></option>
    <? $i++;
			}
		
		}
?>
  </select>
</div>
<div align="left" style="MARGIN-TOP: 20px; background-color:#CAEBF0; padding:5px">
     <input name="cmd_continuer" type="button" onClick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="« Infos de connexion">
     <input name="cmd_continuer" type="submit" value="Suivant &raquo;">
     </div>
 </div>
</div>
</form>
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
