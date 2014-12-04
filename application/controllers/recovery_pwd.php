<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class recovery_pwd extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
    }

    function index() {
        $this->load->helper(array('form'));
        $this->load->view('recovery_pwd_view');
    }
    /**
     * Cette fonction permet d'envoie un mail avec un HASH en md5 pour la récupération de mot de passe
     */
    function sendMail() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Adresse mail', 'trim|required|xss_clean|callback_check_email');

        if ($this->form_validation->run() == FALSE) {
            //email inexistant
            $this->load->view('recovery_pwd_view');
        } else {
            $this->load->library('email');

            $this->email->from('recovery@open-note.ddns.net', 'Admin');
            $this->email->to($this->input->post('email'));

            $this->email->subject('Récupération de votre mot de passe');
            $cle = md5($this->input->post('email') . 'lovemonprojet');
            $this->email->message('<html><body>'
                    . 'Bonjour, <br />'
                    . ' Veuillez cliquer sur ce lien pour continuer la procédure de récupération de mot de passe <br />'
                    . '<br />'
                    . 'https://open-note.ddns.net/recovery_pwd/change_pwd?cle=' . $cle
                    . '<br /><br />'
                    . 'Votre équipe d\'adminstration du site internet Open-Note.<br />'
                    . '</body></html>');


            $this->email->send();

            $query = $this->db->query("SELECT id FROM user WHERE email = '" . $this->input->post('email') . "' LIMIT 1");

            $row = $query->row();



            $sql = "INSERT INTO activation (id, cle) 
        VALUES (" . $this->db->escape($row->id) . ", " . $this->db->escape($cle) . ")";

            $this->db->query($sql);
            $data['message'] = '<div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Un mail de récupération de mot de passe vous a été envoyé.
                            </div>';
            $this->load->view('login_view', $data);
        }
    }
    /**
     * Cette fonction reçoit en paamètre un email et renvoie vrai si l'email existe en base de donnée et inversément.
     * @param type $email
     * @return boolean
     */
    function check_email($email) {
        $this->db->select('id, email, pwd');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();
        $row = $query->row();
        if ($query->num_rows() == 1) {
            $this->db->select('id, cle');
            $this->db->from('activation');
            $this->db->where('id', $row->id);
            $this->db->limit(1);

            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                $this->form_validation->set_message('check_email', 'Vous êtes déjà en récupération de mot de passe, pensez à vérifier vos mails');
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('check_email', 'Adresse mail inexistante');
            return false;
        }
    }
    /**
     * Permet d'afficher la page pour la récupération de mail
     */
    function change_pwd() {
        $this->load->view('change_pwd_view');
    }
    /**
     * Cette fonction permet de faire la récupération du mot de passe
     */
    function recovery() {
        $this->form_validation->set_rules('cle', 'Clé de récupération', 'trim|required|xss_clean|callback_check_cle');
        $this->form_validation->set_rules('pwd1', 'Password', 'trim|required|matches[pwd2]');
        $this->form_validation->set_rules('pwd2', 'Password Confirmation', 'trim|required');


        $data['cle'] = $this->input->post('cle');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('change_pwd_view', $data);
        } else {

            $query = $this->db->query("SELECT id FROM activation WHERE cle = '" . $this->input->post('cle') . "';");
            $row = $query->row();
            
            $userdata = $this->user->user_data($row->id);
            $pwdcrypted = hash("sha512", $this->input->post('pwd1') . $userdata['username']);
            //$str = $this->db->query("UPDATE user SET pwd = '".$this->input->post('pwd1')."' WHERE id = ".$row->id.";");
            $data = array('pwd' => $pwdcrypted);
            $where = "id = " . $row->id;

            $str = $this->db->update_string('user', $data, $where);
            $this->db->query($str);


            $query2 = $this->db->query("DELETE FROM activation WHERE id = '" . $row->id . "';");

            $data['message'] = '<div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Votre nouveau mot de passe est opérationnel, vous pouvez dès à présent vous connecter en utilisant celui-ci.
                            </div>';
            $this->load->view('login_view', $data);
        }
    }
    /**
     * Cette fonction reçoit en paramètre la clé qui a été envoyé via le mail et retourne vrai 
     * si la clé existe dans la base de donnée et inversément
     * @param type $cle
     * @return boolean
     */
    function check_cle($cle) {
        $this->db->select('id, cle');
        $this->db->from('activation');
        $this->db->where('cle', $cle);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->form_validation->set_message('check_cle', 'Clé de récupération de mot de passe inexistante');
            return false;
        }
    }

}
?>

