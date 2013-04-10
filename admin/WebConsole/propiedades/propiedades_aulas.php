<?php
// *************************************************************************************************************************************************
// Aplicación WEB: ogAdmWebCon
// Autor: José Manuel Alonso (E.T.S.I.I.) Universidad de Sevilla
// Fecha Creación: Año 2009-2010
// Fecha Última modificación: Agosto-2010
// Nombre del fichero: propiedades_aulas.php
// Descripción : 
//		 Presenta el formulario de captura de datos de un aula para insertar,modificar y eliminar
// *************************************************************************************************************************************************
include_once("../includes/ctrlacc.php");
include_once("../includes/opciones.php");
include_once("../includes/constantes.php");
include_once("../includes/CreaComando.php");
include_once("../includes/TomaDato.php");
include_once("../includes/HTMLSELECT.php");
include_once("../includes/HTMLCTESELECT.php");
include_once("../clases/AdoPhp.php");
include_once("../idiomas/php/".$idioma."/propiedades_aulas_".$idioma.".php");
//________________________________________________________________________________________________________
$opcion=0;
$opciones=array($TbMsg[0],$TbMsg[1],$TbMsg[2],$TbMsg[3]);
//________________________________________________________________________________________________________
$idaula=0; 
$nombreaula="";
$grupoid=0;
$ordenadores=0;
$ubicacion="";
$cagnon="";
$pizarra="";
$puestos=0;
$horaresevini="";
$horaresevfin="";
$comentarios="";
$router="";
$netmask="";
$modp2p="peer";
$timep2p="";
$modomul=2;
$ipmul="";
$pormulmetodos="";
$pormul=9000;
$velmul="";
$dns="";
$proxy="";
$idmenu="";
$idrepositorio="";
$idprocedimiento="";
$idperfilhard="";
$validacion="";
$paginalogin="";
$paginavalidacion="";

if (isset($_GET["opcion"])) $opcion=$_GET["opcion"]; // Recoge parametros
if (isset($_GET["idaula"])) $idaula=$_GET["idaula"]; 
if (isset($_GET["grupoid"])) $grupoid=$_GET["grupoid"]; 
if (isset($_GET["identificador"])) $idaula=$_GET["identificador"]; 

//________________________________________________________________________________________________________
$cmd=CreaComando($cadenaconexion); // Crea objeto comando
if (!$cmd)
	Header('Location: '.$pagerror.'?herror=2'); // Error de conexión con servidor B.D.
if  ($opcion!=$op_alta){
	$resul=TomaPropiedades($cmd,$idaula);
	if (!$resul)
		Header('Location: '.$pagerror.'?herror=3'); // Error de recuperación de datos.
}
else
	$urlfoto="aula.jpg";
//________________________________________________________________________________________________________
?>
<HTML>
<TITLE>Administración web de aulas</TITLE>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<LINK rel="stylesheet" type="text/css" href="../estilos.css">
	<SCRIPT language="javascript" src="../jscripts/validators.js"></SCRIPT>
	<SCRIPT language="javascript" src="../jscripts/propiedades_aulas.js"></SCRIPT>
	<SCRIPT language="javascript" src="../jscripts/opciones.js"></SCRIPT>
	<?php echo '<SCRIPT language="javascript" src="../idiomas/javascripts/'.$idioma.'/propiedades_aulas_'.$idioma.'.js"></SCRIPT>'?>
	<script language=javascript> 
