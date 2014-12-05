<?php
class legal_mention extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        $this->load->model('user', '', TRUE);
    }

    function index() {

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $result = $this->user->user_data($data['id']);
            $data['name'] = $result['name'];
            $data['firstname'] = $result['firstname'];
            $data['pseudo'] = $result['pseudo'];
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }

        // définition des données variables du template
        $data['title'] = 'Open-Note - Accueil';
        $data['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on charge la view qui contient le corps de la page
        $data['contents'] = 'legal_mention_view';

        $data['sidebar'] = 'normal';

        // on charge la page dans le template
        $this->load->view('templates/template', $data);
    }
}