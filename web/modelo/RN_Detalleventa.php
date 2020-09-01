<?php

require_once("data/Conexion.php");
require_once("RN_Venta.php");
require_once("RN_Producto.php");
class Detalleventa extends Conexion
{
	public $idVentaPFK;
	public $idProductoPFK;
	public $cantidad;
	public $subTotal;
	public $fecha_registro;
	public $hora_registro;
	public $estado;
	public $hash;

	function __construct()
	{
		$this->Open();
		$this->idVentaPFK = new Venta;
		$this->idProductoPFK = new Producto;
	}

	function Insertar_Detalleventa($_obj)
	{
		$sql="insert into detalleventa values(0,'etc')";
		$this->Execute($sql);
	}

	function TraerLista_Detalleventa($_obj)
	{
		$sql="select * from detalleventa";
		$this->Execute($sql);
	}

	function Modificar_Detalleventa($_obj)
	{
		$sql="update detalleventa set campo1='etc',campo2='etc' where id=0";
		$this->Execute($sql);
	}

	function Borrar_Detalleventa($_obj)
	{
		$sql="update detalleventa set estado='Inactivo' where id=0";
		$this->Execute($sql);
	}
}

?>