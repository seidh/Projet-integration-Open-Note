<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class VerifyLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
function index()
{
    //This method will have the credentials validation
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>'); 
    
 
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 
    if($this->form_validation->run() == FALSE)
    {
        //Field validation failed.  User redirected to login page
        $data['message'] = '';
        $this->load->view('login_view',$data);
    }
    else
    {
        //Go to private area
        $this->checkKey();
        redirect('accueil', 'refresh');
    }
 
}
 /**
  * Cette fonction reçoit en paramètre le mot de passe et en POST le login pour la connection. 
  * Elle renvoie vrai si les champs ont bien été complété par l'utilisateur sinon elle renvoie faux.
  * @param type $password
  * @return boolean
  */
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
 
   //query the database
   $result = $this->user->login($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->email
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Mauvais adresse mail ou mot de passe !');
     return false;
   }
 }
 /**
  * Cette fonction permet de supprimer une clé de récupération de mot de passe.
  * Si l'utilisateur avait lancer une récupération de mot de passe mais qu'il arrive bien à se connecter par la suite
  */
 function checkKey()
 {
    $session_data = $this->session->userdata('logged_in');
    $data['id'] = $session_data['id'];                 
    $result = $this->user->user_data($data['id']);
    $this -> db -> select('id, cle');
    $this -> db -> from('activation');
    $this -> db -> where('id', $result['id']);
    $this -> db -> limit(1);
 
    $query = $this -> db -> get();
    if($query -> num_rows() == 1)
    {
        $query2 = $this->db->query("DELETE FROM activation WHERE id = '".$result['id']."';");
    }
 }
}
?>

