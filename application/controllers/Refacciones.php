<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refacciones extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->model("ModelRef");
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->form_validation->set_message('xss_clean', '%s es invalido');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		
	}
	public function index()
	{
			
	}
	public function addRef()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$this->form_validation->set_rules('nombreAcc','Nombre','required|trim|xss_clean');
		$this->form_validation->set_rules('marca','Marca','required|trim');
		$this->form_validation->set_rules('precio','Precio','required|trim');
		$this->form_validation->set_rules('descripcion','Descripcion','trim');
		$this->form_validation->set_rules('cant','Cantidad','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$this->frmAddRef('','');	
		}
		else
		{
			$data['nombreAcc']=$this->input->post('nombreAcc');
			$data['marca']=$this->input->post('marca');
			$data['precio']=$this->input->post('precio');
			$data['descripcion']=$this->input->post('descripcion');
			$data['cant']=$this->input->post('cant');
			$ban=$this->ModelRef->addRef($data);
			echo $ban;
			/*if($ban==1 || $ban==2 || $ban==3)
				$this->frmAddRef('Refaccion Agregada','');	
			else
				if($ban==4)
					$this->frmAddRef('','Error con Sucursal');	
				else
					$this->frmAddRef('','Error reinicie el Sistema');*/	
		}
		
	}
	public function frmAddRef($success,$error)
	{
		$data['title']="Refacciones";
		$data['ruta']="refacciones.js";
		$data['error']=$error;
		$data['message']=$success;
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('refacciones/addRefaccion',$data);
		$this->load->view('templates/footer');
	}
	function consultaGeneral()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('idsuc');
		if($id=="")
			$this->session->set_userdata('idsuc2',$this->session->userdata('idsuc')); // valor por default (ingresar suc)
		else
			$this->session->set_userdata('idsuc2',$id);
		$this->mostrar();
	}
	public function mostrar($offset=0)
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'refacciones/mostrar';
		$config['total_rows']=$this->ModelRef->numRows($this->session->userdata('idsuc2'));
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
		
		
		$data['query']=$this->ModelRef->consultaGeneralRef($this->session->userdata('idsuc2'),$offset,$config['per_page']);
		//$data['query']->next_result();
		//$data['query']->store_result();
		//$data['query']->free_result();
		$data['suc']=$this->ModelRef->getSuc(); // chekar abajo
		$data['title']="Refacciones";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="refacciones.js";
		$data['sucSel']=$this->session->userdata('idsuc2');
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('refacciones/getrefacciones');	
	}
	public function cargarServicio()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('idServ'))
			$this->session->unset_userdata('idServ',$this->input->post('idServ'));
		$this->session->set_userdata('idServ',$this->input->post('idServ'));
		$this->vender();
	}
	public function vender()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$data['idServ']=$this->session->userdata('idServ');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'refacciones/vender';
		$config['total_rows']=$this->ModelRef->numRows($this->session->userdata('idsuc')); //agregar sucursal por defecto solamente
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
		$data['query']=$this->ModelRef->consultaGeneralRef($this->session->userdata('idsuc'),$offset,$config['per_page']);
		//$data['query']->next_result();
		$data['title']="Refacciones";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="carrito.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('refacciones/venderref');	
	}
	function getRefaccion()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('idref');
		$suc=$this->input->post('idsuc');
		if($id!="" and $suc!="")
		{
			$data['message']="";
			$data['error']="";
			$data['query']=$this->ModelRef->getRef($id,$suc);
			if($data['query']->num_rows()>0)
			{
				$data['title']="Refaccion";
				$data['ruta']="default.js";
				$data['usuario']=$this->session->userdata('nombre');
				$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
				$this->load->view('templates/header',$data);
				$this->load->view('refacciones/modiref');
			}
			else
			{
				echo '<script>alert("ya no existe la refaccion")</script>';
				$this->consultaGeneral();
			}
		}
		else
			$this->consultaGeneral();
	}
	function modiref()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$this->form_validation->set_rules('nombreAcc','Nombre','required|trim');
		$this->form_validation->set_rules('marca','Marca','required|trim');
		$this->form_validation->set_rules('descripcion','Descripcion','required|trim');
		$this->form_validation->set_rules('cant','Cantidad','required|trim');
		$this->form_validation->set_rules('precio','Precio','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$this->getRefaccion();
		}
		else
		{
			$data['nombreAcc']=$this->input->post('nombreAcc');
			$data['marca']=$this->input->post('marca');
			$data['descripcion']=$this->input->post('descripcion');
			$data['precio']=$this->input->post('precio');
			$data['cant']=$this->input->post('cant');
			$data['idsuc']=$this->input->post('idsuc');
			$data['idref']=$this->input->post('idref');
			$ban=$this->ModelRef->modiRefdb($data);
			switch ($ban) 
			{
				case 1:
					$this->frmModiRef('Modificación Correcta','',$data['idref'],$data['idsuc']);
					break;
				case 2:
					$this->frmModiRef('','Ya existe ese producto',$data['idref'],$data['idsuc']);
					break;
				case 3:
					$this->frmModiRef('','Esa refaccion no esta en la sucursal',$data['idref'],$data['idsuc']);
					break;
				case 4:
					$this->frmModiRef('','Ya no existe la refacción',$data['idref'],$data['idsuc']);
					break;

				case 5:
					$this->frmModiRef('','Ya no existe la sucursal',$data['idref'],$data['idsuc']);
					break;
				case 6:
					$this->frmModiRef('','Ocurrio un error Reinicie el sistema',$data['idref'],$data['idsuc']);
					break;
				default:
					# code...
					break;
			}
		}
	}
	function frmModiRef($success,$error,$id,$suc)
	{
		$data['message']=$success;
		$data['error']=$error;
		$data['query']=$this->ModelRef->getRef($id,$suc);
		$data['ruta']="default.js";
		$data['title']="Refaccion";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('refacciones/modiref');
	}
	function agregarCarrito()
	{

		$data=array('id' =>$this->input->post('id') ,
		'qty'=>$this->input->post('qty'),
		'price'=>$this->input->post('price'),
		'name'=>$this->input->post('name'),
		'idServ'=>$this->input->post('idServ'));
		$this->cart->insert($data);
		
	}
	function prueba()
	{
		$data['title']="Refaccion";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('refacciones/prueba');
	}
	function actualizar()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$data=$this->input->post();
		//$uri=$this->input->post('uri');
		$this->cart->update($data);
		redirect('serviciofolio/mostrarSalida/'.$uri.'');
	}
	function destruir(){
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$this->session->unset_userdata('idServ');
		//$uri=$this->input->post('uri');
		//$this->session->unset_userdata('uri');
		$this->cart->destroy();
		//redirect('serviciofolio/mostrarSalida/'.$uri.'');
		redirect('serviciofolio/mostrarSalida/');
	}
	function terminar()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		foreach($this->cart->contents() as $items)
		{
			$query=$this->ModelRef->venderRef($items['id'],$items['idServ'],$this->session->userdata('idsuc'),$items['qty'],$items['price']);
		
		}
		$this->session->unset_userdata('idServ');
		//$uri=$this->input->post('uri');
		//$this->session->unset_userdata('uri');
		$this->cart->destroy();
		//redirect('serviciofolio/mostrarSalida/'.$uri.'');
		redirect('serviciofolio/mostrarSalida/');
	}
	function eliminarRef()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('idref');
		$idsuc=$this->input->post('idsuc');
		$ban=$this->ModelRef->eliRefaccion($id,$idsuc);
		echo $ban;
	}
	
}