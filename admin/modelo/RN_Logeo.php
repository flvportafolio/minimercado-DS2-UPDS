<?php

require_once("data/Conexion.php");
require_once("RN_Persona.php");
class Logeo extends Conexion
{
	public $idLogeo;
	public $idUsuarioFK;
	public $intentos;
	public $fechaLogeo;
	public $horaLogeo;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idUsuarioFK = new Persona;
	}

	function registrar_logeo($intentos)
	{  
	  $sql="insert into logeo values(0,".$this->idUsuarioFK->idPersona.",$intentos,CURRENT_DATE(),CURRENT_TIME(),'A','')";
	  $res=$this->Execute($sql);
	  if ($res)
	  {
		$_lastid = mysqli_insert_id($this->getCon());
		$hash = sha1($_lastid);
		$sql = "Update logeo set hash = '$hash' where idLogeo = ".$_lastid;
		$res= $this->Execute($sql);
	  }
		return $res;
	}

	function TraerLista_Logeo()
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,l.intentos,l.fechaLogeo,l.horaLogeo from logeo AS l INNER JOIN persona AS p ON p.idPersona=l.idUsuarioFK WHERE l.estado ='A'";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
        $obj=new $this;
				$obj->idUsuarioFK->nombre=$row["nombre"];
				$obj->idUsuarioFK->apellidoPaterno=$row["apellidoPaterno"];
				$obj->idUsuarioFK->apellidoMaterno=$row["apellidoMaterno"];
        $obj->intentos=$row["intentos"];
				$obj->fechaLogeo=$row["fechaLogeo"];
				$obj->horaLogeo=$row["horaLogeo"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}

	function TraerLista_UltimosLogeados()
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,l.intentos,l.fechaLogeo,l.horaLogeo from logeo AS l INNER JOIN persona AS p ON p.idPersona=l.idUsuarioFK WHERE l.estado ='A' Order BY l.idLogeo DESC LIMIT 10";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
        $obj=new $this;
				$obj->idUsuarioFK->nombre=$row["nombre"];
				$obj->idUsuarioFK->apellidoPaterno=$row["apellidoPaterno"];
				$obj->idUsuarioFK->apellidoMaterno=$row["apellidoMaterno"];
        $obj->intentos=$row["intentos"];
				$obj->fechaLogeo=$row["fechaLogeo"];
				$obj->horaLogeo=$row["horaLogeo"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	/*function TraerLista_Logeo_10en10($page) no se implementara la paginacion por el momento
	{	$page=($page<=0)?1:$page;
		$sql="select l.idLogeo,p.nombre,p.apellidoPaterno,p.apellidoMaterno,l.intentos,l.fechaLogeo,l.horaLogeo from logeo AS l INNER JOIN persona AS p ON p.idPersona=l.idUsuarioFK WHERE l.estado ='A' LIMIT 10 OFFSET ".(($page-1)*10)."";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->idLogeo=$row["idLogeo"];
				$obj->idUsuarioFK->nombre=$row["nombre"];
				$obj->idUsuarioFK->apellidoPaterno=$row["apellidoPaterno"];
				$obj->idUsuarioFK->apellidoMaterno=$row["apellidoMaterno"];
        $obj->intentos=$row["intentos"];
				$obj->fechaLogeo=$row["fechaLogeo"];
				$obj->horaLogeo=$row["horaLogeo"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}*/

	function Modificar_Logeo($_obj)
	{
		$sql="update logeo set campo1='etc',campo2='etc' where id=0";
		$this->Execute($sql);
	}

	function Borrar_Logeo($_obj)
	{
		$sql="update logeo set estado='Inactivo' where id=0";
		$this->Execute($sql);
	}
}

?>