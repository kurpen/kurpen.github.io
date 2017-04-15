<?php
class Lokale_model extends CI_Model {

        public function __construct()
        {
			$this->load->helper(array('form', 'url'));
            $this->load->database();
        }
		public function get_godziny($rest_id)
		{
			$query = $this->db->get_where('godziny_otwarcia', array('restaurant_id' => $rest_id));
			return $query->row_array();
		}
		public function get_godziny_day($rest_id, $column, $open)
		{
			if($open){$app = 'o';}else{$app = 'z';}
			switch($column){
				case 1:
					$col = "pon_".$app;
				case 2:
					$col = "wt_".$app;
				case 3:
					$col = "sr_".$app;
				case 4:
					$col = "czw_".$app;
				case 5:
					$col = "pt_".$app;
				case 6:
					$col = "sob_".$app;
				case 7:
					$col = "nd_".$app;
			}
			$this->db->select($col);
			$this->db->where('restaurant_id', $rest_id);
			$query = $this->db->get('godziny_otwarcia');
			return $query->result_array();
		}
		public function get_miasta()
		{
			$query = $this->db->get('miasta');
			return $query->result_array();
		}
		public function get_miasto($id)
		{
			$query = $this->db->get_where('miasta', array('id' => $id));
			return $query->row_array();
		}
		public function get_lokal_id($id){
			$query = $this->db->get_where('lokale', array('id' => $id));
			return $query->row_array();
		}
		public function get_lokale($slug = FALSE)
		{
			if ($slug === FALSE)
			{
					$query = $this->db->get('lokale');
					return $query->result_array();
			}

			$query = $this->db->get_where('lokale', array('slug' => $slug));
			return $query->row_array();
		}
		
		public function get_lokale_city($city = 'Wrocław')
		{
			$query = $this->db->get_where('miasta', array('miasto' => $city));
			$miasto = $query->row_array();
			$query = $this->db->get_where('lokale', array('miasto_id' => $miasto['id']));
			return $query->result_array();
		}
		
		public function set_lokale()
		{
			$this->load->helper('url');

			$slug = url_title($this->input->post('nazwa'), 'dash', TRUE);
				
			//$pic = '/pictures/'.$slug.'.jpg';
				
			$config['upload_path'] = './pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_form', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$this->load->view('upload_success', $data);
			}
			$pic = '/pictures/'.$this->upload->data('file_name');
			$data = array(
					'nazwa' => $this->input->post('nazwa'),
					'slug' => $slug,
					'opis' => $this->input->post('opis'),
					'pic' => $pic,
					'adres1' => $this->input->post('adres1'),
					'adres2' => $this->input->post('adres2'),
					'kod_pocztowy' => $this->input->post('kod_pocztowy'),
					'miasto' => $this->input->post('miasto')
				);
			$this->db->insert('lokale', $data);
		}
}