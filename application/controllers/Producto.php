<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelProducto');
		$this->load->library('funciones');
		$this->load->library('pagination');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->library('cart');
	}
	public function index()
	{
	}
	public function desactivarProducto()
	{
		$id=$this->input->post('id_producto');
		$query=$this->ModelProducto->desactivarProducto($id);
		echo $query;
	}
	public function buscar()
	{
		//$this->logueado();
		$clave=$this->input->post('clave');
		$cate=$this->input->post('cate');
		if(isset($clave))
			$this->session->set_userdata('clave',$clave);
		else
			$this->session->unset_userdata('clave');
		if(isset($clave))
			$this->session->set_userdata('cate',$cate);
		else
			$this->session->unset_userdata('cate');
		$this->allproductos();
	}
	public function buscarList()
	{
		//$this->logueado();
		$clave=$this->input->post('clave');
		$cate=$this->input->post('cate');
		if(isset($clave))
			$this->session->set_userdata('clave',$clave);
		else
			$this->session->unset_userdata('clave');
		if(isset($clave))
			$this->session->set_userdata('cate',$cate);
		else
			$this->session->unset_userdata('cate');
		$this->pedido();
	}
	public function getProducto()
	{
		$id=$this->input->post('id_producto');
		$id_color=$this->input->post('id_color');
		$query=$this->ModelProducto->getProducto($id,$id_color);
		echo json_encode($query->result());
	}
	public function logueado()
	{
		if(!$this->session->userdata('id_user'))
			redirect(base_url().'login/cerrarSesion');
	}
	function crearVarCliente()
	{
		//$this->logueado();
		$this->session->set_userdata('id_cliente',$this->input->post('id_cliente'));
		redirect(base_url().'producto/allproductos');
	}
	function modiProducto()
	{
		$data=$this->input->post();
		$json['ban']=$this->validarEmpty($data);
		if($json['ban'])
		{
			$json['query']=$this->ModelProducto->modiProducto($data);
		}
		echo json_encode($json);
	}
	function eliminarBusqueda()
	{
		if($this->session->userdata('clave'))
			$this->session->unset_userdata('clave');
		if($this->session->userdata('cate'))
			$this->session->unset_userdata('cate');
		redirect(base_url().'producto/allproductos');
	}
	function eliminarBusquedaList()
	{
		if($this->session->userdata('clave'))
			$this->session->unset_userdata('clave');
		if($this->session->userdata('cate'))
			$this->session->unset_userdata('cate');
		redirect(base_url().'producto/pedido');
	}
	function allproductos()
	{
		//$this->logueado();
		$this->listProducto(true); //para que tome la vista inicial
		
	}
	function crearPedido()
	{
		$cont=$this->input->post('cont');
		$data=$this->input->post();
		for($i=0;$i<$cont;$i++)
		{
			$check=$this->input->post('check_'.$i);
			if(strlen($check)==0)
				{
					unset($data['nombre_'.$i]);
					unset($data['modelo_'.$i]);
					unset($data['cant_'.$i]);
					unset($data['id_'.$i]);
					unset($data['color_'.$i]);
					unset($data['categoria_'.$i]);
					//unset($data['marca_'.$i]);
				}
		}
		
		if($this->session->userdata('lista'))
		{
			$data=array_merge($this->session->userdata('lista'),$data);
			$this->session->unset_userdata('lista');
		}
		$this->session->set_userdata('lista',$data);
		$uri=$this->uri->segment(3);
		redirect(base_url().'producto/pedido/'.$uri);
	}
	function pdfPedido()
	{
		$data=$this->session->userdata('lista');
		date_default_timezone_set('America/Monterrey');
		$fecha=date('Y-m-d');
		require_once('fpdf/fpdf.php');
		$pdf=new FPDF('L','mm','A4');
		$pdf->AddPage();
	//$pdf->Image('img/logotipo.png',10,10,40,20)
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Times','B','10');
		$pdf->cell(0,5,$fecha,0,0,'R');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B','13');
		$pdf->SetTextColor(255,255,255);
		$pdf->cell(20,7,'ID',1,0,'C',1);
		$pdf->cell(40,7,'Art.',0,0,'C',1);
		$pdf->cell(70,7,'Nombre',0,0,'C',1);
		$pdf->cell(70,7,'Modelo',0,0,'C',1);
		$pdf->cell(40,7,'Color',0,0,'C',1);
		$pdf->cell(30,7,'Comprar',0,0,'C',1);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','','11');
		$pdf->Ln();
		$ind=0;
		for($i=0;$i<$data['cont'];$i++)
		{
			if(isset($data['id_'.$i]))
			{
				$ind++;
				$y=$pdf->getY();
				$pdf->MultiCell(20,10,$data['id_'.$i],1,'C');
				$x=$pdf->getX();
				$pdf->setXY($x+20,$y);
				$pdf->MultiCell(40,10,$data['categoria_'.$i],1,'C');
				$x=$pdf->getX();
				$pdf->setXY($x+60,$y);
				$pdf->MultiCell(70,10,$data['nombre_'.$i].'otra mas',1,'C');
				$x=$pdf->getX();
				$pdf->setXY($x+130,$y);
				$pdf->MultiCell(70,10,$data['modelo_'.$i],1,'C');
				$pdf->setXY($x+200,$y);
				$x=$pdf->getX();
				$pdf->MultiCell(40,10,$data['color_'.$i],1,'C');
				$x=$pdf->getX();
				$pdf->setXY($x+240,$y);
				$pdf->MultiCell(30,10,$data['cant_'.$i],1,'C');
				if($ind%15 == 0 && $ind!=0)	
				{

					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Times','B','10');
					$pdf->cell(0,5,$fecha,0,0,'R');
					$pdf->Ln(10);
					$pdf->SetFont('Arial','B','13');
					$pdf->SetTextColor(255,255,255);
					$pdf->cell(20,7,'ar',1,0,'C',1);
					$pdf->cell(40,7,'Art.',0,0,'C',1);
					$pdf->cell(70,7,'Nombre',0,0,'C',1);
					$pdf->cell(70,7,'Modelo',0,0,'C',1);
					$pdf->cell(40,7,'Color',0,0,'C',1);
					$pdf->cell(30,7,'Comprar',0,0,'C',1);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','','11');
					$pdf->Ln();
				}
			}
			
		}
		$this->session->unset_userdata('lista');
		unset($data);
		$pdf->output();
	}
	function listProducto($ban)
	{
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
			$offset=0;
		$config['base_url']='productos/allproductos';
		if($this->session->userdata('clave'))
			$config['total_rows']=$this->ModelProducto->numRowsProductos($this->session->userdata('clave'),$this->session->userdata('cate'));
		else 
			$config['total_rows']=$this->ModelProducto->numProductos();
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
		//$data['query']->next_result();
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="salidaservicio.js";
		$data['query']=$this->ModelProducto->getCategorias();
		if($this->session->userdata('clave'))
			if(ctype_digit($this->session->userdata('clave')))
				$data['productos']=$this->ModelProducto->getIdProductos($this->session->userdata('clave'),$offset,$config['per_page']);
			else
				$data['productos']=$this->ModelProducto->getProductos($this->session->userdata('clave'),$this->session->userdata('cate'),$offset,$config['per_page']);
		else
			$data['productos']=$this->ModelProducto->getAllProductos($offset,$config['per_page']);
		date_default_timezone_set('America/Monterrey');
		$data['fecha_compra']=date('Y-m-d H:i:s'); 
		$data['num']=$config['total_rows'];
		$data['items']=$this->cart->total_items();
		$data['palabra']=$this->session->userdata('clave');
		$data['marcas']=$this->ModelProducto->getMarcas();
		$this->load->view('general/header',$data);
		$this->load->view('general/scripts');
		if($ban)
		{
			$this->load->view('productos/allproductos');
			$this->load->view('productos/modales');
		}
		else
			$this->load->view('productos/pedido');
		$this->load->view('general/footer');
	}
	function pedido()
	{
		$this->listProducto(false); //false para que tome la segunda vista
	}
	function agregarProducto()
	{
		//$this->logueado();
		$this->form_validation->set_rules('nombre_producto','Nombre del Producto','required|trim|callback_comprobarProducto');
		$this->form_validation->set_rules('modelo','Modelo','required|trim');
		$this->form_validation->set_rules('id_categoria','Categoria','required|trim');
		$this->form_validation->set_rules('id_marca','Marca','required');
		$this->form_validation->set_rules('color','Color','required');
		if($this->form_validation->run()==false)
		{
			$this->allproductos();
		}
		else
		{
			$data=$this->input->post();
			$consulta=$this->ModelProducto->obtenerCategoria($data['id_categoria']);
			$catego="";
			foreach ($consulta->result() as $row) {
				$catego=$row->categoria;
			}
			$data['descripcion']=$catego.' '.$data['nombre_producto'].' '.$data['modelo'];
			$vec['color']=$data['color'];
			unset($data['color']);
			$query=$this->ModelProducto->getProdEspicificaciones($data);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) {
					$id_producto=$row->id_producto;	
				}
				
			}
			else
			{
				$this->ModelProducto->agregarProducto($data);
				$id_producto=$this->ModelProducto->maxIdProd();
			}
			$query=$this->ModelProducto->getColor($vec['color']);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) {
					$id_color=$row->id_color;	
				}
				
			}
			else
			{
				$this->ModelProducto->agregarColor($vec);
				$id_color=$this->ModelProducto->maxIdColor();
			}
			if(isset($id_color) and isset($id_producto))
				$query=$this->ModelProducto->addDetColor($id_color,$id_producto);

			$this->allproductos();
		}
	}
	// ----------------Carrito de Compras ----------------------------------------------------
	function sessionCart()
	{
		//$this->logueado();
		$op=$this->input->post('op');
		if($op=="c")
		{
			if(!$this->session->userdata('carrito'))
			{
				$this->session->set_userdata('carrito','compras');
				$this->insertarCarrito($this->input->post());
			}
			else
			{
				if($this->session->userdata('carrito')!='compras')
				{
					$data['ban']=2;
					echo json_encode($data);	
				}
				else
					$this->insertarCarrito($this->input->post());	
			}
		}
		else
		if($op=="v")
		{	
			if(!$this->session->userdata('carrito'))
			{
				$this->session->set_userdata('carrito','ventas');
				$this->insertarVenta($this->input->post());
			}
			else
			{
				if($this->session->userdata('carrito')!='ventas')
				{
					$data['ban']=2;
					echo json_encode($data);	
				}
				else
				{
					$this->insertarVenta($this->input->post());				
				}
			}
		}
		else
			{
				$data['ban']=20;
				echo json_encode($data);	
			}
	}
	function insertarCarrito($data)
	{
		//$this->logueado();
		$datos=$this->input->post();
		$ban=$this->validarEmpty($datos);
		if($ban)
		{
			$this->session->set_userdata('fecha_compra',$datos['fecha_compra']);
			$id_producto=$data['id_producto'];
			$cant=$data['cant_compra'];
			foreach ($this->cart->contents() as $item)
			{
				if($id_producto==$item['id'])
				{
					$cant=$item['qty']+$cant;
				}
			}
			$data=array(
				'id'=>$id_producto,
				'qty'=>$cant,
				'price'=>$data['precio_compra'],
				'name'=>$data['nombre_producto'],
				'id_color'=>$data['id_color'],
				'fecha_compra'=>$data['fecha_compra'],
				'categoria'=>$data['categoria']
				);
			$this->cart->insert($data);
			$data['ban']=1;
			$data['total']=$this->cart->total_items();
		}
		else
			$data['ban']=0;
		echo json_encode($data);
	}
	function validarEmpty($data)
	{
		//$this->logueado();
		if(empty($data))
			$ban=false;
		else
			$ban=true;
		foreach($data as $key => $value) 
		{
			if(empty($data[$key]))
			{
				$ban=false;
				continue;
			}
		}
		return $ban;
	}
	function terminarCompra()
	{
		//$this->logueado();
		if($this->session->userdata('fecha_compra'))
		{
			$this->ModelProducto->compra($this->session->userdata('fecha_compra'));
			$query=$this->ModelProducto->maxIdCompras();
			foreach ($query->result() as $row) 
			{
				$id_compra=$row->id_compra;
			}
			foreach($this->cart->contents() as $item) 
			{

				$data['id_compra']=$id_compra;
				$data['cant']=$item['qty'];
				$data['id_producto']=$item['id'];
				$data['precio']=$item['price'];
				$data['id_color']=$item['id_color'];
				$query=$this->ModelProducto->agregarCompra($data);
			}
		}
		$this->session->unset_userdata('fecha_compra');
		$this->session->unset_userdata('compras');
		$this->cart->destroy();
		$this->session->unset_userdata('carrito');
		$this->allproductos();
	}
	function verCarrito()
	{
		//$this->logueado();
		$data['funcion']="producto/terminarCompra";
		$data['movimiento']="COMPRAS";
		$data['nameLink']="Comprar";
		$this->vistaCart($data);
	}
	function verCarritoV()
	{
		//$this->logueado();
		$data['funcion']="cliente/vistaCliente";
		$data['movimiento']="VENTAS";
		$data['nameLink']="Vender";
		$this->vistaCart($data);
	}
	function vistaCart($data)
	{
		//$this->logueado();
		//$data['urgentes']=$this->getPendientes();
		$this->load->view('general/header',$data);
		$this->load->view('productos/vercarrito');
		$this->load->view('general/scripts');
		$this->load->view('general/footer');
	}
	function updateCompras()// recordar que al dejar en cero carrito hay q borrar posible session
	{
		//$this->logueado();
		$data=$this->input->post();
		$this->cart->update($data);
		if($this->session->userdata('carrito')=="compras")
			redirect(base_url().'producto/verCarrito');
		else
			redirect(base_url().'producto/verCarritoV');
	}
	function destruirCompras()
	{
		//$this->logueado();
		if($this->session->userdata('fecha_compra'))
			$this->session->unset_userdata('fecha_compra');
		$this->session->unset_userdata('carrito');
		$this->cart->destroy();
		redirect(base_url().'producto/allproductos');
	}
	#agregar precios de ventas
	function agregarPrecio()
	{
		//$this->logueado();
		$data=$this->input->post();
		$ban=$this->validarEmpty($data);
		if($ban)
		{
			if($data['op']==1)
				$query=$this->ModelProducto->agregarPrecio($data);
			else
				$query=$this->ModelProducto->agregarPrecioCategoria($data);
			echo $query;
		}
		else
			echo 0;
	}
	function getPrecios()
	{
		//$this->logueado();
		$id_producto=$this->input->post('id_producto');
		$query=$this->ModelProducto->getPrecios($id_producto);
		echo json_encode($query->result());
	}
	//----------------------------------VENTAS--------------------------------------------------
	function insertarVenta($datos)
	{
		//$this->logueado();
		//if($this->session->)
		//$datos=$this->input->post();
		$ban=$this->validarEmpty($datos);
		if($ban)
		{
			$query=$this->ModelProducto->getProducto($datos['id_productoV'],$datos['id_color']);
			if($query->num_rows()>0)
				$vec=$query->row_array();
			if(isset($vec['exist']))
				if($vec['exist']<$datos['cant_venta'])
					$data['ban']=3;
				else
				{
					$this->session->set_userdata('fecha_venta',$datos['fecha_venta']);
					$id_producto=$datos['id_productoV'];
					$color=$datos['id_color'];
					$cant=$datos['cant_venta'];
					$nameColor=$vec['color'];
					$id_precio=$datos['id_precio'];
					$query=$this->ModelProducto->getPrecio($id_precio,$id_producto);
					foreach ($query->result() as $row)
					{
						$pv=$row->precio;
						$datos['id_precio']=$row->id;
					}
					$bandera=true;
					foreach ($this->cart->contents() as $item)
					{
						if($id_producto==$item['id'] && $color==$item['id_color'])
						{
							$cant=$item['qty']+$cant;
							$bandera=false;
							$data=array('rowid'=>$item['rowid'],'qty'=>$cant);
							$this->cart->update($data);
						}
					}
					if($bandera)
					{
						$data=array(
						'id'=>$id_producto,
						'qty'=>$cant,
						'price'=>$pv,
						'name'=>$datos['name'],
						'id_color'=>$datos['id_color'],
						'fecha_venta'=>$datos['fecha_venta'],
						'categoria'=>$datos['categoria'],
						'id_precio'=>$datos['id_precio'],
						'options'=>array('color'=>$nameColor)
						//'credito'=>$datos['credito']
						);
						$this->cart->insert($data);
					}
					
					$data['ban']=1;
					$data['total']=$this->cart->total_items();
					$data['contenido']=$this->cart->contents();
					$data['subtotal']=$this->cart->Total();
				}
				else
					$data['ban']=0;
			}
			else
				$data['ban']=4;
		echo json_encode($data);
	}
	function comprobarProducto()
	{
		//$this->logueado();
		$data=$this->input->post();
		$query=$this->ModelProducto->getProdEspicificaciones($data);
		$ban=true;
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) {
				$id_producto=$row->id_producto;
			}
			
			$query=$this->ModelProducto->getColor($data['color']);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) 
				{
					$id_color=$row->id_color;
				}
				$query=$this->ModelProducto->getDetColor($id_producto,$id_color);
				if($query->num_rows()>0)
				{
					$ban=false;
				}
			}
		}
			if($ban)
				return true;
			else
			{
				$this->form_validation->set_message('comprobarProducto','Ya existe un producto con esas caracteristicas');
				return false;
			}	
	}
	function terminarVenta()
	{
		//$this->logueado();
		$entro=false;
		//$credito=$this->input->post('credito');
		//$data['credito']=$credito;
		$data['fecha_venta']=$this->session->userdata('fecha_venta');
		$query=$this->ModelProducto->insertarVenta($data);
		$query=$this->ModelProducto->maxIdVenta();
		foreach ($query->result() as $row) 
		{
			$id_venta=$row->id_venta;
			$this->session->set_userdata('id_venta',$id_venta); // comprobar fallas al regresar de clientes para otra parte .. etc
		}
		if(isset($id_venta))
		{
			$i=0;
			foreach ($this->cart->contents() as $item) 
			{
				$arr['id_venta']=$id_venta;
				$arr['cantidad_venta']=$item['qty'];
				$arr['id_producto']=$item['id'];
				$arr['id_precio']=$item['id_precio'];
				$arr['precio']=$item['price'];
				$arr['id_color']=$item['id_color'];
				$ban[$i++]=$this->ModelProducto->vender($arr);// regresa banderas del procedure		
			}
			$json['banderas']=$ban;
			$json['ban']=1;
			/*if($this->session->userdata('id_cliente'))
				$json['cliente']=1;
			else
				$json['cliente']=0;*/
			$this->cart->destroy();
			if($this->session->userdata('fecha_venta'))
				$this->session->unset_userdata('fecha_venta');
			$this->session->unset_userdata('carrito');	
			echo json_encode($json);
		}	
		else
		{
			$json['ban']=0;
			echo json_encode($json);
		}	
	}
	#checa si la variable carrito existe.------------------------------------------------------------
	function activarLink()
	{
		//$this->logueado();
		if($this->session->userdata('carrito'))
		{
			$data['ban']=1;
			if($this->session->userdata('carrito')=="compras")
			{
				$data['url']=base_url().'producto/vercarrito';
				$data['urlSig']=base_url().'producto/terminarCompra';
			}
			elseif ($this->session->userdata('carrito')=="ventas")
			{
				$data['url']=base_url().'producto/verCarritoV';
				$data['urlSig']=base_url().'cliente/vistaCliente';
			}
				
		}
		else
		{
			$data['ban']=2;
			$data['url']="#";
		}
		echo json_encode($data);
	}
	public function getPendientes()
	{
		date_default_timezone_set('America/Monterrey');
		$fecha=date('Y-m-d',strtotime('+4 day'));
		$query=$this->ModelProducto->totalUrgentes($fecha);
		$numero=0;
		foreach ($query->result() as $row)
		{
			$numero=$row->numero;
		}
		return $numero;
	}
	/*para la nota********************************************************/
	
}
?>