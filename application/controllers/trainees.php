<?php
	
	class trainees extends CI_Controller{

		public function index(){
			$data['title'] = 'Sign in as Trainee';
			$this->load->view('templates/header');
			$this->load->view('trainees/index' , $data);
			$this->load->view('templates/footer');
		}

//trainee login
		public function login(){

			$data['title'] = 'Login';

			this->form_validation->set_rules('username', 'Username', 'required');
			this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation_run()===FALSE){

				this->load->view('templates/header');
				this->load->view('pages/login', $data);
				this->load->view('templates/footer');
			} else {

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));

				$user_id = $this->trainee_model->login($username,$password);

				if($user_id){
					session_start();
					$this->session->set_flashdata('user_loggedin','You are now logged in');
					$_SESSION["user_id"] = $user_id;
					$_SESSION["password"] = $password;
					redirct('index');
				} else {
					$this->session->set_flashdata('login_failed','Login is Invalid');
					redirect('trainees/login');
				}

			}
//trainee logout
			public function logout(){
				session_destroy();
				redirect('trainees/login');
			}

		}
	}