<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class administration extends CI_Controller
{
        function __construct()
        {
            parent::__construct();
            $this->load->model('administration_model','',TRUE);
            $this->load->model('user','',TRUE);
        }
	function index()
	{
                if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['id'] = $session_data['id'];                 
                    $result = $this->user->user_data($data['id']);
                    $data['name'] = $result['name'];
                    $data['firstname'] = $result['firstname'];
                    $data['pseudo'] = $result['pseudo'];
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
                
                // définition des données variables du template
                $data['title'] = 'Open-Note - Acceuil';
                $data['description'] = 'La description de la page pour les moteurs de recherche';
                $data['keywords'] = 'les, mots, clés, de, la, page';
                // TEST Affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                
                $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                // on choisit la view qui contient le corps de la page
                $data['contents'] = 'admin_view';
                // On choisit la sidebar
                $data['sidebar'] = 'admin';

                // on charge la page dans le template
                $this->load->view('templates/template', $data);   
        }
        
        function userList()
        {
                $data['user_data'] = $this->administration_model->get_all_user();
                if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['id'] = $session_data['id'];                 
                    $result = $this->user->user_data($data['id']);
                    $data['name'] = $result['name'];
                    $data['firstname'] = $result['firstname'];
                    $data['pseudo'] = $result['pseudo'];
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
                
                // définition des données variables du template
                $data['title'] = 'Open-Note - Liste utilisateurs';
                $data['description'] = 'La description de la page pour les moteurs de recherche';
                $data['keywords'] = 'les, mots, clés, de, la, page';
                // TEST Affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                
                $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                // on choisit la view qui contient le corps de la page
                $data['contents'] = 'admin_userList_view';
                // On choisit la sidebar
                $data['sidebar'] = 'admin';

                // on charge la page dans le template
                $this->load->view('templates/template', $data);                
        }
        
        function newUserForm()
        {
                if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['id'] = $session_data['id'];                 
                    $result = $this->user->user_data($data['id']);
                    $data['name'] = $result['name'];
                    $data['firstname'] = $result['firstname'];
                    $data['pseudo'] = $result['pseudo'];
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
                
                // définition des données variables du template
                $data['title'] = 'Open-Note - Liste utilisateurs';
                $data['description'] = 'La description de la page pour les moteurs de recherche';
                $data['keywords'] = 'les, mots, clés, de, la, page';
                // TEST Affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                
                $data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                // on choisit la view qui contient le corps de la page
                $data['contents'] = 'admin_addUser_view';
                // On choisit la sidebar
                $data['sidebar'] = 'admin';

                // on charge la page dans le template
                $this->load->view('templates/template', $data); 
        }
        
        function adduser()
        {
            $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
        }
	/*function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('accueil', 'refresh');
        }*/
 }