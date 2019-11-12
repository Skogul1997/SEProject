<?php
	
	class trainee_model extends CI_Model{

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
		
		public function getTrainingDetails(){
			$query = $this->db->get('training');
			return $query->result_array();
		}

		public function changeStatus($trainee_id){
			$this->db->set('status', 'In-Training');
			$this->db->where('trainee_id', $trainee_id);
			$this->db->update('training');
		}

	}