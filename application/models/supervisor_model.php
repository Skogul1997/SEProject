<?php

	class supervisor_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}
		public function login($username,$password){
			//Validate
			$this->db->where('username',$username);
			$this->db->where('password',$password);
			$result = $this->db->get('supervisors');
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return FALSE;
			}
		}

		public function addTrainee($username,$enc_password,$designation){
			$this->db->where('username',$username);
			$result = $this->db->get('trainees');
			if($result->num_rows() == 1){
				$this->session->set_flashdata('add_trainee','Trainee with username '.$username.' already exists.');
				return FALSE;
			} else {
				$data = array(
					'username' => $username,
					'password' => $enc_password,
					'designation' => $designation
				);
				return $this->db->insert('trainees' , $data);
			}
		}

		public function getTrainees(){
			$query = $this->db->get('trainees');
			return $query->result_array();
		}

		public function addSupervisor($username,$enc_password){
			$this->db->where('username',$username);
			$result = $this->db->get('trainees');
			if($result->num_rows() == 1){
				$this->session->set_flashdata('add_supervisor','Supervisor with username '.$username.' already exists.');
				return FALSE;
			} else {
				$data = array(
					'username' => $username,
					'password' => $enc_password
				);
				return $this->db->insert('supervisors' , $data);
			}
		}
	}
