<?php

require_once("data/Conexion.php");
class Persona extends Conexion
{
	public $idPersona;
	public $nombre;
	public $apellidoPaterno;
	public $apellidoMaterno;
	public $genero;
	public $fecha_nac;
	public $pais_nac;
	public $direccion;
	public $correo;
	public $telefono;
	public $estado_civil;
	public $nivel_educ;
	public $profesion;
	public $foto;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
	}

	function TraerLista_Persona($_obj)
	{
		$sql="select * from persona";
		$this->Execute($sql);
	}
	function TraerPersonas_US_EU()//obtiene las personas que son usuariosistema y empleadousuario
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.genero,p.fecha_nac,p.pais_nac,p.direccion,p.correo,p.telefono,p.estado_civil,p.nivel_educ,p.profesion,p.foto,p.fecha_registro,p.hora_registro from persona AS p 
		WHERE p.idPersona IN(SELECT eu.idEmpleado FROM empleadousuario AS eu UNION ALL SELECT us.idUsuario FROM usuariosistema AS us) and p.estado='A'";

		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre"];
				$obj->apellidoPaterno=$row["apellidoPaterno"];
				$obj->apellidoMaterno=$row["apellidoMaterno"];
				$obj->genero=$row["genero"];
				$obj->fecha_nac=$row["fecha_nac"];
				$obj->pais_nac=$row["pais_nac"];
				$obj->direccion=$row["direccion"];
				$obj->correo=$row["correo"];
				$obj->telefono=$row["telefono"];
				$obj->estado_civil=$row["estado_civil"];
				$obj->nivel_educ=$row["nivel_educ"];
				$obj->profesion=$row["profesion"];
				$obj->foto=$row["foto"];
				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	
}

?>