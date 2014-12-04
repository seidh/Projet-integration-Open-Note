<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class message extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
        
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
        $data['title'] = 'Open-Note - Conversation';
        $data['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on charge la view qui contient le corps de la page
        $data['contents'] = 'creation_message_view';

        $data['sidebar'] = 'message';
        // on charge la page dans le template
        $data['liste_user'] = $this->conversation_model->get_all_user();
        $this->load->view('templates/template', $data);
        
    }
    function send()
    {
        $this->form_validation->set_rules('editor1', 'message', 'trim|required');

        $session_data = $this->session->userdata('logged_in');
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli
            /*
            $result = $this->user->user_data($session_data['id']);

            $result['title'] = 'Open-Note - Conversation';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'message_view';
            // On choisit la sidebar
            $result['sidebar'] = 'sidebarMessage';
            $result['conf_id'] = $this->input->post('conf_id');
            // on charge la page dans le template
            $result['liste_messages'] = $this->conversation_model->get_all_message_from_conversation($this->input->post('conf_id'));
            $result['conf_id'] = $this->input->post('conf_id');
            $this->load->view('templates/template', $result);
             * */
             redirect('message/voir?id='.$this->input->post('conf_id'), 'refresh');
        } else {
            //form bien rempli
            $sql = "INSERT INTO messages (user_id, conversation_id, message,date_creation) VALUES (" . $session_data['id'] . ", " . $this->input->post('conf_id') . " ,'" . $this->input->post('editor1') . "', now());";
            $this->db->query($sql);
            redirect('message/voir?id='.$this->input->post('conf_id'), 'refresh');
        }
    }
    function voir()
    {
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
        $data['title'] = 'Open-Note - voir la conversation';
        $data['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on charge la view qui contient le corps de la page
        $data['contents'] = 'message_view';

        $data['sidebar'] = 'message';
        
        if($this->input->get('id') != '' && is_numeric($this->input->get('id')))
        {
            $data['liste_messages'] = $this->conversation_model->get_all_message_from_conversation(mysql_real_escape_string($this->input->get('id')));
            $data['conf_id'] = mysql_real_escape_string($this->input->get('id'));
            $data['affichage_name'] = $this->conversation_model->get_name_friend(mysql_real_escape_string($this->input->get('id')));
        }
        else
        {
            redirect('accueil','refresh');
        }
        // on charge la page dans le template
        
        $this->load->view('templates/template', $data);
    }
    function ajout_conversation()
    {
        $this->form_validation->set_rules('editor1', 'message', 'trim|required');

        $session_data = $this->session->userdata('logged_in');
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli

            $result = $this->user->user_data($session_data['id']);

            $result['title'] = 'Open-Note - Création de la conversation';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'creation_message_view';
            // On choisit la sidebar
            $result['sidebar'] = 'sidebarMessage';
 
            $this->load->view('templates/template', $result);
        } else {
            //form bien rempli
            $sql = "INSERT INTO conversation (user_id, friend_id, date_creation) VALUES (" . $session_data['id'] . ", " . $this->input->post('friend_id') . " , now());";
            $this->db->query($sql);
            
            $last = $this->conversation_model->get_last_conf();
            $sql = "INSERT INTO messages (user_id, conversation_id, message, date_creation) VALUES (" . $session_data['id'] . ", " . $last[0]['id'] . " ,'" . $this->input->post('editor1') . "', now());";
            $this->db->query($sql);
            redirect('message/voir?id='.$last[0]['id'], 'refresh');
        }
    }
}

