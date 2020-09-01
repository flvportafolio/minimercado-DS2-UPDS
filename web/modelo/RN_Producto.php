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

	function TraerLista_Producto()
	{
		$sql="select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' order by nombre asc";
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
	
	function TraerLista_Prod_Subcat()//trae el conteo de productos de cada subcategoria
	{
		$sql="select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM producto AS p INNER JOIN subcategoria AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categoria AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				//descripcion tendra el valor integer de la cantidad de productos
				$obj->descripcion=$row["cantidad_productos"];
				$obj->idSubCategoriaFK->nombre=$row["nombre_subcategoria"];
				$obj->idSubCategoriaFK->idCategoriaFK->nombre=$row["nombre_categoria"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}

	function TraerLista_UltimosProductos()//devuelve los ultimos 8 registros insertados.
	{
		$sql="select p.nombre AS 'nombre_prod',p.descripcion,p.foto,sc.nombre AS 'nombre_subcat',m.nombre AS 'nombre_marca' FROM producto AS p inner join subcategoria AS sc ON sc.idSubCategoria=p.idSubCategoriaFK inner join marca AS m ON m.idMarca=p.idMarcaFK WHERE p.estado='A' Order BY p.idProducto DESC LIMIT 8";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre_prod"];
				$obj->descripcion=$row["descripcion"];
				$obj->foto=$row["foto"];

				$obj->idSubCategoriaFK->nombre=$row["nombre_subcat"];
				$obj->idMarcaFK->nombre=$row["nombre_marca"];
				
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
	
}

?>