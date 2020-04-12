<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelServicio extends CI_Model {



	function __construct ()

	{

		parent::__construct();

	}

	function addServicio($data)

	{

	$query=$this->db->query('call addFolio('.$data['idCli'].','.$this->session->userdata('idsuc').',
	"'.$data['estado'].'","'.$data['fecha'].'",@ban)');

		//$query->next_result();

		$res=$this->db->query('select @ban');

			foreach ($res->result_array() as $row)

			{

				$ban=$row['@ban'];

			}
			$this->db->close();
		return $ban;

	}
	function lastCambioEstado($folio){
		return $this->db->query('select *from cambioEstados where folio='.$folio.' order by id desc limit 1;');
	}

	function getFolio()

	{

		$query=$this->db->query('select max(folio) as folio from folios');

		return $query;

	}

	/************Servicio ****************************************************************/

	function addDetServicio($data)

	{

		$query=$this->db->query('call addServicio('.$data['folio'].','.$data['idEq'].',"'.$data['tipo'].'",
		"'.$data['falla'].'","'.$data['cables'].'","'.$data['accesorios'].'","'.$data['calcas'].'","'.$data['usuario'].'",
		"'.$data['chip'].'","'.$data['memoria'].'","'.$data['cotizacion'].'","'.$data['marco'].'",
		"'.$data['botones'].'","'.$data['tapa'].'","'.$data['enciende'].'","'.$data['mojado'].'","'.$data['contiene_bateria'].'",@ban);');

		//$query->next_result();

		$res=$this->db->query('select @ban');

			foreach ($res->result_array() as $row)

			{

				$ban=$row['@ban'];

			}
			$this->db->close();
		return $ban;

	}

	function obtenerEstado($folio)

	{

		$this->db->where('folio',$folio);

		$query=$this->db->get('folios');

		return $query;

	}

	function numero($id,$estado)
	{
		$query=$this->db->query('select count(f.folio) as num from folios f join clientes c on f.idCli=c.idCli where idsuc='.$id.' and estadogeneral="'.$estado.'";');
		$num=0;
		foreach($query->result() as $row)

		{

			$num=$row->num;

		}
		return $num;
	}

	function numeroExpirados($fecha)

	{
		$this->db->close();
		$query=$this->db->query('call numeroExpirados("'.$fecha.'");');

		//$query->next_result();

		$nume=0;

		foreach($query->result() as $row)

		{

			$nume=$row->nume;

		}
		$this->db->close();
		return $nume;

	}

	function consultaExpirados($fecha,$uri,$tope)

	{
		$this->db->close();
		$query=$this->db->query('call consultaExpirados("'.$fecha.'",'.$uri.','.$tope.');');

		//$query->next_result();
		$this->db->close();
		return $query;

	}

	function consultaGeneralServ($idsuc,$uri,$tope,$estado)

	{
		$this->db->close();
		$query=$this->db->query('call getServicio('.$idsuc.','.$uri.','.$tope.',"'.$estado.'");');

		//$query->next_result();
		$this->db->close();
		return $query;

	}
	function agregarSoporte($data)
	{
		return $this->db->insert('asistencias',$data);
	}
	function comprobarSoporte($id_user,$id_servicio)
	{
		return $this->db->query('select *from asistencias where id_usuario='.$id_user.' and id_servicio='.$id_servicio);
	}
	function updateSoporte($data,$id){
		$this->db->where('id',$id);
		return $this->db->update('asistencias',$data);
	}

	function numRows($folio)

	{

		$this->db->where('folios.folio',$folio);

		$this->db->from('folios');

		$this->db->join('detservicio','detservicio.folio=folios.folio');

		$query=$this->db->get();

		return $query->num_rows();

	}

	function getSalida($folio)

	{

		$query=$this->db->query('call getSalida('.$folio.')');
		//$query->next_result();
		$this->db->close();
		return $query;

	}

	function salida($data)

	{

		$query=$this->db->query('call salida('.$data['folio'].','.$data['idServ'].',"'.$data['estado'].'",@ban,"'.$data['solucion'].'","'.$data['usuario'].'",'.$this->session->userdata('iduser').','.$data['mano_obra'].','.$data['refaccion'].');');

		//$query->next_result();

		$res=$this->db->query('select @ban');

			foreach ($res->result_array() as $row)

			{

				$ban=$row['@ban'];

			}
			$this->db->close();
		return $ban;

	}

	function getNameUser($pass)

	{

		$this->db->where('usuario_pass',$pass);

		$this->db->select("*");

		$query=$this->db->get("usuarios");

		return $query;

	}

	function getServicio($id)

	{

		$this->db->where('idServ',$id);

		$this->db->select("*");

		$query=$this->db->get('detservicio');

		return $query;

	}

	function getServicioFolio($folio)

	{

		$query=$this->db->query('call getServicioFolio('.$folio.');');

		//$query->next_result();
		$this->db->close();
		return $query;

	}



	function getServicioNombre($nombre)

	{

		$query=$this->db->query('call getServicioNombre("'.$nombre.'");');

		//$query->next_result();
		$this->db->close();
		return $query;

	}

	function modiServicio($data)

	{

		$query=$this->db->query('call modiServicio('.$data['idSrv'].',"'.$data['tipo'].'",

		"'.$data['falla'].'","'.$data['cables'].'",	"'.$data['accesorios'].'",

		"'.$data['calcas'].'","'.$data['chip'].'","'.$data['memoria'].'","'.$data['cotizacion'].'",
		"'.$data['marco'].'","'.$data['tapa'].'","'.$data['enciende'].'","'.$data['mojado'].'",
		"'.$data['botones'].'","'.$data['contiene_bateria'].'",@ban);');

		//$query->next_result();

		$res=$this->db->query('select @ban');

			foreach ($res->result_array() as $row)

			{

				$ban=$row['@ban'];

			}
			$this->db->close();
		return $ban;

	}

	public function getMensaje()

	{

		$query=$this->db->query('select * from mensajes;');

		return $query;

	}

	function getSucursales()

	{
		 $this->db->close();

		$this->db->where('estado',1);

		$this->db->select('nombre,idsuc');

		$query=$this->db->get('sucursal');

		return $query;

	}

	function getSuc($id)

	{

		$query=$this->db->query('select * from sucursal where idsuc='.$id.' and estado=1;');

		return $query;

	}

	public function getTicket()

	{

		$query=$this->db->query('select * from tickets;');

		return $query;

	}

	function numFechas($inicio,$fin,$sucursal)

	{

		$query=$this->db->query('call numFechas ("'.$inicio.'","'.$fin.'",'.$sucursal.',@num);');

		//$query->next_result();
		 $this->db->close();


	}

	function corte($inicio,$fin,$sucursal,$uri,$tope)

	{

		$query=$this->db->query('call corte("'.$inicio.'","'.$fin.'",'.$sucursal.','.$uri.','.$tope.');');
		//$query->next_result();
		 $this->db->close();

		return $query;

	}
	function cambiarFechaSalida($data,$id)
	{

		$query=$this->db->query('update folios set fecha_salida="'.$data['fecha_salida'].'" where folio='.$id);
		return $query;
	}

	function eliFolio($folio)

	{
		 $this->db->close();
		$query=$this->db->query('call eliFolio('.$folio.',@ban);');

		//$query->next_result();

		$res=$this->db->query('select @ban');

			foreach ($res->result_array() as $row)

			{

				$num=$row['@ban'];

			}
			 $this->db->close();

		return $num;

	}

	function ticket($folio)

	{

		$query=$this->db->query('call ticket('.$folio.');');

		//$query->next_result();
		 $this->db->close();

		return $query;

	}



	function MostrarE($suc){
		$this->db->close();
		$query=$this->db->query('call MostrarEmpleados('.$suc.');');

		//$query->next_result();
		$this->db->close();
		return $query;

	}



	public function updateTicket($data)

	{

		$this->db->where('id_ticket',$data['id_ticket']);

		$query=$this->db->update('tickets',$data);

		return $query;

	}

	public function updateMensajeBd($data,$id)

	{

		$this->db->where('id_mensaje',$id);

		$query = $this->db->update('mensajes',$data);

		return $query;

	}

	public function getNumIncompletos($idsuc)

	{

		$query=$this->db->query('select getNumIncompletos('.$idsuc.') as num');

		//$query->next_result();

		foreach ($query->result_array() as $row)

		{

			$num=$row['num'];

		}
		 $this->db->close();

		return $num;

	}

	public function getIncompletos($idsuc)

	{

		$query=$this->db->query('call getIncompletos('.$idsuc.');');
		//$query->next_result();
		 $this->db->close();

		return $query;

	}

	function getReparadores($folio)

	{

		$this->db->where('folio',$folio);

		$this->db->select('*');

		$query=$this->db->get('reparadores');

		return $query;

	}

	function cambiarEntregado($data,$folio)
	{
		$this->db->where('folio',$folio);
		$this->db->update('folios',$data);
	}

	function modiUbicacion($data)

	{

		//$this->db->where('folio',$folio);

		$query=$this->db->insert('reparadores',$data);

		return $query;

	}

	function addComment($data)

	{

		$this->db->trans_start();

		$query=$this->db->insert('comentarios',$data);

		$this->db->trans_complete();

		return $query;

	}
	function getCambioEstado($folio,$id_user,$edo){
		return $this->db->query('select *from cambioEstados where folio='.$folio.' and id_usuario='.$id_user.' and state="'.$edo.'";');
	}
	function insertHistorialEstado($data){
		$query=$this->db->insert('cambioEstados',$data);
		return $query;
	}
	function getComment($id)

	{

		$this->db->where('idServ',$id);

		$this->db->select("*");

		$query=$this->db->get('comentarios');

		return $query;

	}

	function getEstado($folio)

	{

		$this->db->where('folio',$folio);

		$query=$this->db->get('folios');

		return $query;

	}

	function getNumUrgentes()

	{

		$query=$this->db->query('select count(folio) as num from folios where estadogeneral="urgente";');

		$num=0;

		foreach ($query->result() as $row)

		{

			$num=$row->num;

		}

		return $num;

	}

	function getServicioFolioEdo($clave,$edo)

	{

		$query=$this->db->query('call  getServicioFolioEdo('.$clave.',"'.$edo.'");');

		//$query->next_result();
		 $this->db->close();

		return $query;

	}

	function getServicioNombreEdo($clave,$edo)

	{

		$query=$this->db->query('call  getServicioNombreEdo("'.$clave.'","'.$edo.'");');

		//$query->next_result();
		$this->db->close();

		return $query;

	}

}
