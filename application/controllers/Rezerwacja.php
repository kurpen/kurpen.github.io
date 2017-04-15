<?php
class Rezerwacja extends CI_Controller {

	protected $the_user;
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('user_model', 'lokale_model', 'rezerwacja_model'));
                $this->load->helper(array('url','language'));
				$this->load->library('session');
        }

        public function index()
		{
			$data['miasta'] = $this->lokale_model->get_miasta();
			$data['lokale'] = $this->lokale_model->get_lokale();
			$data['title'] = 'Lokale';
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			$this->load->view('templates/header', $data);
			$this->load->view('lokale/bookings-view', $data);
			$this->load->view('templates/footer');
		}

		public function book($id)
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$lokal_id = $id;
			$data['id'] = $id;
			$data['lokal'] = $this->lokale_model->get_lokal_id($id);
			$data['miasto'] = $this->lokale_model->get_miasto($data['lokal']['miasto_id']);
			$data['godziny'] = $this->lokale_model->get_godziny($data['lokal']['id']);
			$data['user'] = $this->ion_auth->user()->row();
			$user_id = $data['user']->id;
			$data['title'] = 'Rezerwacja stolika w lokalu '.$data['lokal']['nazwa'];
			
			$this->form_validation->set_rules('first_name', 'Imię', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Nazwisko', 'trim|required');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header-lokal', $data);
				$this->load->view('lokale/book', $data);
				$this->load->view('templates/footer');

			}
			else
			{
				$this->rezerwacja_model->set_rezerwacja();
				redirect('/rezerwacje');
			}
			
		}
}