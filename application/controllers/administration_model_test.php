<?php
if(defined('ENVIRONMENT') && ENVIRONMENT != 'development') 
    exit ('Developper access only, we are professional and we can\'t allow you to get this page');

class administration_model_test extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('administration_model', 'admin_model', true);
    }
    
    function index(){
//        echo '<pre>';
//        print_r($this->admin_model->get_all_user());
//        echo '<h1>Get category</h1>';
//        print_r($this->admin_model->get_all_category());
//        echo '<h1>Get all moderator</h1>';
//        $moderator = $this->admin_model->get_all_moderator();
//        print_r($moderator);
//        echo '</pre>';
//        echo 'test';
//        var_dump($this->admin_model->is_user_exist("jonathan.beersaerts1993@gmail.com"));
//        
//        var_dump($this->admin_model->get_all_top_level_cat());
    }
    
    
}
