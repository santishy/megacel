<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelPrecio');
		$this->load->model('ModelProducto');
		$this->load->library('funciones');
		$this->load->library('pagination');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
		$this->load->library('cart');
	}
	function update()
	{
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		$permisos[0]=1;
		$permisos[1]=3;
		if($this->session->userdata('tipo')!=2)
		{
			if(IS_AJAX)
				$data=$this->cambioDeVariables($this->input->post());
			else
				$data=$this->input->post();
			for($i=0;$i<$data['cont'];$i++)
			{
				if(isset($data['check_'.$i]))
				{
					$query=$this->ModelProducto->getPrecio($data['tipo'],$data['precio']);
					if($query->num_rows()<1)
					{
						$precio['tipo']=$data['tipo'];
						$precio['precio']=$data['precio'];
						$query=$this->ModelProducto->agregarPrecio($precio);
					}
					foreach ($query->result() as $row)
					{
						$id_precio=$row->id_precio;
					}
					$query=$this->ModelProducto->getTipoPrecio($data['id_producto_'.$i],$data['tipo']);
					if($query->num_rows()>0)
					{
						foreach ($query->result() as $row) {
							$id_precioOld=$row->id_precio;
						}
						$activo['activo']=0;
						$query=$this->ModelProducto->desactivarPrecio($activo,$data['id_producto_'.$i],$id_precioOld);
					}
					$query=$this->ModelProducto->getDetPrecio($id_precio,$data['id_producto_'.$i]);
					if($query->num_rows()>0)
					{
						$activar['activo']=1;
						$query=$this->ModelProducto->activarPrecio($activar,$id_precio,$data['id_producto_'.$i]);
					}
					else
					{
						$detPrecio['id_precio']=$id_precio;
						$detPrecio['id_producto']=$data['id_producto_'.$i];
						$query=$this->ModelProducto->agregarDetPrecios($detPrecio);
					}
					$json[$i]['ban']=$query;
				}
			}
		}
		else
			$json['permiso']=false;
		echo json_encode($json);
		
	}
	public function cambioDeVariables($post)
	{
		$data['tipo']='PUBLICO';
		$data['precio']=$post['value'];
		$data['cont']=1;
		$data['check_0']=1;
		$data['id_producto_0']=$post['pk'];
		return $data;
	}
}