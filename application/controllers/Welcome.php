<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');

	}




	public function index(){
		$this->load->view('welcome_message');
	}

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

}
