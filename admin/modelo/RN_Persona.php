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

	function Insertar_Persona()
	{
		$sql="insert into persona values(0,'".$this->nombre."','".$this->apellidoPaterno."','".$this->apellidoMaterno."','".$this->genero."','".$this->fecha_nac."','".$this->pais_nac."','".$this->direccion."','".$this->correo."','".$this->telefono."','".$this->estado_civil."','".$this->nivel_educ."','".$this->profesion."','".$this->foto."',CURRENT_DATE(),CURRENT_TIME(),'".$this->estado."','".$this->hash."')";
		$res=$this->Execute($sql);
		if($res)
		{
			$this->idPersona = mysqli_insert_id($this->getCon());
			$hash = sha1($this->idPersona);
			$sql2 = "update persona set hash = '$hash' where idPersona = ".$this->idPersona;
			$res2 = $this->Execute($sql2);
			$res=$res2;
		}
		return $res;
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

	function Modificar_Persona()
	{
		$sql="update persona set nombre='".$this->nombre."',apellidoPaterno='".$this->apellidoPaterno."',apellidoMaterno='".$this->apellidoMaterno."',genero='".$this->genero."',fecha_nac='".$this->fecha_nac."',pais_nac='".$this->pais_nac."',direccion='".$this->direccion."',correo='".$this->correo."',telefono='".$this->telefono."',estado_civil='".$this->estado_civil."',nivel_educ='".$this->nivel_educ."',profesion='".$this->profesion."',foto='".$this->foto."',estado='".$this->estado."' where hash='".$this->hash."'";
		$res=$this->Execute($sql);//devuelve 1
		if(mysqli_affected_rows($this->getCon())>0)
		{
			$res=true;
		}
		return $res;		 
	}

	function Borrar_Persona($_obj)
	{
		$sql="update persona set estado='Inactivo' where id=0";
		$this->Execute($sql);
	}
}

?>