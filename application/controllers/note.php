<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

class note extends CI_Controller {

    private $data = array();

    function __construct() {
        parent::__construct();

        $this->load->model('notes_model', '', TRUE);
        $this->load->model('comments_model', '', TRUE);
        $this->load->model('user', '', TRUE);

        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>');

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $this->data['id'] = $session_data['id'];
            $result = $this->user->user_data($this->data['id']);
            $this->data['name'] = $result['name'];
            $this->data['firstname'] = $result['firstname'];
            $this->data['pseudo'] = $result['pseudo'];
            $this->data['email'] = $result['username'];
            //affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
            $this->data['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function index() {

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        var_dump($this->notes_model->get_note_content(18));
    }

    function view($note_id) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->get('id') == '') {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $result = $this->user->user_data($data['id']);
            } else {
                if (!is_numeric($this->input->get('id'))) {
                    redirect('accueil', 'refresh');
                }
                $result = $this->user->user_data(mysql_real_escape_string($this->input->get('id')));
            }
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }

        // définition des données variables du template
        $result['title'] = 'Open-Note - Note';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'note_view';
        // On choisit la sidebar
        $result['sidebar'] = 'normal';

        // on charge la page dans le template
        $result['note'] = $this->notes_model->get_note_content($note_id);
        $result['rating'] = $this->notes_model->get_rating_note($note_id, $session_data['id']);
        $result['history'] = $this->notes_model->get_note_history($note_id);
        $this->load->view('templates/template', $result);
    }

    function view_diff($old_commit) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->get('id') == '') {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $result = $this->user->user_data($data['id']);
            } else {
                if (!is_numeric($this->input->get('id'))) {
                    redirect('accueil', 'refresh');
                }
                $result = $this->user->user_data(mysql_real_escape_string($this->input->get('id')));
            }
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        // définition des données variables du template
        $result['title'] = 'Open-Note - Note';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");
        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'history_view';
        // On choisit la sidebar
        $result['sidebar'] = 'normal';
        // on charge la page dans le template
        $result['note'] = $this->notes_model->get_note_content($this->input->post('note_id'));
        $result['commit_hash'] = $old_commit;
        $result['history'] = $this->notes_model->note_diff($this->input->post('note_id'), $old_commit);
        $this->load->view('templates/template', $result);
    }

    function like($note_id) {
        $session_data = $this->session->userdata('logged_in');
        $sql = "DELETE FROM rate WHERE note_id = " . $note_id . " AND user_id = " . $session_data['id'];
        $this->db->query($sql);

        $this->notes_model->rate_note($note_id, $session_data['id'], true);
        redirect('note/view/' . $note_id, 'refresh');
    }

    function unlike($note_id) {

        $session_data = $this->session->userdata('logged_in');
        $sql = "DELETE FROM rate WHERE note_id = " . $note_id . " AND user_id = " . $session_data['id'];
        $this->db->query($sql);
        $this->notes_model->rate_note($note_id, $session_data['id'], false);
        redirect('note/view/' . $note_id, 'refresh');
    }

    function sendComment($comment_id = null) {
        $this->form_validation->set_rules('comment', 'Commentaire', 'trim|required|xss_clean');
        $session_data = $this->session->userdata('logged_in');
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli
            $result['title'] = 'Open-Note - Note';
            $result['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // TEST Affichage date
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

            $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

            // on choisit la view qui contient le corps de la page
            $result['contents'] = 'note_view';
            // On choisit la sidebar
            $result['sidebar'] = 'normal';
            $result['note'] = $this->notes_model->get_note_content($this->input->post('note_id'));
            $result['rating'] = $this->notes_model->get_rating_note($this->input->post('note_id'), $session_data['id']);

            // on charge la page dans le template

            $this->load->view('templates/template', $result);
        } else {
            $this->comments_model->add_comment($this->input->post('comment'), $this->input->post('note_id'), $session_data['id'], $comment_id);
            redirect('note/view/' . $this->input->post('note_id'), 'refresh');
        }
    }

    function create_online($cat_id) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->get('id') == '') {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $result = $this->user->user_data($data['id']);
            } else {
                if (!is_numeric($this->input->get('id'))) {
                    redirect('accueil', 'refresh');
                }
                $result = $this->user->user_data(mysql_real_escape_string($this->input->get('id')));
            }
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }

        // définition des données variables du template
        $result['title'] = 'Open-Note - Création de note';
        $result['description'] = 'La description de la page pour les moteurs de recherche';
        $data['keywords'] = 'les, mots, clés, de, la, page';
        // TEST Affichage date
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

        $result['date'] = strftime("%a %d/%m/%Y &nbsp;&nbsp;");

        // on choisit la view qui contient le corps de la page
        $result['contents'] = 'note_create_online_view';
        // On choisit la sidebar
        $result['sidebar'] = 'normal';

        // on charge la page dans le template
        $result['cat_id'] = $cat_id;
        $result['category'] = $this->category_model->get_cat($cat_id);
        $this->load->view('templates/template', $result);
    }

    function apply_create_online() {
        $this->form_validation->set_rules('title', 'Titre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('note_content', 'Contenu de la note', 'required');
        $this->form_validation->set_rules('category', '', 'trim|required|xss_clean|call_back_check_cat'); //hidden fields

        if ($this->form_validation->run() == FALSE) {
            $this->create_online($this->input->post('category'));
        } else {
            $repo_path = 'assets/repo.d/' . sha1(bin2hex(openssl_random_pseudo_bytes(24)) . time()) . '/';
            $file_name = $this->input->post('title') . '.txt';

            //create note_file
            mkdir($repo_path);
            $note_file = fopen($repo_path . $file_name, 'w');
            fwrite($note_file, $this->input->post('note_content'));
            fclose($note_file);

            //create repository
            $note_id = $this->notes_model->create_note($this->data['id'], $this->data['pseudo'], $this->data['email'], $repo_path, $this->input->post('title'), $file_name, $this->input->post('category'));

            $this->view($note_id);
        }
    }

    function check_cat($cat_id) {
        /**
         *  call_back function to check if sessions_user is register inside cat_id given
         * 
         */
    }

    function create_by_upload($cat_id) {
        
    }

    function history($note_id) {
        
    }

    function revert_from_history($commit_id) {
        $commit = $this->notes_model->get_db_note_info($this->input->post('note_id'));
        $this->notes_model->revert_note($commit->path, $commit_id);
        redirect('note/view/' . $this->input->post('note_id'), 'refresh');
    }

    function modification() {
        $this->form_validation->set_rules('commentaire_modification', 'Commentaire modification', 'trim|required|xss_clean');
        $this->form_validation->set_rules('modification_note', 'modification', 'trim|required|callback_check_content');
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        if ($this->form_validation->run() == FALSE) {
            //form mal rempli
            $this->view($this->input->post('note_id'));
        } else {
            //form bien rempli
            $this->notes_model->modify_note($this->input->post('note_id'), $session_data['id'], $this->input->post('modification_note'), $this->input->post('commentaire_modification'));
            redirect('note/view/' . $this->input->post('note_id'), 'refresh');
        }
    }

    function check_content($modification_note) {
        $old_note = $this->notes_model->get_note_content($this->input->post('note_id'));
        $modification_note = explode(PHP_EOL, $modification_note);
        $diff = array_diff($modification_note, $old_note['note_content']);
        $diff2 = array_diff($old_note['note_content'], $modification_note);
        if (empty($diff) && empty($diff2)) {
            $this->form_validation->set_message('check_content', 'Vous n\'avez rien modifié');
            return false;
        } else {

            return true;
        }
    }

    function compare_with($commit_id) {
        
    }

}
