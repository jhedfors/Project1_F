<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('appointment_model');
		$this->load->library('session');
	}
	public function appointments_view(){
		$data = $this->appointment_model->show_appointments_user();
		$this->load->view('appointments_view',['appointments'=>$data]);

	}
	public function appointment_view($id){
		$data = $this->appointment_model->show_appointment($id);
		$this->load->view('appointment_view',['appointment'=>$data]);

	}
	public function add(){
		$this->form_validation->set_rules("date", "Date", "trim|required");
		$this->form_validation->set_rules("time", "Time", "trim|required");
		$this->form_validation->set_rules("task", "Task", "trim|required");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors',[validation_errors()]);
			redirect('/appointments/appointments_view');
		}
		else {
			$post = $this->input->post();
			$this->appointment_model->add($post);
			redirect('appointments');
		}
	}
	public function modify_form(){
		$this->form_validation->set_rules("date", "Date", "trim|required");
		$this->form_validation->set_rules("time", "Time", "trim|required");
		$this->form_validation->set_rules("task", "Task", "trim|required");
		$this->form_validation->set_rules("status", "Status", "trim|required");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors',[validation_errors()]);
			$post = $this->input->post();
			redirect('appointments/'.$post['id']);
		}
		else {
			$post = $this->input->post();
			$this->appointment_model->modify_appointment($post);
			redirect('appointments');
		}
	}
	public function mark_complete($id){
		$this->appointment_model->mark_complete($id);
		redirect('appointments');
	}
	public function delete($id){
		$this->appointment_model->delete_appointment($id);
		redirect('appointments');
	}
}
