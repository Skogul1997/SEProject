<?php
	
	class trainees extends CI_Controller{

		public function index(){
			$data['title'] = 'Sign in as Trainee';
			$this->load->view('templates/header');
			$this->load->view('trainees/index' , $data);
			$this->load->view('templates/footer');
		}

//trainee login

		public function login()
		{

			$data['title'] = 'Login';

			this->form_validation->set_rules('username', 'Username', 'required');
			this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation_run() === FALSE) {

				this->load->view('templates/header');
				this->load->view('pages/login', $data);
				this->load->view('templates/footer');
			} else {

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));

				$trainee_id = $this->trainee_model->login($username, $enc_password);

				if ($trainee_id) {
					$this->session->set_userdata('supervisor_id', $supervisor_id);
					$this->session->set_flashdata('login_success', 'You are now logged in');
					redirect('trainees/home');
				} else {
					$this->session->set_flashdata('login_failed', 'Login is Invalid');
					redirect('trainees');
				}

			}
			}
//trainee logout
			public function logout(){
				$this->session->sess_destroy();
				redirect('trainees');
			}

//display all trainings
			public function viewTrainings(){
				if ($this->session->userdata('trainee_id')){
					$data['trainings'] = $this->trainee_model->getTrainingDetails();
					$this->load->view('templates/header');
					$this->load->view('trainees/training', $data);
					$this->load->view('templates/footer');
				}
				else{
					redirect('trainees');
				}
			}

	}
