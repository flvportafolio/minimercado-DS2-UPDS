<?php

require_once("data/Conexion.php");
class Cargo extends Conexion
{
	public $idCargo;
	public $nombre;
	public $descripcion;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
	}

	function Insertar_Cargo()
	{
		$sql="insert into cargo values(0,'".$this->nombre."','".$this->descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')";
		$res=$this->Execute($sql);
		if ($res)
	  {
			$this->idCargo = mysqli_insert_id($this->getCon());
			$this->hash = sha1($this->idCargo);
			$sql = "update cargo set hash = '".$this->hash."' where idCargo = ".$this->idCargo;
			$res= $this->Execute($sql);
	  }
		return $res;
	}

	function TraerLista_Cargo()
	{
		$sql="select * from cargo where estado='A'";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre"];
				$obj->descripcion=$row["descripcion"];
				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	function Traer_Cargo()
	{
		$sql="select * from cargo where hash='".$this->hash."' and estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->nombre=$row["nombre"];
				$this->descripcion=$row["descripcion"];
				$datos=true;
		}
    return $datos;
	}
	function EstablecerId()//a través del hash establezco el idCargo de la instancia
	{
		$sql="select idCargo from cargo where hash='".$this->hash."' and estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			$this->idCargo=$row["idCargo"];
			$datos=true;
		}
    return $datos;
	}
	function Modificar_Cargo()
	{
		$sql="update cargo set nombre='".$this->nombre."',descripcion='".$this->descripcion."' where hash='".$this->hash."'";
		$this->Execute($sql);
		$res=false;
		if(mysqli_affected_rows($this->getCon())>0)
		{
			$res=true;
		}
	 	return $res;
	}
	function Borrar_Cargo()
	{
		$sql="update cargo set estado='I' where hash='".$this->hash."'";
		$this->Execute($sql);
		$res=false;
		if(mysqli_affected_rows($this->getCon())>0)
		{
			$res=true;
		}
	  return $res;
	}
}

?>