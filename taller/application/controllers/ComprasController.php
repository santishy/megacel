<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ComprasController extends CI_Controller {
	public function index(){
		echo 'hola';
	}
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelUser');
		$this->load->model('ModelCompras');
		
	}
	public function comprasCorte(){
		$this->form_validation->set_rules('inicio','De','required');
		$this->form_validation->set_rules('fin','hasta','required');
		if($this->form_validation->run()===false){
			$data['compras']=$this->ModelCompras->corte("2000-00-00","2000-00-00");
			$this->load->view('general/header',$data);
			$this->load->view('general/scripts');
			$this->load->view('compras/corte');
			$this->load->view('general/footer');
		}
		else{
			$data['compras']=$this->ModelCompras->corte($this->input->post('inicio'),$this->input->post('fin'));
			// var_dump($data);
			$this->load->view('general/header',$data);
			$this->load->view('general/scripts');
			$this->load->view('compras/corte');
			$this->load->view('general/footer');
		}
	}
	public function eliminar(){
		$id=$this->input->post('id');
		$id_color=$this->input->post('id_color');
		$total_compra=$this->input->post('total');
		$detCompra=$this->ModelCompras->getDetCompra($id);
		$row=$detCompra->row();
		$cant=$row->cant_compra;
		$id_producto=$row->id_producto;
		$producto=$this->ModelCompras->getProducto($id_producto);
		$producto=$producto->row();
		$precio=$producto->precio_compra;
		$total=$precio*$cant;
		// $compra=$this->ModelCompras->getCompra($row->id_compra);
		// $compra=$compra->row();
		$det_color=$this->ModelCompras->getDetColor($id_color,$id_producto);
		$det_color=$det_color->row();
		$this->ModelCompras->updateTotal($row->id_compra,$total,$total_compra);
		$this->ModelCompras->updateExistColor($det_color->id,$cant,$det_color->exist);
		$this->ModelCompras->updateExistenciaProducto($id_producto,$cant,$producto->existencia);
		$this->ModelCompras->eliminarDetCompras($id);
		return redirect(base_url().'ComprasController/comprasCorte');
	}
}