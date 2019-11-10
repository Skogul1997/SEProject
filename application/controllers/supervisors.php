<?php

	class supervisors extends CI_Controller{

		// Function to view pages inside the supervisor view
		public function view ($page = 'index'){
			if ($this->session->userdata('supervisor_id')){
				if (!file_exists(APPPATH . 'views/supervisors/' . $page . '.php')) {
					show_404();
				}
				$data['title'] = ucfirst($page);
				$this->load->view('templates/header');
				$this->load->view('supervisors/' . $page, $data);
				$this->load->view('templates/footer');
			} else {
				redirect('supervisors');
			}
		}

		// Function to view the default view which is the index view
		public function index(){
			$data['title'] = 'Sign in as Supervisor';
			$this->load->view('templates/header');
			$this->load->view('supervisors/index' , $data);
			$this->load->view('templates/footer');
		}

		// Supervisor Login function
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
				// Calling function of supervisor model to check login credentials (returns supervisor_id)
				$supervisor_id = $this->supervisor_model->login($username,$enc_password);
				if($supervisor_id){
					$this->session->set_userdata('supervisor_id', $supervisor_id);
					$this->session->set_flashdata('login_success','You are now logged in');
					redirect('supervisors/home');

				} else {
					$this->session->set_flashdata('login_failed','Login is Invalid');
					redirect('supervisors');
				}
			}
		}

		// Adding Trainees to database using this military identification number as username and password
		public function addTrainee(){
			if ($this->session->userdata('supervisor_id')){
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
					// Hashing password using md5 algorithm
					$enc_password = md5($username);
					$designation = $this->input->post('designation');
					// Call to supervisor_model to execute the addTrainee function
					if($this->supervisor_model->addTrainee($username,$enc_password,$designation)){
						$this->session->set_flashdata('add_trainee', 'Trainee with ID '.$username.' has been successfully added.');
						redirect('supervisors/add_Trainee');
					} else {
						redirect('supervisors/add_Trainee');
					}
				}
			} else {
				redirect('supervisors');
			}
		}

		public function viewTrainees(){
			if ($this->session->userdata('supervisor_id')){
				$data['trainees'] = $this->supervisor_model->getTrainees();
				$this->load->view('templates/header');
				$this->load->view('supervisors/view_trainee' , $data);
				$this->load->view('templates/footer');
			} else {
				redirect('supervisors');
			}
		}

		public function addSupervisor(){
			if ($this->session->userdata('supervisor_id')){
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
			} else {
				redirect('supervisors');
			}
		}

		// Logout script (Cleared session data)
		public function logout(){
			$this->session->sess_destroy();
			redirect('supervisors');
		}

		// View Trainings
		public function viewTrainings(){
			if ($this->session->userdata('supervisor_id')){
				// Retrieving training details
				$data['trainings'] = $this->supervisor_model->getTrainingDetails();
				$this->load->view('templates/header');
				$this->load->view('supervisors/training' , $data);
				$this->load->view('templates/footer');
			} else {
				redirect('supervisors');
			}
		}
	}
