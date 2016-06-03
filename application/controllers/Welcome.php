<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Employees_model');
	}

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');

	}




	public function index(){
		$this->load->view('welcome_message');
	}

<<<<<<< HEAD
	public function goToLogin(){
		$this->load->view('login_page');
	}

	public function addEmp(){

		$empmodel =$this->Emp_model;
		$id = $this->input->post('empid');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		if($empmodel->employee($empid,$fname,$lname)==TRUE){
			
		}
	}

=======
	public function gotowelcomemessage(){
		$this->load->view('welcome_message');
	}
	public function goToLogin(){
		$this->load->view('login_page');

	}
	public function insertValues(){
		$emp = $this->Employees_model;
		$empid = $this->input->post('empid');
		$fname = $this->input->post('fname');
		$lname= $this->input->post('lname');
		$deptid = $this->input->post('deptid');
		$positionid = $this->input->post('positionid');
		echo $emp->insertValues($empid,$fname,$lname,$deptid,$positionid);


	}
>>>>>>> 4ab98aa8140efe59215ac9121b5c151e437a3c08
}