function abrir_ventana(URL){ 
   window.open('../images/ver.php','Imagenes','scrollbars=yes,resizable=yes,width=950,height=640') 
} 
</script> 
</HEAD>
<BODY>
<DIV  align=center>
<FORM  name="fdatos" action="../gestores/gestor_aulas.php" method="post" enctype="multipart/form-data"> 
	<INPUT type=hidden name=opcion value="<? echo $opcion?>">
	<INPUT type=hidden name=idaula value="<? echo $idaula?>">
	<INPUT type=hidden name=grupoid value="<? echo $grupoid?>">
	<INPUT type=hidden name=ordenadores value="<? echo $ordenadores?>">
	
	<INPUT type=hidden name=gidmenu value="<? echo $gidmenu?>">
	<INPUT type=hidden name=gidprocedimiento value="<? echo $gidprocedimiento?>">
	<INPUT type=hidden name=gidrepositorio value="<? echo $gidrepositorio?>">
	<INPUT type=hidden name=gidperfilhard value="<? echo $gidperfilhard?>">
	
	<P align=center class=cabeceras><?echo $TbMsg[4]?><BR>
	<SPAN align=center class=subcabeceras><? echo $opciones[$opcion]?></SPAN></P>
	<TABLE  align=center border=0 cellPadding=1 cellSpacing=1 class=tabla_datos >
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<tr>
			<th align="center"><?php echo $TbMsg[5]?></th>
			<?php	if ($opcion==$op_eliminacion){
					echo '<td>'. $nombreaula.'</td>';
					echo '<td rowspan="5" colspan="2" valign="top" align=c"enter">
							<img border="3" style="border-color:#63676b" src="../images/fotos/'.$urlfoto.'" />
							<br />'.$TbMsg[21].': '. $ordenadores.'</td>';
			}
			else{
				echo '<td><input class="formulariodatos" name=nombreaula style="width:215" type=text value="'. $nombreaula.'" /></td>';
				echo'<td rowspan="5" colspan="2" valign="top" align="left"><img border="3" style="border-color:#63676b" src="../images/fotos/'.$urlfoto.'" /><br />'.$TbMsg[21].': '. $ordenadores.'<br />(150X110)-(jpg - gif - png) ---- '.$TbMsg[5091].'<br /><input name="archivo" type="file" id="archivo" size="16" /></td>';
			}
			?>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<tr>
			<th align=center>&nbsp;<?php echo $TbMsg[6]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td>'.$ubicacion.'&nbsp; </td>';
				else
					echo '<td><textarea   class="formulariodatos" name=ubicacion rows=3 cols=42>'.$ubicacion.'</textarea></td>';
			?>
		</tr>	
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[7]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion){
					echo '<td><input  class="formulariodatos" name=cagnon type=checkbox  onclick="desabilita(this)" ';
					if ($cagnon) echo ' checked ';
					echo '></td>';
			}
			else{
					echo '<td><input  class="formulariodatos" name=cagnon type=checkbox value="1" ';
					if ($cagnon) echo ' checked ';
					echo '></td>';
			}
			?>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[8]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion){
					echo '<td><input  class="formulariodatos" name=pizarra type=checkbox  onclick="desabilita(this)" ';
					if ($pizarra) echo ' checked ';
					echo '></td>';
				} else {
					echo '<td><input  class="formulariodatos" name=pizarra type=checkbox value="1"  ';
					if ($pizarra) echo ' checked ';
					echo '></td>';
				}
			?>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[9]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td>'.$puestos.'</td>';
				else
					echo '<td><input  class="formulariodatos" name=puestos style="width:30" type=text value='.$puestos.'></td>';
			?>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  HORARIO DE SERVICIO TEMPORALMENTE DESHABILITADO.
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[13]?>&nbsp;</TD>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$TbMsg[14].$horaresevini.'&nbsp;&nbsp;&nbsp&nbsp;'.$TbMsg[15].$horaresevfin.'</TD>';
				else
					echo '<TD colspan=3>'.$TbMsg[14].'&nbsp<INPUT  class="formulariodatos" onclick="vertabla_horas(this)"  name=horaresevini style="width:30" type=text value='.$horaresevini.'>&nbsp;&nbsp;&nbsp&nbsp;'.$TbMsg[15].'&nbsp<INPUT  class="formulariodatos" onclick="vertabla_horas(this)" name=horaresevfin style="width:30" type=text value='.$horaresevfin.'></TD>';
			?>
		</TR>
-->
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[10]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD  colspan=3>../images/fotos/'.$urlfoto.'</TD>';
				else{								
					?>
					<TD colspan=3><SELECT class="formulariodatos" name="urlfoto" >
						<?php if($urlfoto==""){
						echo '<option value="aula.gif"></option>';}else{
						echo '<option value="'.$urlfoto.'">'.$urlfoto.'</option>';}
						if ($handle = opendir("../images/fotos")) {
						while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {?>
						
						<option value="<? echo $entry ?>"><? echo $entry ?></option>
						<?}
						}
						closedir($handle);
						} 
						?>
					 </SELECT>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:abrir_ventana('../images/ver.php')" onClick="MM_openBrWindow('../images/ver.php','Imagenes','scrollbars=yes,resizable=yes,width=950,height=640')"><? echo $TbMsg[5092] ?></a>
					</TD>

					<?
					}
					?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[12]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$comentarios.'</TD>';
				else
					echo '<TD colspan=3><TEXTAREA   class="formulariodatos" name=comentarios rows=3 cols=65>'.$comentarios.'</TEXTAREA></TD>';
			?>
		</TR>
