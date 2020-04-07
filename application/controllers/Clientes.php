<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', 'El %s no es valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->model("ModelCli");
		$this->load->model("ModelEquipo");
		$this->load->library('pagination');
	}
	public function index()
	{
			
	}

	public function addCliente()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$this->form_validation->set_rules('nombre','Nombre','required|trim');
		//$this->form_validation->set_rules('correo','Correo','trim|valid_email');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		//$this->form_validation->set_rules('celular','Celular','trim');
		$this->form_validation->set_rules('fecha','Fecha','required|trim');
		//$this->form_validation->set_rules('direccion','direccion','required|trim');
		//$this->form_validation->set_rules('estado','Estado','required|trim');
		//$this->form_validation->set_rules('ciudad','Estado','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$this->formAgregar('','');
		}
		else
		{

			$data['nombre']=$this->input->post('nombre');
			//$data['correo']=$this->input->post('correo');
			$data['telefono']=$this->input->post('telefono');
			//$data['celular']=$this->input->post('celular');
			$data['fecha']=$this->input->post('fecha');
			$data['direccion']=$this->input->post('direccion');
			//$data['ciudad']=$this->input->post('ciudad');
			//$data['estado']=$this->input->post('estado');
			$ban=$this->ModelCli->addCli($data);
			if($ban==1 || $ban==2)
			{
				//$this->formAgregar('','Cliente Agregado');
				$query=$this->ModelCli->getIdCli($data);
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row) 
					{
						$arr['idcli']=$row->idCli;
						$arr['nombre']=$row->nombre;
						$arr['ruta']="servicio.js";
					}
					$arr['query']=$this->ModelEquipo->getEquipos($arr['idcli']);
					$arr['usuario']=$this->session->userdata('nombre');
					$arr['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
					//$arr['query']=$this->ModelEquipo->getEquipos($id);
					$arr['folio']="";
					$this->load->view('templates/header',$arr);
					$this->load->view('servicios/addservicio');
				}
				else
				{
						$this->formAgregar('','');
				}

			}
			else
			{
				$this->formAgregar('Ese cliente ya Existe','');
			}
		}
	}
	function formAgregar($error,$mns)
	{
			$data['title']="Clientes";
			$data['ruta']="cli.js";
			$data['error']=$error;
			$data['message']=$mns;
			$data['usuario']=$this->session->userdata('nombre');
			$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
			$this->load->view('templates/header',$data);
			$this->load->view('clientes/agregarcliente');
	}
	function mostrar($offset=0)
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$uri_segment=3;
			$offset=$this->uri->segment($uri_segment);	
			if(empty($offset))
				$offset=0;
			else
				if($offset=="eliminarCli")
					$offset=0;
		$config['base_url']=base_url().'clientes/mostrar';
		$config['total_rows']=$this->ModelCli->numRows();
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelCli->consultaGeneralCli($offset,$config['per_page']);
		$data['title']="Clientes";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="clientesgeneral.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('clientes/mostrarcliente');	
	
	}
	function buscar()
	{
		$nombre=trim($this->input->post('nombre'),' ');
		if(strlen($nombre)==0)
			redirect('clientes/mostrar');
		$data['query']=$this->ModelCli->buscar($nombre);
		$data['paginacion']="";
		$data['title']="Clientes";
		$data['cont']="";
		$data['ruta']="clientesgeneral.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('clientes/mostrarcliente');	
	

	}
	function rellenarAjaxCli()
	{
		$id=$this->input->post('idCli');
		$query=$this->ModelCli->getCli($id);
		echo json_encode($query->result());
	}
	function modiCliAjax()
	{
		/*$data['nombre']=$this->input->post('nombre');
		$data['correo']=$this->input->post('correo');
		$data['telefono']=$this->input->post('telefono');
		$data['celular']=$this->input->post('celular');
		$data['fecha']=$this->input->post('fecha');
		$data['direccion']=$this->input->post('direccion');
		$data['estado']=$this->input->post('estado');
		$data['idCli']=$this->input->post('idCli');*/
		$data=array();
		$data=$this->input->post();
		$ban=1;
		foreach ($data as $key => $value) 
		{
				if(empty($data[$key]))
				{
					$ban=0;
					break;
				}
		}
		
		if($ban==1)
		{
			$query=$this->ModelCli->modiCli($data);
			echo $query;
		}
		else
		{
			echo $ban;
		}
	}
	function eliminarCli()
	{
		$id=$this->input->post('idCli');
		$ban=$this->ModelCli->eliminarCli($id);
		echo $ban;
		//$this->mostrar();
	}
	function addF()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('idCli');
		$arr['title']="Servicios";
		$arr['idcli']=$id;
		$arr['nombre']=$this->input->post('nombre');
		$arr['ruta']="servicio.js";
		$arr['query']=$this->ModelEquipo->getEquipos($id);
		$arr['usuario']=$this->session->userdata('nombre');
		$arr['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$arr['folio']=$this->input->post('folio');
		$this->load->view('templates/header',$arr);
		$this->load->view('servicios/addservicio');
	}
	
}
