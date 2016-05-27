<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employees_model extends CI_model{
	private $empid;
	private $fname;
	private $lname;
	private $deptid;
	private $positionid;

	public function __construct(){
		parent::__construct();
		$this->load->helper('array');
	}
	public function set_empid($empid){
		$this->empid=$empid;
	}
	public function set_fname($fname){
		$this->fname=$fname;
	}
	public function set_lname($lname){
		$this->lname=$lname;
	}
	public function set_deptid($deptid){
		$this->deptid=$deptid;
	}
	public function set_positionid($positionid){
		$this->positionid=$positionid;
	}

	public function get_empid(){
		return $this->empid;
	}
	public function get_fname(){
		return $this->fname;
	}
	public function get_lname(){
		return $this->lname;
	}
	public function get_deptid(){
		return $this->deptid;
	}
	public function get_positionid(){
		return $this->positionid;
	}

	public function insertValues($empid,$fname,$lname,$deptid,$positionid){
		$emp_obj = array(
			'emp_id' => $empid,
			'first_name' => $fname,
			'last_name' => $lname,
			'dept_id' => $deptid,
			'position_id' => $positionid
		);

		$this->db->trans_start();
		$this->db->insert('Employees', $emp_obj);
		$this->db->trans_complete();
		if($this->db->trans_status()==FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}
}