<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->load->model("ModelLogin");
		$this->load->library('pagination');
		$this->load->library('encrypt');
		$this->load->library('session');
	}
	public function index()
	{
		$data['query']=$this->ModelLogin->getSucursal();
		$this->load->view("login/login",$data);
	}
	public function Login()
	{
		$arr=array();
		$arr=$this->input->post();
		$query=$this->ModelLogin->Ingreso($arr);
		if ($query['ban'] == '1'){
			$sesion_data=array(
					'nombre'=>$arr['txtUser'],
					'idsuc'=>$arr['lstSuc']
					);
			$this->session->set_userdata('tipo',$query['tipo']);
			$this->session->set_userdata($sesion_data);
			$suc=$this->ModelLogin->getNomsuc($arr['lstSuc']);
			foreach ($suc->result() as $row) {
				$this->session->set_userdata('nomSuc',$row->nombre);
			}
		}
		echo json_encode($query);
	}
	public function Redirect( )
	{
		Redirect('serviciofolio/mostrarServicios');
	}
	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		$data['query']=$this->ModelLogin->getSucursal();
		$this->load->view("login/login",$data);
	}
	public function bienvenida()
	{
		$data['usuario']=$this->session->userdata('nombre');
		$data['title']="Bienvenido Sistema";
		$data['tipo']=$this->session->userdata('tipo');
		Redirect('Usuarios/Bienvenida');
	}
	public function comprobar()
	{
		if(!$this->session->userdata('tipo'))
			Redirect(base_url().'login/cerrarSesion');
	}
}
