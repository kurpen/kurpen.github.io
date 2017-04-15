<?php
class Rezerwacja_model extends CI_Model {

        public function __construct()
        {
			$this->load->helper(array('form', 'url'));
            $this->load->database();
        }
		
		public function get_rezerwacje()
		{
			$query = $this->db->get('rezerwacje');
			return $query->result_array();
		}
		public function get_rezerwacje_klient($id){
			$this->db->order_by("data_rezerwacji", "desc");
			$query = $this->db->get_where('rezerwacje', array('user_id' => $id));
			return $query->result_array();
		}
		public function get_rezerwacje_restauracja($id){
			$this->db->order_by("data_rezerwacji", "desc");
			$query = $this->db->get_where('rezerwacje', array('restaurant_id' => $id));
			return $query->result_array();
		}
		public function set_shown($id, $selection){
			$data_input = array(
				'shown' => $selection
			);
		$query = "UPDATE rezerwacje SET shown =".$selection." WHERE id=".$id;
		$this->db->query($query);
		}
		public function zmien_status_rezerwacji($rest_id, $option){
			$query = "UPDATE rezerwacje SET potwierdzenie =".$option." WHERE id=".$rest_id;
			$this->db->query($query);
		}
		public function set_rezerwacja()
		{
			$this->load->helper('url');
			$data_input = array(
					'restaurant_id' => $_SESSION['lokal_id'],
					'user_id' => $_SESSION['user_id'],
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'phone' => $this->input->post('phone'),
					'data_rezerwacji' => date('Y-m-d H:i:s'),
					'data' => $this->input->post('date'),
					'potwierdzenie' => false,
					'koniec' => false,
					'l_osob' => $this->input->post('l_osob')
				);
			$this->db->insert('rezerwacje', $data_input);
		}
}