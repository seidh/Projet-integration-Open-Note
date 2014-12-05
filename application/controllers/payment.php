<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class payment extends CI_Controller
{
        function __construct()
        {
            parent::__construct();
            if ($this->session->userdata('logged_in')) {
            
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
            $this->load->helper('form','url');
            
            $this->load->model('user','',TRUE);
        }
	function index()
	{
		if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $result = $this->user->user_data($session_data['id']);
                    // définition des données variables du template
                    $result['title'] = 'Open-Note - Offres';
                    $result['description'] = 'La description de la page pour les moteurs de recherche';
                    $result['keywords'] = 'les, mots, clés, de, la, page';
                    // TEST Affichage date
                    setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

                    $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                    // on charge la view qui contient le corps de la page
                    $result['contents'] = 'payment_view';

                    $result['sidebar'] = 'admin';

                    // on charge la page dans le template
                    $this->load->view('templates/template', $result);   
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
                

             
	}
 }


