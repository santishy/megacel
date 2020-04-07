<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelEquipo extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function addEquipo($data)
	{
		$query=$this->db->query('call addEquipo('.$data['idCli'].',"'.$data['nomEquipo'].'","'.$data['marca'].'","'.$data['modelo'].'","'.$data['numSerie'].'","'.$data['descripcion'].'","'.$data['color'].'","'.$data['con'].'",@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		$this->db->close();
		return $ban;
	}
	function getIdEq($data)
	{
		$query=$this->db->query('select idEq from equipocliente where modelo="'.$data['modelo'].'" and marca="'.$data['marca'].'" and numSerie="'.$data['numSerie'].'" 
		and descripcion="'.$data['descripcion'].'" and color="'.$data['color'].'" and contraseña="'.$data['con'].'";');
		return $query;
	}
	function getEquipos($id)
	{
		$this->db->where('clientes.idCli',$id);
		$this->db->from('clientes');
		$this->db->join('equipocliente','clientes.idCli=equipocliente.idCli');
		$query=$this->db->get();
		return $query;
	}
	function getEquipoAjax($id)
	{
		$this->db->where('idEq',$id);
		$this->db->select("*");
		$query=$this->db->get("equipocliente");
		return $query;
	}
	function modiEquipo($data)
	{
		$query=$this->db->query('call modiEquipo('.$data['servicio'].','.$data['idEquipo'].','.$data['idCli'].',"'.$data['nomEquipo'].'","'.$data['marca'].'","'.$data['modelo'].'","'.$data['numSerie'].'","'.$data['descripcion'].'","'.$data['color'].'","'.$data['pass'].'",@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		$this->db->close();
		return $ban;
	}
	function modiFolio($folio,$idEquipo)
	{
		$arr=array('idEquipo'=>$idEquipo);
		//$arr['idEquipo']=$idEquipo;
		$this->db->where('folio',$folio);
		$this->db->update('folios',$arr);
	}
	function modiIdFolio($id,$folio)
	{
		$data['idEquipo']=$id;
		$this->db->where('folio',$folio);
		$query=$this->db->update('folios',$data);
		return $query;
	}
}