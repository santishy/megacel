<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipos extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		//$this->load->library("form_validation");
		$this->load->model("ModelEquipo");
		$this->load->library('pagination');
	}
	public function index()
	{
			
	}
	public function addEquipo()
	{
		$data['idCli']=$this->input->post('idCli');
		$data['nomEquipo']=$this->input->post('nomEquipo');
		$data['marca']=$this->input->post('marca');
		$data['modelo']=$this->input->post('modelo');
		$data['numSerie']=$this->input->post('numSerie');
		$data['descripcion']=$this->input->post('descripcion');
		$data['color']=$this->input->post('color');
		$data['con']=$this->input->post('con');
		$ban=1;
		foreach ($data as $key => $value) {
			if(empty($data[$key]))
				{
					$ban=0;
					break;
				}
		}

		if($ban==1)
			$ban=$this->ModelEquipo->addEquipo($data);
		$arr=array();
		$arr['ban']=$ban;
		if($ban==1)
		{
			$query=$this->ModelEquipo->getIdEq($data);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$id=$row->idEq;
				}
				$arr['idEq']=$id;
				$this->ModelEquipo->modiFolio($this->session->userdata('numFolio'),$id);
				if($this->session->userdata('idEquipo'))
					$this->session->unset_userdata('idEquipo');
				$this->session->set_userdata('idEquipo',$id);
				echo json_encode($arr);
			}
			else
			{
				$arr['ban']=100;
				echo json_encode($arr);
			}
		}
		else
			echo json_encode($arr);
	}
	function getEquipoAjax()
	{
		$id=$this->input->post('comboId');
		$query=$this->ModelEquipo->getEquipoAjax($id);
		echo json_encode($query->result());
	}
	function getEquipoAjax2()
	{
		$id=$this->input->post('idEquipo');
		$query=$this->ModelEquipo->getEquipoAjax($id);
		echo json_encode($query->result());
	}
	function modiEquipoAjax()
	{
		$arr=array();
		$arr=$this->input->post();
		$ban=1;
		foreach ($arr as $key => $value) {
			if(empty($arr[$key]))
			{
				$ban=0;
				break;
			}
		}
		if($ban==1)
		{
			$query=$this->ModelEquipo->modiEquipo($arr);
			echo $query;
		}
		else
			echo $ban;

	}
	function modiIdFolio()
	{

		$data=$this->input->post();
		$query=$this->ModelEquipo->modiIdFolio($data['idEq'],$data['folio']);
		echo $query;
	}
}