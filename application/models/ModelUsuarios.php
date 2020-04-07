<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUsuarios extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}

	function AddUsusario($data)
	{

		$contraseña=$this->encrypt->sha1($data['txtpass']);
		$query=$this->db->query('call addUsuario("'.$data['txtnombre'].'","'.$data['txtap'].'","'.$data['txtam'].'","'.$data['txtname'].'","'.$data['txtemail'].'","'.$contraseña.'",'.$data['lstTipo'].','.$data['lstSuc'].',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;		

	}

	public function deletPermiso($data)
	{
		
		$query=$this->db->query('call deletepermiso('.$data['idsuc'].','.$data['iduser'].',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;

	}
	
	function ValidaUser($nom,$val){
		
		if($val==1)
			$query=$this->db->query('call comprobarUser("'.$nom.'",'.$this->session->userdata('idsuc').',@ban);');
		else if($val==2)
			$query=$this->db->query('call comprobarEmail("'.$nom.'",'.$this->session->userdata('idsuc').',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;
	}
	// validamos cuando modificamos
	function ValidarUserModi($nom,$val){
		$this->db->close();
		if($val==1)
			$query=$this->db->query('call comprobarUserModi("'.$nom.'",'.$this->session->userdata('idsuc').',@ban);');
		else if($val==2)
			$query=$this->db->query('call comprobarEmail("'.$nom.'",'.$this->session->userdata('idsuc').',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;
	}
	// 
	public function miUser($usuario)
	{
		$this->db->where('usuario_nickname',$usuario);
		$this->db->select('iduser,usuario_nickname,usuario_pass');
		$query=$this->db->get('usuarios');
		return $query;

	}
	function Mostrarmodi($id){
		$this->db->where('iduser',$id);
		$this->db->select('*');
		$query=$this->db->get('usuarios');
		return $query;
	}
	function mostrarU(){
		
		$query=$this->db->query('call MostrarUsuarios('.$this->session->userdata('idsuc').');');
		$this->db->close();
		return $query;
	}
	public function eliminarUser($id)
	{
	
		$query=$this->db->query('call elminaUser('.$this->session->userdata('idsuc').','.$id.',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;
	}
	public function getSucursal()
	{
		$this->db->close();
		$this->db->where('estado',1);
		$this->db->select('idsuc,nombre');
		$query=$this->db->get('sucursal');
		return $query;
	}

	public function updateDetalleU($data)
	{
		
		$query=$this->db->query('call insertDetalleUser('.$data['idsuc'].','.$data['iduser'].',@ban);');
		//$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;

	}

	public function updateMyuser($arr)
	{
		$this->db->close();
		$this->db->where('iduser',$arr['iduser']);
		$query=$this->db->update('usuarios',$arr);
		return $query;
	}

	public function updateUsers($data)
	{
		//$this->db->close();
		$query=$this->db->query('call updateUser('.$data['iduser'].',"'.$data['usuario_nombre'].'","'.$data['usuario_apellidop'].'","'.$data['usuario_apellidom'].'","'.$data['usuario_nickname'].'","'.$data['usuario_correo'].'","'.$data['usuario_pass'].'","'.$data['usuario_tipo'].'",@ban);');
		$query->next_result();
		$res=$this->db->query('select @ban');
		foreach($res->result_array() as $row)
			$ban=$row['@ban'];
		$this->db->close();
		return $ban;
	}
	public function filasRendimientoGeneral($usuario,$inicio,$fin,$status)
	{
		$query=$this->db->query('call filasRendimientoGeneral('.$usuario.',"'.$inicio.'","'.$fin.'","'.$status.'");');
		$query->next_result();
		$numero=0;
		foreach($query->result() as $row )
			$numero=$row->numero;
		return $numero;
	}
	function numSoporteDado($id,$inicio,$fin)
	{
		return $this->db->query('select numSoporteDado('.$id.',"'.$inicio.'","'.$fin.'") as numero;');
	}
	function miSoporte($id,$inicio,$fin)
	{
		$query=$this->db->query('call miSoporte('.$id.',"'.$inicio.'","'.$fin.'")');
		$query->next_result();
		return $query;
	}
	public function rendimientoGeneral($inicio,$fin,$usuario,$uri,$tope,$status)
	{
		$query=$this->db->query('call rendimientoGeneral("'.$inicio.'","'.$fin.'",'.$usuario.','.$uri.','.$tope.',"'.$status.'")');
		$query->next_result();
		return $query;
	}
	public function filasRendimientoTotal($inicio,$fin,$status)
	{
		$query=$this->db->query('call filasRendimientoTotal("'.$inicio.'","'.$fin.'","'.$status.'");');
		$query->next_result();
		$numero=0;
		foreach($query->result() as $row )
			$numero=$row->numero;
		return $numero;
	}
	public function getUsuarios()
	{
		$query=$this->db->query('select *from usuarios where usuario_tipo=1 or usuario_tipo=3');
		return $query;
	}
	public function rendimientoTotal($inicio,$fin,$uri,$tope,$status)
	{
		$query=$this->db->query('call rendimientoTotal("'.$inicio.'","'.$fin.'",'.$uri.','.$tope.',"'.$status.'")');
		$query->next_result();
		return $query;
	}

}