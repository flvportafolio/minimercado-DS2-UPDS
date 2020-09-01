<?php

require_once("data/Conexion.php");
require_once("RN_Persona.php");
require_once("RN_Cargo.php");
class Empleadousuario extends Conexion
{
	public $idEmpleado;
	public $idCargoFK;
	public $ci; // es de tipo integer
	public $user;
	public $password;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idEmpleado = new Persona;
		$this->idCargoFK = new Cargo;
	}

	function verificar()
	{//verifica el logeo de un empleadousuario
		$key="minimarket2020";
		$sql="select e.idEmpleado,c.nombre AS 'cargo',e.hash from empleadousuario AS e INNER JOIN cargo AS c ON c.idCargo=e.idCargoFK where e.user=AES_ENCRYPT('$this->user','$key') and e.password=AES_ENCRYPT('$this->password','$key') and e.estado='A'";
		$res=$this->Execute($sql);
		$dat=false;
		if(mysqli_num_rows($res)>0)
		{   
			$row=mysqli_fetch_array($res);
			$this->idEmpleado=$row["idEmpleado"];//hago pasar idUsuario como un integer
			$dataUser=array("hash"=>$row["hash"],"alias"=>$row["cargo"]);
			$_SESSION["UsuarioRegistrado"]=$dataUser;
			$dat=true;
			
		}
		return $dat;
	}

	function Insertar_Empleadousuario()
	{
		$key="minimarket2020";
		$res=false;
		if($this->idEmpleado->Insertar_Persona())//si se inserta la persona correctamente, inserto el usuariosistema
		{	
			if($this->idCargoFK->EstablecerId()) //si se logra establecer el IdCargo, se procede a insertar el registro
			{
				$sql="insert into empleadousuario values(".$this->idEmpleado->idPersona.",".$this->idCargoFK->idCargo.",".$this->ci.", AES_ENCRYPT('".$this->user."','$key'), AES_ENCRYPT('".$this->password."','$key'), CURRENT_DATE(),CURRENT_TIME(), '".$this->estado."', SHA1(".$this->idEmpleado->idPersona."))";
				$res=$this->Execute($sql);
			}			
		}		
		return $res;
	}

	function TraerLista_Empleadousuario()
	{
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,c.nombre AS cargo,eu.ci,eu.fecha_registro,eu.hora_registro,eu.estado,eu.hash from empleadousuario AS eu INNER JOIN persona AS p ON p.idPersona=eu.idEmpleado INNER JOIN cargo AS c ON c.idCargo=eu.idCargoFK";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj_Empl=new $this;
				$obj_Empl->idEmpleado->nombre=$row["nombre"];
				$obj_Empl->idEmpleado->apellidoPaterno=$row["apellidoPaterno"];
				$obj_Empl->idEmpleado->apellidoMaterno=$row["apellidoMaterno"];
				$obj_Empl->idCargoFK->nombre=$row["cargo"];
        $obj_Empl->ci=$row["ci"];
					/*$obj_Empl->user=$row["user"];
					$obj_Empl->password=$row["password"];*/
				$obj_Empl->fecha_registro=$row["fecha_registro"];
				$obj_Empl->hora_registro=$row["hora_registro"];
				$obj_Empl->estado=$row["estado"];
				$obj_Empl->hash=$row["hash"];
        $lista[]=$obj_Empl;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	function Traer_Empleadousuario()
	{
		$key="minimarket2020";
		$sql="select c.hash AS cargo,eu.ci,p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.profesion,p.direccion,p.foto,p.fecha_nac,p.telefono,p.estado_civil,p.nivel_educ,p.pais_nac,p.genero,p.correo,AES_DECRYPT(eu.user,'$key') as user,AES_DECRYPT(eu.password,'$key') as password,eu.estado from empleadousuario AS eu  inner join persona as p on p.idPersona=eu.idEmpleado inner join cargo AS c ON c.idCargo=eu.idCargoFK where eu.hash='".$this->hash."'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->idEmpleado->nombre=$row["nombre"];
				$this->idEmpleado->apellidoPaterno=$row["apellidoPaterno"];
				$this->idEmpleado->apellidoMaterno=$row["apellidoMaterno"];
				$this->idEmpleado->genero=$row["genero"];
				$this->idEmpleado->fecha_nac=$row["fecha_nac"];
				$this->idEmpleado->pais_nac=$row["pais_nac"];
				$this->idEmpleado->direccion=$row["direccion"];
				$this->idEmpleado->correo=$row["correo"];
				$this->idEmpleado->telefono=$row["telefono"];
				$this->idEmpleado->estado_civil=$row["estado_civil"];
				$this->idEmpleado->nivel_educ=$row["nivel_educ"];
				$this->idEmpleado->profesion=$row["profesion"];
				$this->idEmpleado->foto=$row["foto"];
				
				$this->idCargoFK->hash=$row["cargo"];

				$this->ci=$row["ci"];
				$this->user=$row["user"];
				$this->password=$row["password"];
				$this->estado=$row["estado"];
				$datos=true;
		}
    return $datos;
	}

	function Modificar_Empleadousuario()
	{
		//manera correcta de usar el modificar, es decir que el res devuelva el 1 en caso de update sin errores.
		$key="minimarket2020";
		$res=false;
		if($this->idEmpleado->Modificar_Persona())//si se modifica la persona correctamente, modifico el usuariosistema
		{
			if($this->idCargoFK->EstablecerId()) //si se logra establecer el IdCargo, se procede a modificar el registro
			{
				$sql="update empleadousuario set idCargoFK=".$this->idCargoFK->idCargo.",ci='".$this->ci."',user=AES_ENCRYPT('".$this->user."','$key'),password=AES_ENCRYPT('$this->password','$key'),estado='".$this->estado."' where hash='".$this->hash."'";
				$res=$this->Execute($sql);//retorna 1 que equivale a true.
				if(mysqli_affected_rows($this->getCon())>0)//se verifica si hay un registro actualizado
				{
					$res=true;
				}
			}
		}
	 	return $res;
	}

	function Borrar_Empleadousuario($_obj)
	{
		$sql="update empleadousuario set estado='Inactivo' where id=0";
		$this->Execute($sql);
	}
}

?>