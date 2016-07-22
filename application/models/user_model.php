<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct(){
		$this->load->helper('security');
	}
	public function register($post){
		$password = do_hash($post['password']);
		$first_name = $this->get_first_name($post['name']);
		$query = "INSERT INTO users (name, first_name, email, password, dob, created_at, modified_at) VALUES(?,?,?,?,?,NOW(),NOW());";
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
}
