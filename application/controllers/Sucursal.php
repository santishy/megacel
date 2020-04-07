<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursal extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->model("ModelSuc");
	}
	public function index()
	{
			
	}
	public function addsuc()
	{
		/*if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');*/
		$this->form_validation->set_rules('nombre','Nombre','required|trim');
		$this->form_validation->set_rules('domicilio','Domicilio','required|trim');
		$this->form_validation->set_rules('localidad','Localidad','required|trim');
		$this->form_validation->set_rules('edo','Estado','required|trim');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$data['title']="Bienvenido";
			$data['ruta']="validarsuc.js";
			$data['message']="";
			$data['error']="";
			$data['usuario']=$this->session->userdata('nombre');
			$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
			$this->load->view('templates/header',$data);
			$this->load->view('sucursales/addsucursal');
		}
		else
		{
			$suc['nombre']=$this->input->post('nombre');
			$suc['domicilio']=$this->input->post('domicilio');
			$suc['localidad']=$this->input->post('localidad');
			$suc['edo']=$this->input->post('edo');
			$suc['telefono']=$this->input->post('telefono');
			$query=$this->ModelSuc->addsuc($suc);
			switch ($query) {
				case 1:
					$data['title']="Bienvenido";
					$data['ruta']="validarsuc.js";
					$data['message']="Sucursal Agregada";
					$data['error']="";
					$data['usuario']=$this->session->userdata('nombre');
					$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
					$this->load->view('templates/header',$data);
					$this->load->view('sucursales/addsucursal',$data);
					break;
				case 2:
					$data['title']="Bienvenido";
					$data['ruta']="validarsuc.js";
					$data['message']="";
					$data['error']="La dirección ya existe, elija otra";
					$data['usuario']=$this->session->userdata('nombre');
					$this->load->view('templates/header',$data);
					$this->load->view('sucursales/addsucursal',$data);
					break;
				case 3:
					$data['title']="Bienvenido";
					$data['ruta']="validarsuc.js";
					$data['message']="";
					$data['error']="El nombre ya existe, elija otro";
					$data['usuario']=$this->session->userdata('nombre');
					$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
					$this->load->view('templates/header',$data);
					$this->load->view('sucursales/addsucursal',$data);
					break;
				default:
					# code...
					break;
			}
			
		}
	}
	function mostrar()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');
		$data['query']=$this->ModelSuc->mostrarsuc();
		$data['ruta']="validarsuc.js";
		$data['title']="Sucursales";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('sucursales/mostrarsucs');
	}
	function ajaxSucursal()
	{
		$id=$this->input->post('idsuc');
		$query=$this->ModelSuc->getSuc($id);
		echo json_encode($query->result());
	}
	function modiSuc()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$data['nombre']=$this->input->post('nombre');
		$data['domicilio']=$this->input->post('domicilio');
		$data['localidad']=$this->input->post('localidad');
		$data['edo']=$this->input->post('edo');
		$data['telefono']=$this->input->post('telefono');
		$data['idsuc']=$this->input->post('idsuc');
		$ban=false;
		foreach ($data as $key => $value) 
		{
				if(!empty($value))
					$ban=true;
				else
				{
					$ban=false;
					break;
				}
		}
		if($ban)
		{
			$query=$this->ModelSuc->modiSuc($data);
			echo $query;
		}
		else
		{
			echo 'error';
		}

	}
	function eliminar_suc()
	{
		$id=$this->input->post('idsuc');
		$this->ModelSuc->eliminarsuc($id);
		echo '1';
	}
}