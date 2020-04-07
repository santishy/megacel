<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelLogin extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}

	function Ingreso($data){
		$contraseña=$this->encrypt->sha1($data['txtPass']);
		$query=$this->db->query('call ingresoSistema("'.$data['txtUser'].'","'.$contraseña.'",'.$data['lstSuc'].',@ban,@tipo);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$arr['ban']=$row['@ban'];
		$tipo=$this->db->query('select @tipo');
		foreach($tipo->result_array() as $row)
			$arr['tipo']=$row['@tipo'];
		$this->db->close();
		return $arr;
	}
	public function getNomsuc($id)
	{
		$this->db->where('idsuc',$id);
		$this->db->select('nombre');
		$query=$this->db->get('sucursal');
		return $query;

	}
	public function getSucursal()
	{
		$this->db->where('estado',1);
		$this->db->select('idsuc,nombre');
		$query=$this->db->get('sucursal');
		return $query;
	}

}