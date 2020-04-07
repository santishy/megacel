<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPedido extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function addPedido($data)
	{
		$query=$this->db->insert('pedidos',$data);
		return $query;
	}
	function comprobarPass($pass)
	{
		$this->db->where('usuario_pass',$pass);
		$query=$this->db->get('usuarios');
		return $query;
	}
	function getMiercoles($fecha)
	{
		$this->db->where('fecha_orden >=',$fecha);
		$query=$this->db->get('pedidos');
		return $query;
	}
	function eliminarPedido($id_pedido)
	{
		$this->db->where('id_pedido',$id_pedido);
		$this->db->delete('pedidos');
	}
}