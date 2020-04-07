<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCompras extends CI_Model {
	function __construct ()
	{
		parent::__construct();
	}
	function corte($inicio,$fin)
	{
		return $this->db->query('
			select c.id_compra,p.modelo,p.precio_compra,p.existencia,p.nombre_producto,p.descripcion,dc.id as id_det_compra,c.total_compra as total, dc.cant_compra, p.id_producto,m.marca,ctgs.categoria,colores.color,colores.id_color,dclr.exist,dclr.id as id_det_color from compras c join det_compras dc on c.id_compra=dc.id_compra join productos p on dc.id_producto=p.id_producto join det_color dclr on p.id_producto=dclr.id_producto
			join colores  on dclr.id_color=colores.id_color join categorias ctgs on ctgs.id_categoria=p.id_categoria join marcas m on m.id_marca=p.id_marca where date(fecha_compra) between "'.$inicio.'" and "'.$fin.'";');
	}
	function getDetCompra($id)
	{
		return $this->db->query('select *from det_compras where id='.$id);
	}
	function getProducto($id_producto){
		return $this->db->query('select *from productos where id_producto='.$id_producto);
	}
	function updateTotal($id_compra,$subtotal,$total)
	{
		return $this->db->query('update compras set total_compra='.($total-$subtotal).' where id_compra='.$id_compra);
	}
	function getDetColor($id_color,$id_producto){
		return $this->db->query('select *from det_color where id_color='.$id_color.' and id_producto='.$id_producto);
	}
	function updateExistColor($id,$cant,$exist){
		$exist=$exist-$cant;
		return $this->db->query('update det_color set exist='.$exist.' where id='.$id);
	}
	function updateExistenciaProducto($id_producto,$cant,$existencia){
		$existencia=$existencia-$cant;
		return $this->db->query('update productos set existencia='.$existencia.' where id_producto='.$id_producto);
	}
	function eliminarDetCompras($id){
		return $this->db->query ('delete from det_compras where id='.$id);
	}
}