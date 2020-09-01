<?php

require_once("data/Conexion.php");
require_once("RN_Categoria.php");
class Subcategoria extends Conexion
{
	public $idSubCategoria;
	public $nombre;
	public $descripcion;
	public $idCategoriaFK;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idCategoriaFK = new Categoria;
	}

	function EstablecerId()//a través del hash establezco el idSubCategoria de la instancia
	{
		$sql="select idSubCategoria from subcategoria where hash='".$this->hash."' and estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			$this->idSubCategoria=$row["idSubCategoria"];
			$datos=true;
		}
    return $datos;
	}

	function TraerLista_Subcategoria()
	{
		$sql="select sc.nombre,sc.descripcion,c.nombre AS 'categoria',sc.fecha_registro,sc.hora_registro,sc.estado,sc.hash from subcategoria AS sc INNER JOIN categoria AS c ON c.idCategoria=sc.idCategoriaFK WHERE sc.estado='A'";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
        $obj=new $this;
        $obj->nombre=$row["nombre"];
				$obj->descripcion=$row["descripcion"];
				$obj->idCategoriaFK->nombre=$row["categoria"];
				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	
	function Traer_Subcategoria()
	{
		$sql="select sc.nombre,sc.descripcion,c.hash AS 'categoria',sc.fecha_registro,sc.hora_registro,sc.estado,sc.hash from subcategoria AS sc INNER JOIN categoria AS c ON c.idCategoria=sc.idCategoriaFK WHERE sc.hash='".$this->hash."' and sc.estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->nombre=$row["nombre"];
				$this->descripcion=$row["descripcion"];
				$this->idCategoriaFK->hash=$row["categoria"];
				$datos=true;
		}
    return $datos;
	}
	
}

?>