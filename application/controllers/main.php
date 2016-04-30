<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('main_model');
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('login_reg_view');
	}
	public function validation(){
		$routing = [
			'name'=>function($post_data){$this->form_validation->set_rules("name", "Name", "trim|required|min_length[1]");},
			'email'=>function($post_data){$this->form_validation->set_rules("email", "Email", "trim|required|min_length[3]");},
			'email_pk'=>function($post_data){$this->form_validation->set_rules("email_pk", "Email", "trim|required|min_length[3]|callback_check_preexisting_email");},
			'alias'=>function($post_data){$this->form_validation->set_rules("alias", "Alias", "trim|required|min_length[3]");},
			'password'=>function($post_data){$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");},
			'password_chk'=>function($post_data){$this->form_validation->set_rules("password_chk", "Password", "trim|required||callback_check_credentials");},
			'confirm_pw'=>function($post_data){$this->form_validation->set_rules("confirm_pw", "Confirmed Password", "trim|required|matches[password]");},
			'dob'=>function($post_data){$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");},
			];
		foreach (array_keys($this->input->post()) as $key) {
			$routing[$key]($this->input->post($key));
		}
}
	public function login(){
		$this->validation();
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors_login',[validation_errors()]);
			$this->load->view('login_reg_view');
		}
		else{
			redirect('appointments');
		}
	}
	public function register(){
		$this->validation();
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors_reg',[validation_errors()]);
			$this->load->view('login_reg_view');
		}
		else{
			$post = $this->input->post();
			if($this->main_model->register($post) ){
				$record = $this->main_model->show_by_email($post['email_pk']);
				$this->session->set_userdata('active_id' ,$record['id']);
				$this->session->set_userdata('alias' ,$record['first_name']);
				redirect('appointments');
			}
			redirect('unanticipated_error');
		}
	}
	public function check_preexisting_email($post_email){
		$record = $this->main_model->show_by_email($post_email);
		if($record){
			$this->form_validation->set_message('check_preexisting_email', '%s is already in use');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	public function check_credentials(){
		$post = $this->input->post();
		$record;
		if ($this->main_model->show_by_email($post['email']) == null) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$record = $this->main_model->show_by_email($post['email']);
		if($record['password'] != do_hash($post['password_chk'])) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$this->session->set_userdata('active_id' ,$record['id']);

		$this->session->set_userdata('first_name' ,$record['first_name']);
		return TRUE;
	}

	public function appointments_view(){
		$data = $this->main_model->show_appointments_user();
		$this->load->view('appointments_view',['appointments'=>$data]);

	}
	public function appointment_view($id){
		$data = $this->main_model->show_appointment($id);
		$this->load->view('appointment_view',['appointment'=>$data]);

	}

	public function add(){
		$post = $this->input->post();
		$this->main_model->add($post);
		redirect('appointments');
	}
	public function modify_form(){
		$post = $this->input->post();
		$this->main_model->modify_appointment($post);
		redirect('appointments');
	}

	public function delete($id){
		$this->main_model->delete_appointment($id);
		redirect('appointments');
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}
