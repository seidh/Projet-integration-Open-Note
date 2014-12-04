<?php

class model_testing extends CI_Controller
{
    function index()
    {
        $this->load->model('comments_model');
        $tmp = $this->comments_model->get_note_comments(18);
        var_dump(empty($tmp[3]));
        echo '<pre>';
        print_r($tmp);
        echo '<pre/><hr/>';
        $this->write_comments_r($tmp);
    }
    
    function test()
    {
                $this->load->model('administration_model');
                print_r($this->administration_model->get_all_notes());

    }
    
    function test_note(){
        echo '<pre>';
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $this->load->model('notes_model', '', TRUE);
        
        //var_dump($this->notes_model->get_note_content(17));
        //$this->notes_model->modify_note(17, 4, 'un truc random', 'test of modify_note function');
        var_dump($this->notes_model->get_note_history(17));
    }
    
    private function write_comments_r($comments)
    {
        
        if(is_array($comments)){
            foreach ($comments as $probably_comment) {
                
                echo '<div style="padding-left:30px;">';
                $this->write_comments_r($probably_comment);
                echo '</div>';
                
            }
        }
        elseif(is_object($comments))
        {
            /*
             *  [id] => 10
                [user_id] => 4
                [name] => Beersaerts
                [firstname] => Jonathan
                [parent_id] => 9
                [text] => Troisième lvl
                [note_id] => 18
                [creation_date] => 2014-12-01 16:51:45
             */
            echo $comments->id;
            echo $comments->name;
            echo $comments->creation_date;
            echo $comments->text."<br/>";
            
        }
    }
    
    function test_get_note_id_from_path()
    {
        echo '<pre>';
        $repo_path = 'assets/repo.d/jiksaa1417053582/';
        $db_result = $this->db->select('id')
                              ->from('note')
                              ->where('path', $repo_path)
                              ->limit(1)
                              ->get()
                              ->result();
        
        print_r($db_result);
    }
}


