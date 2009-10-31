﻿<?
// *************************************************************************************************************************************************
// Aplicación WEB: ogAdmWebCon
// Autor: José Manuel Alonso (E.T.S.I.I.) Universidad de Sevilla
// Fecha Creación: Año 2003-2004
// Fecha Última modificación: Marzo-2005
// Nombre del fichero: gruposordenadores_eliminacion.php
// Descripción :
//	Elimina en cascada registros de la tabla gruposordenadores 
//		Parametros: 
//		-	cmd:Una comando ya operativo (con conexión abierta)  
//		-	identificador: El identificador por el que se eliminará el grupo de ordenadores
//		-	nombreid: Nombre del campo identificador del registro 
//		-	swid: Indica 0= El identificador es tipo alfanumérico	1= EI identificador es tipo numérico ( valor por defecto) *************************************************************************************************************************************************
function	EliminaGruposOrdenadores($cmd,$identificador,$nombreid,$swid=1){
	if (empty($identificador)) return(true);
	if($swid==0)
		$cmd->texto="SELECT  idgrupo  FROM  gruposordenadores WHERE ".$nombreid."='".$identificador."'";
	else
		$cmd->texto='SELECT  idgrupo  FROM gruposordenadores WHERE '.$nombreid.'='.$identificador;
	$rs=new Recordset; 
	$rs->Comando=&$cmd; 
	if (!$rs->Abrir()) return(false); // Error al abrir recordset
	if ($rs->numeroderegistros==0) return(true);
	$rs->Primero(); 
	while (!$rs->EOF){
		$resul=EliminaGruposOrdenadores($cmd,$rs->campos["idgrupo"],"grupoid");
		if ($resul)
			$resul=EliminaOrdenadores($cmd,$rs->campos["idgrupo"],"grupoid");

		if (!$resul){
			$rs->Cerrar();
			return(false);
		}
		$rs->Siguiente();
	}
	if($swid==0)
		$cmd->texto="DELETE  FROM gruposordenadores WHERE ".$nombreid."='".$identificador."'";
	else
		$cmd->texto='DELETE  FROM gruposordenadores  WHERE '.$nombreid.'='.$identificador;
	$resul=$cmd->Ejecutar();
	return($resul);
}
?>
