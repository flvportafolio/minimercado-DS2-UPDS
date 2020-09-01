<?php

require_once("data/Conexion.php");
require_once("RN_Persona.php");
class Marca extends Conexion
{
	public $idMarca;
	public $nombre;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idMarca = new Persona;
	}

	function EstablecerId()//a través del hash establezco el idMarca de la instancia
	{
		$sql="select idMarca from marca where hash='".$this->hash."' and estado='A'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			$this->idMarca=$row["idMarca"];
			$datos=true;
		}
    return $datos;
	}

	function TraerLista_Marca()
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,m.nombre AS 'marca',m.fecha_registro,m.hora_registro,m.estado,m.hash from marca AS m INNER JOIN persona AS p ON p.idPersona =m.idMarca WHERE m.estado='A' order by marca asc";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->idMarca->nombre=$row["nombre"];
				$obj->idMarca->apellidoPaterno=$row["apellidoPaterno"];
				$obj->idMarca->apellidoMaterno=$row["apellidoMaterno"];

        $obj->nombre=$row["marca"];
				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	
	function Traer_Marca()
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,m.nombre AS 'marca',p.profesion,p.direccion,p.foto,p.fecha_nac,p.telefono,p.estado_civil,p.nivel_educ,p.correo,p.pais_nac,p.genero,p.estado from marca AS m INNER JOIN persona AS p ON p.idPersona =m.idMarca where m.hash='".$this->hash."' and m.estado='A' ";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->idMarca->nombre=$row["nombre"];
				$this->idMarca->apellidoPaterno=$row["apellidoPaterno"];
				$this->idMarca->apellidoMaterno=$row["apellidoMaterno"];
				$this->idMarca->genero=$row["genero"];
				$this->idMarca->fecha_nac=$row["fecha_nac"];
				$this->idMarca->pais_nac=$row["pais_nac"];
				$this->idMarca->direccion=$row["direccion"];
				$this->idMarca->correo=$row["correo"];
				$this->idMarca->telefono=$row["telefono"];
				$this->idMarca->estado_civil=$row["estado_civil"];
				$this->idMarca->nivel_educ=$row["nivel_educ"];
				$this->idMarca->profesion=$row["profesion"];
				$this->idMarca->foto=$row["foto"];
				
				$this->nombre=$row["marca"];
				$this->estado=$row["estado"];
				$datos=true;
		}
    return $datos;
	}	
}

?>