<!---- ADV ---------------------------router------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[28]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$router.'</TD>';
				else
					echo '<TD colspan=3><INPUT  class="formulariodatos" name=router style="width:100" type=text value='.$router.'></TD>';
			?>
		</TR>
<!---- ADV --------------------------netmask------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center&nbsp;><?echo $TbMsg[29]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$netmask.'</TD>';
				else
					echo '<TD colspan=3><INPUT  class="formulariodatos" name=netmask style="width:100" type=text value='.$netmask.'></TD>';
			?>
		</TR>
<!---- Ramón ------------------------dns------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg['PROP_DNSIP'] ?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td colspan="3">'.$dns.'</td>';
				else
					echo '<td colspan="3"><input class="formulariodatos" name="dns" style="width:100" type="text" maxlength="15" value="'.$dns.'" /></td>';
			?>
		</tr>
<!---- Ramón ------------------------proxy------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg['PROP_PROXYURL'] ?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td colspan="3">'.$proxy.'</td>';
				else
					echo '<td colspan="3"><input class="formulariodatos" name="proxy" style="width:200" type="text" maxlength="30" value="'.$proxy.'" /></td>';
			?>
		</tr>
<!---- ADV --------------------------p2pmodo------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[26]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$modp2p.'</TD>';
				else {
					echo '<TD colspan=3>';
					$p2pmetodos="peer=peer".chr(13);
					$p2pmetodos.="leecher=leecher".chr(13);
					$p2pmetodos.="seeder=seeder";
					echo HTMLCTESELECT($p2pmetodos,"modp2p","estilodesple","",$modp2p,100).'</TD>';
				}
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------p2p tiempo semillero--------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[27]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$timep2p.'</TD>';
				else
					echo '<TD colspan=3><INPUT  class="formulariodatos" name=timep2p style="width:100" type=text value='.$timep2p.'></TD>';
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[22]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion){
					$TBMetodos[0]="";
					$TBMetodos[1]="Half-Duplex";
					$TBMetodos[2]="Full-Duplex";
					echo '<TD colspan=3>'.$TBMetodos[$modomul].'</TD>';
				} else {
					echo '<TD colspan=3>';
					$metodos="0=".chr(13);
					$metodos.="1=Half-Duplex".chr(13);
					$metodos.="2=Full-Duplex";
					echo HTMLCTESELECT($metodos,"modomul","estilodesple","",$modomul,100).'</TD>';
				}
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[23]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$ipmul.'</TD>';
				else
					echo '<TD colspan=3><INPUT  class="formulariodatos" name=ipmul style="width:100" type=text value='.$ipmul.'></TD>';
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[24]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$pormul.'</TD>';
				else {
					echo '<td colspan="3">';
					for ($i=9000; $i<9050; $i+=2) {
						$pormulmetodos.="$i=$i".chr(13);
					}
					$pormulmetodos.="9050=9050";
					echo HTMLCTESELECT($pormulmetodos,"pormul","estilodesple","",$pormul,100).'</td>';
				}
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[25]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.$velmul.'</TD>';
				else
					echo '<TD colspan=3><INPUT  class="formulariodatos" name=velmul style="width:100" type=text value='.$velmul.'></TD>';
			?>
		</TR>				
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH style="BACKGROUND-COLOR:#FFFFFF;COLOR:#999999" colspan=4 align=center>&nbsp;<?echo $TbMsg[18]?>&nbsp;</TH>
		</TR>	
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[11]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.TomaDato($cmd,$idcentro,'menus',$idmenu,'idmenu','descripcion').'&nbsp;</TD>';
				else
					echo '<TD colspan=3>'.HTMLSELECT($cmd,$idcentro,'menus',$idmenu,'idmenu','descripcion',330).'</TD>';
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[16]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.TomaDato($cmd,$idcentro,'repositorios',$idrepositorio,'idrepositorio','nombrerepositorio').'&nbsp;</TD>';
				else
					echo '<TD colspan=3>'.HTMLSELECT($cmd,$idcentro,'repositorios',$idrepositorio,'idrepositorio','nombrerepositorio',330).'</TD>';
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[20]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.TomaDato($cmd,$idcentro,'procedimientos',$idprocedimiento,'idprocedimiento','descripcion').'&nbsp;</TD>';
				else
					echo '<TD colspan=3>'.HTMLSELECT($cmd,$idcentro,'procedimientos',$idprocedimiento,'idprocedimiento','descripcion',330).'</TD>';
			?>
		</TR>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<TR>
			<TH align=center>&nbsp;<?echo $TbMsg[17]?>&nbsp;</TH>
			<?
				if ($opcion==$op_eliminacion)
					echo '<TD colspan=3>'.TomaDato($cmd,$idcentro,'perfileshard',$idperfilhard,'idperfilhard','descripcion').'&nbsp;</TD>';
				else
					echo '<TD colspan=3>'.HTMLSELECT($cmd,$idcentro,'perfileshard',$idperfilhard,'idperfilhard','descripcion',330).'</TD>';
			?>
		</TR>		
