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
    
    function test($arg1, $arg2)
    {
        echo $arg1;
        echo $arg2;
        echo '<br/>';
        echo time();
    }
    
    function test_note(){
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $this->load->model('notes_model', '', TRUE);
        
        var_dump($this->notes_model->get_note_content(17));
        
        $this->notes_model->modify_note(17, 4, 'get new content', 'test of modify_note function');
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
}


