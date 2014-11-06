<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class profil extends CI_Controller
{
        function __construct()
        {
            parent::__construct();
            $this->load->helper('form','url');
            $this->load->library('form_validation');
            
            $this->load->model('user','',TRUE);
        }
	function index()
	{
		if($this->session->userdata('logged_in'))
                {
                    $session_data = $this->session->userdata('logged_in');
                    $result = $this->user->user_data($session_data['id']);
                    $this->load->view('profil_view', $result);
                }
                else
                {
                    //If no session, redirect to login page
                    redirect('login', 'refresh');
                }
	}
        function edit()
        {   
            $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('firstname', 'Prénom', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Adresse mail', 'trim|required|xss_clean|callback_check_email');
            
            
            $session_data = $this->session->userdata('logged_in');
            if ($this->form_validation->run() == FALSE)
            {
                //form mal rempli
                
                $result = $this->user->user_data($session_data['username']);
                sleep(1);
		$this->load->view('profil_view',$result);
            }
            else
            {
                //form bien rempli
                $data = array('name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'firstname' => $this->input->post('firstname'));

                $where = "id = ".$session_data['id']; 

                $str = $this->db->update_string('user', $data, $where);
                $this->db->query($str);
                
                $sess_array = array(
                    'id' => $session_data['id'],
                    'username' => $this->input->post('email'));
                
                $this->session->set_userdata('logged_in', $sess_array);
                
		redirect('profil', 'refresh');
            }
        }
        function check_email($email)
        {
            $this -> db -> select('id, email, pwd');
            $this -> db -> from('user');
            $this -> db -> where('email', $email);
            $this -> db -> limit(1);
 
            $query = $this -> db -> get();
            $session_data = $this->session->userdata('logged_in');
            if($query -> num_rows() == 0 || $email == $session_data['username'])
            {
                return true;
            }
            else
            {
                $this->form_validation->set_message('check_email', 'Adresse mail déja utilisée');
                return false;
            }
        }
        
        function do_upload($field = 'userfile')
        {
            $session_data = $this->session->userdata('logged_in');
            $result = $this->user->user_data($session_data['id']);
            
            $config['upload_path'] = './assets/image';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '1000';
            $config['max_width']  = '1500';
            $config['max_height']  = '1500';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $result['id'];
            

            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload())
            {
               
                $result['error'] = $this->upload->display_errors();
		$this->load->view('profil_view', $result);
            }
            else
            {
                $image_data = $this->upload->data();
                $data = array('avatar' => $image_data['file_name']);

                $where = "id = ".$session_data['id']; 

                $str = $this->db->update_string('user', $data, $where);
                $this->db->query($str);
		redirect('profil', 'refresh');
            }
        }
 }

