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
            $this->form_validation->set_rules('newName', 'Nom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('newFirstname', 'Prénom', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('sexe','Sexe', 'trim|required|xss_clean');
            $this->form_validation->set_rules('newEmail', 'Email', 'trim|required|xss_clean|callback_check_email');
            $this->form_validation->set_rules('newGroup', 'Groupe', 'trim|required|xss_clean');
            $this->form_validation->set_rules('newPseudo', 'Pseudo', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('dayBirth', 'Jour de naissance', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('monthBirth', 'Mois de naissance', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('yearBirth', 'Année de naissance', 'trim|required|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                //erreur dans le formulaire

                redirect('administration/userList', 'refresh');
                
            }
            else
            {
                //build default user password by concat name and firstname (tolowercase)
                $user_default_pwd = strtolower($this->input->post('newName') . $this->input->post('newFirstname'));
                
                //build user data array to inject into database
                $user_data = array('name' => $this->input->post('newName'),
                        'firstname' => $this->input->post('newFirstname'),
                        'pwd' => sha1($user_default_pwd),
                        'email' => $this->input->post('newEmail'),
                        //'birthday' => $this->input->post('yearBirth').'-'.$this->input->post('monthBirth').'-'.$this->input->post('dayBirth'),
                        'birthday' => null,
                        'groupe' => $this->input->post('newGroup'),
                        //'sexe' => $this->input->post('sexe'),
                        'sexe' => null,
                        'pseudo' => $this->input->post('newPseudo'),
                        'avatar' => null);
                
                //print_r($user_data);//debug instruction
                
                //check if unique fields aren't used yet
                if($this->administration_model->is_user_exist($user_data['email']))
                {
                    //user already exist so put error message
                }
                //else add user inside database
                $this->administration_model->create_user($user_data);
                redirect("administration/userList","refresh");
            }
        }
        
        function modify_user($id){
            
            $this->form_validation->set_rules('editName', 'Nom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('editFirstname', 'Prénom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('editEmail', 'Email', 'trim|required|xss_clean|callback_check_email');
            $this->form_validation->set_rules('editGroup', 'Groupe', 'trim|required|xss_clean');
            $this->form_validation->set_rules('editPseudo', 'Pseudo', 'trim|required|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                //erreur dans le formulaire
                echo'Debug';
                //redirect('administration/userList', 'refresh');
                
            }
            else
            {
//                echo $this->input->post('editFirstname'); 
//                echo $this->input->post('editName'); 
//                echo $this->input->post('editPseudo'); 
//                echo $this->input->post('editEmail'); 
//                echo $this->input->post('editGroup'); 
                
                //build user data array to inject into database
                $user_data = array('name' => $this->input->post('editName'),
                        'firstname' => $this->input->post('editFirstname'),                        
                        'email' => $this->input->post('editEmail'),
                        'groupe' => $this->input->post('editGroup'),
                        'pseudo' => $this->input->post('editPseudo'));
                
                //print_r($user_data);//debug instruction
                
                //check if unique fields aren't used yet
                if($this->administration_model->is_user_exist($user_data['email']))
                {
                    //user already exist so put error message
                    echo'Error';
                }
                //else add user inside database
                $this->administration_model->modify_user($user_data, "id = $id");
                redirect("administration/userList","refresh");
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
            $this->data['contents'] = 'admin_moderator_list'; //TODO : sync with Olivier view
            
            $this->data['users_data'] = $this->administration_model->get_all_user();
            $this->data['moderators_data'] = $this->administration_model->get_all_moderator();
            $this->data['category_data'] = $this->administration_model->get_all_category();
            
            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        function addModoForm()
        {
            
            $this->form_validation->set_rules('user', 'Utilisateur', 'trim|required|xss_clean');
            $this->form_validation->set_rules('category', 'Catégorie', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirm', 'Pseudo', 'trim|required|xss_clean');
            
            if(($this->form_validation->run() == FALSE) OR ($this->input->post('confirm') == FALSE))
            {
                //erreur dans le formulaire
                echo'DEBUG';
                sleep(5);
                //redirect('administration/userList', 'refresh');
                
            }
            else
            {
                //build modo-cat data array to inject into database
                $assignation = array('userid' => (int)$this->input->post('user'),
                        'catid' => (int)$this->input->post('category'));
                
                //print_r($assignation);//debug instruction
                
                //check if unique fields aren't used yet
                if($this->administration_model->is_moderator_of($assignation['userid'],$assignation['catid']))
                {
                    echo"ERREUR";//user already exist so put error message
                    sleep(5);
                } else {
                    echo var_dump($assignation);
                    $this->administration_model->attribute_moderator($assignation['userid'],$assignation['catid']);
                    echo "SUCCES";
                    
                    redirect("administration/moderatorsList","refresh");
                    
                }                
            }
        }
        
        // INUTILE
        function assignModoForm()
        {
            //TODO controller form side
            // définition des données variables du template
            $this->data['title'] = 'Open-Note - Attribution de modérateur';
            $this->data['description'] = 'Page d\'attribution manuel de modérateur';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_addModo_view';

            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
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
            $this->form_validation->set_rules('cat_name', 'Nom', 'trim|required|xss-clean');
            $this->form_validation->set_rules('parent_id', 'Categories parentes', 'trim|required|xss-clean');
            
            $this->administration_model->create_category();
        }
        
        
        function categoriesList()
        {
            $this->data['title'] = 'Open-Note - Liste des catégories de notes';
            $this->data['description'] = 'Page listant toutes les catégories de la plateforme';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';
            
            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_cat_list'; //TODO : sync with Olivier view
            
            $this->data['cat_moderators'] = $this->administration_model->get_all_moderator();
            $this->data['cat_datas'] = $this->administration_model->get_all_category();
            
            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        function addCatForm()
        {
            //TODO add form in controller side
            
            // définition des données variables du template
            $this->data['title'] = 'Open-Note - Ajout d\'une catégorie';
            $this->data['description'] = 'Page d\'ajout manuel d\'une catégorie';
            $this->data['keywords'] = 'les, mots, clés, de, la, page';

            // on choisit la view qui contient le corps de la page
            $this->data['contents'] = 'admin_addCat_view';

            // on charge la page dans le template
            $this->load->view('templates/template', $this->data); 
        }
        
        /**
         *  Function of moderation
         * input : id of the category which is moderated
         * 
         */
        function moderation($catId)
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->administration_model->is_moderator_of($session_data['id'], $catId) or $this->user->is_admin($session_data['id'])){
                $this->data['title'] = 'Open-Note - Modifier une catégorie';
                $this->data['description'] = 'Page permettant la modification d\'une catégorie';
                $this->data['keywords'] = 'les, mots, clés, de, la, page';

                // on choisit la view qui contient le corps de la page
                $this->data['contents'] = 'admin_category_view'; //TODO : sync with Olivier view

                $this->data['cat_moderators'] = $this->administration_model->get_all_moderator();
                $this->data['cat_data'] = $this->administration_model->get_category($catId);
                $this->data['notes_data'] = $this->administration_model->get_all_notes_from($catId);
                $this->data['users_data'] = $this->administration_model->get_users_of_cat($catId);
                $this->data['isAdmin'] = $this->user->is_admin($session_data['id']);
                $this->data['allusers'] = $this->administration_model->get_all_user();
                // on charge la page dans le template
                $this->load->view('templates/template', $this->data); 
            } else {
                redirect('accueil', 'refresh');
            }
        }
 }