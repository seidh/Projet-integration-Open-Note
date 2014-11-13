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
            $this->load->helper('form','url');
            
            $this->load->model('user','',TRUE);
        }
	function index()
	{
		if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $result = $this->user->user_data($session_data['id']);
                    $this->load->view('payment_view', $result);
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
	}
 }