<!--------------------------------------------------------------UHU comprobar si se requiere validacion -------------------------------------------------------------------------->
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[30]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td colspan="3">'.(($validacion == 1)?"Si":"No").'</td>';
				else {
					echo '<td colspan="3">';
					$validaciones="1=Si".chr(13);
					$validaciones.="0=No";
					echo HTMLCTESELECT($validaciones,"validacion","estilodesple","",$validacion,100).'</td>';
				}
			?>
		</tr>
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[31]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td colspan="3">'.$paginalogin.'</td>';
				else
					echo '<td colspan="3"><input class="formulariodatos" name="paginalogin" style="width:200" type="text" value="'.$paginalogin.'"></td>';
			?>
		</tr>
		<tr>
			<th align="center">&nbsp;<?php echo $TbMsg[32]?>&nbsp;</th>
			<?php	if ($opcion==$op_eliminacion)
					echo '<td colspan="3">'.$paginavalidacion.'</td>';
				else
					echo '<td colspan="3"><input class="formulariodatos" name="paginavalidacion" style="width:200" type="text" value="'.$paginavalidacion.'"></td>';
			?>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	</TABLE>
</FORM>
</DIV>
<?php
//________________________________________________________________________________________________________
include_once("../includes/opcionesbotonesop.php");
//________________________________________________________________________________________________________
?>
</BODY>
</HTML>
<?php
//________________________________________________________________________________________________________
//	Recupera los datos de un aula
//		Parametros: 
//		- cmd: Una comando ya operativo (con conexión abierta)  
//		- id: El identificador del aula
//________________________________________________________________________________________________________
function TomaPropiedades($cmd,$ida)
{
	global $idaula;
	global $nombreaula;
	global $urlfoto;
	global $cagnon;
	global $pizarra;
	global $ubicacion;
	global $comentarios;
	global $ordenadores;
	global $puestos;
	global $horaresevini;
	global $horaresevfin;
	global $grupoid;

	global $idmenu;
	global $idprocedimiento;
	global $idrepositorio;
	global $idperfilhard;
	
	global $gidmenu;
	global $gidprocedimiento;
	global $gidrepositorio;
	global $gidperfilhard;
###################### ADV	
	global $router;
	global $netmask;
	global $modp2p;
	global $timep2p;
###################### ADV
	global $modomul;
	global $ipmul;
	global $pormul;
	global $velmul;
###################### Ramón
	global $dns;
	global $proxy;
###################### UHU
        global $validacion;
        global $paginalogin;
        global $paginavalidacion;
###################### UHU
	
	$idaula=0; 
	$nombreaula="";
	$urlfoto="";
	$cagnon=false;
	$pizarra=false;
	$ubicacion="";
	$comentarios="";
	$ordenadores=0;
	$puestos=0;
	$horaresevini=0;
	$horaresevfin=0;
	$grupoid=0;	
## ADV #########################################
	$router=0;
	$netmask=0;
	$modp2p=0;
	$timep2p=0;
### ADV ########################################
	$modomul=0;
	$ipmul=0;
	$pormul=0;
	$velmul=0;
### UHU ########################################
        $validacion="";

	$idmenu=0;
	$idprocedimiento=0;
	$idrepositorio=0;
	$idperfilhard=0;

	$gidmenu=0;
	$gidprocedimiento=0;
	$gidrepositorio=0;
	$gidperfilhard=0;
	
	$rs=new Recordset; 
	$cmd->texto="SELECT	aulas.*, COUNT(ordenadores.idordenador) AS numordenadores,
				GROUP_CONCAT(DISTINCT CAST( ordenadores.idmenu AS char( 11 ) )  
				ORDER BY ordenadores.idmenu SEPARATOR ',' ) AS idmenus,
				GROUP_CONCAT(DISTINCT CAST( ordenadores.idrepositorio AS char( 11 ) )  
				ORDER BY ordenadores.idrepositorio SEPARATOR ',' ) AS idrepositorios,
				GROUP_CONCAT(DISTINCT CAST( ordenadores.idperfilhard AS char( 11 ) )  
				ORDER BY ordenadores.idperfilhard SEPARATOR ',' ) AS idperfileshard,
				GROUP_CONCAT(DISTINCT CAST( ordenadores.idproautoexec AS char( 11 ) )  
				ORDER BY ordenadores.idproautoexec SEPARATOR ',' ) AS idprocedimientos
			FROM aulas
			LEFT OUTER JOIN ordenadores ON ordenadores.idaula = aulas.idaula
			WHERE aulas.idaula =".$ida." 
			GROUP BY aulas.idaula";

	$rs->Comando=&$cmd; 
	if (!$rs->Abrir()) return(false); // Error al abrir recordset
	if (!$rs->EOF){
		$idaula=$rs->campos["idaula"];
		$nombreaula=$rs->campos["nombreaula"];
		$urlfoto=$rs->campos["urlfoto"];
		if ($urlfoto=="" ) $urlfoto="aula.jpg";
		$cagnon=$rs->campos["cagnon"];
		$pizarra=$rs->campos["pizarra"];
		$ubicacion=$rs->campos["ubicacion"];
		$comentarios=$rs->campos["comentarios"];
		$puestos=$rs->campos["puestos"];
		$horaresevini=$rs->campos["horaresevini"];
		$horaresevfin=$rs->campos["horaresevfin"];
		$grupoid=$rs->campos["grupoid"];
		$modomul=$rs->campos["modomul"];
		$ipmul=$rs->campos["ipmul"];
		$pormul=$rs->campos["pormul"];
		$velmul=$rs->campos["velmul"];
#################### ADV		
		$router=$rs->campos["router"];
		$netmask=$rs->campos["netmask"];
		$modp2p=$rs->campos["modp2p"];
		$timep2p=$rs->campos["timep2p"];
#################### Ramón
		$dns=$rs->campos["dns"];
		$proxy=$rs->campos["proxy"];
#################### UHU
		$validacion=$rs->campos["validacion"];
		$paginalogin=$rs->campos["paginalogin"];
		$paginavalidacion=$rs->campos["paginavalidacion"];
###################### UHU

		$ordenadores=$rs->campos["numordenadores"];
		$idmenu=$rs->campos["idmenus"];
		if(count(split(",",$idmenu))>1) $idmenu=0;		
		$idrepositorio=$rs->campos["idrepositorios"];
		if(count(split(",",$idrepositorio))>1) $idrepositorio=0;		
		$idperfilhard=$rs->campos["idperfileshard"];		
		if(count(split(",",$idperfilhard))>1) $idperfilhard=0;		
		$idmenu=$rs->campos["idmenus"];
		if(count(split(",",$idmenu))>1) $idmenu=0;		
		$idprocedimiento=$rs->campos["idprocedimientos"];
		if(count(split(",",$idprocedimiento))>1) $idprocedimiento=0;	
	
		$gidmenu=$idmenu;
		$gidprocedimiento=$idprocedimiento;
		$gidrepositorio=$idrepositorio;
		$gidperfilhard=$idperfilhard;

		$rs->Cerrar();
		return(true);
	}
	return(false);
}
?>

