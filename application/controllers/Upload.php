<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
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
?>