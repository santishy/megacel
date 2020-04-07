<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRef extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function addRef($data)
	{
		$query=$this->db->query('call addRefaccion('.$this->session->userdata('idsuc').',"'.$data['nombreAcc'].'","'.$data['marca'].'",'.$data['precio'].',"'.$data['descripcion'].'",'.$data['cant'].',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function consultaGeneralRef($id,$uri=0,$tope)
	{
		$query=$this->db->query('call mostrarRef('.$id.','.$uri.','.$tope.');');
		//$query->store_result();
		return $query;

	}
	function numRows($id)
	{
		$this->db->where("sucursal.idsuc",$id);
		$this->db->select('*');
		$this->db->from('sucursal');
		$this->db->join('detrefsuc','detrefsuc.idsuc=sucursal.idsuc');
		$this->db->join('refacciones','refacciones.idref=detrefsuc.idref');
		$query=$this->db->get();
		return $query->num_rows();
	}
	function getSuc()
	{
		
		$query=$this->db->query('select *from sucursal where estado=1');
		return $query;
	}
	function getRef($id,$suc)
	{
		$this->db->where('refacciones.idref',$id);
		$this->db->where('detrefsuc.idsuc',$suc);
		$this->db->select('nombreAcc,refacciones.idref,sucursal.idsuc,cant,descripcion,precio,marca');
		$this->db->from('sucursal');
		$this->db->join('detrefsuc','detrefsuc.idsuc=sucursal.idsuc');
		$this->db->join('refacciones','refacciones.idref=detrefsuc.idref');
		$query=$this->db->get();
		return $query;
	}
	function modiRefdb($data)
	{
		$query=$this->db->query('call modiRef('.$data['idref'].','.$data['idsuc'].',"'.$data['nombreAcc'].'","'.$data['marca'].'",'.$data['precio'].',"'.$data['descripcion'].'",'.$data['cant'].',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function venderRef($idref,$idServ,$idsuc,$cant,$precio)
	{
		$query=$this->db->query('call venderRef('.$idref.','.$idServ.','.$idsuc.','.$cant.','.$precio.',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function eliRefaccion($id,$idsuc)
	{
		$query=$this->db->query('call eliRefaccion('.$id.','.$idsuc.',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
}