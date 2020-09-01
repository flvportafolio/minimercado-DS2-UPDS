<?php

require_once("data/Conexion.php");
require_once("RN_Marca.php");
require_once("RN_Subcategoria.php");
class Producto extends Conexion
{
	public $idProducto;
	public $nombre;
	public $descripcion;
	public $foto;
	public $idSubCategoriaFK;
	public $idMarcaFK;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idMarcaFK = new Marca;
		$this->idSubCategoriaFK = new Subcategoria;
	}

	function Insertar_Producto()
	{
		$res=false;
		if($this->idSubCategoriaFK->EstablecerId() && $this->idMarcaFK->EstablecerId()) //si se logra establecer el idSubCategoria y idMarca, se procede a insertar el registro
		{
			$sql="insert into producto values(0,'".$this->nombre."','".$this->descripcion."','".$this->foto."',".$this->idSubCategoriaFK->idSubCategoria.",".$this->idMarcaFK->idMarca.",CURRENT_DATE(),CURRENT_TIME(),'A','')";
			$res=$this->Execute($sql);
			if ($res)
			{
				$this->idProducto = mysqli_insert_id($this->getCon());
				$this->hash = sha1($this->idProducto);
				$sql = "update producto set hash = '".$this->hash."' where idProducto = ".$this->idProducto;
				$res= $this->Execute($sql);
			}
		}
		return $res;
	}

	function TraerLista_Producto()
	{
		$sql="select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A'";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre"];
				$obj->descripcion=$row["descripcion"];
				$obj->foto=$row["foto"];

				$obj->idSubCategoriaFK->nombre=$row["subcategoria"];
				$obj->idMarcaFK->nombre=$row["marca"];

				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}

	function Traer_Producto()
	{
		$sql="select prod.nombre,prod.descripcion,prod.foto,sc.hash AS 'subcategoria',m.hash AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' and prod.hash='".$this->hash."'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->nombre=$row["nombre"];
				$this->descripcion=$row["descripcion"];
				$this->foto=$row["foto"];

				$this->idSubCategoriaFK->hash=$row["subcategoria"];
				$this->idMarcaFK->hash=$row["marca"];
				$datos=true;
		}
    return $datos;
	}

	function TraerLista_UltimosProductos()//devuelve los ultimos 8 registros insertados.
	{
		$sql="select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' Order BY prod.idProducto DESC LIMIT 10";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre"];
				$obj->descripcion=$row["descripcion"];
				$obj->foto=$row["foto"];

				$obj->idSubCategoriaFK->nombre=$row["subcategoria"];
				$obj->idMarcaFK->nombre=$row["marca"];

				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	
	function Modificar_Producto()
	{
		$res=false;
		if($this->idSubCategoriaFK->EstablecerId() && $this->idMarcaFK->EstablecerId()) //si se logra establecer el idSubCategoria y idMarca, se procede a modificar el registro
		{
			$sql="update producto set nombre='".$this->nombre."',descripcion='".$this->descripcion."',foto='".$this->foto."',idSubCategoriaFK=".$this->idSubCategoriaFK->idSubCategoria.",idMarcaFK=".$this->idMarcaFK->idMarca." where hash='".$this->hash."'";
			$res=$this->Execute($sql);//retorna 1 que equivale a true.
			if(mysqli_affected_rows($this->getCon())>0)//se verifica si hay un registro actualizado
			{
				$res=true;
			}
		}
		return $res;
	}

	function Borrar_Producto()
	{
		$sql="update producto set estado='I' where hash='".$this->hash."'";
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