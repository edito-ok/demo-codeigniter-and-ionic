<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $startTime = null;
	
	function __construct(){
		parent::__construct();
		$this->load->model('date_model');
		$this->load->helper('form');
	}
	/*service */
    function get()
	{
		$datetime['datetime'] = $this->date_model->getDate()[0]->date;
		$datetime['id'] = $this->date_model->getDate()[0]->id_table;
		echo (json_encode($datetime));
	}
	public function index()
	{
		$datetime['datetime'] = $this->date_model->getDate()[0]->date;
		$datetime['id'] = $this->date_model->getDate()[0]->id_table;
		$script = '<script type="text/javascript">'.
     'load();'.
	 '</script>';
	 $datetime['script']= $script;
		$this->load->view('welcome_message',$datetime);
	}
	public function postUpdateService($request){	
		echo (json_encode($request));
	}
	public function update(){
		$data = array(
			'date'=>$this->input->post('date'),
			'id'=>$this->input->post('id')
			);
		$this->date_model->update($data);
		$this->index();
	} 
}
