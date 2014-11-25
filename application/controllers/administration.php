<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class administration extends CI_Controller
{   
    public $data = array();
    
        function __construct()
        {
            parent::__construct();
            $this->load->model('administration_model','',TRUE);
            $this->load->model('user','',TRUE);
            
            $this->load->helper('form','url');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
            
            if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $this->data['id'] = $session_data['id'];                 
                $result = $this->user->user_data($this->data['id']);
                $this->data['name'] = $result['name'];
                $this->data['firstname'] = $result['firstname'];
                $this->data['pseudo'] = $result['pseudo'];

                //affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                $this->data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");
                
                // On choisit la sidebar
                $this->data['sidebar'] = 'admin';

            }
            else
            {
                //If no session, redirect to login page
                redirect('login', 'refresh');
            }
            
        }
	function index()
	{
            // définition des données variables du template
            $this->data['title'] = 'Open-Note - Administrationl';
            $this->data['description'] = 'La description de la page pour les moteurs de recherche';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_view';

            // on charge la page dans le template
            $this->load->view('templates/template', $this->data);
        }


        function userList()
        {
            // définition des données variables du template
            $this->data['title'] = 'Open-Note - Liste des utilisateurs';
            $this->data['description'] = 'Page d\'administation - affichage des utilisateurs de la plateforme';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            //get userlist from model
            $this->data['user_data'] = $this->administration_model->get_all_user();

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_userList_view';

            // on charge la page dans le template
            $this->load->view('templates/template', $this->data);
        }
        
        function newUserForm()
        {
                // définition des données variables du template
                $this->data['title'] = 'Open-Note - Ajout d\'utilisateur';
                $this->data['description'] = 'Page d\'ajout manuel d\'utilisateur';
                $this->data['keywords'] = 'les, mots, clés, de, la, page';

                // on choisit la view qui contient le corps de la page
                $this->data['contents'] = 'admin_addUser_view';
                
                // on charge la page dans le template
                $this->load->view('templates/template', $this->data); 
        }
        
        function adduser()
        {
//                                    <div class="form-group row">
//                            <div class="col-lg-3 text-right top5">
//                                <label>Groupe :</label>
//                            </div>
//                            <div class="col-lg-5">
//                                <input id="group" name="group" class="form-control" />
//                            </div>                                     
//                        </div>   
//                        <div class="form-group row">
//                            <div class="col-lg-3 text-right top5">
//                                <label>Date de naissance :</label>
//                            </div>
//                            <div class="col-lg-1">
//                                <input id="dayBirth" name="dayBirth" class="form-control" />
//                            </div>
//                            <div class="col-lg-1">
//                                <input id="monthBirth" name="monthBirth" class="form-control" /> 
//                            </div> 
//                            <div class="col-lg-2">
//                                <input id="yearBirth" name="yearBirth" class="form-control" />
//                            </div>    
            
            
            //TODO : use user existance check from model (maybe not implemented yet)
            
            $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('firstname', 'Prénom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sexe','Sexe', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('groupe', 'Groupe', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dayBirth', 'Jour de naissance', 'trim|required|xss_clean');
            $this->form_validation->set_rules('monthBirth', 'Mois de naissance', 'trim|required|xss_clean');
            $this->form_validation->set_rules('yearBirth', 'Année de naissance', 'trim|required|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                //erreur dans le formulaire
                redirect('newUserForm', 'refresh');
            }
            else
            {
                //build default user password by concat name and firstname (tolowercase)
                $user_default_pwd = strtolower($this->input->post('name') . $this->input->post('firstname'));
                
                //build user data array to inject into database
                $user_data = array('name' => $this->input->post('name'),
                        'firstname' => $this->input->post('firstname'),
                        'pwd' => sha1($user_default_pwd),
                        'birthday' => $this->input->post('yearBirth').'-'.$this->input->post('monthBirth').'-'.$this->input->post('dayBirth'),
                        'groupe' => $this->input->post('groupe'),
                        'sexe' => $this->input->post('sexe'),
                        'pseudo' => $this->input->post('name').$this->input->post('firstname'),
                        'avatar' => null);
                
                print_r($user_data);
            }
        }
	/*function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('accueil', 'refresh');
        }*/
        
        function moderatorsList()
        {
            $this->data['title'] = 'Open-Note - Liste des modérateurs';
            $this->data['description'] = 'Page d\'attribution de modérateurs';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_modoList_view'; //TODO : sync with Olivier view
            
            $this->data['moderators_data'] = $this->administation_model->get_all_moderators();
            
            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        function addModoForm()
        {
            //TODO controller form side
        }

        
        function notesList()
        {
            $this->data['title'] = 'Open-Note - Liste des notes';
            $this->data['description'] = 'Page listant toutes les notes de la plateforme';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_notesList_view'; //TODO : sync with Olivier view
            
            $this->data['notes_data'] = $this->administration_model->get_all_notes();

            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        function addCat()
        {
            //TODO cat adding form validation
            
            $this->administration_model->create_category();
        }
        
        
        function categoriesList()
        {
            $this->data['title'] = 'Open-Note - Liste des catégories de notes';
            $this->data['description'] = 'Page listant toutes les catégories de la plateforme';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            $this->data['caterories_data'] = $this->administration_model->get_all_categories();
            
            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_categoriesList_view'; //TODO : sync with Olivier view

            $this->data['cat_datas'] = $this->administration_model->get_all_category();
            
            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        function addCatForm()
        {
            //TODO add form in controller side
        }
 }