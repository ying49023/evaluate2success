<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Emp_model extends CI_Model(
		
		private $empid;
		private $fname;
		private $lname;

		public function __construct(){
			parent::__construct();
		}

		public function set_empid($empid){
			$this->empid = $empid;
		}

		public function set_fname($fname){
			$this->fname = $fname;
		}

		public function set_lname($lname){
			$this->lname ->lname;
		}

			public function get_empid($empid){
			return $this->empid; 

		public function get_fname($fname){
			return $this->fname;
		}

		public function set_lname($lname){
			return $this->lname;
		}

		public function addEmployee($empid,$fname,$lname){
			$emp_obj = array('employee_id' => $empid, 
							 'first_name' => $fname,
							 'last_name' => $lname);
			$this->db->trans_start();
			$this->db->insert('employee',$emp_obj);
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return true;
			}
		}

	)