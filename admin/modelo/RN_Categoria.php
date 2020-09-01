<?php

require_once("data/Conexion.php");
class Categoria extends Conexion
{
	public $idCategoria;
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

	function Insertar_Categoria()
	{
		$sql="insert into categoria values(0,'".$this->nombre."','".$this->descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')";
		$res=$this->Execute($sql);
		if ($res)
	  {
			$this->idCategoria = mysqli_insert_id($this->getCon());
			$this->hash = sha1($this->idCategoria);
			$sql = "update categoria set hash = '".$this->hash."' where idCategoria = ".$this->idCategoria;
			$res= $this->Execute($sql);
	  }
		return $res;
	}
	function EstablecerId()//a través del hash establezco el idCategoria de la instancia
	{
		$sql="select idCategoria from categoria where hash='".$this->hash."' and estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			$this->idCategoria=$row["idCategoria"];
			$datos=true;
		}
    return $datos;
	}
	function TraerLista_Categoria()
	{
		$sql="select * from categoria where estado='A'";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
        $obj_Cat=new $this;
        $obj_Cat->nombre=$row["nombre"];
        $obj_Cat->descripcion=$row["descripcion"];
				$obj_Cat->fecha_registro=$row["fecha_registro"];
				$obj_Cat->hora_registro=$row["hora_registro"];
				$obj_Cat->estado=$row["estado"];
				$obj_Cat->hash=$row["hash"];
        $lista[]=$obj_Cat;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	function Traer_Categoria()
	{
		$sql="select * from categoria where hash='".$this->hash."' and estado='A'";
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
	
	function Modificar_Categoria()
	{
		$sql="update categoria set nombre='".$this->nombre."',descripcion='".$this->descripcion."' where hash='".$this->hash."'";
		$this->Execute($sql);
		$res=false;
		if(mysqli_affected_rows($this->getCon())>0)
		{
			$res=true;
		}
	 	return $res;
	}

	function Borrar_Categoria()
	{//tambien se puede borrar por id en vez de hash
		$sql="update categoria set estado='I' where hash='".$this->hash."'";
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