<?php

require_once("data/Conexion.php");
require_once("RN_Persona.php");
class Usuariosistema extends Conexion
{
	public $idUsuario;
	public $alias;
	public $user;
	public $password;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idUsuario = new Persona;
	}

	function verificar()
	{//verifica el logeo de un usuariosistema
		$key="minimarket2020";
		$sql="select * from usuariosistema where user=AES_ENCRYPT('$this->user','$key') and password=AES_ENCRYPT('$this->password','$key') and estado='A'";
		$res=$this->Execute($sql);
		$dat=false;
		if(mysqli_num_rows($res)>0)
		{   
			$row=mysqli_fetch_array($res);
			$this->idUsuario=$row["idUsuario"];//hago pasar idUsuario como un integer
			$dataUser=array("hash"=>$row["hash"],"alias"=>$row["alias"]);
			$_SESSION["UsuarioRegistrado"]=$dataUser;
			$dat=true;
			
		}
		return $dat;
	}
	
	function Insertar_Usuariosistema()
	{
			$key="minimarket2020";
			$res=false;
			if($this->idUsuario->Insertar_Persona())//si se inserta la persona correctamente, inserto el usuariosistema
			{
				$sql = "insert into usuariosistema values(".$this->idUsuario->idPersona.",'$this->alias', AES_ENCRYPT('$this->user','$key'), AES_ENCRYPT('$this->password','$key'),CURRENT_DATE(),CURRENT_TIME(),'$this->estado',SHA1(".$this->idUsuario->idPersona."))";
				$res = $this->Execute($sql);
			}
      return $res;
	}

	function TraerLista_Usuariosistema()
	{
		$sql="select alias,fecha_registro,hora_registro,estado,hash from usuariosistema";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
        $obj_UserSis=new $this;
        $obj_UserSis->alias=$row["alias"];
					/*$obj_UserSis->user=$row["user"];
					$obj_UserSis->password=$row["password"];*/
				$obj_UserSis->fecha_registro=$row["fecha_registro"];
				$obj_UserSis->hora_registro=$row["hora_registro"];
				$obj_UserSis->estado=$row["estado"];
				$obj_UserSis->hash=$row["hash"];
        $lista[]=$obj_UserSis;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	}
	function Traer_UsuarioSistema()
	{
		$key="minimarket2020";
		$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.profesion,p.direccion,p.foto,p.fecha_nac,p.telefono,p.estado_civil,p.nivel_educ,p.pais_nac,p.genero,p.correo,us.alias,us.estado,AES_DECRYPT(us.user,'$key') as user,AES_DECRYPT(us.password,'$key') as password from usuariosistema as us inner join persona as p on p.idPersona=us.idUsuario where us.hash='".$this->hash."'";
		$res=$this->Execute($sql);
		$datos=false;
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
				$this->idUsuario->nombre=$row["nombre"];
				$this->idUsuario->apellidoPaterno=$row["apellidoPaterno"];
				$this->idUsuario->apellidoMaterno=$row["apellidoMaterno"];
				$this->idUsuario->genero=$row["genero"];
				$this->idUsuario->fecha_nac=$row["fecha_nac"];
				$this->idUsuario->pais_nac=$row["pais_nac"];
				$this->idUsuario->direccion=$row["direccion"];
				$this->idUsuario->correo=$row["correo"];
				$this->idUsuario->telefono=$row["telefono"];
				$this->idUsuario->estado_civil=$row["estado_civil"];
				$this->idUsuario->nivel_educ=$row["nivel_educ"];
				$this->idUsuario->profesion=$row["profesion"];
				$this->idUsuario->foto=$row["foto"];
				$this->alias=$row["alias"];
				$this->user=$row["user"];
				$this->password=$row["password"];
				$this->estado=$row["estado"];
				$datos=true;
		}
    return $datos;
	}

	function Modificar_Usuariosistema()
	{//manera correcta de usar el modificar, es decir que el res devuelva el 1 en caso de update sin errores.
		$key="minimarket2020";
		$res=false;
		if($this->idUsuario->Modificar_Persona())//si se modifica la persona correctamente, modifico el usuariosistema
		{
			$sql="update usuariosistema set alias='".$this->alias."',user=AES_ENCRYPT('".$this->user."','$key'),password=AES_ENCRYPT('$this->password','$key'),estado='".$this->estado."' where hash='".$this->hash."'";
			$res=$this->Execute($sql);//retorna 1 que equivale a true.
			if(mysqli_affected_rows($this->getCon())>0)//se verifica si hay un registro actualizado
			{
				$res=true;
			}
		}
	 	return $res;
	}
	
	function Traer_Datos_MenuPrincipal()
	{
		$sql="select ( SELECT COUNT(*) FROM producto WHERE producto.estado='A') AS total_prod, ( SELECT COUNT(*) FROM categoria WHERE categoria.estado='A') AS total_cat, ( SELECT COUNT(*) FROM subcategoria WHERE subcategoria.estado='A') AS total_subcat , ( SELECT COUNT(*) FROM marca WHERE marca.estado='A') AS total_marca ";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			$lista=array("total_productos"=>$row["total_prod"],"total_categorias"=>$row["total_cat"],"total_subcategorias"=>$row["total_subcat"],"total_marcas"=>$row["total_marca"]);
		}
		return $lista;
	}
	/*function Borrar_Usuariosistema($_obj)
	{
		$sql="update usuariosistema set estado='Inactivo' where id=0";
		$this->Execute($sql);
	}*/
}

?>