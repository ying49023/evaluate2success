<?php
class Database {
 
       private $host = '103.27.202.37'; //ชื่อ Host 
	   private $user = 'prasukrit_alt'; //ชื่อผู้ใช้งาน ฐานข้อมูล
	   private $password = '13579alt'; // password สำหรับเข้าจัดการฐานข้อมูล
	   private $database = 'prasukrit_evaluate2success'; //ชื่อ ฐานข้อมูล

	//function เชื่อมต่อฐานข้อมูล
	protected function connect(){
		
		$mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
			
			$mysqli->set_charset("utf8");

			if ($mysqli->connect_error) {

			    die('Connect Error: ' . $mysqli->connect_error);
			}

		return $mysqli;
	}
	
	//function เรื่ยกดูข้อมูล all user
	public function get_all_user(){
		
		$db = $this->connect();
		$get_user = $db->query("SELECT * FROM employees");
		
		while($user = $get_user->fetch_assoc()){
			$result[] = $user;
		}
		
		if(!empty($result)){
			
			return $result;
		}
	}
	
	public function search_user($post = null){
		
		$db = $this->connect();
		$get_user = $db->query("SELECT * FROM employees WHERE first_name LIKE '%".$post."%' OR last_name LIKE '%".$post."%' OR employee_id LIKE '%".$post."%' ");
		
		while($user = $get_user->fetch_assoc()){
			$result[] = $user;
		}
		
		if(!empty($result)){
			
			return $result;
		}
		
	}
	
	public function get_user($user_id){
		
		$db = $this->connect();
		$get_user = $db->prepare("SELECT employee_id,first_name,last_name, telephone_no FROM employees WHERE employee_id = ?");
		$get_user->bind_param('i',$user_id);
		$get_user->execute();
		$get_user->bind_result($id,$f_name,$l_name,$tel);
		$get_user->fetch();
		
		$result = array(
			'employee_id'=>$id,
			'first_name'=>$f_name,
			'last_name'=>$l_name,
			'telephone_no'=>$tel
		);
		
		return $result;
	}
	
	//function เพื่ม user
	public function add_user($data){
		
		$db = $this->connect();
		
		$add_user = $db->prepare("INSERT INTO employees (employee_id,first_name,last_name,telephone_no) VALUES(NULL,?,?,?) ");
		
		$add_user->bind_param("sss",$data['send_f_name'],$data['send_l_name'],$data['send_tel']);
		
		if(!$add_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "บันทึกข้อมูลเรียบร้อย";
		}
	}
	
	//function edit user
	public function edit_user($data){
		
		$db = $this->connect();
		
		$add_user = $db->prepare("UPDATE employees SET first_name = ? ,last_name = ? , telephone_no = ? WHERE employee_id = ?");
		
		$add_user->bind_param("sssi",$data['edit_f_name'],$data['edit_l_name'],$data['edit_tel'],$data['edit_user_id']);
		
		if(!$add_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "บันทึกข้อมูลเรียบร้อย";
		}
	}
	
	//function delete user
	public function delete_user($id){
		
		$db = $this->connect();
		
		$del_user = $db->prepare("DELETE FROM employees WHERE employee_id = ?");
		
		$del_user->bind_param("i",$id);
		
		if(!$del_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "ลบข้อมูลเรียบร้อย";
		}
	}
	
	
	
	
}
?>