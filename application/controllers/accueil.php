<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class accueil extends CI_Controller {

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
        $data['contents'] = 'accueil';

        $data['sidebar'] = 'normal';
        
        $data['my_note'] = $this->category_model->get_my_note($session_data['id']);

        // on charge la page dans le template
        $this->load->view('templates/template', $data);
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('accueil', 'refresh');
    }

    function category() {
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);

        $result['title'] = 'Open-Note - catégorie';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'category_view';
        // On choisit la sidebar
        $result['sidebar'] = 'accueil';

        $category = $this->category_model->get_cat($this->input->get('id'));
        foreach ($category as $cat) {
            $result['cat_name'] = $cat['name'];
            $result['cat_id'] = $cat['id'];
            $result['cat_parent_id'] = $cat['parent_id'];
        }
        $note_cat = $this->category_model->get_note_cat($result['cat_id']);
        $result['notes'] = $note_cat;

        // on charge la page dans le template
        $this->load->view('templates/template', $result);
    }

}
