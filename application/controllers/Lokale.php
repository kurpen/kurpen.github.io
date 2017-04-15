<?php
class Lokale extends CI_Controller {

	protected $the_user;
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('user_model', 'lokale_model'));
                $this->load->helper(array('url','language'));
				$this->load->library('session');
        }

        public function index()
		{
			$data['miasta'] = $this->lokale_model->get_miasta();
			$data['lokale'] = $this->lokale_model->get_lokale();
			$data['title'] = 'Lokale';
			$data['view'] = 'Lokale';
			$data['view_link'] = base_url().'index.php/lokale';
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			$this->load->view('templates/header', $data);
			$this->load->view('lokale/index', $data);
			$this->load->view('templates/footer');
		}
		
		public function city($city = null)
		{
			if($city == null){
				redirect('/lokale');
			}
			$data['miasta'] = $this->lokale_model->get_miasta();
			$city = $this->string_miasta($city);
			$data['lokale'] = $this->lokale_model->get_lokale_city($city);
			$data['title'] = 'Lokale';
			$data['view'] = 'Lokale';
			$data['view_link'] = base_url().'index.php/lokale';
			$data['view2'] = $city;
			$data['view_link2'] = base_url().'index.php/lokale/'.$city;
			$data['city'] = $city;
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			$this->load->view('templates/header', $data);
			$this->load->view('lokale/index', $data);
			$this->load->view('templates/footer');
		}
		
        public function view($slug = NULL)
		{
			$data['lokal'] = $this->lokale_model->get_lokale($slug);
			$data['miasto'] = $this->lokale_model->get_miasto($data['lokal']['miasto_id']);
			$data['godziny'] = $this->lokale_model->get_godziny($data['lokal']['id']);
			$data['view'] = 'Lokale';
			$data['view_link'] = base_url().'index.php/lokale';
			$data['view2'] = $data['lokal']['nazwa'];
			$data['view_link2'] = base_url().'index.php/lokale/'.$slug;
			if (empty($data['lokal']))
			{
					show_404();
			}
			
			$data['nazwa'] = $data['lokal']['nazwa'];
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			$this->load->view('templates/header-lokal', $data);
			$this->load->view('lokale/view', $data);
			$this->load->view('templates/footer');
		}
		
		public function create()
		{
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			$data['miasta'] = $this->lokale_model->get_miasta();
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$data['title'] = 'Dodaj lokal';

			$this->form_validation->set_rules('nazwa', 'Nazwa', 'required');
			$this->form_validation->set_rules('opis', 'Opis', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('lokale/create');
				$this->load->view('templates/footer');

			}
			else
			{
				$this->lokale_model->set_lokale();
				$this->load->view('lokale/success');
			}
		}
		public function string_miasta($wyr){
			$wyr = str_replace("%C4%85","ą",$wyr);
			$wyr = str_replace("%C5%BC","ż",$wyr);
			$wyr = str_replace("%C5%BA","ź",$wyr);
			$wyr = str_replace("%C4%87","ć",$wyr);
			$wyr = str_replace("%C5%84","ń",$wyr);

			$wyr = str_replace("%C5%82","ł",$wyr);
			$wyr = str_replace("%C3%B3","ó",$wyr);
			$wyr = str_replace("%C4%99","ę",$wyr);
			$wyr = str_replace("%C5%9B","ś",$wyr);
			return $wyr;
		}
}