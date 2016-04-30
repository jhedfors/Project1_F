<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {
	public function __construct(){
		$this->load->helper('security');
	}
	public function register($post){
		$password = do_hash($post['password']);
		$first_name = $this->get_first_name($post['name']);
		$query = "INSERT INTO users (name, first_name, email, password, dob, created_at, modified_at) VALUES(?,?,?,?,?,NOW(),NOW());
";
		$values =
			 ["{$post['name']}",$first_name,"{$post['email_pk']}",$password,"{$post['dob']}"];
		$this->db->query($query, $values);
		return true;
	}

	public function get_first_name($name){
		$first_name ='';
		for ($i=0; $i < strlen($name); $i++) {
			if ($name[$i] == ' ') {
				break;
			}
			else {
				$first_name.=$name[$i];
			}
		};

		return $first_name;
	}
	public function show_user($index,$value){
		$query =
			"SELECT * FROM users WHERE ".$index." = ?";
		$values = [$value];
		return $this->db->query($query,$values)->row_array();
	}
	public function show_by_id($id){
		$query =
			"SELECT alias, name, email FROM users WHERE id = ?";
		$values = [$id];
		return $this->db->query($query,$values)->row_array();
	}
	public function show_by_email($email){
		return $this->show_user('email',$email);
	}
	public function add($post){
		$active_id = $this->session->userdata('active_id');
		$date_time = "{$post['date']} {$post['time']}";
		$query =
			"INSERT INTO appointments (task, date_time, status, created_at, modified_at, user_id) VALUES (?,?,?, NOW(), NOW(),?)";
		$values = [$post['task'],$date_time,'pending',$active_id];
		return $this->db->query($query,$values);
	}
	public function show_appointments_user(){
		$active_id = $this->session->userdata('active_id');
		$query =
			"SELECT appointments.id as appointment_id, task, date_time, status FROM appointments
			LEFT JOIN users ON users.id = appointments.user_id
			WHERE users.id = ? ORDER BY date_time";
		$values =[$active_id];
		return $this->db->query($query,$values)->result_array();
	}
	public function show_appointment($id){
		$query =
			"SELECT * from appointments WHERE id = ?";
		$values =[$id];
		return $this->db->query($query,$values)->row_array();
	}
	public function modify_appointment($post){
		$date_time = "{$post['date']} {$post['time']}";
		$query =
				"UPDATE appointments SET task = ?, date_time = ?, status = ?, modified_at = NOW()
				WHERE id = ?";
		$values =[$post['task'],$date_time,$post['status'],$post['id']];
		$this->db->query($query,$values);
	}
	public function delete_appointment($id){
		$query =
				"DELETE FROM appointments WHERE id=?";
		$values =[$id];
		$this->db->query($query,$values);
	}
}
