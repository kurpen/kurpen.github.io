<?php
class profile extends CI_Controller
{
	protected $the_user;
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','html','language'));
        $this->load->library('session');
        $this->load->database();
        $this->load->model(array('user_model','lokale_model','rezerwacja_model','ion_auth_model'));
    }

    function index()
    {
	// Load helpers//
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['miasta'] = $this->lokale_model->get_miasta();
		$the_user = $this->ion_auth->user()->row();
		$data['user'] = $this->ion_auth->user()->row();
		$data['lokal'] = $this->lokale_model->get_lokal_id($data['user']->restaurant_id);
		$data['miasto'] = $this->lokale_model->get_miasto($data['lokal']['miasto_id']);
		$data['godziny'] = $this->lokale_model->get_godziny($data['lokal']['id']);
		if($this->ion_auth->logged_in() && ($this->ion_auth->get_users_groups($the_user->id)->row()->name == 'restauracja')){
			$this->load->view('templates/header-lokal', $data);
			$this->load->view('/pages/lokal_view', $data);
			$this->load->view('templates/footer');
		}else if($this->ion_auth->logged_in() && ($this->ion_auth->get_users_groups($the_user->id)->row()->name == 'klient')){
			// Initiate
			if ($this->form_validation->run() === FALSE)
			{
				$this->form_validation->set_rules('first_name', 'Imię', 'required');
				$this->form_validation->set_rules('last_name', 'Nazwisko', 'required');
			
				$this->load->view('templates/header', $data);
				$this->load->view('/auth/edit_user', $data);
				$this->load->view('templates/footer');
			}else{
				//$this->ion_auth_model->update($data['user']->id, $data['user']);
				redirect('/lokale');
				
			}
		}else if($this->ion_auth->is_admin()){
			$this->load->view('templates/header', $data);
			$this->load->view('/pages/profile_view', $data);
			$this->load->view('templates/footer');
		} else{
			redirect('/auth/login');
		}
		//$this->load->view('templates/header', $data);
		//$this->load->view('/pages/profile_view', $data);
		//$this->load->view('templates/footer');
    }
	public function rezerwacje(){
		$data['miasta'] = $this->lokale_model->get_miasta();
		$the_user = $this->ion_auth->user()->row();
		$data['user'] = $this->ion_auth->user()->row();
		$data['rezerwacje'] = $this->rezerwacja_model->get_rezerwacje();
		$data['lokale'] = $this->lokale_model->get_lokale();
		$data['lokal'] = $this->lokale_model->get_lokal_id($the_user->restaurant_id);
		$data['miasto'] = $this->lokale_model->get_miasto($data['lokal']['miasto_id']);
		
		
		$data['title'] = "Rezerwacje";
		
		if($this->ion_auth->get_users_groups($the_user->id)->row()->name == 'restauracja'){
			$data['rezerwacje'] = $this->rezerwacja_model->get_rezerwacje_restauracja($the_user->restaurant_id);
			$this->load->view('templates/header-lokal', $data);
			$this->load->view('/pages/rezerwacje_rest_view', $data);
			$this->load->view('templates/footer');
		}else if($this->ion_auth->get_users_groups($the_user->id)->row()->name == 'klient'){
			$data['rezerwacje'] = $this->rezerwacja_model->get_rezerwacje_klient($data['user']->id);
			$this->load->view('templates/header', $data);
			$this->load->view('/pages/rezerwacje_klient_view', $data);
			$this->load->view('templates/footer');
		} else if($this->ion_auth->is_admin()){
			$data['rezerwacje'] = $this->rezerwacja_model->get_rezerwacje();
			$this->load->view('templates/header', $data);
			$this->load->view('/pages/rezerwacje_rest_view', $data);
			$this->load->view('templates/footer');
		}
	}
}
?>