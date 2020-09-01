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

	function Insertar_Subcategoria()
	{
		$res=false;
		if($this->idCategoriaFK->EstablecerId()) //si se logra establecer el idCategoria, se procede a insertar el registro
		{
			$sql="insert into subcategoria values(0,'".$this->nombre."','".$this->descripcion."',".$this->idCategoriaFK->idCategoria.",CURRENT_DATE(),CURRENT_TIME(),'A','')";
			$res=$this->Execute($sql);
			if ($res)
			{
				$this->idSubCategoria = mysqli_insert_id($this->getCon());
				$this->hash = sha1($this->idSubCategoria);
				$sql = "update subcategoria set hash = '".$this->hash."' where idSubCategoria = ".$this->idSubCategoria;
				$res= $this->Execute($sql);
			}
		}
		return $res;
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

	function Modificar_Subcategoria()
	{
		$res=false;
		if($this->idCategoriaFK->EstablecerId()) //si se logra establecer el idCategoria, se procede a modificar el registro
		{
			$sql="update subcategoria set nombre='".$this->nombre."',descripcion='".$this->descripcion."',idCategoriaFK=".$this->idCategoriaFK->idCategoria." where hash='".$this->hash."'";
			$res=$this->Execute($sql);//retorna 1 que equivale a true.
			if(mysqli_affected_rows($this->getCon())>0)//se verifica si hay un registro actualizado
			{
				$res=true;
			}
		}				
	 	return $res;
	}

	function Borrar_Subcategoria()
	{
		$sql="update subcategoria set estado='I' where hash='".$this->hash."'";
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