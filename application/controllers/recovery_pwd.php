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
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Adresse mail', 'trim|required|xss_clean|callback_check_email');
    
    if ($this->form_validation->run() == FALSE)
    {
        //email inexistant
        $this->load->view('recovery_pwd_view');
    }
    else
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
 
    function check_email($email)
    {
        $this -> db -> select('id, email, pwd');
        $this -> db -> from('user');
        $this -> db -> where('email', $email);
        $this -> db -> limit(1);
 
        $query = $this -> db -> get();
        if($query -> num_rows() == 1)
        {
                return true;
        }
        else
        {
            $this->form_validation->set_message('check_email', 'Adresse mail inexistante');
            return false;
        }
    }
 
}
 
?>

