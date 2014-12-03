<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class profil extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');
        $this->load->model('user', '', TRUE);
    }

    function index() {
        
        if ($this->session->userdata('logged_in')) {
            if($this->input->get('id') == '')
            {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $result = $this->user->user_data($data['id']);
            }
            else
            {
                if(!is_numeric($this->input->get('id')))
                {
                    redirect('accueil','refresh');
                }
                $result = $this->user->user_data(mysql_real_escape_string($this->input->get('id')));
            }
            
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }

        // définition des données variables du template
        $result['title'] = 'Open-Note - Profil';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'profil_view';
        // On choisit la sidebar
        $result['sidebar'] = 'profil';

        // on charge la page dans le template
        $this->load->view('templates/template', $result);
    }

    function edit() {
        $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('firstname', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Adresse mail', 'trim|required|xss_clean|callback_check_email');

        $this->form_validation->set_rules('old_pwd', 'Ancien mot de passe', 'trim|xss_clean|callback_change_password[new_pwd_1.new_pwd_2]');
        $this->form_validation->set_rules('new_pwd_1', 'Nouveau mot de passe', 'trim|xss_clean');
        $this->form_validation->set_rules('new_pwd_2', 'Retapper votre nouveau mot de passe', 'trim|xss_clean');



        $session_data = $this->session->userdata('logged_in');
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli

            $result = $this->user->user_data($session_data['id']);

            $result['title'] = 'Open-Note - Profil';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'profil_view';
            // On choisit la sidebar
            $result['sidebar'] = 'profil';

            // on charge la page dans le template
            $this->load->view('templates/template', $result);
        } else {
            //form bien rempli
            $data = array('name' => $this->input->post('name'), 'email' => $this->input->post('email'), 'firstname' => $this->input->post('firstname'));

            $where = "id = " . $session_data['id'];

            $str = $this->db->update_string('user', $data, $where);
            $this->db->query($str);

            $sess_array = array(
                'id' => $session_data['id'],
                'username' => $this->input->post('email'));

            $this->session->set_userdata('logged_in', $sess_array);

            redirect('profil', 'refresh');
        }
    }

    public function change_password($str, $params) {
        //Fonction permettant de verifier le mot de passe courant.
        if ($str != '') {
            list($param1, $param2) = explode('.', $params, 2);
            //Le mot de passe courant est correct
            $old_pwd_crypt = SHA1($str);
            $session_data = $this->session->userdata('logged_in');
            $result = $this->user->user_data($session_data['id']);

            $this->db->select('id, email, pwd');
            $this->db->from('user');
            $this->db->where('pwd', $old_pwd_crypt);
            $this->db->where('id', $result['id']);
            $this->db->limit(1);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                //Le nouveau mot de passe est renseigne
                if ($this->input->post($param1) != '') {
                    //Le nouveau password est coherent
                    if ($this->input->post($param1) == $this->input->post($param2)) {
                        $new_pwd_crypt = SHA1($this->input->post($param1));
                        $data = array('pwd' => $new_pwd_crypt);
                        $where = "id = " . $result['id'];

                        $str = $this->db->update_string('user', $data, $where);
                        $this->db->query($str);

                        return TRUE;
                    } else {
                        $this->form_validation->set_message('change_password', 'Votre nouveau mot de passe ne correspond pas avec sa confirmation');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('change_password', 'Vous devez reseigner un nouveau mot de passe');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('change_password', 'Votre mot de passe actuel est incorrect');
                return FALSE;
            }
        }
        return TRUE;
    }

    function check_email($email) {
        $this->db->select('id, email, pwd');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();
        $session_data = $this->session->userdata('logged_in');
        if ($query->num_rows() == 0 || $email == $session_data['username']) {
            return true;
        } else {
            $this->form_validation->set_message('check_email', 'Adresse mail déja utilisée');
            return false;
        }
    }

    function do_upload($field = 'userfile') {
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);

        $config['upload_path'] = './assets/image';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $result['id'];


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $result['error'] = $this->upload->display_errors();
            $result['title'] = 'Open-Note - Profil';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'profil_view';
            // On choisit la sidebar
            $result['sidebar'] = 'profil';

            // on charge la page dans le template
            $this->load->view('templates/template', $result);
        } else {
            $image_data = $this->upload->data();
            $data = array('avatar' => $image_data['file_name']);

            $where = "id = " . $session_data['id'];

            $str = $this->db->update_string('user', $data, $where);
            $this->db->query($str);

            //resize
            $resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $resize['maintain_ratio'] = FALSE;
            $resize['width'] = 300;
            $resize['height'] = 300;

            $this->load->library('image_lib', $resize);
            if ($this->image_lib->resize()) {
                $result['error'] = $this->image_lib->display_errors();

                $result['title'] = 'Open-Note - Profil';
                $result['description'] = 'La description de la page pour les moteurs de recherche';
                $data['keywords'] = 'les, mots, clés, de, la, page';
                // TEST Affichage date
                setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

                $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

                // on choisit la view qui contient le corps de la page
                $result['contents'] = 'profil_view';
                // On choisit la sidebar
                $result['sidebar'] = 'profil';

                // on charge la page dans le template
                $this->load->view('templates/template', $result);
            }

            redirect('profil', 'refresh');
        }
    }

    function my_category() {
        if(!is_numeric($this->input->get('id')))
        {
            redirect('accueil','refresh');
        }
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);

        $result['title'] = 'Open-Note - Profil';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'profil_my_category_view';
        // On choisit la sidebar
        $result['sidebar'] = 'profil';

        $category = $this->category_model->get_cat(mysql_real_escape_string($this->input->get('id')));
        foreach ($category as $cat) {
            $result['cat_name'] = $cat['name'];
            $result['cat_id'] = $cat['id'];
            $result['cat_parent_id'] = $cat['parent_id'];
        }



        // on charge la page dans le template
        $this->load->view('templates/template', $result);
    }

    function other_category() {
        if(!is_numeric($this->input->get('id')))
        {
            redirect('accueil','refresh');
        }
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);

        $result['title'] = 'Open-Note - Profil';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'profil_other_category_view';
        // On choisit la sidebar
        $result['sidebar'] = 'profil';

        $category = $this->category_model->get_cat(mysql_real_escape_string($this->input->get('id')));
        foreach ($category as $cat) {
            $result['cat_name'] = $cat['name'];
            $result['cat_id'] = $cat['id'];
            $result['cat_parent_id'] = $cat['parent_id'];
        }



        // on charge la page dans le template
        $this->load->view('templates/template', $result);
    }

    function ask_cat() {
        $this->form_validation->set_rules('editor1', 'message', 'trim|required|callback_check_ask');
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli


            $result['title'] = 'Open-Note - Profil';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'profil_other_category_view';
            // On choisit la sidebar
            $result['sidebar'] = 'profil';

            $category = $this->category_model->get_cat($this->input->post('cat_id'));
            foreach ($category as $cat) {
                $result['cat_name'] = $cat['name'];
                $result['cat_id'] = $cat['id'];
                $result['cat_parent_id'] = $cat['parent_id'];
            }



            // on charge la page dans le template
            $this->load->view('templates/template', $result);
        } else {
            //form bien rempli
            $sql = "INSERT INTO cat_subscription (cat_id, user_id, motivation) VALUES (" . $this->input->post('cat_id') . ", " . $result['id'] . " ,'" . $this->input->post('editor1') . "');";
            $this->db->query($sql);


            $result['title'] = 'Open-Note - Profil';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'profil_view';
            // On choisit la sidebar
            $result['sidebar'] = 'profil';

            $result['message'] = '<div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Votre demande a bien été envoyé.
                            </div>';
            $this->load->view('templates/template', $result);
        }
    }

    function check_ask() {
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);
        $this->db->select('*');
        $this->db->from('cat_subscription');
        $this->db->where('cat_id', $this->input->post('cat_id'));
        $this->db->where('user_id', $result['id']);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return true;
        } else {
            $this->form_validation->set_message('check_ask', 'Vous avez déjà effectué une demande pour cette catégorie.');
            return false;
        }
    }

    function delink_cat() {
        $session_data = $this->session->userdata('logged_in');
        $result = $this->user->user_data($session_data['id']);
        $sql = "DELETE FROM cat_perm WHERE cat_id = ".$this->input->post('cat_id')." AND user_id = ".$result['id']."";
        $this->db->query($sql);
        
        $result['title'] = 'Open-Note - Profil';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'profil_view';
        // On choisit la sidebar
        $result['sidebar'] = 'profil';

        $result['message'] = '<div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Votre demande a été traitée avec succès.
                            </div>';
        $this->load->view('templates/template', $result);
    }

}
