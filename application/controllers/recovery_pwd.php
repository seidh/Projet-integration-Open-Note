<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class recovery_pwd extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
   $this->load->helper(array('form'));
   $this->load->view('recovery_pwd_view');
 }
 function sendMail()
 {
    $this->load->library('email');

    $this->email->from('recovery@open-note.ddns.net', 'Admin');
    $this->email->to($this->input->post('email'));

    $this->email->subject('Récupération de votre mot de passe');
    $this->email->message('Testing the email class');	

    $this->email->send();

    echo $this->email->print_debugger();
 }
 
}
 
?>

