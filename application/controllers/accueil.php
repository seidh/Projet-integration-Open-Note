<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class accueil extends CI_Controller
{
        function __construct()
        {
            parent::__construct();
        }
	function index()
	{
		if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $data['username'] = $session_data['username'];
                    $this->load->view('accueil', $data);
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
	}

	function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('accueil', 'refresh');
        }
 }
