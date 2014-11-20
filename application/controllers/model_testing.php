<?php

class model_testing extends CI_Controller
{
    function index()
    {
        $this->load->model('comments_model');
        $tmp = $this->comments_model->get_note_comments(2);
        var_dump(empty($tmp[3]));
        echo '<pre>';
        print_r($tmp);
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

