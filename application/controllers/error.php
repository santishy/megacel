<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->model("ModelCli");
		$this->load->library('pagination');
	}
	public function index()
	{
			
	}

}