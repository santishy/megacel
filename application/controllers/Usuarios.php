<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		//$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->model('ModelUsuarios');
		$this->load->library('pagination');
		$this->load->library('Encrypt');
	}
	public function index()
	{

	}
	function bienvenida(){

		$data['title']="Usuarios";
		$data['ruta']="usuarios.js";
		$data['error']="";
		$data['message']="";
		$data['query']=$this->ModelUsuarios->getSucursal();
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['sucSel']=$this->session->userdata('idsuc');
		$this->load->view('templates/header',$data);
		$this->load->view('templates/bienvenida',$data);
	}
	function AddUser(){
			$arr=array();
			$arr=$this->input->post();
			$this->load->library('Encrypt');
			$query=$this->ModelUsuarios->AddUsusario($arr);
			echo $query;

	}
	public function redirectRendimiento()
	{
		$inicio=$this->input->post('inicio');
		$fin=$this->input->post('fin');
		$status=$this->input->post('status');
		$usuario=$this->input->post('usuario');
		$this->session->set_userdata('usuario',$usuario);
		$this->session->set_userdata('inicio_r',$inicio);
		$this->session->set_userdata('status',$status);
		$this->session->set_userdata('fin_r',$fin);
		redirect(base_url().'usuarios/rendimiento');
	}
	function VistaAdd(){
		/*if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');*/
		$data['title']="Usuarios";
		$data['ruta']="usuarios.js";
		$data['error']="";
		$data['message']="";
		$data['query']=$this->ModelUsuarios->getSucursal();
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['sucSel']=$this->session->userdata('idsuc');
		$this->load->view('templates/header',$data);
		$this->load->view("usuarios/agregaruser");
	}

	function ValidaUser($val){
		$nombre=$_POST['nombre'];
		if($val==1) //valida nickname no existente
		{

			$query=$this->ModelUsuarios->ValidaUser($nombre,$val);
			echo $query;
		}
		// valida emial no existente
		else if($val==2)
		{

			$query=$this->ModelUsuarios->ValidaUser($nombre,$val);
			echo $query;
		}

	}
	// validamos cuando estamos modificando
	function ValidaUserModi($val){
		$nombre=$_POST['nombre'];
		if($val==1) //valida nickname no existente
		{

			$query=$this->ModelUsuarios->ValidarUserModi($nombre,$val);
			echo $query;
		}
		// valida emial no existente
		else if($val==2)
		{

			$query=$this->Modelusuarios->ValidaUser($nombre,$val);
			echo $query;
		}

	}
	public function miUser()
	{
		if(!$this->session->userdata('nombre'))
			redirect(base_url().'login');
		$data['ruta']="miUser.js";
		$data['query']=$this->ModelUsuarios->miUser($this->session->userdata('nombre'));
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('usuarios/miUser');
	}

	public function modiUser()
	{
		$arr=array();
		$consulta="";
		$arr=$this->input->post();
		if(strcmp($arr['usuario_pass'],$arr['tempass'])!= 0)// encryptamos la contrasela en caso de haberla modificado
			$arr['usuario_pass']=$this->encrypt->sha1($arr['usuario_pass']);
		$data=array(
				'iduser'=>$arr['iduser'],
				'usuario_nombre'=>$arr['usuario_nombre'],
				'usuario_apellidop'=>$arr['usuario_apellidop'],
				'usuario_apellidom'=>$arr['usuario_apellidom'],
				'usuario_nickname'=>$arr['usuario_nickname'],
				'usuario_correo'=>$arr['usuario_correo'],
				'usuario_pass'=>$arr['usuario_pass'],
				'usuario_tipo'=>$arr['usuario_tipo'],
			);
		/* modifica datos */
		$resul=$this->ModelUsuarios->updateUsers($data);
		if($resul == 1){
				/* insertamos conexion con sucursales*/
				if($arr['usuario_tipo'] == 1){
					$query=$this->ModelUsuarios->getSucursal();
					if($query->num_rows()>0){
						foreach ($query->result() as $row) {
							$datos['idsuc']=$row->idsuc;
							$datos['iduser']=$arr['iduser'];
							$consulta=$this->ModelUsuarios->updateDetalleU($datos);

						}
					}
				}
				else{

					$query=$this->ModelUsuarios->getSucursal();
					if($query->num_rows()>0){
						foreach ($query->result() as $row) {
							$datos['idsuc']=$row->idsuc;
							$datos['iduser']=$arr['iduser'];
							if($datos['idsuc'] != $this->session->userdata('idsuc')){
								$consulta=$this->ModelUsuarios->deletPermiso($datos);

							}
						}
					}
				}
		}
		echo $resul;
	} // ---fin modiUser---

	function mostrarUsers(){
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');
		$data['query']=$this->ModelUsuarios->mostrarU();
		$data['title']="Usuarios";
		$data['ruta']="usuarios.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('usuarios/mostrarUsers');
	}

	function eliminarUsers(){
		$idU=$this->input->post('idU');
		$query=$this->ModelUsuarios->eliminarUser($idU);
		echo $query;
	}
	function getUsuarioAjax(){
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('iduser');
		$query=$this->ModelUsuarios->Mostrarmodi($id);
		echo json_encode($query->result());

	}
	public function updateMyuser( )
	{
		$arr=array();
		$arr=$this->input->post();
		if(strcmp($arr['txtPassh'],$arr['usuario_pass'])!= 0)// encryptamos la contrasela en caso de haberla modificado
			$arr['usuario_pass']=$this->encrypt->sha1($arr['usuario_pass']);
		$data=array(
				'iduser'=>$arr['iduser'],
				'usuario_nickname'=>$arr['usuario_nickname'],
				'usuario_pass'=>$arr['usuario_pass']
			);
		$query=$this->ModelUsuarios->updateMyuser($data);
		if($query==1)
			$this->session->set_userdata('nombre',$arr['usuario_nickname']);
		echo $query;
	}

	public function Permiso( )
	{
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('templates/permiso');
	}
	public function rendimiento()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');

		$url=base_url().'usuarios/rendimiento/';
		$uri=$this->uri->segment(3);
		if(empty($uri))
			$uri=0;
		if(!$this->session->userdata('inicio_r')){
			$this->session->set_userdata('inicio_r',date('Y-m-d'));
			$this->session->set_userdata('fin_r',date('Y-m-d'));
			$this->session->set_userdata('status','Terminado');
			$this->session->set_userdata('usuario',90000);
		}

		if($this->session->userdata('status')=='total')
		{
			$data['paginacion']=$this->paginate(
				$this->ModelUsuarios->filasRendimientoTotal($this->session->userdata('inicio_r'),$this->session->userdata('fin_r'),$this->session->userdata('status')),
				$url
			);
			// $data['sExpress']=$this->ModelUsuarios->getServiciosExpressTotal($this->session->userdata('inicio_r'),$this->session->userdata('fin_r'));
			$data['query']=$this->ModelUsuarios->rendimientoTotal($this->session->userdata('inicio_r'),$this->session->userdata('fin_r'),
				$uri,200,$this->session->userdata('status'));
		}else
		{

			$data['paginacion']=$this->paginate(
				$this->ModelUsuarios->filasRendimientoGeneral($this->session->userdata('usuario'),$this->session->userdata('inicio_r'),$this->session->userdata('fin_r'),$this->session->userdata('status')),
				$url
			);
			// $data['sExpress']=$this->ModelUsuarios->getServiciosExpress($this->session->userdata('usuario'),$this->session->userdata('inicio_r'),$this->session->userdata('fin_r'));
			$data['query']=$this->ModelUsuarios->rendimientoGeneral($this->session->userdata('inicio_r'),$this->session->userdata('fin_r'),$this->session->userdata('usuario'),
				$uri,200,$this->session->userdata('status'));
		}
		// $services=$data['sExpress']->result_object();
		// $data['total_express']=0;
		$data['total_material']=0;
		// foreach($services as $service){
		// 	$data['total_express']+=$service->total;
		// 	$data['total_material']+=$service->material;
		// }

		$data['total']=0;
		$data['numerosoporte']=0;
		$data['total_ref']=0;
		foreach ($data['query']->result() as $row) {
			$data['total']+=$row->total;
			$data['numerosoporte']+=$row->soporte;
			$data['total_ref']+=$row->refaccion;
		}
		$data['inicio']=$this->session->userdata('inicio_r');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['usuario']=$this->session->userdata('nombre');
		$data['fin']=$this->session->userdata('fin_r');
		$data['tecnico']=$this->session->userdata('usuario');
		$data['usuarios']=$this->ModelUsuarios->getUsuarios();
		$data['asistencias']=$this->ModelUsuarios->numSoporteDado($this->session->userdata('usuario'),$this->session->userdata('inicio_r'),$this->session->userdata('fin_r'));
		foreach($data['asistencias']->result() as $row)
		{
			$data['asistencias']=$row->numero;
		}
		$data['ruta']='rendimiento.js';
		$this->load->view('templates/header',$data);
		$this->load->view('usuarios/rendimiento');
	}
	public function asistencias()
	{
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['usuario']=$this->session->userdata('nombre');
		$data['query']=$this->ModelUsuarios->miSoporte($this->session->userdata('usuario'),$this->session->userdata('inicio_r'),$this->session->userdata('fin_r'));
		$data['ruta']='rendimiento.js';
		$this->load->view('templates/header',$data);
		$this->load->view('usuarios/asistencias');
	}
	function paginate($cantidad,$url)
	{
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['total_rows'] = $cantidad;
		$config['base_url']=$url;
		$config['per_page'] = 200;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link']="Último";
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link']="&raquo;";
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link']="&laquo;";
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open']='<li class="active"><a href="#">';
		$config['cur_tag_close']='</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		return $data['paginacion'] = $this->pagination->create_links();
	}
}
