<?php

class News extends CI_Controller
{
	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$data = array();
		$data['pseudo'] = 'Arthur';
		$data['email'] = 'email@ndd.fr';
		$data['en_ligne'] = true;
		
		//	Maintenant, les variables sont disponibles dans la vue
		$this->load->view('vue', $data);
	}
}