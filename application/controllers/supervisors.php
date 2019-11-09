<?php

	class supervisors extends CI_Controller{
		
		public function view ($page = 'index'){
			if(!file_exists(APPPATH.'views/supervisors/'.$page.'.php')){
					show_404();
			}
			$data['title'] = ucfirst($page);
			$this->load->view('templates/header');
			$this->load->view('supervisors/'.$page , $data);
			$this->load->view('templates/footer');
		}

		public function index(){
			$data['title'] = 'Sign in as Supervisor';
			$this->load->view('templates/header');
			$this->load->view('supervisors/index' , $data);
			$this->load->view('templates/footer');
		}

		// Login supervisor
		public function login(){
			$data['title'] = 'Sign In';
			$this->form_validation->set_rules('username' , 'Username' , 'required');
			$this->form_validation->set_rules('password' , 'Password' , 'required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('supervisors/index' , $data);
				$this->load->view('templates/footer');
			} else {
				$username = $this->input->post('username');
				$enc_password = md5($this->input->post('password'));
				//Login user
				$supervisor_id = $this->supervisor_model->login($username,$enc_password);
				if($supervisor_id){
					$this->session->set_flashdata('login_success','You are now logged in');
					redirect('supervisors/home');

				} else {
					$this->session->set_flashdata('login_failed','Login is Invalid');
					redirect('supervisors');
				}
			}
		}

		//Add Trainee
		public function addTrainee(){
			$data['title'] = 'Add Trainee';
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('designation','Designation','required');
			if($this->form_validation->run() === FALSE){
				$this->session->set_flashdata('add_trainee', 'Form details were not entered properly. Try again.');
				$this->load->view('templates/header');
				$this->load->view('supervisors/add_Trainee' , $data);
				$this->load->view('templates/footer');
			} else {
				$username = $this->input->post('username');
				$enc_password = md5($username);
				$designation = $this->input->post('designation');
				if($this->supervisor_model->addTrainee($username,$enc_password,$designation)){
					$this->session->set_flashdata('add_trainee', 'Trainee with ID '.$username.' has been successfully added.');
					redirect('supervisors/add_Trainee');
				} else {
					redirect('supervisors/add_Trainee');
				}
			}
		}

		public function viewTrainees(){
			$data['trainees'] = $this->supervisor_model->getTrainees();
			$this->load->view('templates/header');
			$this->load->view('supervisors/view_trainee' , $data);
			$this->load->view('templates/footer');
		}

		public function addSupervisor(){
			$data['title'] = 'Add Supervisor';
			$this->form_validation->set_rules('username','Username','required');
			if($this->form_validation->run() === FALSE){
				$this->session->set_flashdata('add_supervisor', 'Form details were not entered properly. Try again.');
				$this->load->view('templates/header');
				$this->load->view('supervisors/add_Supervisor' , $data);
				$this->load->view('templates/footer');
			} else {
				$username = $this->input->post('username');
				$enc_password = md5($username);
				if($this->supervisor_model->addSupervisor($username,$enc_password)){
					$this->session->set_flashdata('add_supervisor', 'Supervisor with ID '.$username.' has been successfully added.');
					redirect('supervisors/add_Supervisor');
				} else {
					redirect('supervisors/add_Supervisor');
				}
			}
		}
	}