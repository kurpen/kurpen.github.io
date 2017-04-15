<?php
class Pages extends CI_Controller {
	
	protected $the_user;
	
		public function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url', 'html'));
			$this->load->library(array('ion_auth','session','form_validation'));
			$this->load->database();
			$this->load->model(array('user_model', 'lokale_model', 'rezerwacja_model'));
		}

        public function view($page = 'home')
		{
			if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
			{
					// Whoops, we don't have a page for that!
					show_404();
			}
			if($page = 'home'){
				$data['miasta'] = $this->lokale_model->get_miasta();
			}else{
				$data['view'] = $page;
			}
			$data['title'] = ucfirst($page); // Capitalize the first letter
			$the_user = $this->ion_auth->user()->row();
			$data['user'] = $the_user;
			//$data['rezerwacje'] = $this->rezerwacja_model->get_rezerwacje();
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}
		
		function logout()
		{
		 // destroy session
			$data = array('login' => '', 'uname' => '', 'uid' => '');
			$this->session->unset_userdata($data);
			$this->session->sess_destroy();
			redirect('home/index');
		 }
		
}