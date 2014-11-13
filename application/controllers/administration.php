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
        }
	function index()
	{
		$this->load->view('admin_view');
	}
        
        function userList()
        {
                $data['user_data'] = $this->administration_model->get_all_user();
                $this->load->view('admin_userList_view', $data);
        }
	/*function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('accueil', 'refresh');
        }*/
 }