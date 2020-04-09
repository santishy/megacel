<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServicioFolio extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->model("ModelServicio");
		$this->load->library('encrypt');
		$this->load->library('pagination');
		$this->load->helper('date');
	}
	public function index()
	{

	}
	public function tiempo()
	{

	}
	function comprobarPass()
	{
		$pass=$this->input->post("pass");
		if(strlen($pass)>0)
			$pass=$this->encrypt->sha1($pass);
		$query=$this->ModelServicio->getNameUser($pass);
		$name="1";
		foreach ($query->result() as $row) {
			$name=$row->usuario_nombre." ".$row->usuario_apellidop;
			$this->session->set_userdata('iduser',$row->iduser);
		}
		echo $name;
	}
	public function agregarSoporte(){
		$pass=$this->input->post("pass");
		$data=$this->input->post();
		$json['ban']=false;
		$pass=$this->encrypt->sha1($this->input->post('usuario_pass'));
		$query=$this->ModelServicio->getNameUser($pass);
		foreach($query->result() as $row)
		{
			$iduser=$row->iduser;
		}

		if(isset($iduser) && strlen($pass)>0){
			$query=$this->ModelServicio->comprobarSoporte($iduser,$this->input->post('id_servicio'));
			if(count($query->result_array())==0)
			{	unset($data['usuario_pass']);
				$data['id_usuario']=$iduser;
				$json['ban']=$this->ModelServicio->agregarSoporte($data);
			}
			else{
				$soporte=$query->row_array();


				date_default_timezone_set('America/Monterrey');
				$update['fecha_asistencia']=date('Y-m-d H:i:s');
				$update['aporte']=$data['aporte'];
				$json['ban']=$this->ModelServicio->updateSoporte($update,$soporte['id']);
			}
		}
		echo json_encode($json);
	}
	function folioPDF()
	{
		$suc=$this->ModelServicio->getSuc($this->session->userdata['idsuc']);
		$ticket=$this->ModelServicio->getTicket();
		foreach ($ticket->result() as $row) {
			$header=$row->ticket_header;
			$logo=$row->ticket_logo;
			$mensaje=$row->ticket_mensaje;
			$mensajet=$row->ticket_mensajet;
			$pagina=$row->ticket_sitio;
		}
		foreach ($suc->result() as $row) {
			$nombreSuc=$row->nombre;
			$localidad=$row->localidad;
			$domicilio=$row->domicilio;
			$phone=$row->telefono;
			$estado=$row->edo;

		}
		$fol=$this->uri->segment(3);
		$query=$this->ModelServicio->ticket($fol,$this->session->userdata('idEquipo'));
		foreach ($query->result() as $row) {
			$folio=$row->folio;
			$fecha_salida=$row->fecha_salida;
			$fecha=$row->fecha;
			$edo=$row->estadogeneral;
			$nombre=$row->nombre;
			$nomEquipo=$row->nomEquipo;
			$numSerie=$row->numSerie;
			$tipo=$row->tipo;
			$falla=$row->falla;
			$marca=$row->marca;
			$color=$row->color;
			// $botones=$row->botones;
			$modelo=$row->modelo;
			$solucion=$row->solucion;
			$total=$row->total;
			$subtotal=$row->subtotal;
			$touch=$row->cables;
			// $display=$row->discos;
			$carcasa=$row->accesorios;
			$bateria=$row->calcas;
			// $prende=$row->golpes;
			$usuario=$row->atendio;
			$telefono=$row->tel;
			$contra=$row->pass;
			$entrego=$row->entrego;
			$cotizacion=$row->cotizacion;
			$memoria=$row->memoria;
			$descripcion=$row->descripcion;
			$chip=$row->chip;
		}
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm',array(80,295));
		$pdf->AddPage();
		//$pdf->Image('img/thumbs/'.$logo.'.jpg',15,5,0,0);
		$pdf->SetMargins(5,10,5);
		$pdf->SetFont('Arial','B',8);
		//$pdf->Ln(10);
		$pdf->Cell(0,5,strtoupper(utf8_decode($header)),0,1,'C');
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(0,5,'SUCURSAL '.strtoupper(utf8_decode($nombreSuc)) .'',0,1,'C');
		$pdf->Cell(0,1,strtoupper(utf8_decode($domicilio)),0,1,'C');
		$pdf->Cell(0,5,''.utf8_decode('TEL').' '.utf8_decode($phone).'',0,1,'C');
		$pdf->Cell(0,1,''.strtoupper(utf8_decode($localidad)).' '.strtoupper(utf8_decode($estado)).'',0,1,'C');
		$pdf->Ln(5);
		if($edo=="Entregado")
			$pdf->Cell(0,5,'Fecha '.$fecha_salida.'','TB',1,'C');
		else
			$pdf->Cell(0,5,'Fecha '.$fecha.'','TB',1,'C');
		$pdf->SetFont('Arial','B',8);
		$pdf->Ln(5);
		$pdf->Cell(10,5,'TIPO:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(20,5,utf8_decode($tipo),0,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(10,5,'Folio',1,0,'L',1);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(25,5,$folio,1,1,'L');
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,5,'CLIENTE:',0,1,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,1,utf8_decode($nombre),0,1);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(12,1,'MARCA:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(23,1,utf8_decode($marca),0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(8,1,'MOD:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(27,1,utf8_decode($modelo),0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(12,6,'COLOR:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(23,6,utf8_decode($color),0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,6,'IMEI:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(25,6,$numSerie,0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,6,'EQUIPO:',0,1,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,1,utf8_decode($nomEquipo),0,1,'L');
		$pdf->Ln(1);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(7,6,'Tel:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,6,$telefono,0,1,'L');
		$pdf->Ln(1);

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,1,'Password:',0,1,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,6,$contra,0,1,'L');
		$pdf->Ln(1);
		$pdf->SetFont('Arial','B',8);
		if($edo=="Terminado" || $edo=="Entregado")
		{
			//$pdf->Ln(10);
			$pdf->Cell(1,0,"**************************************************************",1,0,'L');
			$pdf->Ln(1);
			$pdf->Cell(0,3,'SOLUCION:',0,1,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(0,3,utf8_decode($solucion),0,'L');
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(0,3,'TOTAL:',0,1,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,3,number_format($total,2),0,1,'L');
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(0,3,'***'.$edo.'***',0,1,'C');
			$pdf->Ln(2);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,0,"**************************************************************",0,0,'L');
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
		}
		else
		{
			$pdf->Cell(0,3,'FALLA:',0,1,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(0,3,utf8_decode($falla),0,'L');
		}
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(0,5,'Detalles del equipo:','B',1,'C');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,'Contiene Tarjeta SIM:',0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,$chip,0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,'Contiene Memoria:',0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,$memoria,0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,'Contiene Bateria:',0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,$bateria,0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,4,'Estado de la Carcasa:',0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,5,$carcasa,'B',1,'L');
		if($edo=="pendiente")
		{
			$pdf->Ln(5);
			//$pdf->SetTextColor(255,255,255);
			$pdf->SetFont('Arial','BI',10);
			$pdf->Cell(16);
			$pdf->Cell(24,1,'COTIZACION:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,1,$cotizacion,0,1,'L');
			$pdf->SetTextColor(0,0,0);
			$pdf->Ln(7);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,0,"**************************************************************",0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Ln();
			//$pdf->SetY(115);
		}
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(0,5,'Estado del equipo:',0,0,'L');
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(0,5,utf8_decode($descripcion),0,'L',0,1);
			$pdf->Cell(0,1,"**************************************************************",0,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(20,1,'ATENDIO:',0,0,'L');
		$pdf->SetFont('Arial','',8);
		if($edo=="Terminado" || $edo=="Entregado")
			$pdf->Cell(10,1,$entrego,0,1,'L');
		else
			$pdf->Cell(10,1,$usuario,0,1,'L');
		$pdf->Ln(15);
		if(strcmp($edo,'Terminado') == 0 || strcmp($edo,'Entregado') == 0)
		{
			$pdf->Ln(3);
			$pdf->SetFont('Arial','B',7);
			//$pdf->Cell(5);
			$pdf->MultiCell(0,3,strtoupper(utf8_decode($mensajet)),'BT','L');
		}
		else
		{
			$pdf->SetFont('Arial','',6);
			//$pdf->Cell(5);
			$pdf->MultiCell(0,3,strtoupper(utf8_decode($mensaje)),'BT','L');
		}
		$pdf->SetFont('Arial','UB',7);
		$pdf->Cell(0,5,$pagina,0,1,'C');
		$pdf->output();
		return $pdf;
	}
	public function getReparadores(){
		$folio=$this->input->post('folio');
		$query=$this->ModelServicio->getReparadores($folio);
		echo json_encode($query->result());
	}
	public function modiUbicacion()
	{
		$data=array();
		$data['folio']=$this->input->post('id_folio');
		$data['ubicacion']=$this->input->post('usuario');
		date_default_timezone_set('America/Monterrey');
		$data['fechaubicacion']=date('Y-m-d H:i:s');
		$data['lugar']=$this->input->post('lugar');
		if(strlen($data['folio'])>0 && strlen($data['ubicacion'])>0 && strlen($data['lugar'])>0)
			$data['query']=$this->ModelServicio->modiUbicacion($data);
		else
			$data['query']=2;
		echo json_encode( $data);
	}
	/*public function modiUbicacion()
	{
		$folio=$this->input->post('id_folio');
		$data['ubicacion']=$this->input->post('usuario');
		date_default_timezone_set('America/Monterrey');
		$data['fechaubicacion']=date('Y-m-d H:i:s');
		if(strlen($folio)>0 && strlen($data['ubicacion'])>0)
			$query=$this->ModelServicio->modiUbicacion($folio,$data);
		else
			$query=2;
		echo $query;
	}*/
	public function addFolio()
	{
		if($this->session->userdata('usuario'))
			$this->session->unset_userdata('usuario');
		$vec=array();
		$vec['ban']="50";
		$data['idCli']=$this->input->post('idCli');
		$data['estado']=$this->input->post('estado');
		$data['fecha']=$this->input->post('fecha');
		//$data['idsuc']=$this->session->userdata['idsuc'];
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
			$res=$this->ModelServicio->addServicio($data);
			$vec['ban']=$res;
			if($res==1)
			{
				$query=$this->ModelServicio->getFolio();
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row)
					{
						$id=$row->folio;

					}
					if($this->session->userdata('numFolio'))
						$this->session->unset_userdata('numFolio');
					$this->session->set_userdata('numFolio',$id);
					$vec['folio']=$id;
					echo json_encode($vec);
				}
				else
				{
					$vec['ban']="100";
					echo json_encode($vec);
				}
			}
			else
				echo json_encode($vec);
		}
		else
			echo json_encode($vec);
	}
	/*************************Servicio*****************************************************/
	function addServicio()
	{
		$data['folio']=$this->input->post('sfolio');
		$data['idEq']=$this->input->post('sidEq');
		$data['tipo']=$this->input->post('tipo');
		$data['enciende']=$this->input->post('enciende');
		$data['mojado']=$this->input->post('mojado');
		$data['tapa']=$this->input->post('tapa');
		$data['falla']=$this->input->post('falla');
		$data['cables']=$this->input->post('cables');
		$data['marco']=$this->input->post('discos');
		$data['accesorios']=$this->input->post('accesorios');
		$data['calcas']=$this->input->post('calcas');
		$data['botones']=$this->input->post('botones');
		$data['contiene_bateria']=$this->input->post('contiene_bateria');
		$data['chip']=$this->input->post('chip');
		$data['memoria']=$this->input->post('memoria');
		$data['cotizacion']=$this->input->post('cotizacion');
		if(strlen($this->input->post('usuario'))>0)
			$data['usuario']=$this->input->post('usuario');
		$ban=true;
		foreach ($data as $key => $value)
		{
				if(strlen($value)==0)
				{
					$ban=false;
					break;
				}
		}

		if($ban)
		{
			$query=$this->ModelServicio->addDetServicio($data);
			echo $query;
		}
		else
		{
			echo "6";
		}
	}
	public function cambiarEstado()
	{
		if($this->session->userdata('estado'))
			$this->session->unset_userdata('estado');
		$estado=$this->input->post('estado');
		if(strlen($estado)>0)
			$this->session->set_userdata('estado',$estado);
		else
			$this->session->set_userdata('estado','pendiente');
		$this->mostrarServicios();
	}
	function buscar()
	{
		$clave=$this->input->post('clave');
		$temp=$this->input->post('clave');
		if(ctype_digit($clave))
		{
			$query=$this->ModelServicio->getServicioFolio($clave);
			$this->mostrarBusqueda($query);
		}
		else
			if(preg_match('|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|',$clave))
			{
				$query=$this->ModelServicio->getServicioNombre($temp);
				$this->mostrarBusqueda($query);
			}

			else
				$this->mostrarServicios();
	}
	function buscarEdo()
	{
		$clave=$this->input->post('clave');
		$temp=$this->input->post('clave');
		$edo=$this->input->post('edo');
		if(ctype_digit($clave))
		{
			$query=$this->ModelServicio->getServicioFolioEdo($clave,$edo);
			$this->mostrarBusqueda($query);
		}
		else
			if(preg_match('|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|',$clave))
			{
				$query=$this->ModelServicio->getServicioNombreEdo($temp,$edo);
				$this->mostrarBusqueda($query);
			}

			else
				$this->mostrarServicios();
	}
		function mostrarBusqueda($query)
	{
		$data['query']=$query;
		$data['ban']=0;
		$data['paginacion']="";
		$data['cont']=$this->uri->segment(3);
		$data['ruta']="salidaservicio.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['estado']=$this->session->userdata('estado');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['querySuc']=$this->ModelServicio->getSucursales();
		$data['num']=$this->ModelServicio->getNumIncompletos($this->session->userdata('idsuc'));
		$data['urgente']=$this->ModelServicio->getNumUrgentes();
		$data['tipo']=$this->session->userdata('tipo');
		$this->load->view('templates/header',$data);

			$this->load->view('servicios/mostrarservicio');
	}
	public function consultaGeneral()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$id=$this->input->post('lstSuc');
			if($id=="")
				$this->session->set_userdata('idsuc2',$this->session->userdata('idsuc')); // valor por default (ingresar suc)
			else
				$this->session->set_userdata('idsuc2',$id);
		if(!$this->session->userdata('estado'))
			$this->session->set_userdata('estado','pendiente');

		$this->mostrarServicios();
	}
	public function mostrarIncompletos()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'servicioFolio/mostrarServicios';
		$config['total_rows']=$this->ModelServicio->getNumIncompletos($this->session->userdata('idsuc'));
		$config['per_page']=50;
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
		$data['query']=$this->ModelServicio->getIncompletos($this->session->userdata('idsuc'));
		//$data['query']->next_result();
		$data['title']="Servicio";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="salidaservicio.js";
		$data['sucSel']=$this->session->userdata('idsuc2');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['querySuc']=$this->ModelServicio->getSucursales();
		$data['usuario']=$this->session->userdata('nombre');
		$data['estado']='Terminado';
		$data['tipo']=$this->session->userdata('tipo');
		$data['num']=$config['total_rows'];
		$data['ban']=1;
		$this->load->view('templates/header',$data);
		//if($this->session->userdata('tipo')==2)
		//	$this->load->view('servicios/mostrarservicioempleada');
	//	else
			$this->load->view('servicios/mostrarservicio');
	}
	function mostrarServicios($offset=0)
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
if(strlen($this->session->userdata('idusuc2')==0))
			$this->session->set_userdata('idsuc2',$this->session->userdata('idsuc'));
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'serviciofolio/mostrarServicios';
		$config['total_rows']=$this->ModelServicio->numero($this->session->userdata('idsuc2'),$this->session->userdata('estado'));
		$config['per_page']=20;
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
		$data['query']=$this->ModelServicio->consultaGeneralServ($this->session->userdata('idsuc2'),$offset,$config['per_page'],$this->session->userdata('estado'));
		//$data['query']->next_result();
		$data['title']="Servicio";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="salidaservicio.js";
		$data['sucSel']=$this->session->userdata('idsuc2');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['querySuc']=$this->ModelServicio->getSucursales();
		$data['usuario']=$this->session->userdata('nombre');
		$data['estado']=$this->session->userdata('estado');
		//$data['num']=$this->ModelServicio->getNumIncompletos($this->session->userdata('idsuc'));
		$data['ban']=0;
		$data['tipo']=$this->session->userdata('tipo');
		//$data['urgente']=$this->ModelServicio->getNumUrgentes();
		$this->load->view('templates/header',$data);
		//if($this->session->userdata('tipo')==2)
		//	$this->load->view('servicios/mostrarservicioempleada');
	//	else
		$this->load->view('servicios/mostrarservicio');
	}
	function expirados()
	{
		date_default_timezone_set('America/Monterrey');
		$data['fechaLimite']=date('Y-m-d',strtotime('-1 month'));
		echo $data['fechaLimite'];
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'serviciofolio/expirados';
		$config['total_rows']=$this->ModelServicio->numeroExpirados($data['fechaLimite']);
		$config['per_page']=25;
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
		$data['query']=$this->ModelServicio->consultaExpirados($data['fechaLimite'],$offset,$config['per_page']);
		//$data['query']->next_result();
		$data['title']="Servicio";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="salidaservicio.js";
		$data['sucSel']=$this->session->userdata('idsuc2');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['querySuc']=$this->ModelServicio->getSucursales();
		$data['usuario']=$this->session->userdata('nombre');
		$data['estado']=$this->session->userdata('estado');
		//$data['num']=$this->ModelServicio->getNumIncompletos($this->session->userdata('idsuc'));
		$data['ban']=0;
		$data['tipo']=$this->session->userdata('tipo');
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/mostrarservicio');
	}
	function cargarVariable()
	{
		if(!$this->session->userdata('nombre'))
			redirect(base_url().'login');
		$this->session->set_userdata('folio',$this->input->post('folio'));
		$this->session->set_userdata('pag',$this->input->post('pag'));
		$this->mostrarSalida();
	}
	public function mensajeCliente($msg)
	{
		if(!$this->session->userdata('nombre'))
			redirect(base_url().'login');
		$data['ruta']="mensajes.js";
		$data['query']=$this->ModelServicio->getMensaje();
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/mensajeCli',$msg);
	}
	function mostrarSalida($offset=0)
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		/*if($this->session->userdata('uri'))
			$this->session->unset_userdata('uri');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'servicioFolio/mostrarSalida';
		$config['total_rows']=$this->ModelServicio->numRows($this->session->userdata('folio'));
		$config['per_page']=1;
		$connfig['num_links']=3;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();*/
		$data['query']=$this->ModelServicio->getSalida($this->session->userdata('folio'));
		//$data['query']->next_result();
		$data['emp']=$this->ModelServicio->MostrarE($this->session->userdata('idsuc'));
		$data['title']="Servicio";
		//$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="salida.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/mostrarsalida');
	}
	function subirArchivo()
	{
			$config['upload_path']="./img/";
			$config['allowed_types']='jpg'; //gif|png|
			$config['max_size']='2048';
			$config['max_width']='0';
			$config['max_height']='0';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload("logo"))
			{
				//$error=$this->upload->display_errors('<div class="error">','</div>');
				//$this->vistaNumSerie($error,"");
				echo "error";
			}
			else
			{
				$file_info=$this->upload->data();
				$data=$this->upload->data();
				/*unlink('.img/black.PNG');
				unlink('.img/black.jpg');*/
				$img=$file_info['file_name'];
				$this->crearThumbnail($img);
				echo $data['file_name'];
			}
	}
	public function crearThumbnail($img)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'img/'.$img;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['new_image']='img/thumbs/';
		$config['width'] = 300;
		$config['height'] = 60;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}
	function salida()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		//$this->form_validation->set_rules('tecnico','Tecnico','required|trim');
		$this->form_validation->set_rules('estado','Estado','required|trim');
		$this->form_validation->set_rules('idServ','Id Servicio','required|trim');
		//$this->form_validation->set_rules('total','Total','required|trim');
		$this->form_validation->set_rules('mano_obra','Mano obra','required|trim');
		$this->form_validation->set_rules('refaccion','Total Refaccion','required|trim');
		if($this->form_validation->run()===FALSE)
		{
			$this->mostrarSalida();
		}
		else
		{
			//$data['tecnico']=$this->input->post('tecnico');
			$data['mano_obra']=$this->input->post('mano_obra');
			$data['refaccion']=$this->input->post('refaccion');
			$data['estado']=$this->input->post('estado');
			$data['total']=$this->input->post('total');
			$data['folio']=$this->session->userdata('folio');
			$data['idServ']=$this->input->post('idServ');
			$data['usuario']=$this->input->post('usuario');
			$msg['folio']=$this->input->post('hdnFolio');
			$msg['cliente']=$this->input->post('hdnCli');
			$msg['equipo']=$this->input->post('hdnEquipo');
			//$msg['celular']=$this->input->post('hdnCel');
			$data['solucion']=$this->input->post('solucion');
			$pag=$this->session->userdata('pag');
			$estados=$this->ModelServicio->obtenerEstado($data['folio']);
			$estado="";
			foreach ($estados->result() as $row) {
				$estado=$row->estadogeneral;
			}
			if($this->session->userdata('tipo')!=1)
				switch ($estado) {
					case 'Terminado':
						if($data['estado']=='pendiente')
							$data['estado']='Terminado';
						break;
					case 'pendiente':
						if($data['estado']=='Entregado')
							$data['estado']='pendiente';
						break;
					case 'Entregado':
						if($data['estado']!='Entregado')
							$data['estado']='Entregado';
						break;
					default:
						# code...
						break;
				}
			$estado=$data['estado'];
			$ban=$this->ModelServicio->salida($data);
			switch($ban)
			{
				case 1:
						if($estado=="Entregado")
						{
							date_default_timezone_set('America/Monterrey');
							$v['fecha_salida']=date('Y-m-d H:i:s');
							$this->ModelServicio->cambiarFechaSalida($v,$this->session->userdata('folio'));
						}
					$query=$this->ModelServicio->getServicioFolio($this->session->userdata('folio'));
					$this->mostrarBusqueda($query);
					$this->session->unset_userdata('folio');
					$this->session->unset_userdata('pag');
					//redirect("serviciofolio/mostrarServicios/".$pag);
					//$this->consultaGeneral();
					break;
				case 2:
					$this->mostrarSalida();
					break;
				case 3:
					$this->mostrarSalida();
					break;
				default:
					$this->mostrarSalida();
			}

		}
	}
	function getServicioAjax()
	{
		$id=$this->input->post('idServ');
		$query=$this->ModelServicio->getServicio($id);
		echo json_encode($query->result());
	}
	function modiServicioAjax()
	{
		$arr=array();
		$arr=$this->input->post();
		$ban=1;
		foreach ($arr as $key=>$val) {
			if(strlen($arr[$key])==0)
			{
				$ban=0;
				break;
			}
		}
		if($ban==1)
		{
			//$query="puto";
			$query=$this->ModelServicio->modiServicio($arr);
			echo $query;
		}
		else
			echo "0";
	}
	function fechasCorte()
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1 )
			Redirect('usuarios/Permiso');
		if($this->session->userdata('sucursal'))
			$this->session->unset_userdata('sucursal');
		if($this->session->set_userdata('inicio'))
			$this->session->unset_userdata('inicio');
		if($this->session->userdata('fin'))
			$this->session->unset_userdata('fin');
		$this->form_validation->set_rules('idsuc','Sucursal','required');
		$this->form_validation->set_rules('inicio','La fecha De:','required');
		$this->form_validation->set_rules('fin','La fecha hasta:','required');
		if($this->form_validation->run()===FALSE)
		{
			date_default_timezone_set('America/Monterrey');
			$data['query']=$this->ModelServicio->getSucursales();
			$data['title']="Corte";
			$data['ruta']="fechas.js";
			$data['usuario']=$this->session->userdata('nombre');
			$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
			$this->load->view('templates/header',$data);
			$this->load->view('servicios/fechas');
		}
		else
		{
				echo 'inicio:'.$this->session->userdata('inicio').' fin:'.$this->session->userdata('fin');
			$this->session->set_userdata('sucursal',$this->input->post('idsuc'));
			$this->session->set_userdata('inicio',$this->input->post('inicio'));
			$this->session->set_userdata('fin',$this->input->post('fin'));
			$this->corte();
		}
	}
	function corte($offset=0)
	{
		echo 'inicio:'.$this->session->userdata('inicio').' fin:'.$this->session->userdata('fin');
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		date_default_timezone_set('America/Monterrey');
		$config['base_url']=base_url().'servicioFolio/corte';
/*liberar*/$config['total_rows']=$this->ModelServicio->numFechas($this->session->userdata('inicio'),$this->session->userdata('fin'),$this->session->userdata('sucursal'));
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
		$data['query']=$this->ModelServicio->corte($this->session->userdata('inicio'),$this->session->userdata('fin'),$this->session->userdata('sucursal'),$offset,$config['per_page']);
		//$data['query']->next_result();
		$data['title']="Servicios";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="corte.js";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$data['fecha1']=$this->session->userdata('inicio');
		$data['fecha2']=$this->session->userdata('fin');
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/corte');
	}
	function eliFolioAjax()
	{
		$folio=$this->input->post('folio');
		if(!empty($folio))
		{
			$query=$this->ModelServicio->eliFolio($folio);
			echo $query;
		}
		else
			echo '4';
	}

	public function updateTicket( )
	{
		if(!$this->session->userdata('tipo'))
			redirect(base_url().'login');
		if($this->session->userdata('tipo')!= 1)
			Redirect('usuarios/Permiso');
		$ticket=$this->ModelServicio->getTicket();
		$arr['query']=$ticket;
		$data['ruta']="ticket.js";
		$data['title']="Ticket";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/editTicket',$arr);
	}
	public function updateMensaje()
	{
		$mensaje=$this->ModelServicio->getMensaje();
		$arr['query']=$mensaje;
		$data['ruta']="upmensaje.js";
		$data['title']="Editar mensaje";
		$data['usuario']=$this->session->userdata('nombre');
		$data['nomSuc']=strtoupper(utf8_decode($this->session->userdata('nomSuc')));
		$this->load->view('templates/header',$data);
		$this->load->view('servicios/mensaje',$arr);
	}

	public function updateMensajeBd()
	{
		$id = $this->input->post('id_mensaje');
		$data['mensaje_celular'] = $this->input->post('txtMensaje');
		$query = $this->ModelServicio->updateMensajeBd($data,$id);
		echo $query;
	}
	public function updateTicketBd()
	{
		$extensiones=array(".jpg",".png");
		$arr=array();
		//$arr=$this->input->post();
		$arr['id_ticket']=$this->input->post('id_ticket');
		$arr['ticket_header']=$this->input->post('txtHeader');
		$arr['ticket_mensaje']=$this->input->post('ticket_mensaje');
		$arr['ticket_mensajet']=$this->input->post('ticket_mensajet');
		$arr['ticket_sitio']=$this->input->post('ticket_sitio');
		$arr['ticket_logo']=str_replace($extensiones,"", $arr['ticket_logo']=$this->input->post('url_logo'));
		$query=$this->ModelServicio->updateTicket($arr);
		echo $query;
	}
	function cambiarEntregado()
	{
		//date_default_timezone_set('Mexico/General');
		date_default_timezone_set('Mexico/General');
		$data['estadogeneral']=$this->input->post('edo');
		$data['fecha']=date("Y-m-d");
		$cont=$this->input->post('cont');
		$folio=$this->input->post('folio');
		$this->ModelServicio->cambiarEntregado($data,$folio);
		$historialData['folio']=$folio;
		$query=$this->ModelServicio->lastCambioEstado($folio);
		if(count($query->result())==0)
			return redirect('serviciofolio/mostrarServicios/'.$cont);
		$row=$query->row();
		$historialData['state']="Entregado";
		$historialData['id_usuario']=$row->id_usuario;

		$query=$this->ModelServicio->getCambioEstado($folio,$row->id_usuario,$data['estadogeneral']);
		if(count($query->result())==0)
			$this->ModelServicio->insertHistorialEstado($historialData);
		return redirect('serviciofolio/mostrarServicios/'.$cont);
		//////////////////////////////////////////////////
		//***********************************************
		// $folio=$this->input->post('folio');
		// $status=$this->input->post('edo');
		// $query=$this->ModelServicio->getEstado($folio);
		// foreach ($query->result() as $row)
		// {
		// 	$edo=$row->estadogeneral;
		// }

		// if($edo=="Terminado" )
		// {
		// 	$data['estadogeneral']=$this->input->post('edo');
		// 	//$data['fecha']=date("Y-m-d");
		// 	date_default_timezone_set('America/Monterrey');
		// 	$data['fecha_salida']=date('Y-m-d H:i:s');
		// 	$cont=$this->input->post('cont');
		// 	$this->ModelServicio->cambiarEntregado($data,$folio);
		// }
		// $query=$this->ModelServicio->getServicioFolio($folio);
		// $this->mostrarBusqueda($query);
	}
	function cambiarUrgente()
	{
		$data['estadogeneral']=$this->input->post('edo');
		$folio=$this->input->post('folio');
		$this->ModelServicio->cambiarEntregado($data,$folio);
		$query=$this->ModelServicio->getServicioFolio($folio);
		$this->mostrarBusqueda($query);
	}
	function addComment()
	{
		$data=$this->input->post();
		$ban=true;
		foreach ($data as $key => $value)
		{
			if(strlen($data[$key])==0)
			{
				$ban=false;
				break;
			}
		}
		if($ban)
		{
			date_default_timezone_set('America/Monterrey');
			$data['fecha_comentario']=date('Y-m-d H:i:s');
			$query=$this->ModelServicio->addComment($data);
			echo $query;
		}
		else
			echo 2;
	}
	function getComment()
	{
		$id=$this->input->post('id_comentario');
		$query=$this->ModelServicio->getComment($id);
		echo json_encode($query->result());
	}
}
