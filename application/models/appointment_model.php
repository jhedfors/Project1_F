<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointment_model extends CI_Model {
	public function add($post){
		$active_id = $this->session->userdata('active_id');
		$date_time = "{$post['date']} {$post['time']}";
		$query =
			"INSERT INTO appointments (task, date_time, status, created_at, modified_at, user_id) VALUES (?,?,?, NOW(), NOW(),?)";
		$values = [$post['task'],$date_time,'Pending',$active_id];
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
	public function mark_complete($id){
		$query =
				"UPDATE appointments SET status = ?, modified_at = NOW()
				WHERE id = ?";
		$values =['Done',$id];
		$this->db->query($query,$values);
	}
	public function delete_appointment($id){
		$query =
				"DELETE FROM appointments WHERE id=?";
		$values =[$id];
		$this->db->query($query,$values);
	}
}
