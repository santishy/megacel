<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->model('ModelPedido');
		$this->load->library('pagination');
		$this->load->library('encrypt');
	}
	public function index()
	{

	}
	public function addPedido()
	{
		$this->form_validation->set_rules('orden','Pedido','required|trim');
		$this->form_validation->set_rules('fecha_orden','Fecha','required');
		$this->form_validation->set_rules('user','Password','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$this->frmPedido("");
		}
		else
		{
			$data=$this->input->post();
			$query=$this->ModelPedido->addPedido($data);
			if($query==1)
				$data['mensaje']="Insercion Correcta";
			else
				$data['mensaje']="Insercion Incorrecta";
			$this->frmPedido($data['mensaje']);
		}
	}
	function frmPedido($mensaje)
	{
		$data['titulo']="LIBERACEL";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		date_default_timezone_set('America/Monterrey');
		$data['fecha']=date('Y-m-d',strtotime('wednesday'));
		$data['query']=$this->ModelPedido->getMiercoles($data['fecha']);
		$data['ruta']="pedidos.js";
		$data['mensaje']=$mensaje;
		$this->load->view('templates/header',$data);
		$this->load->view('pedidos/addpedido');
	}
	function comprobarPass()
	{
		$pass=$this->input->post('pass');
		if(strlen($pass)>0)
			$pass=$this->encrypt->sha1($pass);
		$query=$this->ModelPedido->comprobarPass($pass);
		$nombre=0;
		foreach ($query->result() as $row) 
		{
			$nombre=$row->usuario_nombre.' '.$row->usuario_apellidop;
		}
		echo $nombre;
	}
	function eliminarPedido()
	{
		$id_pedido=$this->input->post('id_pedido');
		$query=$this->ModelPedido->eliminarPedido($id_pedido);
		$this->frmPedido($id_pedido);
	}
}